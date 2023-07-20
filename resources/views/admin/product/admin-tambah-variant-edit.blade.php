@extends('admin.layout.template-admin-content')
@section('title', $title)
@section('namepage', 'Edit Data Variant Product')

@section('content')
<div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Edit Data Variant Product</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="quickForm" action="{{route('admin.variant-edit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{old('id', $getId)}}">
        <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <div class="form-group">
              <label>Available Variant</label>
              <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100" name="variant[]">
                  @foreach ($arr as $key => $value)
                    <option value="{{$value}}">{{$value}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="variant">Variant Name :</label> @error('variant')<span class="text-danger">{{$message}}</span>@enderror                
              <input type="text" name="variant[]" class="form-control @error('variant') is-invalid @enderror" id="variant" placeholder="Variant Name" value="{{old('variant', $finds->variant)}}">
            </div>
          </div> 
          <div class="col-sm-7">
            <div class="form-group">
              <label for="product_id">Product : </label> @error('product_id')<span class="text-danger">{{$message}}</span>@enderror
              <select id="product_id" class="form-control select2bs4 @error('product_id') is-invalid @enderror" name="product_id" readonly>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ (old('product_id', $product->id) == $finds->product_id) ? 'selected' : '' }}>
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