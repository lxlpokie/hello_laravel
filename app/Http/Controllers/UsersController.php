<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required|max:50',
    		'email' => 'required|email|uniqid::users|max:255',
    		'password' => 'required|confirmd|min:6',
    	]);

    	$user = User::create([
    		'name' => $request->name,
    		'eamil' => $request->eamil,
    		'password' => bcrypt($request->password),
    	]);

    	session()->flash('success','恭喜你注册成功');
    	return redirect()->route('users.show',[$user]);
    }

}
