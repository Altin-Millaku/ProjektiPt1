<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Product;
use \Core\View;
use \Core\Controller;

class CccController extends Controller
{

    public function index()
    {
        $session = Session::getInstance();
        $isLoggdin = $session->isUserSignedin();
        $getUserRole = $session->getUserRole();
        $products = Product::orderBy('id','desc')->get();   
        $message = '';
        if(!empty($session->message)){
            $message = $session->message;
        }
        View::renderTemplate('ccc/index.html'
        ,['isLoggdin' => $isLoggdin,
                'role' => $getUserRole,
                'message'=>$message,
                'products'=>$products]);
    }
}
