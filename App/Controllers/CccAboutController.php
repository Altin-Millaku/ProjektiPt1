<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Product;
use \Core\View;
use \Core\Controller;


class CccAboutController extends Controller
{

    public function index()
    {
        $session = Session::getInstance();
        $isLoggdin = $session->isUserSignedin();
        $getUserRole = $session->getUserRole();
        $message = '';
        if(!empty($session->message)){
            $message = $session->message;
        }
        View::renderTemplate('ccc/about.html',[
            'isLoggdin'=>$isLoggdin,
            'role'=>$getUserRole,
            'message'=>$message
        ]);
    }
}
