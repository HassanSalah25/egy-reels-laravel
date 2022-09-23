<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class   FacebookController extends Controller
{
/**
 * Login Using Facebook
 */
use GeneralTrait;
 public function loginUsingFacebook()
 {
    return Socialite::driver('facebook')->stateless()->redirect();
 }

 public function callbackFromFacebook()
 {
  try {
       $user = Socialite::driver('facebook')->stateless()->user();



       $saveUser = User::updateOrCreate([
           'facebook_id' => $user->getId(),
       ],[
           'name' => $user->getName(),
           'email' => $user->getEmail(),
           'password' => Hash::make($user->getName().'@'.$user->getId())
            ]);

       Auth::loginUsingId($saveUser->id);

       return $this->returnData("user",$saveUser);
       } catch (\Throwable $th) {
          throw $th;
       }
   }
    public function logoutFromFacebook()
    {
        Auth::logout();
        return view('welcome');
    }
}
