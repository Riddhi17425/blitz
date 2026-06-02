<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\{Category, SubCategory, Banner, BLog, NewsletterInquiry, ContactInquiry, Product, Country, Industry, Testimonial, Setting};
use Carbon\Carbon;

class HomeController extends Controller 
{ 
    public function index()   
    {
        $banners = Banner::with('category')->whereNull('deleted_at')->where('status', 'Active')->get();
        $categories = Category::whereNull('deleted_at')->where('is_active', 1)->get();
        $industries = Industry::whereNull('deleted_at')->get();
        $testimonials = Testimonial::whereNull('deleted_at')->where('status', 'Active')->get();
        $featuredProducts = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->with(['technicalSpecifications' => function ($query) {
                $query->where('is_show_on_list', 1);
            }])->take(4)->get();
        $countries = Country::orderBy('name')->get();
        return view('front.home', compact('banners', 'categories', 'industries', 'testimonials', 'featuredProducts', 'countries'));
    }

    public function thankYou()
    {
        $metaTitle = "";
        $metaDescription = "";

        return view('front.thank-you',compact('metaTitle','metaDescription'));
    } 

    public function about()
    {
       $metaTitle="";
       $metaDescription=""; 
       $settings = Setting::first();

        return view('front.about',compact('metaTitle','metaDescription','settings'));
    }

    public function blogs()
    {
        $metaTitle= "";
        $metaDescription= "";
        
        $blogdata = Blog::wherenull('deleted_at')->get();
        return view('front.blogs',compact('metaTitle','metaDescription','blogdata'));
    }

    public function blogsDetails($url) 
    {
        $blogdetail = Blog::whereNull('deleted_at')->where('url', $url)->first();

        $metaTitle = $blogdetail->meta_metaTitle ?? '';
        $metaDescription = $blogdetail->meta_metaDescription ?? '';

        return view('front.blog-details',compact('metaTitle','metaDescription','blogdetail'));
    }

    public function productList(Request $request, $cat_url = null, $sub_cat_url = null){
        $metaTitle="";
        $metaDescription="";
        $industries = Industry::whereNull('deleted_at')->get();
        $category = Category::whereNull('deleted_at')->where('is_active', 1)->where('category_url', $cat_url)->first();
        $subCategory = SubCategory::whereNull('deleted_at')->where('is_active', 1)->where('category_id', $category->id)->where('sub_category_url', $sub_cat_url)->first();
        $products = Product::with('technicalSpecifications')->whereNull('deleted_at')->where('is_active', 1)->where('sub_category_id', $subCategory->id)->where('category_id', $subCategory->category_id)->get();

        return view('front.product-list',compact('metaTitle','metaDescription', 'industries', 'category', 'subCategory', 'products'));
    }

    public function productDetails(Request $request, $url = null){
        $url = $url ?: $request->query('product');

        $product = Product::with(['category', 'subCategory', 'technicalSpecifications'])
            ->whereNull('deleted_at')
            ->where(function ($query) {
                $query->where('is_active', 1)->orWhereNull('is_active');
            })
            ->when($url, fn ($query) => $query->where('product_url', $url))
            ->firstOrFail();

        $metaTitle = $product->meta_title ?? $product->product_name ?? '';
        $metaDescription = $product->meta_description ?? '';
        
        $countries = Country::orderBy('name')->get();

        return view('front.product-details',compact('metaTitle','metaDescription','product', 'countries'));
    }

    public function categoryDetails($slug){
        $category = Category::whereNull('deleted_at')->where('category_url', $slug)->with('subCategories', 'products')->firstOrFail();
        $industries = Industry::whereNull('deleted_at')->get();
        $metaTitle = $category->meta_title ?? '';
        $metaDescription = $category->meta_description ?? '';

        return view('front.category-details',compact('metaTitle', 'metaDescription','category', 'industries'));
    }

    public function contact()
    {
        $metaTitle=""; 
        $metaDescription="";

        $countries = Country::orderBy('name')->get();
        $products = Product::whereNull('deleted_at')->orderBy('product_name')->get();

        return view('front.contact', compact('metaTitle', 'metaDescription', 'countries', 'products'));
    }

    public function subscribeNewsletter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $email = $request->input('email');

        $inquiry = NewsletterInquiry::firstOrCreate(['email' => $email]);

        // Send to Google Sheets if webhook provided
        $webhook = env('GOOGLE_SHEETS_WEBHOOK_URL');
        if ($webhook) {
            try {
                Http::post($webhook, [
                    'type' => 'newsletter',
                    'email' => $email,
                    'created_at' => now()->toDateTimeString()
                ]);
            } catch (\Exception $e) {
                // ignore
            }
        }

        return response()->json(['success' => true, 'message' => 'Subscribed successfully.']);
    }

    public function submitContactInquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'company' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'product' => 'nullable|string|max:255',
            'requirement_details' => 'nullable|string',
            'inquiry_type' => 'nullable|string|in:page,popup',
        ]);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $inquiry = ContactInquiry::create([
            'name' => $request->input('name'),
            'company' => $request->input('company'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'country' => $request->input('country'),
            'product' => $request->input('product'),
            'requirement_details' => $request->input('requirement_details'),
            'inquiry_type' => $request->input('inquiry_type', 'page'),
        ]);
        // STORE IN GOOGLE SHEETS
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        $sheetsData = [
            'name' => $inquiry->name ?? '',
            'company' => $inquiry->company ?? '',
            'email' => $inquiry->email ?? '',
            'phone' => $inquiry->phone ?? '',
            'country' => $inquiry->country ?? '',
            'product' => $inquiry->product ?? '',
            'requirement_details' => $inquiry->requirement_details ?? '',
            'inquiry_type' => $request->input('inquiry_type', 'page'),
            'date'      => $timestamp,
        ];
        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post('https://script.google.com/macros/s/AKfycbz2pP-5ZXlhDkyF0Eg3DOIbArsWXt15tDeX41JYelNbSGGeVyOVeyYDr1hZhvBMawpZ/exec', 
                $sheetsData
            );
        if ($response->failed()) {
            \Log::error('Google Sheet request failed: '.$response->body());
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Your inquiry has been submitted.']);
        }

        return redirect()->route('thankyou')->with('success', 'Your message has been sent successfully.');
    }

    public function privacy()
    {
        $metaTitle="";
        $metaDescription="";

        return view('front.privacy-policy', compact('metaTitle','metaDescription'));
    }

    public function termsCondition()
    { 
        $metaTitle="";
        $metaDescription="";
        
        return view('front.terms-condition', compact('metaTitle','metaDescription'));
    }
}
