<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Home Admin - Laravel Irfan'
        ];
        return view('admin.index', $data);
    }
}
