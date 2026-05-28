<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::orderBy('created_at', 'desc')->get();
        return view('admin.sub_categories.index', compact('subCategories'));
    }

    public function create()
    {
        return view('admin.sub_categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_form' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'catalogue_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'list_img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img_title' => 'nullable|string|max:255',
            'cta_img_description' => 'nullable|string',
            'cta_icon.*' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_title.*' => 'nullable|string|max:255',
            'cta_description.*' => 'nullable|string',
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

            SubCategory::create([
                'title' => $request->title,
                'short_form' => $request->short_form,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'catalogue_pdf' => $cataloguePath,
                'list_img' => $listImage,
                'detail_img' => $detailImage,
                'cta_img' => $ctaImage,
                'cta_img_title' => $request->cta_img_title,
                'cta_img_description' => $request->cta_img_description,
                'cta_icon' => $ctaIcons,
                'cta_title' => $ctaTitles,
                'cta_description' => $ctaDescriptions,
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
        return view('admin.sub_categories.edit', compact('subCategory'));
    }

    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_form' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'catalogue_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'list_img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img_title' => 'nullable|string|max:255',
            'cta_img_description' => 'nullable|string',
            'cta_icon.*' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_title.*' => 'nullable|string|max:255',
            'cta_description.*' => 'nullable|string',
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

            // Cleanup old icons that are no longer used
            $oldIcons = $subCategory->cta_icon ?? [];
            $deletedIcons = array_diff($oldIcons, $ctaIcons);
            foreach ($deletedIcons as $delIcon) {
                if ($delIcon && File::exists(public_path('images/sub_category_cta_icons/' . $delIcon))) {
                    File::delete(public_path('images/sub_category_cta_icons/' . $delIcon));
                }
            }

            $subCategory->update([
                'title' => $request->title,
                'short_form' => $request->short_form,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'catalogue_pdf' => $cataloguePath,
                'list_img' => $listImage,
                'detail_img' => $detailImage,
                'cta_img' => $ctaImage,
                'cta_img_title' => $request->cta_img_title,
                'cta_img_description' => $request->cta_img_description,
                'cta_icon' => $ctaIcons,
                'cta_title' => $ctaTitles,
                'cta_description' => $ctaDescriptions,
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
}
