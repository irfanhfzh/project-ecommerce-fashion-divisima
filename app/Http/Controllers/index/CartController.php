<?php

namespace App\Http\Controllers\index;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function cartList(Request $req)
    {
        $data = [
            'title' => 'Cart - Laravel Irfan'
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

        $products = Cart::leftjoin('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $userId)
            ->select('products.*', 'carts.id as cart_id', 'carts.qty as cart_qty', 'carts.size as cart_size', 'carts.variant as cart_variant', 'products.size', 'products.variant', 'products.qty as product_qty')
            ->orderBy('carts.created_at', 'desc')
            ->paginate(5);

        $totals = Cart::leftjoin('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $userId)
            ->select('products.*', 'carts.id as cart_id')
            ->sum(DB::raw('products.price * carts.qty'));    

        // return $editProductCart;
        return view('index.cart', $data, compact('products', 'productGet', 'totals', 'categories'));
    }

    public function cartEdit(Request $req)
    {
        $editCart = Cart::find($req->cart_id);
        $editCart->variant = $req->variantEdit;
        $editCart->qty = $req->qtyEdit;
        if($req->qtyEdit > $req->product_qty){
            return Redirect::back()->withErrors('The Product Quantity do not have enough Items in stock');
        }
        $editCart->size = $req->sizeEdit;
        $editCart->save();

        return redirect()->route('product.cart')->with('success','You have successfully Edit Cart Product!');
    }

    public function cartDelete($id)
    {
        DB::table('carts')->where('id', $id)->delete();

        return redirect()->route('product.cart')->with('delete','You have successfully Delete Cart Product!');
    }
}
