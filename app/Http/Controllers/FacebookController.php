<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

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


          $credentials = ['email' => $user->getEmail(), 'password' => $user->getName().'@'.$user->getId()];

            $token = Auth::guard('api-jwt')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'it is not valid!');

            $admin = Auth::guard('api-jwt')->user();
            $admin->api_token = $token;
       return $this->returnData("user",$admin);

       } catch (\Throwable $th) {
          throw $th;
       }
   }
    public function logoutFromFacebook(Request $request)
    {
        $token = $request -> header('auth-token');
        if($token){
            try {

                JWTAuth::setToken($token)->invalidate(); //logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError('','some thing went wrongs');
            }
            return $this->returnSuccessMessage('Logged out successfully');
        }else{
            $this -> returnError('','some thing went wrongs');
        }

    }
}
