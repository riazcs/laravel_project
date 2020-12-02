<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   protected function validator(array $data)
    {
      return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'avatar' => ['required', 'string', 'max:255'],
            // 'avatar' => ['image:jpeg,png,jpg,gif,svg|max:2048'],
        'phone' => ['required', 'string', 'max:11', 'min:11'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }


    protected function store(Request $request)
	{
		$user = new User();
      $user->name=$request->input('name');
      $user->phone=$request->input('phone');
      $user->email=$request->input('email');
      $user->password=Hash::make($request->input('password'));
      if($request->hasfile('avatar')) {
        $file=$request->file('avatar');
        $extension=$file->getClientOriginalExtension();
        $filename=time().'.'.$extension;
        $file->move('uploads/image/',$filename);
        $user->avatar=$filename;
      } else {
        $user->avatar='';
      }
      $user->save();
      return redirect()->route('home');
   }
}
