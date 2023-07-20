<?php

namespace App\Http\Controllers\index;

use App\Models\Cart;
use App\Models\Size;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderNow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DetailProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function show($id, $slug)
    {
        $title = [
            'title' => 'Detail Product - Laravel Irfan'
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

        // $sizes = Size::get();
        $productGet = Product::orderby('created_at', 'desc')->take(4)->get();

        // $userId = auth()->user()->id;
        $orderGet = Order::leftjoin('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.product_id', $id)
            ->paginate(5);
            
        // $averageRate = DB::select("SELECT AVG(rating) FROM orders WHERE product_id = $id AND rating != 0");
        $averageRate = DB::table('orders')
            ->where('orders.product_id', $id)
            ->where('orders.rating', '!=', 0)
            ->avg('orders.rating'); 
        $round = round($averageRate, 2);

        $getRatingCountUser = $averageRate = DB::table('orders')
            ->where('orders.product_id', $id)
            ->where('orders.rating', '!=', 0)
            ->count(); 

        // $data = Product::where('slug', $slug)->get();
        $data = Product::where('slug', $slug)
            ->select('products.*', 'products.qty as product_qty')
            ->get();

        foreach($data as $productItem){
            if($productItem['qty'] == 0){
                $stockLevel = '<div class="badge badge-danger" style="padding: 5px; font-size: 80%;">Out of Stock</div>';
            } elseif($productItem['qty'] < 4 && $productItem['qty'] > 0) {
                $stockLevel = '<div class="badge badge-warning" style="padding: 5px; font-size: 80%;">Low Stock</div>';
            } else {
                $stockLevel = '<div class="badge badge-success" style="padding: 5px; font-size: 80%;">In Stock</div>';
            }
        }

        // return $averageRate;
        return view('index.detail-product', $title, compact('data', 'productGet', 'orderGet', 'round', 'stockLevel', 'averageRate', 'getRatingCountUser', 'product', 'categories'));
    }

    public function addToCart(Request $request)
    {
        $messages = [
            'unique' => 'The Product has already in your Cart',
        ];
        $this->validate($request, [
            'product_id' => 'required|unique:carts',
            'size' => 'required',
            'variant' => 'required',
            'qty' => 'required|integer',
        ], $messages);

        if(Auth::attempt($request->only('email', 'password'), $request->remember)){
            return redirect()->route('login');
        }else{
            if($request->submit == "addToCart"){
                $orderProduct = new Cart;
                $orderProduct->user_id = $request->user()->id;
                $orderProduct->product_id = $request->product_id;
                $orderProduct->size = $request->size;
                $orderProduct->variant = $request->variant;
                $orderProduct->qty = $request->qty;
                if($request->qty > $request->product_qty){
                    return Redirect::back()->withErrors('The Product Quantity do not have enough Items in stock');
                }
                $orderProduct->save();
                return redirect()->back()->with('success', 'The Product has Successfully Add to Cart');
    
            }else if($request->submit == "orderNow"){
                DB::table('order_nows')->delete();
                $orderProduct = new OrderNow;
                $orderProduct->user_id = $request->user()->id;
                $orderProduct->product_id = $request->product_id;
                $orderProduct->size = $request->size;
                $orderProduct->variant = $request->variant;
                $orderProduct->qty = $request->qty;
                $orderProduct->save();
                return redirect()->route('checkout.now');
            }
        } 
    }

    static function cartItem()
    {
        $userId = auth()->id();
        return Cart::where('user_id', $userId)->count();
    }
}
