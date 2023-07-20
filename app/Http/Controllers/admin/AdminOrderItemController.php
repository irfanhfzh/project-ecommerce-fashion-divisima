<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminOrderItemController extends Controller
{
    public function index($id) {
		$data = [
            'title' => 'Order Item - Laravel Irfan'
        ];

        $userId = auth()->user()->id;
        $products = Order::with('product')->where('orders.user_id', $userId)
            ->where('orders.id', $id)
            ->select('orders.*', 'orders.qty as order_qty')
            ->get();

        $orderGet = Order::get();
        $totals = Order::leftjoin('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.user_id', $userId)
            ->where('orders.id', $id)
            ->sum(DB::raw('products.price * orders.qty'));

            // return $products;
        return view('admin.order.order-item.admin-order-item', $data, compact('products', 'totals'));
    }
}


