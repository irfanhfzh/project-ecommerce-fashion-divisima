<?php

namespace App\Http\Controllers\index;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Contact - Laravel Irfan'
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
        
        return view('index.contact', $data, compact('product', 'categories'));
    }
}
