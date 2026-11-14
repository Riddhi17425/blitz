<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Blog;

class SitemapController extends Controller
{
    protected function xmlResponse(string $xml)
    {
        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    public function index()
    {
        $todayTime = now()->toAtomString();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // HOMEPAGE
        $xml .= '
        <url>
            <loc>' . route('front.home') . '</loc>
            <lastmod>' . $todayTime . '</lastmod>
            <priority>1.00</priority>
        </url>';

        // CATEGORIES
        $categories = Category::where('is_active', 1)
            ->whereNotNull('category_url')
            ->where('category_url', '!=', '')
            ->where('category_url', '!=', 'solar-accessories') // EXCLUDE ONLY THIS URL
            ->orderBy('updated_at', 'asc')
            ->get();

        foreach ($categories as $category)
        {
            $xml .= '
            <url>
                <loc>' . route('front.category.details', $category->category_url) . '</loc>
                <lastmod>' . optional($category->updated_at)->toAtomString() . '</lastmod>
                <priority>0.80</priority>
            </url>';
        }

        // SUB CATEGORIES
        $subCategories = SubCategory::with('category')
            ->where('is_active', 1)
            ->whereNotNull('sub_category_url')
            ->where('sub_category_url', '!=', '')
            ->orderBy('updated_at', 'asc')
            ->get();

        foreach ($subCategories as $subCategory)
        {
            if (!$subCategory->category || empty($subCategory->category->category_url))
            {
                continue;
            }

            $xml .= '
            <url>
                <loc>' . route('front.product.list', [
                    'cat_url' => $subCategory->category->category_url,
                    'sub_cat_url' => $subCategory->sub_category_url,
                ]) . '</loc>
                <lastmod>' . optional($subCategory->updated_at)->toAtomString() . '</lastmod>
                <priority>0.80</priority>
            </url>';
        }

        // PRODUCTS
        $products = Product::where('is_active', 1)
            ->whereNotNull('product_url')
            ->where('product_url', '!=', '')
            ->orderBy('updated_at', 'asc')
            ->get();

        foreach ($products as $product)
        {
            $xml .= '
            <url>
                <loc>' . route('front.product.details', $product->product_url) . '</loc>
                <lastmod>' . optional($product->updated_at)->toAtomString() . '</lastmod>
                <priority>0.80</priority>
            </url>';
        }

        // STATIC PAGES
        $staticPages = [
            route('front.about'),
            route('front.contact'),
            route('front.blogs'),
        ];

        foreach ($staticPages as $page)
        {
            $xml .= '
            <url>
                <loc>' . $page . '</loc>
                <lastmod>' . $todayTime . '</lastmod>
                <priority>0.60</priority>
            </url>';
        }

        // BLOGS
        $blogs = Blog::where('status', 'Active')
            ->whereNotNull('url')
            ->where('url', '!=', '')
            ->orderBy('updated_at', 'asc')
            ->get();

        foreach ($blogs as $blog)
        {
            $xml .= '
            <url>
                <loc>' . route('front.blog.details', $blog->url) . '</loc>
                <lastmod>' . optional($blog->updated_at)->toAtomString() . '</lastmod>
                <priority>0.60</priority>
            </url>';
        }

        $xml .= '</urlset>';
        return $this->xmlResponse($xml);
    }
}