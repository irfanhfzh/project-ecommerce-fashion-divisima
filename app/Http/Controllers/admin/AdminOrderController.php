<?php

namespace App\Http\Controllers\Admin;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Order Admin - Laravel Irfan'
        ];  
        
        $search = request()->query('cari');
        if ($search) {
            $orders = DB::table('orders')->where('name','LIKE',"%{$search}%")->paginate(10);
        } else {
            $orders['statuses'] = DB::table('statuses')->get();
            $orders['users'] = DB::table('users')->get();
            $orders['products'] = DB::table('products')->get();
            $orders['orders'] = DB::table('orders')
                ->join('statuses', 'orders.status_id', '=', 'statuses.id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->select('orders.*', 'statuses.status', 'users.full_name', 'products.name')
                ->orderBy('orders.id', 'DESC')
                ->paginate(10);
        }

        return view('admin.order.admin-order', $data, $orders);
    }

    public function insert(){
        $data = [
            'title' => 'Order Admin - Laravel Irfan'
        ];  

        $orders['statuses'] = DB::table('statuses')->get();
        $orders['users'] = DB::table('users')->get();
        $orders['products'] = DB::table('products')->get();
        $orders['cashes'] = DB::table('cashes')->get();

        return view('admin.order.admin-insert-order', $data, $orders);
    }

    public function insertAction(Request $request){
        $this->validate($request, [
            'status_id' => 'nullable',
            'user_id' => 'required',
            'product_id' => 'required',
            'tanggal_order' => 'required',
            'address' => 'nullable',
            'profile_address' => 'nullable',
            'notes' => 'required',
            'payment_method' => 'required',
        ]);

        $id = DB::table('orders')->insertGetId([
            'status_id' => $request->status_id,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'tanggal_order' => $request->tanggal_order,
            'address' => $request->address,
            'profile_address' => $request->profile_address,
            'notes' => $request->notes,
            'payment_method' => $request->payment_method,
        ]);

        return redirect('admin/order/orders_item/'.$id)->with('success','You have successfully Insert Data Order!');
    }

    public function edit($id){
        $data = [
            'title' => 'Order Admin - Laravel Irfan'
        ];  

        $orders['statuses'] = DB::table('statuses')->get();
        $orders['users'] = DB::table('users')->get();
        $orders['products'] = DB::table('products')->get();
        $orders['order'] = DB::table('orders')->where('id', $id)->first();

        return view('admin.order.admin-edit-order', $data, $orders);
    }

    public function editAction(Request $request, $id){
        $this->validate($request, [
            'status_id' => 'required',
        ]);

        $orders = DB::table('orders')
        ->where('id', $id)
        ->update([
            'status_id' => $request->input('status_id'),
        ]);

        return redirect()->route('admin.order')->with('success','You have successfully Edit Data Order!');
    }

    public function delete($id){
        DB::table('orders')->where('id', $id)->delete();
        DB::table('order_items')->where('order_id', $id)->delete();

        return redirect()->route('admin.order')->with('delete','You have successfully Delete Data Order!');
    }
}
