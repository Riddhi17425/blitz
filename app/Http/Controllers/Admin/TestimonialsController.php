<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Testimonial;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Str;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class TestimonialsController extends Controller
{
    public function index(){
        return view('admin.testimonials.index');
    }

    public function create(){
        return view('admin.testimonials.create'); 
    }

   public function Store(Request $request)
{
    // Validate input
    $validator = Validator::make($request->all(), [
        'testimonials_desc'    => 'required|string|max:500',
        'testimonials_title'   => 'required|string|max:255',
        'testimonials_status'  => 'nullable|in:Active,In-Active',
        'testimonials_alt'     => 'required|string|max:255',
        'testimonials_image'   => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
        'testimonials_locations' => 'required|string|max:255',
        'testimonials_star' => 'required|numeric|min:0|max:5',
    ]);
 
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Please fix the validation errors.');
    }

    try {
        

        $imagePath = '';
            
            // Handle image upload 
            if ($request->hasFile('testimonials_image') && $request->file('testimonials_image')->isValid()) {
                // Try with compression first
                $imagePath = storeImage($request->file('testimonials_image'), 'admin/testimonials');
                
                if (!$imagePath) {
                    return redirect()->back()
                        ->with('error', 'Failed to upload image. Please try again.')
                        ->withInput();
                }
            } 

        
        Testimonial::create([
            'title'       => $request->testimonials_title,
            'description' => $request->testimonials_desc,
            'status'      => $request->testimonials_status ?? 'Active',
            'alt_tag'     => $request->testimonials_alt,
            'image'       => $imagePath,
            'locations'   => $request->testimonials_locations,
            'star'        => $request->testimonials_star,
        ]);

        return redirect()->route('testimonials')->with('success', 'Record added successfully!');
    } catch (\Exception $e) {
        Log::error('testimonials Store Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to save: ' . $e->getMessage());
    }
}   

    public function getData()
    {
        $testimonials = Testimonial::whereNull('deleted_at')->get();
        return DataTables::of($testimonials)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                
                $editUrl = route('testimonials.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete_testimonials" data-id="' . $row->id . '">
                        <i class="icofont-ui-delete"></i>
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function Edit($id){
        $testimonials = Testimonial::find($id);
        return view('admin.testimonials.edit' , compact('testimonials'));
    }

    public function Destory($id){
        $testimonials = Testimonial::find($id);
        if(empty($testimonials)){
            return response()->json([
                'result' => false,
                "message" => "Testimonials Not Found."
            ]);
        }
        $testimonials->delete();
        return response()->json([
            'result' => true,
            'message' => "Data Deleted."
        ]);
    }


    public function Update(Request $request, $id)
    {
        // 1. Validate the request
        $validator = Validator::make($request->all(), [
            'testimonials_desc'    => 'required|string|max:500',
            'testimonials_title'   => 'required|string|max:255',
            'testimonials_status'  => 'required|in:Active,In-Active',
            'testimonials_alt'     => 'required|string|max:255',
            'testimonials_image'   => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'testimonials_locations' => 'required|string|max:255',
            'testimonials_star' => 'required|numeric|min:0|max:5',
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
            $testimonials = Testimonial::findOrFail($id);

            $imagePath = $testimonials->image;
            // Handle image upload 
            if ($request->hasFile('testimonials_image') && $request->file('testimonials_image')->isValid()) {
                // Delete old image from public folder
                if (!empty($testimonials->image) && File::exists(public_path('admin/testimonials/' . $testimonials->image))) {
                    File::delete(public_path('admin/testimonials/' . $testimonials->image));
                }

                $imagePath = storeImage($request->file('testimonials_image'), 'admin/testimonials');
                
                if (!$imagePath) {
                    return redirect()->back()
                        ->with('error', 'Failed to upload image. Please try again.')
                        ->withInput();
                }
            } 
            
            // 4. Update whychooseus data
            $testimonials->update([
                'title'       => $request->testimonials_title,
                'description' => $request->testimonials_desc,
                'status'      => $request->testimonials_status,
                'alt_tag'     => $request->testimonials_alt,
                'image'       => $imagePath,  
                'locations'   => $request->testimonials_locations,
                'star'        => $request->testimonials_star,
            ]);

            return redirect()->route('testimonials')->with('success', 'testimonials updated successfully!');
        } catch (\Exception $e) {
            Log::error('testimonials update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update testimonials: ' . $e->getMessage());
        }
    }

}
