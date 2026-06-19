<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use App\Models\Category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Str;
use DataTables;
use Illuminate\Support\Facades\Log;

class BlogsController extends Controller
{
    public function index(){
        return view('admin.blogs.index');
    }

    public function createBlogs(){
        $categories = Category::orderBy('title')->get();
        return view('admin.blogs.create', compact('categories'));
    }

    public function BlogsStore(Request $request)
    {
        // dd($request->all());
        // Step 1: Validation
        $validator = Validator::make($request->all(), [
            'category_id'      => 'required|exists:categories,id',
            'title'               => 'required|string',
            'meta_title'               => 'required|string',
            'meta_description'               => 'required|string',
            'short_description' => 'nullable|string',
            'detail_description'  => 'nullable|string',
            'conclusion'          => 'nullable|string',
            'cta_link_url'            => 'required|string',
            'date'                => 'required',
            'url'                 => 'required|string',
            'front_image'         => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_image'        => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_image'           => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
            'status'              => 'required|in:Active,In-Active',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors.');
        }
        try {
            
            $frontImagePath = '';
            // Handle image upload 
            if ($request->hasFile('front_image') && $request->file('front_image')->isValid()) {
                // Try with compression first
                $frontImagePath = storeImage($request->file('front_image'), 'admin/blogs/front_image');
                
                if (!$frontImagePath) {
                    return redirect()->back()
                        ->with('error', 'Failed to upload image. Please try again.')
                        ->withInput();
                }
            }

            $detailImagePath = '';
            // Handle image upload 
            if ($request->hasFile('detail_image') && $request->file('detail_image')->isValid()) {
                // Try with compression first
                $detailImagePath = storeImage($request->file('detail_image'), 'admin/blogs/detail_image');
                
                if (!$detailImagePath) {
                    return redirect()->back()
                        ->with('error', 'Failed to upload image. Please try again.')
                        ->withInput();
                }
            }

            $ctaImagePath = '';
            // Handle image upload 
            if ($request->hasFile('cta_image') && $request->file('cta_image')->isValid()) {
                // Try with compression first
                $ctaImagePath = storeImage($request->file('cta_image'), 'admin/blogs/cta_image');
                
                if (!$ctaImagePath) {
                    return redirect()->back()
                        ->with('error', 'Failed to upload image. Please try again.')
                        ->withInput();
                }
            }

            $faqTitles = $request->faq_title ?? [];
            $faqDescriptions = $request->faq_description ?? [];
        
            $title_description = [];
            foreach ($faqTitles as $index => $title) {
                $title_description[] = [
                    'faq_title' => $title,
                    'faq_description' => $faqDescriptions[$index],
                ];
            }

            // Step 4: Store in DB
            Blog::create([
                'category_id'  => $request->category_id ?? null,
                'title'              => $request->title,
                'conclusion'         => $request->conclusion,
                'short_description'  => $request->short_description ?? NULL,
                'detail_description' => $request->detail_description ?? NULL,
                'date'               => date('Y-m-d', strtotime($request->input('date'))),
                'url'                => $request->url,
                'status'             => $request->status ?? 'Active',
                'front_image'        => $frontImagePath,
                'detail_image'       => $detailImagePath,
                'cta_image'          => $ctaImagePath,
                'cta_link_url'           => $request->cta_link_url,
                'meta_title'         => $request->meta_title,
                'meta_description'   => $request->meta_description,
                'front_image_alt'    => $request->front_image_alt,
                'detail_image_alt'   => $request->detail_image_alt,
                'cta_image_alt'      => $request->cta_image_alt,
                'schema_json'        => $request->schema_json,
                //'blog_faq'           => json_encode($title_description),
                'blog_faq'           => $title_description,
            ]); 
            return redirect()->route('blogs')->with('success', 'Blogs created successfully!');
        } catch (\Exception $e) {
            Log::error('BlogsStore error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create blogs: ' . $e->getMessage());
        }
    }

    public function getBlogsData()
    {
       $blogs = Blog::all();
         
        return DataTables::of($blogs)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                
                $editUrl = route('blogs.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete_blogs" data-id="' . $row->id . '">
                        <i class="icofont-ui-delete"></i>
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function EditBlogs($id){
        $blogs = Blog::find($id);
        $categories = Category::orderBy('title')->get();

        return view('admin.blogs.edit',compact('blogs', 'categories'));
    }

    public function DestoryBlogs($id){
        $blogs = Blog::find($id);
        if(empty($blogs)){
            return response()->json([
                'result' => false,
                "message" => "Product Not Found."
            ]);
        }
        $blogs->delete();
        return response()->json([
            'result' => true,
            'message' => "Data Deleted."
        ]);
    }


    public function UpdateBlogs(Request $request, $id) 
    {
        // Step 1: Validation
        $validator = Validator::make($request->all(), [
            'category_id'      => 'required|exists:categories,id',
            'title'               => 'required|string',
            'short_description'   => 'nullable|string',
            'detail_description'  => 'nullable|string',
            'conclusion'          => 'nullable|string',
            'cta_link_url'            => 'required|string',
            'date'                => 'required',
            'url'                 => 'required|string',
            'front_image'         => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_image'        => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_image'           => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'status'              => 'required|in:Active,In-Active',
            'meta_title'          => 'required|string',
            
            'meta_description'       => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // remove all HTML tags and whitespace
                    $plainText = trim(strip_tags($value));
                    if ($plainText === '') {
                        $fail("Meta Description cannot be blank.");
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
             
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors.');
        }

        try {
            // Step 2: Find existing record
            $blogs = Blog::findOrFail($id);

            $frontImagePath = $blogs->front_image;
            // Handle image upload 
            if ($request->hasFile('front_image') && $request->file('front_image')->isValid()) {
                // Try with compression first
                $frontImagePath = storeImage($request->file('front_image'), 'admin/blogs/front_image');
                
                if (!$frontImagePath) {
                    return redirect()->back()
                        ->with('error', 'Failed to upload image. Please try again.')
                        ->withInput();
                }
            }

            $detailImagePath = $blogs->detail_image;
            // Handle image upload 
            if ($request->hasFile('detail_image') && $request->file('detail_image')->isValid()) {
                // Try with compression first
                $detailImagePath = storeImage($request->file('detail_image'), 'admin/blogs/detail_image');
                
                if (!$detailImagePath) {
                    return redirect()->back()
                        ->with('error', 'Failed to upload image. Please try again.')
                        ->withInput();
                }
            }

            $ctaImagePath = $blogs->cta_image;
            // Handle image upload 
            if ($request->hasFile('cta_image') && $request->file('cta_image')->isValid()) {
                // Try with compression first
                $ctaImagePath = storeImage($request->file('cta_image'), 'admin/blogs/cta_image');
                
                if (!$ctaImagePath) {
                    return redirect()->back()
                        ->with('error', 'Failed to upload image. Please try again.')
                        ->withInput();
                }
            }

            $faqTitles = $request->faq_title ?? [];
            $faqDescriptions = $request->faq_description ?? [];
        
            $title_description = [];
            foreach ($faqTitles as $index => $title) {
                $title_description[] = [
                    'faq_title' => $title,
                    'faq_description' => $faqDescriptions[$index],
                ];
            }

            // Step 5: Update in DB 
            $blogs->update([
                'category_id'  => $request->category_id,
                'title'              => $request->title,
                'conclusion'         => $request->conclusion,
                'short_description'  => $request->short_description ?? NULL,
                'detail_description' => $request->detail_description ?? NULL,
                'date'               => date('Y-m-d', strtotime($request->input('date'))),
                'url'                => $request->url,
                'status'             => $request->status ?? 'Active',
                'front_image'        => $frontImagePath,
                'detail_image'       => $detailImagePath,
                'cta_image'          => $ctaImagePath,
                'cta_link_url'           => $request->cta_link_url,
                'meta_title'           => $request->meta_title,
                'meta_description'           => $request->meta_description,
                'front_image_alt'    => $request->front_image_alt,
                'detail_image_alt'   => $request->detail_image_alt,
                'cta_image_alt'      => $request->cta_image_alt,
                'schema_json'        => $request->schema_json,
                'blog_faq'           => $title_description,
                //'blog_faq'           => json_encode($title_description),
            ]);
            return redirect()->route('blogs')->with('success', 'Blogs updated successfully!');
        } catch (\Exception $e) {
            Log::error('BlogsUpdate error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update blogs: ' . $e->getMessage());
        }
    }

}
