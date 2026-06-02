<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTechnicalSpecification;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'subCategory'])->orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->orWhereNull('is_active')->orderBy('title')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'product_url' => $request->filled('product_url') ? Str::slug($request->product_url) : Str::slug($request->product_name),
        ]);

        $validator = Validator::make($request->all(), $this->productValidationRules($request));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $datasheetPath = null;
            if ($request->hasFile('datasheet') && $request->file('datasheet')->isValid()) {
                $datasheetPath = storeFileWithTimeId($request->file('datasheet'), 'files/product_datasheets');
            }

            $listImage = null;
            if ($request->hasFile('list_image') && $request->file('list_image')->isValid()) {
                $listImage = storeImageWithTimeId($request->file('list_image'), 'images/product_list_images');
            }

            $detailImages = [];
            if ($request->hasFile('detail_images')) {
                foreach ($request->file('detail_images') as $file) {
                    if ($file->isValid()) {
                        $detailImages[] = storeImageWithTimeId($file, 'images/product_detail_images');
                    }
                }
            }

            $product = Product::create([
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'product_name' => $request->product_name ?? null,
                'product_url' => $request->product_url ?? null,
                'product_modal' => $request->product_modal ?? null,
                'datasheet' => $datasheetPath,
                'description' => $request->description ?? null,
                'features' => $request->features ?? null,
                'list_image' => $listImage,
                'detail_images' => $detailImages,
                'meta_title' => $request->meta_title ?? null,
                'meta_description' => $request->meta_description ?? null,
                'is_featured' => $request->boolean('is_featured'),
                'is_active' => $request->has('is_active') ? $request->boolean('is_active') : true,
            ]);

            // Save Technical Specifications
            $specs = $request->specs ?? [];
            foreach ($specs as $spec) {
                if (!empty($spec['parameter']) || !empty($spec['specifications'])) {
                    $product->technicalSpecifications()->create([
                        'parameter' => $spec['parameter'] ?? null,
                        'specifications' => $spec['specifications'] ?? null,
                        'is_show_on_list' => isset($spec['is_show_on_list']) && $spec['is_show_on_list'] == '1' ? 1 : 0,
                    ]);
                }
            }

            return redirect()->route('products')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            Log::error('Product store failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to save product: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::with('technicalSpecifications')->findOrFail($id);
        $categories = Category::where('is_active', 1)->orWhereNull('is_active')->orderBy('title')->get();
        $subCategories = SubCategory::where('category_id', $product->category_id)
            ->where(function ($query) {
                $query->where('is_active', 1)->orWhereNull('is_active');
            })
            ->orderBy('title')
            ->get();
        return view('admin.products.edit', compact('product', 'categories', 'subCategories'));
    }

    public function downloadDatasheet($id)
    {
        $product = Product::findOrFail($id);

        if (!$product->datasheet || !Storage::disk('public')->exists($product->datasheet)) {
            return redirect()->back()->with('error', 'Datasheet file not found.');
        }

        $filePath = Storage::disk('public')->path($product->datasheet);
        $downloadName = $product->product_name
            ? Str::slug($product->product_name) . '-datasheet.pdf'
            : basename($product->datasheet);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $downloadName . '"'
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->merge([
            'product_url' => $request->filled('product_url') ? Str::slug($request->product_url) : Str::slug($request->product_name),
        ]);

        $validator = Validator::make($request->all(), $this->productValidationRules($request, false));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $datasheetPath = $product->datasheet;
            if ($request->hasFile('datasheet') && $request->file('datasheet')->isValid()) {
                if ($datasheetPath && Storage::disk('public')->exists($datasheetPath)) {
                    Storage::disk('public')->delete($datasheetPath);
                }
                $datasheetPath = storeFileWithTimeId($request->file('datasheet'), 'files/product_datasheets');
            }

            $listImage = $product->list_image;
            if ($request->hasFile('list_image') && $request->file('list_image')->isValid()) {
                if ($listImage && File::exists(public_path('images/product_list_images/' . $listImage))) {
                    File::delete(public_path('images/product_list_images/' . $listImage));
                }
                $listImage = storeImageWithTimeId($request->file('list_image'), 'images/product_list_images');
            }

            $detailImages = $product->detail_images ?? [];
            
            // Handle removed detail images
            $removedImages = $request->removed_detail_images ?? [];
            if (!empty($removedImages)) {
                foreach ($removedImages as $removedImg) {
                    if (File::exists(public_path('images/product_detail_images/' . $removedImg))) {
                        File::delete(public_path('images/product_detail_images/' . $removedImg));
                    }
                    if (($key = array_search($removedImg, $detailImages)) !== false) {
                        unset($detailImages[$key]);
                    }
                }
                $detailImages = array_values($detailImages);
            }

            // Handle new detail images (append to existing set)
            if ($request->hasFile('detail_images')) {
                foreach ($request->file('detail_images') as $file) {
                    if ($file->isValid()) {
                        $detailImages[] = storeImageWithTimeId($file, 'images/product_detail_images');
                    }
                }
            }

            $product->update([
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'product_name' => $request->product_name,
                'product_url' => $request->product_url,
                'product_modal' => $request->product_modal,
                'datasheet' => $datasheetPath,
                'description' => $request->description,
                'features' => $request->features,
                'list_image' => $listImage,
                'detail_images' => $detailImages,
                'is_featured' => $request->boolean('is_featured'),
                'is_active' => $request->boolean('is_active'),
                'meta_title' => $request->meta_title ?? null,
                'meta_description' => $request->meta_description ?? null,
            ]);

            // Sync Technical Specifications (Delete old ones and save new list)
            $product->technicalSpecifications()->delete();
            $specs = $request->specs ?? [];
            foreach ($specs as $spec) {
                if (!empty($spec['parameter']) || !empty($spec['specifications'])) {
                    $product->technicalSpecifications()->create([
                        'parameter' => $spec['parameter'] ?? null,
                        'specifications' => $spec['specifications'] ?? null,
                        'is_show_on_list' => isset($spec['is_show_on_list']) && $spec['is_show_on_list'] == '1' ? 1 : 0,
                    ]);
                }
            }

            return redirect()->route('products')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            Log::error('Product update failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        try {
            // Delete datasheet
            if ($product->datasheet && Storage::disk('public')->exists($product->datasheet)) {
                Storage::disk('public')->delete($product->datasheet);
            }

            // Delete list image
            if ($product->list_image && File::exists(public_path('images/product_list_images/' . $product->list_image))) {
                File::delete(public_path('images/product_list_images/' . $product->list_image));
            }

            // Delete detail images
            if (!empty($product->detail_images)) {
                foreach ($product->detail_images as $oldImg) {
                    if (File::exists(public_path('images/product_detail_images/' . $oldImg))) {
                        File::delete(public_path('images/product_detail_images/' . $oldImg));
                    }
                }
            }

            // Deleting the product will automatically cascade-delete specifications due to DB foreign key cascade delete.
            $product->delete();

            return redirect()->route('products')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Product delete failed: ' . $e->getMessage());
            return redirect()->route('products')->with('error', 'Failed to delete product.');
        }
    }

    public function toggleFlag(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'field' => 'required|in:is_featured,is_active',
            'value' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid request.'], 422);
        }

        $product = Product::findOrFail($id);
        $product->update([
            $request->field => $request->boolean('value'),
        ]);

        return response()->json(['success' => true, 'message' => 'Product updated successfully.']);
    }

    private function productValidationRules(Request $request, bool $isCreate = true): array
    {
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => [
                'nullable',
                Rule::exists('sub_categories', 'id')->where(function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                }),
            ],
            'product_name' => 'required|string|max:255',
            'product_url' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'product_modal' => 'required|string|max:255',
            'datasheet' => 'nullable|file|mimes:pdf|max:10240',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ];

        if ($isCreate) {
            $rules['list_image'] = 'required|file|image|mimes:jpg,jpeg,png,webp|max:2048';
            $rules['detail_images'] = 'required|array|min:1';
            $rules['detail_images.*'] = 'file|image|mimes:jpg,jpeg,png,webp|max:2048';
        } else {
            $rules['list_image'] = 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048';
            $rules['detail_images'] = 'nullable|array';
            $rules['detail_images.*'] = 'file|image|mimes:jpg,jpeg,png,webp|max:2048';
        }

        return $rules;
    }
}
