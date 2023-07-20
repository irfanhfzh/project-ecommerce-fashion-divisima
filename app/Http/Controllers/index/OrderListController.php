<?php

namespace App\Http\Controllers\index;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderListController extends Controller
{
    public function orderList(Request $request)
    {
        $data = [
            'title' => 'Order List - Laravel Irfan'
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
        
        $productGet = Product::orderby('created_at', 'desc')->take(4)->get();
        
        $userId = auth()->user()->id;
        $orders = Order::with('product')->where('orders.user_id', $userId)
            ->select('orders.*', 'orders.id as order_id')
            ->orderBy('orders.created_at', 'desc')
            ->paginate(4);
            
        // return $orders;
        return view('index.list-order', $data, compact('orders', 'productGet', 'product', 'categories'));
    }

    public function addRate(Request $req)
    {
        $addRate = Order::find($req->id);
        $addRate->rating = $req->rating;
        $addRate->reviews = $req->reviews;
        $addRate->save();

        return redirect('/')->with('success', 'The Product has Successfully Add Your Reviews');
    }
}
