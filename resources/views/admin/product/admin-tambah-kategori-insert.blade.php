@extends('admin.layout.template-admin-content')
@section('title', $title)
@section('namepage', 'Insert Data Category Product')

@section('content')
<div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Insert Data Category Product</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="quickForm" action="{{route('admin.kategori-insert')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="nama">Category Name :</label> @error('nama')<span class="text-danger">{{$message}}</span>@enderror
              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Delivery Days" value="{{old('nama')}}">
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