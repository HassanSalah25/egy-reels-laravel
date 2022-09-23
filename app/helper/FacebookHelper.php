<?php
namespace App\helper;
use Facebook\FacebookSession;
use Facebook\Helpers\FacebookRedirectLoginHelper;
class FacebookHelper
{
    private $helper;
    public function __construct()
    {
        FacebookSession::setDefaultApplication(Config::get('facebook.app_id', Config::get('facebook.app_id')));
        $this-> helper = new facebookRedirectLoginHelper('login/fb/callback');


    }
    public function getUrlLogin(){
        return $this->helper->getLoginUrl(Config::get('Facebook.app_scope'));
    }
}
