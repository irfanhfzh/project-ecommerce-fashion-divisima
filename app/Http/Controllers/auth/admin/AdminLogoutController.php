<?php

namespace App\Http\Controllers\auth\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLogoutController extends Controller
{
    public function store(){
        Auth::logout();

        return redirect()->route('login');
    }
}
