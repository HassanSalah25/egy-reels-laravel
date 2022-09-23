<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\helper\FacebookHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
/**
 * Login Using Facebook
 */
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
}
