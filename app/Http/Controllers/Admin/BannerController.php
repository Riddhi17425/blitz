<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Banner;
use App\Models\Category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Str;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    public function index(){
        return view('admin.banner.index');
    }

    public function create(){
        $categories = Category::orderBy('title')->get();
        return view('admin.banner.create', compact('categories')); 
    }

   public function Store(Request $request)
{
    // Validate input
    $validator = Validator::make($request->all(), [
        'category_id'      => 'required|exists:categories,id',
        'banners_desc'    => 'required|string|max:500',
        'banners_title'   => 'required|string|max:255',
        'banners_status'  => 'nullable|in:Active,In-Active',
        'banners_alt'     => 'required|string|max:255',
        'banners_image'   => 'required|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Please fix the validation errors.');
    }

    // try {
        $imagePath = '';
            // Handle image upload 
            if ($request->hasFile('banners_image') && $request->file('banners_image')->isValid()) {
                // Try with compression first
                $imagePath = storeImageWithTimeId($request->file('banners_image'), 'admin/banners');
                
                if (!$imagePath) {
                    return redirect()->back()
                        ->with('error', 'Failed to upload image. Please try again.')
                        ->withInput();
                }
            } 

        
        Banner::create([
            'category_id'  => $request->category_id,
            'title'       => $request->banners_title,
            'description' => $request->banners_desc,
            'status'      => $request->banners_status ?? 'Active',
            'alt_tag'     => $request->banners_alt,
            'image'       => $imagePath,
        ]);

        return redirect()->route('banners')->with('success', 'Record added successfully!');
    // } catch (\Exception $e) {
    //     Log::error('banners Store Error: ' . $e->getMessage());
    //     return redirect()->back()->with('error', 'Failed to save: ' . $e->getMessage());
    // }
}   

    public function getData()
    {
        $banners = Banner::with('category')->whereNull('deleted_at')->get();
        return DataTables::of($banners)
            ->addIndexColumn()
            ->addColumn('category_title', function ($row) {
                return $row->category->title ?? '-';
            })
            ->addColumn('action', function ($row) {
                
                $editUrl = route('banners.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete_banners" data-id="' . $row->id . '">
                        <i class="icofont-ui-delete"></i>
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function Edit($id){
        $banners = Banner::find($id);
        $categories = Category::orderBy('title')->get();
        return view('admin.banner.edit' , compact('banners', 'categories'));
    }

    public function Destory($id){
        $banners = Banner::find($id);
        if(empty($banners)){
            return response()->json([
                'result' => false,
                "message" => "Banners Not Found."
            ]);
        }
        $banners->delete();
        return response()->json([
            'result' => true,
            'message' => "Data Deleted."
        ]);
    }


    public function Update(Request $request, $id)
    {
        // 1. Validate the request
        $validator = Validator::make($request->all(), [
            'category_id'      => 'required|exists:categories,id',
            'banners_desc'    => 'required|string|max:500',
            'banners_title'   => 'required|string|max:255',
            'banners_status'  => 'required|in:Active,In-Active',
            'banners_alt'     => 'required|string|max:255',
            'banners_image'   => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please correct the highlighted errors.');
        }
 
        try {
            // 2. Find the whychooseus
            $banners = Banner::findOrFail($id);

            $imagePath = $banners->image;
            // Handle image upload 
            if ($request->hasFile('banners_image') && $request->file('banners_image')->isValid()) {
                // Delete old image from public folder
                if (!empty($banners->image) && File::exists(public_path('admin/banners/' . $banners->image))) {
                    File::delete(public_path('admin/banners/' . $banners->image));
                }

                $imagePath = storeImageWithTimeId($request->file('banners_image'), 'admin/banners');
                
                if (!$imagePath) {
                    return redirect()->back()
                        ->with('error', 'Failed to upload image. Please try again.')
                        ->withInput();
                }
            } 
            
            // 4. Update whychooseus data
            $banners->update([
                'category_id'  => $request->category_id,
                'title'       => $request->banners_title,
                'description' => $request->banners_desc,
                'status'      => $request->banners_status,
                'alt_tag'     => $request->banners_alt,
                'image'       => $imagePath,  
            ]);

            return redirect()->route('banners')->with('success', 'Banners updated successfully!');
        } catch (\Exception $e) {
            Log::error('banners update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update banners: ' . $e->getMessage());
        }
    }

}
