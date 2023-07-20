@extends('admin.layout.template-admin')
@section('title', $title)
@section('namepage', 'Data Product')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <form action="{{route('admin.product-insert')}}">
            @csrf
            <button type="submit" class="btn btn-success mb-6"><i class="far fa-plus-square"></i> Insert Data</button>
        </form>
    </div>
    <div class="col-sm-6">
        <form action="{{route('admin.product')}}" method="GET">
            <div class="input-group input-group-md">
                <input type="text" class="form-control" name="cari" placeholder="Search Data..." value="{{request()->query('cari')}}">
                <span class="input-group-append">
                  <button type="submit" class="btn btn-info btn-flat">Go!</button>
                </span>
            </div>
        </form>
    </div>
</div>
    @if (session()->has('success'))
        <div class="py-2">
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session()->get('success') }}</strong>
            </div>
        </div>
    @endif
    @if (session()->has('delete'))
        <div class="py-2">
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session()->get('delete') }}</strong>
            </div>
        </div>
    @endif
<table class="table table-striped">
<thead>
    <tr>
        <th>No</th>
        <th>Category</th>
        <th>Code</th>
        <th>Name</th>
        <th>Stock</th>
        <th>Variant</th>
        <th>Description</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @forelse ( $products as $key => $product )
    <div class="d-none">
        @if ($product->qty == 0)
            {!! $stock = '<div class="badge badge-danger" style="padding: 5px; font-size: 80%;">Out of Stock</div>' !!}
        @elseif ($product->qty < 4 && $product->qty > 0)
            {!! $stock = '<div class="badge badge-warning" style="padding: 5px; font-size: 80%;">Low Stock</div>' !!}
        @else
            {!! $stock = '<div class="badge badge-success" style="padding: 5px; font-size: 80%;">In Stock</div>' !!}
        @endif
    </div>
    <tr>
        <td>{{$key + $products->firstItem()}}</td>
        <td>{{$product->category->nama}}</td>
        <td>{{$product->code}}</td>
        <td>{{$product->name}}</td>
        <td>{!! $stock !!}</td>
        <td>{{$product->variant}}</td>
        <td class="text-break">{{$product->description}}</td>
        <td><img style="width: 100%" src="{{ asset('images') }}/{{ $product->image1 }}" alt="Image"></td>
        <td style="display: flex">
            <a href="{{url('admin/product/edit-product/'.$product->id)}}" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i>Edit</a>
            <a href="{{url('admin/product/delete/'.$product->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Delete</a>
        </td>
        @empty
        <td colspan="9" class="text-center">
            No data results found for <strong>{{request()->query('cari')}}</strong>
        </td>
    </tr>
    @endforelse
</tbody>
</table>
  
<div class="row mt-1">
    <div class="col d-flex justify-content-center">
        {{ $products->appends(['cari' => request()->query('cari')])->links() }}
    </div>
</div>
@endsection