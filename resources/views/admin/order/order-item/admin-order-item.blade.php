@extends('admin.layout.template-admin')
@section('title', 'Order Admin - Laravel Irfan')
@section('namepage', 'Data Order Item')

@section('content')
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

          <!-- cart section end -->
          <section class="cart-section">
            <div class="container">
              <div class="row">
                @forelse ($products as $item)
                <div class="col-lg-12">
                  <div class="cart-table">
                    <h3>Order Item {{ $item->name }}</h3>
                      <div class="row bg-light border rounded" style="padding: 20px 0px; margin: 10px 5px;">					
                        <div class="col-sm-2 pr-0">
                          <img src="{{asset('images')}}/{{ $item->product->image1 }}" style="max-width: 100%;">
                        </div>
                        <div class="col-sm-3 pr-0">
                          <h6 style="margin-bottom: 15px">#Order {{ $item->product->code }}</h6>
                          <h4 style="margin-bottom: 5px">{{ $item->product->name }}</h4>
                          <p style="margin-bottom: 5px">${{ $item->product->price }}</p>
                          <p style="margin-bottom: 5px">Qty : {{ $item->order_qty }}</p>
                          <p style="margin-bottom: 5px" class="pr-2">Size : {{ $item->size }}</p>
                          <p style="margin-bottom: 5px" class="pr-2">Variant : {{ $item->variant }}</p>
                          <p class="pr-2">Notes : {{ $item->notes }}</p>
                        </div>
                        <div class="col-sm-3 pl-0">
                          <h5 style="margin-bottom: 15px">Shipping address</h5>
                          <p style="margin-bottom: 5px">{{ auth()->user()->full_name }}</p>
                          <p>{{ $item->address }}{{ $item->profile_address }}</p>
                        </div>
                        <div class="col-sm-2 pr-0 pl-0">
                          <p style="margin-bottom: 5px">Subtotal ${{ $item->price }}</p>
                          <p>Qty : x{{ $item->order_qty }}</p>
                          <hr>
                          <h5 style="margin-bottom: 5px">Total ${{ $totals }}</h5>
                          <p>Payment : <span class="text-info">{{ $item->payment_method }}</span></p>
                        </div>
                        <div class="col-sm-2">
                          <h6>Status : <span class="text-info">{{ $item->status->status }}</span></h6>
                        </div>
                      </div>									
                      @empty
                      <div class="text-center">
                        <strong>No Orders List, <a href="/product">Go for Shopping</a></strong> 
                      </div>
                      @endforelse							
                      <div class="total-cost">
                      
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- cart section end -->
        </div>
    </div>
    </div>
</section>
@endsection