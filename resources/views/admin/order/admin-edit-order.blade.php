@extends('admin.layout.template-admin-content')
@section('title', $title)
@section('namepage', 'Edit Data Order')

@section('content')
<div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Edit Data Pembeli</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="quickForm" action="{{url('admin/order/edit-order/'.$order->id)}}" method="POST">
        @csrf
        <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label for="user_id">Name : </label> @error('user_id')<span class="text-danger">{{$message}}</span>@enderror
                <select id="user_id" class="form-control select2bs4 @error('user_id') is-invalid @enderror" name="user_id" disabled>
                  @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ (old('user_id', $user->id) == $order->user_id) ? 'selected' : '' }}>
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
                    <option value="{{ $status->id }}" {{ (old('status_id', $status->id) == $order->status_id) ? 'selected' : '' }}>
                      {{ $status->status }}
                    </option>
                  @endforeach
                </select>
              </div>     
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="product_id">Product : </label> @error('product_id')<span class="text-danger">{{$message}}</span>@enderror
                <select id="product_id" class="form-control select2bs4 @error('product_id') is-invalid @enderror" name="product_id" disabled>            
                  @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ (old('product_id', $product->id) == $product->name) ? 'selected' : '' }}>
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
                  <input type="date" name="tanggal_order" class="form-control" value="{{old('tanggal_order', $order->tanggal_order)}}" disabled>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="address">Address : </label> @error('address')<span class="text-danger">{{$message}}</span>@enderror
              <textarea id="address" class="form-control select2bs4 @error('address') is-invalid @enderror" name="address" disabled>{{Request::old('address', $order->address)}}</textarea>
            </div> 
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="profile_address">Profile Address : </label> @error('profile_address')<span class="text-danger">{{$message}}</span>@enderror
              <textarea id="profile_address" class="form-control select2bs4 @error('profile_address') is-invalid @enderror" name="profile_address" disabled>{{Request::old('profile_address', $order->profile_address)}}</textarea>
            </div> 
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="notes">Notes : </label> @error('notes')<span class="text-danger">{{$message}}</span>@enderror
              <textarea id="notes" class="form-control select2bs4 @error('notes') is-invalid @enderror" name="notes" disabled>{{Request::old('notes', $order->notes)}}</textarea>
            </div> 
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="payment_method">Payment Method : </label> @error('payment_method')<span class="text-danger">{{$message}}</span>@enderror
              <input type="text" id="payment_method" class="form-control select2bs4 @error('payment_method') is-invalid @enderror" name="payment_method" value="{{Request::old('payment_method', $order->payment_method)}}" disabled>
            </div> 
          </div>
        </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-success">Edit</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
    </div>
@endsection