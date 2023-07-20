@extends('admin.layout.template-admin-content')
@section('title', $title)
@section('namepage', 'Insert Data Admin')

@section('content')
<div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Insert Data Admin</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form id="quickForm" action="{{route('admin.admin-insert')}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group d-none">
              <select class="form-control" name="level_id">
                  <option value="1">1</option>
              </select>
            </div>
          <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                  <label for="username">Username</label> @error('username')<span class="text-danger">{{$message}}</span>@enderror 
                  <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" value="{{old('username')}}">
                </div>     
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label for="name">Name</label> @error('name')<span class="text-danger">{{$message}}</span>@enderror 
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{old('name')}}">
                </div>     
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="no_hp">Nomor HP</label> @error('no_hp')<span class="text-danger">{{$message}}</span>@enderror 
                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="Nomor HP" value="{{old('no_hp')}}">
                </div>
            </div>
        </div>
            <div class="form-group">
              <label for="address">Address</label> @error('address')<span class="text-danger">{{$message}}</span>@enderror
              <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Address" value="{{old('address')}}"></textarea>
            </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                  <label for="email">Email</label> @error('email')<span class="text-danger">{{$message}}</span>@enderror
                  <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{old('email')}}">
                </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="password">Password</label> @error('password')<span class="text-danger">{{$message}}</span>@enderror
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"  rows="3" placeholder="Password" value="{{old('password')}}"></input>
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