<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class ProfileController extends Controller
{
    //
    use GeneralTrait;
    public function redirectToFacebookProvider(){
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderFacebookCallback(){
//        $auth_user = Socialite::driver('facebook')->user();
//        $user = User::find(6);
//        $user->token = $auth_user->getEmail();
//        $user->facebook_id = $auth_user->getName();
//        $user->save();
//        return returnData('user',$user);
        try {
            $user = Socialite::driver('facebook')->stateless()->user();

            // Check Users Email If Already There
            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){

                $saveUser = User::updateOrCreate([
                    'facebook_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'facebook_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }


            Auth::loginUsingId($saveUser->id);

            return view('welcome');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
