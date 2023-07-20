<?php

namespace App\Http\Controllers\index;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderNow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CheckoutNowController extends Controller
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
        $products = OrderNow::leftjoin('products', 'order_nows.product_id', '=', 'products.id')
            ->where('order_nows.user_id', $userId)
            // ->where('order_nows.id', $id)
            // ->where('products.slug', $slug)
            ->select('products.*', 'order_nows.id as order_id',  'order_nows.qty as order_qty', 'order_nows.size', 'order_nows.variant')
            ->get();

        $totals = OrderNow::leftjoin('products', 'order_nows.product_id', '=', 'products.id')
            ->where('order_nows.user_id', $userId)
            ->sum(DB::raw('products.price * order_nows.qty'));  

        // return $products;
        return view('index.checkout-now', $data, compact('products', 'totals', 'userAddress', 'product', 'categories'));
    }

    public function orderNowPlace(Request $req, $id)
    {
        $userId = auth()->user()->id;
        $allOrderNow = OrderNow::where('user_id', $userId)
        ->where('id', $id)
        ->get();
        foreach($allOrderNow as $orderNow){
            $order = new Order;
            $order->status_id = $req->status_id;
            $order->user_id = $orderNow['user_id'];
            $order->product_id = $orderNow['product_id'];
            $order->size = $orderNow['size'];
            $order->variant = $orderNow['variant'];
            $order->qty = $orderNow['qty'];
            $order->tanggal_order = Carbon::now()->format('Y-m-d H:i:s');
            $order['address'] = implode(", ", (array)$req->address);
            $order->profile_address = $req->profile_address;
            $order->notes = $req->notes;
            $order->payment_method = $req->payment_method;
            $order->rating = '0';
            $order->reviews = $req->reviews;
            $order->total_price = OrderNow::leftjoin('products', 'order_nows.product_id', '=', 'products.id')
                ->where('order_nows.id', $id)
                ->sum(DB::raw('products.price * order_nows.qty'));;
            $order->save();
            
            $product = Product::find($orderNow['product_id']);
            $product->qty = OrderNow::leftjoin('products', 'order_nows.product_id', '=', 'products.id')
                ->where('order_nows.id', $id)
                ->sum(DB::raw('products.qty - order_nows.qty'));;
            $product->save();

            DB::table('order_nows')->delete();
        }
        $req->input();
        // return $order;
        return redirect('/')->with('success', 'The Product has Successfully Ordered');
    }
}
