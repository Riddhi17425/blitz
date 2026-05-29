<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private const ASSOCIATION_MESSAGE = 'You cannot perform this action because this category is associated with sub-categories or products.';

    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'category_url' => $request->filled('category_url') ? Str::slug($request->category_url) : Str::slug($request->title),
        ]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_url' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'short_form' => 'required|string|max:255',
            'description' => 'required|string',
            'catalogue_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'list_img' => 'required|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_img' => 'required|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img_desktop' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img_mobile' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img_title' => 'nullable|string|max:255',
            'cta_img_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $cataloguePath = null;
            if ($request->hasFile('catalogue_pdf') && $request->file('catalogue_pdf')->isValid()) {
                $cataloguePath = storeFileWithTimeId($request->file('catalogue_pdf'), 'files/category_catalogues');
            }

            $listImage = null;
            if ($request->hasFile('list_img') && $request->file('list_img')->isValid()) {
                $listImage = storeImageWithTimeId($request->file('list_img'), 'images/category_list');
            }

            $detailImage = null;
            if ($request->hasFile('detail_img') && $request->file('detail_img')->isValid()) {
                $detailImage = storeImageWithTimeId($request->file('detail_img'), 'images/category_detail');
            }

            $ctaDesktop = null;
            if ($request->hasFile('cta_img_desktop') && $request->file('cta_img_desktop')->isValid()) {
                $ctaDesktop = storeImageWithTimeId($request->file('cta_img_desktop'), 'images/category_cta_desktop');
            }

            $ctaMobile = null;
            if ($request->hasFile('cta_img_mobile') && $request->file('cta_img_mobile')->isValid()) {
                $ctaMobile = storeImageWithTimeId($request->file('cta_img_mobile'), 'images/category_cta_mobile');
            }

            Category::create([
                'title' => $request->title,
                'category_url' => $request->category_url,
                'short_form' => $request->short_form,
                'description' => $request->description,
                'catalogue_pdf' => $cataloguePath,
                'list_img' => $listImage,
                'detail_img' => $detailImage,
                'cta_img_desktop' => $ctaDesktop,
                'cta_img_mobile' => $ctaMobile,
                'cta_img_title' => $request->cta_img_title,
                'cta_img_description' => $request->cta_img_description,
                'is_active' => 1,
            ]);

            return redirect()->route('categories')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            Log::error('Category store failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to save category: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->merge([
            'category_url' => $request->filled('category_url') ? Str::slug($request->category_url) : Str::slug($request->title),
        ]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_url' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'short_form' => 'required|string|max:255',
            'description' => 'required|string',
            'catalogue_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'list_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img_desktop' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img_mobile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_img_title' => 'nullable|string|max:255',
            'cta_img_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $cataloguePath = $category->catalogue_pdf;
            if ($request->hasFile('catalogue_pdf') && $request->file('catalogue_pdf')->isValid()) {
                if ($cataloguePath && Storage::disk('public')->exists($cataloguePath)) {
                    Storage::disk('public')->delete($cataloguePath);
                }
                $cataloguePath = storeFileWithTimeId($request->file('catalogue_pdf'), 'files/category_catalogues');
            }

            $listImage = $category->list_img;
            if ($request->hasFile('list_img') && $request->file('list_img')->isValid()) {
                if ($listImage && File::exists(public_path('images/category_list/' . $listImage))) {
                    File::delete(public_path('images/category_list/' . $listImage));
                }
                $listImage = storeImageWithTimeId($request->file('list_img'), 'images/category_list');
            }

            $detailImage = $category->detail_img;
            if ($request->hasFile('detail_img') && $request->file('detail_img')->isValid()) {
                if ($detailImage && File::exists(public_path('images/category_detail/' . $detailImage))) {
                    File::delete(public_path('images/category_detail/' . $detailImage));
                }
                $detailImage = storeImageWithTimeId($request->file('detail_img'), 'images/category_detail');
            }

            $ctaDesktop = $category->cta_img_desktop;
            if ($request->hasFile('cta_img_desktop') && $request->file('cta_img_desktop')->isValid()) {
                if ($ctaDesktop && File::exists(public_path('images/category_cta_desktop/' . $ctaDesktop))) {
                    File::delete(public_path('images/category_cta_desktop/' . $ctaDesktop));
                }
                $ctaDesktop = storeImageWithTimeId($request->file('cta_img_desktop'), 'images/category_cta_desktop');
            }

            $ctaMobile = $category->cta_img_mobile;
            if ($request->hasFile('cta_img_mobile') && $request->file('cta_img_mobile')->isValid()) {
                if ($ctaMobile && File::exists(public_path('images/category_cta_mobile/' . $ctaMobile))) {
                    File::delete(public_path('images/category_cta_mobile/' . $ctaMobile));
                }
                $ctaMobile = storeImageWithTimeId($request->file('cta_img_mobile'), 'images/category_cta_mobile');
            }

            $category->update([
                'title' => $request->title,
                'category_url' => $request->category_url,
                'short_form' => $request->short_form,
                'description' => $request->description,
                'catalogue_pdf' => $cataloguePath,
                'list_img' => $listImage,
                'detail_img' => $detailImage,
                'cta_img_desktop' => $ctaDesktop,
                'cta_img_mobile' => $ctaMobile,
                'cta_img_title' => $request->cta_img_title,
                'cta_img_description' => $request->cta_img_description,
            ]);

            return redirect()->route('categories')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            Log::error('Category update failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update category: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->hasAssociations()) {
            return redirect()->route('categories')->with('error', self::ASSOCIATION_MESSAGE);
        }
        try {
            if ($category->catalogue_pdf && Storage::disk('public')->exists($category->catalogue_pdf)) {
                Storage::disk('public')->delete($category->catalogue_pdf);
            }
            foreach (['list_img' => 'images/category_list/', 'detail_img' => 'images/category_detail/', 'cta_img_desktop' => 'images/category_cta_desktop/', 'cta_img_mobile' => 'images/category_cta_mobile/'] as $field => $folder) {
                if ($category->$field && File::exists(public_path($folder . $category->$field))) {
                    File::delete(public_path($folder . $category->$field));
                }
            }
            $category->delete();
            return redirect()->route('categories')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Category delete failed: ' . $e->getMessage());
            return redirect()->route('categories')->with('error', 'Failed to delete category.');
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

        $category = Category::findOrFail($id);

        if ($request->field === 'is_active' && $category->hasAssociations()) {
            return response()->json(['success' => false, 'message' => self::ASSOCIATION_MESSAGE], 422);
        }

        $category->update([
            $request->field => $request->boolean('value'),
        ]);

        return response()->json(['success' => true, 'message' => 'Category updated successfully.']);
    }
}
