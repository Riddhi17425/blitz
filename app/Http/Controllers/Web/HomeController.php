<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ContactInquiry;
use App\Models\Country;
use App\Models\Industry;
use App\Models\NewsletterInquiry;
use App\Models\Product;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $metaTitle        = "Electrical Protection Devices & Surge Protection Solutions | Blitz";
        $metaDescription  = "Blitz Energy offers IEC-compliant surge protection devices, MCBs, fuse terminals and fuse links for residential, industrial, commercial and solar applications.";
        $banners          = Banner::with('category')->whereNull('deleted_at')->where('status', 'Active')->get();
        $categories       = Category::whereNull('deleted_at')->where('is_active', 1)->get();
        $industries       = Industry::whereNull('deleted_at')->get();
        $testimonials     = Testimonial::whereNull('deleted_at')->where('status', 'Active')->get();
        $featuredProducts = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->with(['technicalSpecifications' => function ($query) {
                $query->where('is_show_on_list', 1);
            }])->take(4)->get();
        $countries = Country::orderBy('name')->get();

        return view('front.home', compact('banners', 'categories', 'industries', 'testimonials', 'featuredProducts', 'countries', 'metaTitle', 'metaDescription'));
    }

    public function thankYou()
    {
        $metaTitle       = "";
        $metaDescription = "";

        return view('front.thank-you', compact('metaTitle', 'metaDescription'));
    }

    public function about()
    {
        $metaTitle       = "About Us | Blitz";
        $metaDescription = "Blitz is a trusted provider of surge protection devices and electrical safety solutions, dedicated to reliable power system protection and innovation.";
        $settings        = Setting::first();

        return view('front.about', compact('metaTitle', 'metaDescription', 'settings'));
    }

    public function blogs()
    {
        $metaTitle       = "Blitz Blogs | Surge Protection & Electrical Safety Guides";
        $metaDescription = "Explore expert blogs on surge protection devices, lightning protection, electrical safety, installation guides, and industry insights from Blitz Energy India.";

        $blogs = Blog::wherenull('deleted_at')->where('status', 'Active')->orderBy('created_at', 'DESC')->get();
        return view('front.blogs', compact('metaTitle', 'metaDescription', 'blogs'));
    }

    public function blogsDetails($url = null)
    {
        $blog            = Blog::where('url', $url)->firstOrFail();
        $metaTitle       = $blog->meta_title;
        $metaDescription = $blog->meta_description;
        // $blog->blog_faq = $blog->blog_faq ? json_decode($blog->blog_faq) : "";

        return view('front.blog-details', compact('blog', 'metaTitle', 'metaDescription'));
    }

    public function productList(Request $request, $cat_url = null, $sub_cat_url = null)
    {
        $industries      = Industry::whereNull('deleted_at')->get();
        $category        = Category::whereNull('deleted_at')->where('is_active', 1)->where('category_url', $cat_url)->first();
        $subCategory     = SubCategory::whereNull('deleted_at')->where('is_active', 1)->where('category_id', $category->id)->where('sub_category_url', $sub_cat_url)->first();
        $products        = Product::with('technicalSpecifications')->whereNull('deleted_at')->where('is_active', 1)->where('sub_category_id', $subCategory->id)->where('category_id', $subCategory->category_id)->get();
        $metaTitle       = $subCategory->meta_title ?? '';
        $metaDescription = $subCategory->meta_description ?? '';

        return view('front.product-list', compact('metaTitle', 'metaDescription', 'industries', 'category', 'subCategory', 'products'));
    }

    public function productDetails(Request $request, $url = null)
    {
        $url = $url ?: $request->query('product');

        $product = Product::with(['category', 'subCategory', 'technicalSpecifications'])
            ->whereNull('deleted_at')
            ->where(function ($query) {
                $query->where('is_active', 1)->orWhereNull('is_active');
            })
            ->when($url, fn($query) => $query->where('product_url', $url))
            ->firstOrFail();

        $metaTitle       = $product->meta_title ?? $product->product_name ?? '';
        $metaDescription = $product->meta_description ?? '';

        $countries = Country::orderBy('name')->get();

        return view('front.product-details', compact('metaTitle', 'metaDescription', 'product', 'countries'));
    }

    public function categoryDetails($slug)
    {
        $category        = Category::whereNull('deleted_at')->where('category_url', $slug)->with('subCategories', 'products')->firstOrFail();
        $industries      = Industry::whereNull('deleted_at')->get();
        $metaTitle       = $category->meta_title ?? '';
        $metaDescription = $category->meta_description ?? '';

        return view('front.category-details', compact('metaTitle', 'metaDescription', 'category', 'industries'));
    }

    public function contact()
    {
        $metaTitle       = "Contact Us | Blitz";
        $metaDescription = "Get in touch with Blitz India for expert assistance on surge protection devices, MCBs, electrical safety products, and technical support.";

        $countries = Country::orderBy('name')->get();
        $products  = Product::whereNull('deleted_at')->orderBy('product_name')->get();

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

        $email   = $request->input('email');
        $inquiry = NewsletterInquiry::firstOrCreate(['email' => $email]);

        // STORE IN GOOGLE SHEETS
        $timestamp  = Carbon::now()->format('Y-m-d H:i:s');
        $sheetsData = [
            'email' => $inquiry->email ?? '',
            'date'  => $timestamp,
        ];
        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post('https://script.google.com/macros/s/AKfycbzkYnnaYKAhqv4kD7m7kGvXFsAbSefULOpCFNHHgK2Y1kRkgDr9gxx0NC7GHxUTKlPs/exec',
                $sheetsData
            );
        if ($response->failed()) {
            \Log::error('Google Sheet request failed: ' . $response->body());
        }

        return response()->json(['success' => true, 'message' => 'Subscribed successfully.']);
    }

    public function submitContactInquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'phone'               => 'required|string|max:20',
            'company'             => 'nullable|string|max:255',
            'country'             => 'required|string|max:255',
            'city'                => 'required_if:inquiry_type,page|nullable|string|max:255',
            'product'             => 'nullable|string|max:255',
            'requirement_details' => 'nullable|string',
            'inquiry_type'        => 'nullable|string|in:page,popup',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $submittedProduct = $request->input('product');
        $productForDb     = ($submittedProduct === 'Other') ? null : $submittedProduct;
        $productForSheet  = $submittedProduct;

        $inquiry = ContactInquiry::create([
            'name'                => $request->input('name'),
            'company'             => $request->input('company'),
            'email'               => $request->input('email'),
            'phone'               => $request->input('phone'),
            'country'             => $request->input('country'),
            'city'                => $request->input('city'),
            'product'             => $productForDb,
            'requirement_details' => $request->input('requirement_details'),
            'inquiry_type'        => $request->input('inquiry_type', 'page'),
        ]);

        $timestamp = Carbon::now()->format('Y-m-d H:i:s');

        $sheetsData = [
            'inquiry_type'        => $request->input('inquiry_type', 'page'),
            'date'                => $timestamp,
            'name'                => $inquiry->name ?? '',
            'company'             => $inquiry->company ?? '',
            'email'               => $inquiry->email ?? '',
            'phone'               => "'" . $inquiry->phone, // apostrophe still forces plain-text in Sheets
            'country'             => $inquiry->country ?? '',
            'city'                => $inquiry->city ?? '',
            'product'             => $productForSheet ?? '',
            'requirement_details' => $inquiry->requirement_details ?? '',
        ];

        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post('https://script.google.com/macros/s/AKfycbz2pP-5ZXlhDkyF0Eg3DOIbArsWXt15tDeX41JYelNbSGGeVyOVeyYDr1hZhvBMawpZ/exec',
                $sheetsData
            );

        if ($response->failed()) {
            \Log::error('Google Sheet request failed: ' . $response->body());
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Your inquiry has been submitted.']);
        }

        return redirect()->route('thankyou')->with('success', 'Your message has been sent successfully.');
    }

    public function privacy()
    {
        $metaTitle       = "";
        $metaDescription = "";

        return view('front.privacy-policy', compact('metaTitle', 'metaDescription'));
    }

    public function termsCondition()
    {
        $metaTitle       = "";
        $metaDescription = "";

        return view('front.terms-condition', compact('metaTitle', 'metaDescription'));
    }
}
