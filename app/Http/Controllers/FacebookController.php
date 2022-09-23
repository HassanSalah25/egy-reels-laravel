<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\User;
use App\Traits\GeneralTrait;
=======

use App\Models\User;
use App\helper\FacebookHelper;
>>>>>>> parent of 9b74312 (ksnfdlkf)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

<<<<<<< HEAD
class   FacebookController extends Controller
=======
class FacebookController extends Controller
>>>>>>> parent of 9b74312 (ksnfdlkf)
{
/**
 * Login Using Facebook
 */
<<<<<<< HEAD
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
=======
    private $fb;
    public function __construct(FacebookHelper $fb)
    {

        $this->fb = $fb;
    }

    public function loginUsingFacebook()
     {
        return Redircet::to($this->fb->getUrlLogin());
     }

     public function callbackFromFacebook()
     {
        return Input::all();
     }
>>>>>>> parent of 9b74312 (ksnfdlkf)
}
