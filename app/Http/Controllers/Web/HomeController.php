<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\{Category, SubCategory, Banner, BLog, NewsletterInquiry, ContactInquiry, Product, Country, Industry, Testimonial, Setting};

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

    public function Thankyou()
    {
        $metatitle = "";
        $metadescription = "";

        return view('front.thank-you',compact('metatitle','metadescription'));
    } 

    public function about()
    {
       $metatitle="";
       $metadescription=""; 
       $settings = Setting::first();

        return view('front.about',compact('metatitle','metadescription','settings'));
    }

    public function blogs()
    {
        $metatitle= "";
        $metadescription= "";
        
        $blogdata = Blog::wherenull('deleted_at')->get();
        return view('front.blogs',compact('metatitle','metadescription','blogdata'));
    }

    public function blogsDetails($url) 
    {
        $blogdetail = Blog::whereNull('deleted_at')->where('url', $url)->first();

        $metatitle = $blogdetail->meta_metatitle ?? '';
        $metadescription = $blogdetail->meta_metadescription ?? '';

        return view('front.blog-details',compact('metatitle','metadescription','blogdetail'));
    }

    public function productList(Request $request){
        $metatitle="";
        $metadescription="";
        $industries = Industry::whereNull('deleted_at')->get();
        $category = Category::whereNull('deleted_at')
            ->where(function ($query) {
                $query->where('is_active', 1)->orWhereNull('is_active');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category_url', $request->category);
            }, function ($query) {
                $query->where(function ($query) {
                    $query->whereNotNull('faq_title')
                        ->orWhereNotNull('faq_description')
                        ->orWhereNotNull('faqs');
                });
            })
            ->orderBy('created_at')
            ->first();

        return view('front.product-list',compact('metatitle','metadescription', 'industries', 'category'));
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

        $metatitle = $product->meta_title ?? $product->product_name ?? '';
        $metadescription = $product->meta_description ?? '';

        return view('front.product-details',compact('metatitle','metadescription','product'));
    }

    public function categoryDetails($slug){
        $category = Category::whereNull('deleted_at')
            ->where(function ($query) {
                $query->where('is_active', 1)->orWhereNull('is_active');
            })
            ->where('category_url', $slug)
            ->firstOrFail();
        $industries = Industry::whereNull('deleted_at')->get();
        $metatitle = $category->meta_title ?? '';
        $metadescription = $category->meta_description ?? '';

        return view('front.category-details',compact('metatitle','metadescription','category', 'industries'));
    }

    public function contact()
    {
        $metatitle=""; 
        $metadescription="";

        $countries = Country::orderBy('name')->get();
        $products = Product::whereNull('deleted_at')->orderBy('product_name')->get();

        return view('front.contact', compact('metatitle', 'metadescription', 'countries', 'products'));
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
            // if ($request->ajax()) {
            //     return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            // }
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

        // Send to Google Sheets if webhook provided
        $webhook = env('GOOGLE_SHEETS_WEBHOOK_URL');
        if ($webhook) {
            try {
                Http::post($webhook, [
                    'type' => 'contact',
                    'payload' => $inquiry->toArray(),
                ]);
            } catch (\Exception $e) {
                // ignore failures
            }
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Your inquiry has been submitted.']);
        }

        return redirect()->route('thankyou')->with('success', 'Your message has been sent successfully.');
    }

    public function privacy()
    {
        $metatitle="";
        $metadescription="";

        return view('front.privacy-policy', compact('metatitle','metadescription'));
    }

    public function termsCondition()
    { 
        $metatitle="";
        $metadescription="";
        
        return view('front.terms-condition', compact('metatitle','metadescription'));
    }
}
