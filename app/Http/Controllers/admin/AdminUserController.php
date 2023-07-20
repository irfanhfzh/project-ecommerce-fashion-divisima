<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Admin - Laravel Irfan'
        ];

        $search = request()->query('cari');
        if ($search) {
            $users = User::where('name','LIKE',"%{$search}%")->paginate(10);
        } else {
            $users = User::where('level_id', '=', 2)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('admin.user.admin-user', $data, compact('users'));
    }

    public function insert(){
        $data = [
            'title' => 'Admin - Laravel Irfan'
        ];  

        return view('admin.user.admin-insert-user', $data);
    }

    public function insertAction(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'no_hp' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        User::create([  
            'level_id' => $request->level_id,
            'username' => $request->username,
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.user')->with('success','You have successfully Insert Data User!');
    }

    public function edit($id){
        $data = [
            'title' => 'Product Admin - Laravel Irfan'
        ];  

        $row = User::find($id);

        return view('admin.user.admin-edit-user', $data, ['row'=>$row]);
    }

    public function editAction(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'no_hp' => 'required',
            'address' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->no_hp = $request->no_hp;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.user')->with('success','You have successfully Edit Data User!');
    }

    public function delete($id){
        $row = User::find($id);
        
        $row->delete();

        return redirect()->route('admin.user')->with('delete','You have successfully Delete Data User!');
    }
}
