<?php

//=================Admin===============

use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BlogsController; 
use App\Http\Controllers\Admin\TestimonialsController;
//=================WEB=================    
use App\Http\Controllers\Web\HomeController;

 

    Route::get('/', [HomeController::class, 'index'])->name('front.home');
    Route::get('/about-us' , [HomeController::class , 'About'])->name('front.about');
    Route::get('/contact' , [HomeController::class , 'Contact'])->name('front.contact');
    Route::get('/blogs' , [HomeController::class , 'Blogs'])->name('front.blogs');
    route::get('/blogs/{url}' , [HomeController::class , 'BlogsDetails'])->name('front.blog.details');

    route::get('/thank-you' , [HomeController::class , 'Thankyou'])->name('thankyou');
    
    Route::get('/privacy-policy' , [HomeController::class , 'privacy'])->name('front.privacy.policy');
    Route::get('/terms-condition' , [HomeController::class , 'termscondition'])->name('front.terms.condition');
    
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

    });  
    

     
 

    // that is only for front-user  
    route::middleware(['auth' , 'role:sales'])->group(function(){
        route::get('/front-dashboard' , function() {
            return 'Front-user'; 
        });
        // route::post('/logout' , [LoginController::class , 'logout'])->name('logout');

    }); 