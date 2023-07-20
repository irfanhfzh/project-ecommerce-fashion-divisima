<?php

namespace App\Http\Controllers\auth\user;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function __construct(){
        $this->middleware(['guest']);
    }

    public function index(){
        $levels = Level::get();

        return view('auth.user.user-register')->with(['levels'=>$levels]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'full_name'=>'required|max:255',
            'username'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
            'terms'=>'required',
        ]);

        User::create([
            'level_id'=> $request->level_id,
            'full_name'=> $request->full_name,
            'username'=> $request->username,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        Auth::attempt($request->only('email', 'password'));

        return redirect('/');
    }
}
