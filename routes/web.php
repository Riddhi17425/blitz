<?php

//=================Admin===============

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
//=================WEB=================    
use App\Http\Controllers\Web\HomeController;

 

    Route::get('/', [HomeController::class, 'index'])->name('front.home');
    Route::get('/about-us' , [HomeController::class , 'about'])->name('front.about');
    Route::get('/contact-us' , [HomeController::class , 'contact'])->name('front.contact');
    Route::post('/newsletter/subscribe', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
    Route::post('/contact/submit', [HomeController::class, 'submitContactInquiry'])->name('contact.submit');
    Route::get('/blogs' , [HomeController::class , 'blogs'])->name('front.blogs');
    Route::get('/blog/{url?}' , [HomeController::class , 'blogsDetails'])->name('front.blog.details');
    Route::get('/products/{cat_url}/{sub_cat_url}' , [HomeController::class , 'productList'])->name('front.product.list');
    Route::get('/product/{product_url}' , [HomeController::class , 'productDetails'])->name('front.product.details');
    Route::get('/category/{slug}' , [HomeController::class , 'categoryDetails'])->name('front.category.details');
    Route::get('/products/{id}/datasheet/download', [ProductController::class, 'downloadDatasheet'])->name('products.datasheet.download');

    // remaining pages
    Route::get('/thank-you' , [HomeController::class , 'thankYou'])->name('thankyou');
    Route::get('/privacy-policy' , [HomeController::class , 'privacy'])->name('front.privacy.policy');
    Route::get('/terms-condition' , [HomeController::class , 'termsCondition'])->name('front.terms.condition');
    
    
    Route::middleware('guest')->group(function(){
        Route::get('/register' , [LoginController::class , 'register_page'])->name('register');
        Route::post('/register' , [LoginController::class , 'register'])->name('admin.register');
        Route::get('/login',[LoginController::class , 'login_page'])->name('login'); 
        Route::Post('/login',[LoginController::class , 'login'])->name('admin.login'); 
    }); 
    
    // that is access for admin and super admin;
    Route::middleware(['auth' , 'role:admin,super_admin'])->prefix('admin')->group(function(){
        Route::get('/' , [DashboardController::class , 'index'])->name('dashboard');
        Route::post('/logout' , [LoginController::class , 'logout'])->name('logout');

    
        
        //testimonials 
        Route::get('/testimonials' , [TestimonialsController::class , 'index'])->name('testimonials');
        Route::get('/add/testimonials' , [TestimonialsController::class , 'create'])->name('testimonials.addtestimonials');
        Route::post('/testimonials/store' , [TestimonialsController::class , "Store"])->name('testimonials.store');
        Route::get("/get-testimonials-Data" , [TestimonialsController::class , "getData"])->name('gettestimonialsData');
        Route::get('/edit/testimonials/{id}' , [TestimonialsController::class , 'Edit'])->name('testimonials.edit');
        Route::delete("/delete/testimonials/{id}" , [TestimonialsController::class , 'Destory'])->name('testimonials.delete');
        Route::put('/update/testimonials/{id}' , [TestimonialsController::class , 'Update'])->name('testimonials.update');


        //banner
        Route::get('/banners' , [BannerController::class , 'index'])->name('banners');
        Route::get('/add/banners' , [BannerController::class , 'create'])->name('banners.create');
        Route::post('/banners/store' , [BannerController::class , "Store"])->name('banners.store');
        Route::get("/get-banners-Data" , [BannerController::class , "getData"])->name('getbannersData');
        Route::get('/edit/banners/{id}' , [BannerController::class , 'Edit'])->name('banners.edit');
        Route::delete("/delete/banners/{id}" , [BannerController::class , 'Destory'])->name('banners.delete');
        Route::put('/update/banners/{id}' , [BannerController::class , 'Update'])->name('banners.update');


        //Blogs 
        Route::get('/blogs' , [BlogsController::class , 'index'])->name('blogs');
        Route::get('/add/blogs' , [BlogsController::class , 'createBlogs'])->name('blogs.addBlogs');
        Route::post('/blogs/store' , [BlogsController::class , "BlogsStore"])->name('blogs.store');
        Route::get("/getBlogsData" , [BlogsController::class , "getBlogsData"])->name('getBlogsData');
        Route::get('/edit/blogs/{id}' , [BlogsController::class , 'EditBlogs'])->name('blogs.edit');
        Route::delete("/delete/blogs/{id}" , [BlogsController::class , 'DestoryBlogs'])->name('blogs.delete');
        Route::put('/update/blogs/{id}' , [BlogsController::class , 'UpdateBlogs'])->name('blogs.update');

        // Industries
        Route::get('/industries', [IndustryController::class, 'index'])->name('industries');
        Route::get('/add/industries', [IndustryController::class, 'create'])->name('industries.create');
        Route::post('/industries/store', [IndustryController::class, 'store'])->name('industries.store');
        Route::get('/edit/industries/{id}', [IndustryController::class, 'edit'])->name('industries.edit');
        Route::put('/update/industries/{id}', [IndustryController::class, 'update'])->name('industries.update');
        Route::delete('/delete/industries/{id}', [IndustryController::class, 'destroy'])->name('industries.delete');

        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
        Route::get('/add/categories', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/categories/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::patch('/categories/{id}/toggle-flag', [CategoryController::class, 'toggleFlag'])->name('categories.toggle_flag');
        Route::put('/update/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/delete/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');

        // Sub Categories
        Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub_categories');
        Route::get('/add/sub-categories', [SubCategoryController::class, 'create'])->name('sub_categories.create');
        Route::post('/sub-categories/store', [SubCategoryController::class, 'store'])->name('sub_categories.store');
        Route::get('/edit/sub-categories/{id}', [SubCategoryController::class, 'edit'])->name('sub_categories.edit');
        Route::patch('/sub-categories/{id}/toggle-flag', [SubCategoryController::class, 'toggleFlag'])->name('sub_categories.toggle_flag');
        Route::put('/update/sub-categories/{id}', [SubCategoryController::class, 'update'])->name('sub_categories.update');
        Route::delete('/delete/sub-categories/{id}', [SubCategoryController::class, 'destroy'])->name('sub_categories.delete');
        Route::get('/sub-categories/by-category/{categoryId}', [SubCategoryController::class, 'getByCategory'])->name('sub_categories.by_category');

        // FAQs
        Route::get('/faqs', [FaqController::class, 'index'])->name('faqs');
        Route::get('/add/faqs', [FaqController::class, 'create'])->name('faqs.create');
        Route::post('/faqs/store', [FaqController::class, 'store'])->name('faqs.store');
        Route::get('/edit/faqs/{id}', [FaqController::class, 'edit'])->name('faqs.edit');
        Route::put('/update/faqs/{id}', [FaqController::class, 'update'])->name('faqs.update');
        Route::delete('/delete/faqs/{id}', [FaqController::class, 'destroy'])->name('faqs.delete');

        // Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

        // Products
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('/add/products', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/edit/products/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::patch('/products/{id}/toggle-flag', [ProductController::class, 'toggleFlag'])->name('products.toggle_flag');
        Route::put('/update/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/delete/products/{id}', [ProductController::class, 'destroy'])->name('products.delete');

    });  
    

     
 

    // that is only for front-user  
    route::middleware(['auth' , 'role:sales'])->group(function(){
        route::get('/front-dashboard' , function() {
            return 'Front-user'; 
        });
        // route::post('/logout' , [LoginController::class , 'logout'])->name('logout');

    }); 
