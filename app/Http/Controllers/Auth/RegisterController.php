<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function store(Request $request)
    {

      dd("im here");
      //    $request = request();
      //
      //  if($request->hasfile('avatar'))
      // {
      //    $profileImage = $request->file('avatar');
      //    $profileImageSaveAsName = time() . $profileImage->getClientOriginalExtension();
      //
      //    $upload_path = 'storage/images';
      //    $profile_image_url = $upload_path . $profileImageSaveAsName;
      //    $success = $profileImage->move($upload_path, $profileImageSaveAsName);
      //
      //   return User::create([
      //       'name' => $data['name'],
      //       'avatar' =>  $profile_image_url,
      //       'phone' => $data['phone'],
      //       'email' => $data['email'],
      //       'password' => Hash::make($data['password']),
      //   ]);
      //
      // }
      $user = new User();
      $user->name=$request->input('name');
      $user->phone=$request->input('phone');
      $user->email=$request->input('email');
      $user->password=Hash::make($request->input('password'));
      if($request->hasfile('avatar'))
      {
        $file=$request->file('avatar');
        $extension=$file->getClientOriginalExtension();
        $filename=time().'-'.$extension;
        $path = storage_path('images');
        $file->move($path,$filename);
        $user->avatar=$filename;
      }
      else {

        return $request;
        $user->avatar='';
      }
      $user->save();
      return redirect()->route('home');
      
  }


}


