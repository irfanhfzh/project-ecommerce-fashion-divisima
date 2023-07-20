@extends('admin.layout.template-admin-content')
@section('title', 'Order Admin - Laravel Irfan')
@section('namepage', 'Edit Data Order Item')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif 
          
          @if(session()->has('message'))
            <div class="alert alert-success">
              {{ session()->get('message') }}     
            </div>
          @endif    

          <form action="{{url('admin/order/orders_item/edit/'.$orderitems->id)}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="order_id" value="{{$orderitems->order_id}}">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nama">Product : </label>
                <select id="nama" class="form-control select2bs4" name="product_id">
                  <option selected>Choose Product</option>              
                  @foreach ($product as $prd)
                    <option value="{{ $prd->id }}" {{ (old('product_id', $orderitems->name) == $prd->name) ? 'selected' : '' }}>
                      {{ $prd->name }}
                    </option>
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="qty">QTY : </label>
                <div class="input-group">
                  <input type="text" name="qty" class="form-control" value="{{old('qty', $orderitems->qty)}}">
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Update Data</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection