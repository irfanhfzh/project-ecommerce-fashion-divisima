<?php

namespace App\Http\Controllers\index;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index(){
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

        $userAddress = User::get();
        $userId = auth()->user()->id;
        $products = Cart::leftjoin('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $userId)
            ->select('products.*', 'carts.id as cart_id', 'carts.qty as order_qty', 'carts.size', 'carts.variant')
            ->latest('carts.created_at', 'desc')
            ->get();

        $totals = Cart::leftjoin('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $userId)
            ->select('products.*', 'carts.id as cart_id')
            ->sum(DB::raw('products.price * carts.qty'));

        return view('index.checkout', $data, compact('products', 'totals', 'userAddress', 'product', 'categories'));
    }

    public function orderPlace(Request $req)
    {
        $userId = auth()->user()->id;
        $allCart = Cart::leftjoin('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $userId)
            ->select('products.*', 'carts.id as cart_id', 'carts.qty as order_qty', 'carts.size', 'carts.variant', 'carts.user_id as user_id')
            ->get();
        foreach($allCart as $cart){
            $order = new Order;
            $order->status_id = $req->status_id;
            $order->user_id = $cart['user_id'];
            $order->product_id = $cart['id'];
            $order->size = $cart['size'];
            $order->variant = $cart['variant'];
            $order->qty = $cart['order_qty'];
            $order->tanggal_order = Carbon::now()->format('Y-m-d H:i:s');
            $order['address'] = implode(", ", (array)$req->address);
            $order->profile_address = $req->profile_address;
            $order->notes = $req->notes;
            $order->payment_method = $req->payment_method;
            $order->rating = '0';
            $order->reviews = $req->reviews;
            $order->total_price = $cart['price'] * $cart['order_qty'];
            $order->save();

            $product = Product::find($cart['id']);
            $product->qty = $cart['qty'] - $cart['order_qty'];
            $product->save();

            Cart::where('user_id', $userId)->delete();
        }

        // return $order;
        return redirect('/')->with('success', 'The Product has Successfully Ordered');
    }

}
