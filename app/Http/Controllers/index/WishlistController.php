<?php

namespace App\Http\Controllers\index;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishList(Request $req)
    {
        $data = [
            'title' => 'Wishlist - Laravel Irfan'
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

        $productGet = Product::orderby('created_at', 'desc')->get();
        
        $userId = auth()->user()->id;
        $wishlists = Wishlist::with('product')->where('wishlists.user_id', $userId)
            ->select('wishlists.*', 'wishlists.id as wish_id')
            ->latest('wishlists.created_at', 'desc')
            ->get();
            
        // return $wishlists;
        return view('index.wishlist', $data, compact('wishlists', 'productGet', 'product', 'categories'));
    }

    public function addToWishlist(Request $request)
    {
        $messages = [
            'unique' => 'The Product has already in your Wishlist',
        ];
        $this->validate($request, [
            'product_id' => 'required|unique:wishlists',
        ], $messages);

        if(Auth::attempt($request->only('email', 'password'), $request->remember)){
            return redirect()->route('login');
        }else{
            $orderProduct = new Wishlist;
            $orderProduct->user_id = $request->user()->id;
            $orderProduct->product_id = $request->product_id;
            $orderProduct->save();

            return redirect()->back()->with('success', 'Product has been added to Wishlist');
        }
    }

    public function deleteWishlist($id)
    {
        DB::table('wishlists')->where('id', $id)->delete();

        return redirect('/wish-list')->with('delete','You have successfully Delete Wishlist Product!');
    }
}
