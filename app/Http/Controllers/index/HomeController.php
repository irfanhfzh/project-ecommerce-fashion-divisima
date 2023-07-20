<?php

namespace App\Http\Controllers\index;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Home - Laravel Irfan'
        ];

        if(request()->category) {
            $product = Product::with('category')->whereHas('category', function($query) {
                $query->where('slug', request()->category);
            })->get();
            $categories = Category::all();
        } else {
            $product = Product::where('featured', true)->take(8)->inRandomOrder()->get();
            $categories = Category::all();
        }

        $products = Product::where('featured', true)->take(8)->inRandomOrder()->get();

        return view('index.home', $data, compact('product', 'products', 'categories'));
    }

    public function templateIndex()
    {
        $data = [
            'title' => 'Home - Laravel Irfan'
        ];

        if(request()->category) {
            $product = Product::with('category')->whereHas('category', function($query) {
                $query->where('slug', request()->category);
            })->get();
            $categories = Category::all();
        } else {
            $product = Product::orderby('created_at', 'desc')->get();
            $categories = Category::all();
        }

        $products = Product::orderby('created_at', 'desc')->get();

        return view('index.layout.template', $data, compact('product', 'products', 'categories'));
    }
}
