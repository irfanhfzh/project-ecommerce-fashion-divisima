<?php

namespace App\Http\Controllers\api;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiOrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = OrderItem::with('product')->where('order_id', $id)->get();

        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'qty' => 'required|integer'
        ]);

        $data = $request->all();
        OrderItem::create($data);

        $orderitem = OrderItem::with('product')->where('order_id', $data['order_id'])->get();

        return response()->json(['data' => $orderitem]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($order_id, $id)
    {
        $data = OrderItem::with('product')->where('order_id', $order_id)->where('id', $id)->get(); 
        
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order_id, $id)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'qty' => 'required|integer'
        ]);

        $result = OrderItem::with('product')
        ->where('order_id', $order_id)
        ->where('id', $id)
        ->update([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
        ]);

        $orderitem = OrderItem::with('product')->where('id', $id)->get();

        if($result){
            return response()->json(["result" => "Data has been updated", 'data' => $orderitem]);
        } else {
            return response()->json(["result" => "Update operation has been failed"], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_id, $id)
    {
        OrderItem::where('order_id', $order_id)->where('id', $id)->delete();
        $orderitem = OrderItem::with('product')->where('order_id', $order_id)->get();

        return response()->json(['data' => $orderitem]);
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($keyword, $id) 
    { 
        $data = OrderItem::with('product')->where('product_id', 'like', '%'.$id.'%')->get();

        if(count($data)){
            return response()->json(['data' => $data]);
        } else{
            return response()->json(['result' => 'Data Order Item Not Found!'], 404);
        }
    }
}
