@extends('admin.layout.template-admin-content')
@section('title', $title)
@section('namepage', 'Insert Data Variant Product')

@section('content')
@if (session()->has('success'))
<div class="py-2">
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session()->get('success') }}</strong>
    </div>
</div>
@endif
<div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Insert Data Variant Product</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="quickForm" action="{{route('admin.variant-insert')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <div class="form-group">
              <label for="variant">Variant Name :</label> @error('variant')<span class="text-danger">{{$message}}</span>@enderror
              <input type="text" name="variant[]" class="form-control @error('variant') is-invalid @enderror" id="variant" placeholder="Variant Name">
            </div>
            <i class="fa fa-plus inputAdd mb-3 mr-2"></i>Tambah Variant
          </div> 
          <div class="col-sm-7">
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
@push('inputAdd')
<script>
$(".inputAdd").click(function(){
  $(this).closest(".row").find('.inputAdd').before('<div class="col-sm-12"><div class="form-group"><label for="variant" class="mr-2">Variant Name :</label><i class="fa fa-times del"></i> @error('variant')<span class="text-danger">{{$message}}</span>@enderror<input type="text" name="variant[]" class="form-control @error('variant') is-invalid @enderror" id="variant" placeholder="Variant Name"></div></div>');
});
$(document).on("click", "i.del" , function() {
  $(this).parent().remove();
});
</script>
@endpush