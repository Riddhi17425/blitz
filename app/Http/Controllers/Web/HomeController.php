<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, SubCategory, Banner, BLog};

class HomeController extends Controller 
{ 
    public function index()   
    {
        $banners = Banner::whereNull('deleted_at')->where('status', 'Active')->get();
        $categories = Category::whereNull('deleted_at')->where('is_active', 1)->get();
        return view('front.home', compact('banners', 'categories'));
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

        return view('front.about',compact('metatitle','metadescription'));
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

    public function productList(){
        $metatitle="";
        $metadescription="";

        return view('front.product-list',compact('metatitle','metadescription'));
    }

    public function productDetails(){
        $metatitle="";
        $metadescription="";

        return view('front.product-details',compact('metatitle','metadescription'));
    }

    public function subCategoryList(){
        $metatitle="";
        $metadescription="";

        return view('front.sub-category-list',compact('metatitle','metadescription'));
    }

    public function contact()
    {
        $metatitle=""; 
        $metadescription="";

        return view('front.contact',compact('metatitle', 'metadescription'));
    }

    public function contactstore(Request $request)
    { 
       
        $post = new Contact;
        $post->name = $request->get('name');
        $post->email = $request->get('email');
        $post->number = $request->get('contact');
        $post->company_name = $request->get('company');
        $post->subject = $request->get('subject');
        $post->interested_in = $request->get('interest');
        $post->activity = $request->get('activity');
        $post->country = $request->get('country');
        $post->message = $request->get('message') ?? '';

        $post->save();
 
       return redirect()->route('thankyou')->with('success', 'Your message has been sent successfully.!');    
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
    
    // public function showCaptcha(Request $request)
    // {
    //     $width = 150;
    //     $height = 60;

    //     // Generate random captcha text
    //     $characters = '0123456789'; // Only numbers like in your image
    //     $captcha_text = '';
    //     for ($i = 0; $i < 4; $i++) { // 4 digits like your example
    //         $captcha_text .= $characters[rand(0, strlen($characters) - 1)];
    //     }
 
    //     // Store captcha in session
    //     session(['captcha_code' => $captcha_text]);
 
    //     // Create ImageManager with GD driver
    //     $manager = ImageManager::gd();
    //     $img = $manager->create($width, $height)->fill('#f8f8f8'); // Light gray background

    //     // Add colorful background dots
    //     $colors = ['#f0dcdbff', '#ceebf5ff', '#daf1daff', '#c5c1adff', '#e7c5e7ff', '#b8b59bff', '#cab6afff'];
        
    //     for ($i = 0; $i < 80; $i++) {
    //         $color = $colors[array_rand($colors)];
    //         $x = rand(0, $width);
    //         $y = rand(0, $height);
            
    //         // Create small circles instead of single pixels
    //         $img->drawCircle($x, $y, function ($circle) use ($color) {
    //             $circle->radius(rand(1, 3));
    //             $circle->background($color);
    //         });
    //     }
        
    //     // Add some subtle gray dots for texture
    //     for ($i = 0; $i < 30; $i++) {
    //         $img->drawPixel(rand(0, $width), rand(0, $height), '#e0e0e0');
    //     }

    //     // Add some very light noise lines
    //     for ($i = 0; $i < 3; $i++) {
    //         $img->drawLine(function($line) use ($width, $height) {
    //             $line->from(rand(0, $width), rand(0, $height))
    //                 ->to(rand(0, $width), rand(0, $height))
    //                 ->color('#eeeeee');
    //         });
    //     }

    //     // Add each digit with spacing like in your image
    //     $start_x = 20;
    //     $spacing = 35;
        
    //     for ($i = 0; $i < strlen($captcha_text); $i++) {
    //         $char = $captcha_text[$i];
    //         $x = $start_x + ($i * $spacing); 
            
    //         // Add slight random offset for each character
    //         $offset_x = rand(-3, 3);
    //         $offset_y = rand(-2, 2);
            
    //         $img->text($char, $x + $offset_x, 35 + $offset_y, function ($font) {
    //             $font->filename(public_path('front/font/Roboto-Black.ttf'));
    //             $font->size(28);
    //             $font->color('#666666'); // Dark gray text
    //             $font->align('center');
    //             $font->valign('center');
    //         });
    //     }
    //     return $img->toPng();
    // }

    // public function verifyCaptcha(Request $request)
    // {
    //     $userInput = $request->input('custom_captcha'); // value from input
    //     $captchaCode = session('captcha_code'); // value stored in session

    //     if ($userInput === $captchaCode) {
    //         return response()->json(['success' => true]);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Captcha incorrect']);
    //     }
    // }
    

}
