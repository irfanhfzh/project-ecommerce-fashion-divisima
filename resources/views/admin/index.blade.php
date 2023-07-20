@extends('admin.layout.template-admin')
@section('title', $title)
@section('namepage', 'Dashboard')

@section('content')
<h1>Selamat Datang Admin, {{auth()->user()->full_name}}</h1>
@endsection