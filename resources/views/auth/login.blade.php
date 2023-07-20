@extends('auth.layout.template-auth')
@section('title', 'Login - Larvel Irfan | Divisima')

@section('content')
<div class="login-box">
<div class="login-logo">
    <a href="{{route('login')}}">Login</a>
</div>
<!-- /.login-logo -->
<div class="card">
<div class="card-body login-card-body">
    <p class="login-box-msg">Sign in to start your session</p>

    @if (session('status'))
        <div class="alert alert-danger" role="alert">
            {{session('status')}}
        </div>
    @endif
    
    <form action="{{route('login')}}" method="post">
        @csrf
        @error('email')
            <div class="text-danger">
                {{$message}}
            </div>
        @enderror
        <div class="input-group mb-3">
        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" autofocus placeholder="Input Your E-Mail">
        <div class="input-group-append">
            <div class="input-group-text">
            <span class="fas fa-envelope"></span>
            </div>
        </div>
        </div>

        @error('password')
            <div class="text-danger">
                {{$message}}
            </div>
        @enderror
        <div class="input-group mb-3">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Input Your Password">
        <div class="input-group-append">
            <div class="input-group-text">
            <span class="fas fa-lock"></span>
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{old('remember') ? 'checked' : ''}}>
            <label for="remember">
                Remember Me
            </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        <!-- /.col -->
        </div>
    </form>
@endsection
@section('relog')
<p class="mb-0">
    <a href="{{route('user.register')}}" class="text-center">Register a new Account</a>
</p>
@endsection