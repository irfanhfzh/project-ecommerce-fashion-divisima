@extends('admin.layout.template-admin-content')
@section('title', $title)
@section('namepage', 'Insert Data Order')

@section('content')
<div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Insert Data Pembeli</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="quickForm" action="{{route('admin.order-insert')}}" method="POST">
        @csrf
        <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                  <label for="user_id">Name : </label> @error('user_id')<span class="text-danger">{{$message}}</span>@enderror
                  <select id="user_id" class="form-control select2bs4 @error('user_id') is-invalid @enderror" name="user_id">
                    <option holder>Choose Name</option>                    
                    @foreach ($users as $user)
                      <option value="{{ $user->id }}">
                        {{ $user->full_name }}
                      </option>
                    @endforeach
                  </select>
                </div>     
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="status_id">Status : </label> @error('status_id')<span class="text-danger">{{$message}}</span>@enderror
                <select id="status_id" class="form-control select2bs4 @error('status_id') is-invalid @enderror" name="status_id">
                  @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">
                      {{ $status->status }}
                    </option>
                  @endforeach
                </select>
              </div>     
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="product_id">Product : </label> @error('product_id')<span class="text-danger">{{$message}}</span>@enderror
                <select id="product_id" class="form-control select2bs4 @error('product_id') is-invalid @enderror" name="product_id">
                  <option holder>Choose Product</option>                  
                  @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                      {{ $product->name }}
                    </option>
                  @endforeach
                </select>
              </div>     
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                  <label for="tanggal_order">Tanggal Order : </label> @error('tanggal_order')<span class="text-danger">{{$message}}</span>@enderror
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" name="tanggal_order" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="address">Address : </label> @error('address')<span class="text-danger">{{$message}}</span>@enderror
              <textarea id="address" class="form-control select2bs4 @error('address') is-invalid @enderror" name="address"></textarea>
            </div> 
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="profile_address">Profile Address : </label> @error('profile_address')<span class="text-danger">{{$message}}</span>@enderror
              <textarea id="profile_address" class="form-control select2bs4 @error('profile_address') is-invalid @enderror" name="profile_address"></textarea>
            </div> 
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="notes">Notes : </label> @error('notes')<span class="text-danger">{{$message}}</span>@enderror
              <textarea id="notes" class="form-control select2bs4 @error('notes') is-invalid @enderror" name="notes"></textarea>
            </div> 
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="payment_method">Payment Method : </label> @error('payment_method')<span class="text-danger">{{$message}}</span>@enderror
              <select id="payment_method" class="form-control select2bs4 @error('payment_method') is-invalid @enderror" name="payment_method">
                <option holder>Choose Payment Method</option>                    
                  <option value="Paypal">Paypal</option>
                  <option value="Credit / Debit card">Credit / Debit card</option>
                  <option value="Cash On Delivery">Cash On Delivery</option>
              </select>
            </div> 
          </div>
        </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-success">Insert</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
    </div>
@endsection