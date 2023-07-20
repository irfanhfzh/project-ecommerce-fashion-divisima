<?php

namespace App\Http\Controllers\index;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Product - Laravel Irfan'
        ];

        $pagination = 12;
        $categories = Category::all();

        if(request()->category) {
            $product = Product::with('category')->whereHas('category', function($query) {
                $query->where('slug', request()->category);
            });
            $categoryName = $categories->where('slug', request()->category)->first()->nama;
        } else {
            $product = Product::take(12);
            $categoryName = "Featured Products";
        }

        if(request()->sort == 'low_high') {
            $product = $product->orderBy('price')->paginate($pagination);
        } elseif(request()->sort == 'high_low') {
            $product = $product->orderBy('price', 'desc')->paginate($pagination);
        } else {
            $product = $product->paginate($pagination);
        }

        return view('index.product', $data, compact('product', 'categories', 'categoryName'));
    }
}
