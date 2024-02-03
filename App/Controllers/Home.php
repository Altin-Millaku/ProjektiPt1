<?php

namespace App\Controllers;

use App\Models\Role;
use \Core\View;
use \Core\Controller;
use App\Helper\Session;


class Home extends Controller
{

    
    public function __construct()
    {
        $session = Session::getInstance();
        $getRole = $session->getUserRole();

        if (!$session->isSignedIn()) {

            header('Location: /login-form');
            exit;
        }
        if ($getRole == '2') {
            $session->message("You are not supposed to be there");
            header('Location: /');
            exit;
        }
    }

    public function index()
    {
        $session = Session::getInstance();
        $Roles = $session->getUserRole();
        View::renderTemplate('Dashboard/index.html', ['role' => $Roles]);
    }
}
