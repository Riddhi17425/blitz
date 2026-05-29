<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductTechnicalSpecification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_modal' => 'required|string|max:255',
            'datasheet' => 'nullable|file|mimes:pdf|max:10240',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'list_image' => 'required|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_images' => 'required|array|min:1',
            'detail_images.*' => 'file|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

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
                'product_name' => $request->product_name,
                'product_modal' => $request->product_modal,
                'datasheet' => $datasheetPath,
                'description' => $request->description,
                'features' => $request->features,
                'list_image' => $listImage,
                'detail_images' => $detailImages,
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
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_modal' => 'required|string|max:255',
            'datasheet' => 'nullable|file|mimes:pdf|max:10240',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'list_image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_images' => 'nullable|array',
            'detail_images.*' => 'file|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

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
                'product_name' => $request->product_name,
                'product_modal' => $request->product_modal,
                'datasheet' => $datasheetPath,
                'description' => $request->description,
                'features' => $request->features,
                'list_image' => $listImage,
                'detail_images' => $detailImages,
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
}
