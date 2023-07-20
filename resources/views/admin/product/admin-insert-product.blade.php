@extends('admin.layout.template-admin-content')
@section('title', $title)
@section('namepage', 'Insert Data Product')

@section('content')
<div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Insert Data Product</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="quickForm" action="{{route('admin.insert-product')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label for="code">Code</label> @error('code')<span class="text-danger">{{$message}}</span>@enderror 
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code" placeholder="Code" value="{{old('code')}}">
              </div>     
            </div>
            <div class="col-sm-8">
              <div class="form-group">
                <label for="name">Product Name</label> @error('name')<span class="text-danger">{{$message}}</span>@enderror
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Product Name" value="{{old('name')}}">
              </div>
            </div>
      <br><div class="container">
            <div class="row">
              <div class="col-sm-3 imgUp">
                <div class="imagePreview"></div>
                  <label class="btn btn-success">
                    Upload Image
                    <input type="file" class="uploadFile img" name="image1" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                  <i class="fa fa-times del1"></i>
              </div>
              <div class="col-sm-3 imgUp">
                <div class="imagePreview"></div>
                  <label class="btn btn-success">
                    Upload Image
                    <input type="file" class="uploadFile img" name="image2" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                  <i class="fa fa-times del2"></i>
              </div>
              <div class="col-sm-3 imgUp">
                <div class="imagePreview"></div>
                  <label class="btn btn-success">
                    Upload Image
                    <input type="file" class="uploadFile img" name="image3" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                  <i class="fa fa-times del3"></i>
              </div>
              <div class="col-sm-3 imgUp">
                <div class="imagePreview"></div>
                  <label class="btn btn-success">
                    Upload Image
                    <input type="file" class="uploadFile img" name="image4" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                  <i class="fa fa-times del4"></i>
              </div>
            </div>
          </div>                                             
        </div>
        <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    @foreach ($categories as $row)
                        <option value="{{$row->id}}">{{$row->nama}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="price">Price</label> @error('price')<span class="text-danger">{{$message}}</span>@enderror
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Price" value="{{old('price')}}">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="pr-2">Variant</label>
                <button class="text-success" name="submit" style="font-size: 15px;" value="createVariant"> Create Variant for this Product</button>
                <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100" name="variant[]">
                </select>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-1">
            <div class="form-group">
              <label for="qty">Quantity</label> @error('qty')<span class="text-danger">{{$message}}</span>@enderror
              <input type="text" name="qty" class="form-control @error('qty') is-invalid @enderror" id="qty" placeholder="QTY" value="{{old('qty')}}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label>Size</label>
              <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100" name="size[]">
                  @foreach ($sizes as $row)
                      <option value="{{$row->size}}">{{$row->size}}</option>
                  @endforeach
              </select>
            </div>
          </div> 
          <div class="col-sm-2">
            <div class="form-group">
              <label>Cash On Delivery</label>
              <select class="form-control" name="cash_id">
                  @foreach ($cashes as $row)
                      <option value="{{$row->id}}">{{$row->cash}}</option>
                  @endforeach
              </select>
            </div>
          </div>  
          <div class="col-sm-3">
            <div class="form-group">
              <label for="returns">Return Days</label> @error('returns')<span class="text-danger">{{$message}}</span>@enderror
              <input type="text" name="returns" class="form-control @error('returns') is-invalid @enderror" id="returns" placeholder="Return Days" value="{{old('returns')}}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="delivery">Delivery Days</label> @error('delivery')<span class="text-danger">{{$message}}</span>@enderror
              <input type="text" name="delivery" class="form-control @error('delivery') is-invalid @enderror" id="delivery" placeholder="Delivery Days" value="{{old('delivery')}}">
            </div>
          </div>         
        </div>
          <div class="form-group">
            <label for="description">Description</label> @error('description')<span class="text-danger">{{$message}}</span>@enderror
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="10" placeholder="Description..." value="{{old('description')}}"></textarea>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" name="submit" class="btn btn-success" value="createVariant">Insert</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
    </div>
@endsection
@push('previewImage')
<script>
  $(document).on("click", "i.del1" , function() {
    // to clear image
    $(this).parent().find('.imagePreview').css("background-image","url('')");
  });
  $(document).on("click", "i.del2" , function() {
    // to clear image
    $(this).parent().find('.imagePreview').css("background-image","url('')");
  });
  $(document).on("click", "i.del3" , function() {
    // to clear image
    $(this).parent().find('.imagePreview').css("background-image","url('')");
  });
  $(document).on("click", "i.del4" , function() {
    // to clear image
    $(this).parent().find('.imagePreview').css("background-image","url('')");
  });

  $(function() {
      $(document).on("change",".uploadFile", function()
      {
          var uploadFile = $(this);
          var files = !!this.files ? this.files : [];
          if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
  
          if (/^image/.test( files[0].type)){ // only image file
              var reader = new FileReader(); // instance of the FileReader
              reader.readAsDataURL(files[0]); // read the local file
  
              reader.onloadend = function(){ // set image data as background of div
                  // alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
              }
          }
        
      });
  });
</script>
@endpush