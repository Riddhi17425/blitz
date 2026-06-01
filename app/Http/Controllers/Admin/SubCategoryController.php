<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    private const ASSOCIATION_MESSAGE = 'You cannot perform this action because this sub-category is associated with products.';

    public function index()
    {
        $subCategories = SubCategory::with('category')->orderBy('created_at', 'desc')->get();
        return view('admin.sub_categories.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->orWhereNull('is_active')->orderBy('title')->get();
        return view('admin.sub_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'sub_category_url' => $request->filled('sub_category_url') ? Str::slug($request->sub_category_url) : Str::slug($request->title),
        ]);

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'sub_category_url' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'short_form' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'catalogue_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'list_img' => 'required|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_img' => 'required|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img_title' => 'nullable|string|max:255',
            'cta_img_description' => 'nullable|string',
            'faq_title' => 'nullable|string|max:255',
            'faq_description' => 'nullable|string',
            'cta_icon.*' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_title.*' => 'nullable|string|max:255',
            'cta_description.*' => 'nullable|string',
            'faqs_question.*' => 'nullable|string',
            'faqs_answer.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $cataloguePath = null;
            if ($request->hasFile('catalogue_pdf') && $request->file('catalogue_pdf')->isValid()) {
                $cataloguePath = storeFileWithTimeId($request->file('catalogue_pdf'), 'files/sub_category_catalogues');
            }

            $listImage = null;
            if ($request->hasFile('list_img') && $request->file('list_img')->isValid()) {
                $listImage = storeImageWithTimeId($request->file('list_img'), 'images/sub_category_list');
            }

            $detailImage = null;
            if ($request->hasFile('detail_img') && $request->file('detail_img')->isValid()) {
                $detailImage = storeImageWithTimeId($request->file('detail_img'), 'images/sub_category_detail');
            }

            $ctaImage = null;
            if ($request->hasFile('cta_img') && $request->file('cta_img')->isValid()) {
                $ctaImage = storeImageWithTimeId($request->file('cta_img'), 'images/sub_category_cta');
            }

            $ctaTitlesInput = $request->input('cta_title', []);
            $ctaDescriptionsInput = $request->input('cta_description', []);
            $ctaIconsFiles = $request->file('cta_icon', []);

            $ctaTitles = [];
            $ctaDescriptions = [];
            $ctaIcons = [];

            foreach ($ctaTitlesInput as $index => $title) {
                $ctaTitles[] = $title ?? '';
                $ctaDescriptions[] = $ctaDescriptionsInput[$index] ?? '';
                
                $iconName = null;
                if (isset($ctaIconsFiles[$index]) && $ctaIconsFiles[$index]->isValid()) {
                    $iconName = storeImageWithTimeId($ctaIconsFiles[$index], 'images/sub_category_cta_icons');
                }
                $ctaIcons[] = $iconName;
            }

                $faqs = [];
                $faqQs = $request->input('faqs_question', []);
                $faqAs = $request->input('faqs_answer', []);
                foreach ($faqQs as $i => $q) {
                    $question = trim($q ?? '');
                    $answer = trim($faqAs[$i] ?? '');
                    if ($question === '' && $answer === '') continue;
                    $faqs[] = ['question' => $question, 'answer' => $answer];
                }

            SubCategory::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'sub_category_url' => $request->sub_category_url,
                'short_form' => $request->short_form,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'catalogue_pdf' => $cataloguePath,
                'list_img' => $listImage,
                'detail_img' => $detailImage,
                'cta_img' => $ctaImage,
                'cta_img_title' => $request->cta_img_title,
                'cta_img_description' => $request->cta_img_description,
                'faq_title' => $request->faq_title,
                'faq_description' => $request->faq_description,
                'cta_icon' => $ctaIcons,
                'cta_title' => $ctaTitles,
                'cta_description' => $ctaDescriptions,
                'faqs' => $faqs,
                'is_active' => 1,
            ]);

            return redirect()->route('sub_categories')->with('success', 'Sub Category created successfully.');
        } catch (\Exception $e) {
            Log::error('SubCategory store failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to save sub category: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::where('is_active', 1)->orWhereNull('is_active')->orderBy('title')->get();
        return view('admin.sub_categories.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $request->merge([
            'sub_category_url' => $request->filled('sub_category_url') ? Str::slug($request->sub_category_url) : Str::slug($request->title),
        ]);

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'sub_category_url' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'short_form' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'catalogue_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'list_img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img_title' => 'nullable|string|max:255',
            'cta_img_description' => 'nullable|string',
            'faq_title' => 'nullable|string|max:255',
            'faq_description' => 'nullable|string',
            'cta_icon.*' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_title.*' => 'nullable|string|max:255',
            'cta_description.*' => 'nullable|string',
            'faqs_question.*' => 'nullable|string',
            'faqs_answer.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $cataloguePath = $subCategory->catalogue_pdf;
            if ($request->hasFile('catalogue_pdf') && $request->file('catalogue_pdf')->isValid()) {
                if ($cataloguePath && Storage::disk('public')->exists($cataloguePath)) {
                    Storage::disk('public')->delete($cataloguePath);
                }
                $cataloguePath = storeFileWithTimeId($request->file('catalogue_pdf'), 'files/sub_category_catalogues');
            }

            $listImage = $subCategory->list_img;
            if ($request->hasFile('list_img') && $request->file('list_img')->isValid()) {
                if ($listImage && File::exists(public_path('images/sub_category_list/' . $listImage))) {
                    File::delete(public_path('images/sub_category_list/' . $listImage));
                }
                $listImage = storeImageWithTimeId($request->file('list_img'), 'images/sub_category_list');
            }

            $detailImage = $subCategory->detail_img;
            if ($request->hasFile('detail_img') && $request->file('detail_img')->isValid()) {
                if ($detailImage && File::exists(public_path('images/sub_category_detail/' . $detailImage))) {
                    File::delete(public_path('images/sub_category_detail/' . $detailImage));
                }
                $detailImage = storeImageWithTimeId($request->file('detail_img'), 'images/sub_category_detail');
            }

            $ctaImage = $subCategory->cta_img;
            if ($request->hasFile('cta_img') && $request->file('cta_img')->isValid()) {
                if ($ctaImage && File::exists(public_path('images/sub_category_cta/' . $ctaImage))) {
                    File::delete(public_path('images/sub_category_cta/' . $ctaImage));
                }
                $ctaImage = storeImageWithTimeId($request->file('cta_img'), 'images/sub_category_cta');
            }

            $ctaTitlesInput = $request->input('cta_title', []);
            $ctaDescriptionsInput = $request->input('cta_description', []);
            $existingCtaIcons = $request->input('existing_cta_icon', []);
            $ctaIconsFiles = $request->file('cta_icon', []);

            $ctaTitles = [];
            $ctaDescriptions = [];
            $ctaIcons = [];

            foreach ($ctaTitlesInput as $index => $title) {
                $ctaTitles[] = $title ?? '';
                $ctaDescriptions[] = $ctaDescriptionsInput[$index] ?? '';
                
                // If a new icon is uploaded for this index
                if (isset($ctaIconsFiles[$index]) && $ctaIconsFiles[$index]->isValid()) {
                    $newIcon = storeImageWithTimeId($ctaIconsFiles[$index], 'images/sub_category_cta_icons');
                    $ctaIcons[] = $newIcon;
                } else {
                    // Keep the existing icon if it exists and wasn't replaced
                    $ctaIcons[] = $existingCtaIcons[$index] ?? null;
                }
            }

            $faqs = [];
            $faqQs = $request->input('faqs_question', []);
            $faqAs = $request->input('faqs_answer', []);
            foreach ($faqQs as $i => $q) {
                $question = trim($q ?? '');
                $answer = trim($faqAs[$i] ?? '');
                if ($question === '' && $answer === '') continue;
                $faqs[] = ['question' => $question, 'answer' => $answer];
            }

            // Cleanup old icons that are no longer used
            $oldIcons = $subCategory->cta_icon ?? [];
            $deletedIcons = array_diff($oldIcons, $ctaIcons);
            foreach ($deletedIcons as $delIcon) {
                if ($delIcon && File::exists(public_path('images/sub_category_cta_icons/' . $delIcon))) {
                    File::delete(public_path('images/sub_category_cta_icons/' . $delIcon));
                }
            }

            $subCategory->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'sub_category_url' => $request->sub_category_url,
                'short_form' => $request->short_form,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'catalogue_pdf' => $cataloguePath,
                'list_img' => $listImage,
                'detail_img' => $detailImage,
                'cta_img' => $ctaImage,
                'cta_img_title' => $request->cta_img_title,
                'cta_img_description' => $request->cta_img_description,
                'faq_title' => $request->faq_title,
                'faq_description' => $request->faq_description,
                'cta_icon' => $ctaIcons,
                'cta_title' => $ctaTitles,
                'cta_description' => $ctaDescriptions,
                'faqs' => $faqs,
            ]);

            return redirect()->route('sub_categories')->with('success', 'Sub Category updated successfully.');
        } catch (\Exception $e) {
            Log::error('SubCategory update failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update sub category: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        if ($subCategory->hasAssociations()) {
            return redirect()->route('sub_categories')->with('error', self::ASSOCIATION_MESSAGE);
        }
        try {
            if ($subCategory->catalogue_pdf && Storage::disk('public')->exists($subCategory->catalogue_pdf)) {
                Storage::disk('public')->delete($subCategory->catalogue_pdf);
            }

            foreach (['list_img' => 'images/sub_category_list/', 'detail_img' => 'images/sub_category_detail/', 'cta_img' => 'images/sub_category_cta/'] as $field => $folder) {
                if ($subCategory->$field && File::exists(public_path($folder . $subCategory->$field))) {
                    File::delete(public_path($folder . $subCategory->$field));
                }
            }

            if ($subCategory->cta_icon) {
                foreach ($subCategory->cta_icon as $icon) {
                    if ($icon && File::exists(public_path('images/sub_category_cta_icons/' . $icon))) {
                        File::delete(public_path('images/sub_category_cta_icons/' . $icon));
                    }
                }
            }

            $subCategory->delete();
            return redirect()->route('sub_categories')->with('success', 'Sub Category deleted successfully.');
        } catch (\Exception $e) {
            Log::error('SubCategory delete failed: ' . $e->getMessage());
            return redirect()->route('sub_categories')->with('error', 'Failed to delete sub category.');
        }
    }

    public function toggleFlag(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'field' => 'required|in:is_active',
            'value' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid request.'], 422);
        }

        $subCategory = SubCategory::findOrFail($id);

        if ($request->field === 'is_active' && $subCategory->hasAssociations()) {
            return response()->json(['success' => false, 'message' => self::ASSOCIATION_MESSAGE], 422);
        }

        $subCategory->update([
            $request->field => $request->boolean('value'),
        ]);

        return response()->json(['success' => true, 'message' => 'Sub category updated successfully.']);
    }

    public function getByCategory($categoryId)
    {
        $subCategories = SubCategory::where('category_id', $categoryId)
            ->where(function ($query) {
                $query->where('is_active', 1)->orWhereNull('is_active');
            })
            ->orderBy('title')
            ->get(['id', 'title']);

        return response()->json($subCategories);
    }
}
