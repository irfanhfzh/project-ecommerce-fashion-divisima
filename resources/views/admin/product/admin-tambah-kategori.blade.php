@extends('admin.layout.template-admin')
@section('title', $title)
@section('namepage', 'Data Category Product')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <form action="{{route('admin.kategori-insert')}}">
            @csrf
            <button type="submit" class="btn btn-success mb-6"><i class="far fa-plus-square"></i> Insert Data</button>
        </form>
    </div>
    <div class="col-sm-6">
        <form action="{{ route('admin.kategori') }}" method="GET">
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
        <th>Category Name</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @forelse ( $categories as $key => $category )
    <tr>
        <td>{{$key + $categories->firstItem()}}</td>
        <td>{{$category->nama}}</td>
        <td style="display: flex">
            <a href="{{url('admin/product/tambah-kategori/edit-kategori/'.$category->id)}}" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i>Edit</a>
            <a href="{{url('admin/product/tambah-kategori/delete/'.$category->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Delete</a>
        </td>
        @empty
        <td colspan="3" class="text-center">
            No data results found for <strong>{{request()->query('cari')}}</strong>
        </td>
    </tr>
    @endforelse
</tbody>
</table>
  
<div class="row mt-1">
    <div class="col d-flex justify-content-center">
        {{ $categories->appends(['cari' => request()->query('cari')])->links() }}
    </div>
</div>
@endsection