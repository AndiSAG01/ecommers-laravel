<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $categories = [
            'podMod' => [4],
            'liquid' => [2, 3]
        ];

        $products = [];
        foreach ($categories as $key => $categoryIds) {
            foreach ($categoryIds as $categoryId) {
                $products[$key][$categoryId] = Product::where('category_id', $categoryId)
                    ->orderBy('created_at', 'DESC')
                    ->where('status', 1)
                    ->paginate(10);
            }
        }
        return view('frontend.pages.home.index', compact('products'));
    }

    public function shop()
    {
        $product = Product::orderBy('created_at', 'DESC')->paginate(12);
        return view('frontend.pages.product.shop', compact('product'));
    }

    public function categoryProduct($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if($category) {
            $product = $category->product()->orderBy('created_at', 'DESC')->paginate(12);
            return view('frontend.pages.product.category', compact('category', 'product'));
        }
    }

    public function colorProduct($color)
    {
        $colors = explode(',', $color);
        $colors = array_map('trim', $colors);

        $product = Product::where(function ($query) use ($colors) {
            foreach ($colors as $color) {
                $query->orWhere('color', 'like', "%{$color}%");
            }
        })->orderBy('created_at', 'DESC')->paginate(12);
        return view('frontend.pages.product.color', compact('colors', 'product'));
    }

    public function searchProduct(Request $request)
    {
        $searchTerm = $request->query('q');
        $product = Product::where('status', 1)->with(['category'])
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('slug', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('color', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('nicotine', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('price', 'LIKE', '%' . $searchTerm . '%');
            })->orderBy('id', 'DESC')->paginate(9);

        return view('frontend.pages.product.shop', compact('product'));
    }

    public function show($slug)
    {
        $product = Product::with(['category'])->where('slug', $slug)->first();
        return view('frontend.pages.product.index', compact('product'));
    }
}
