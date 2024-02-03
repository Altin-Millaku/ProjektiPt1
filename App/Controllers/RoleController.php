<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Role;
use App\Models\User;
use \Core\View;
use \Core\Controller;


class RoleController extends Controller
{



    public function __construct()
    {
        $session = Session::getInstance();
        $role = $session->getUserRole();
        if (!$session->isSignedIn()) {
            header('Location: /login-form');
            exit;
        }
        if($role == '2'){
            $session->message("You dont have permission for this action!");
            header('Location: /');
            exit;
        }
    }

    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->get();
        $session = Session::getInstance();
        $session_role = $session->getUserRole();
        $message = '';
        if ($session_role != 'Costumer') {
            if (!empty($session->message)) {
                $message = $session->message;
            }
            View::renderTemplate('Roles/index.html', ['message'=>$message, 'roles' => $roles, 'session_role' => $session_role]);
        } else {
            $session->message("You dont have permission for this action!");
            header('Location: /');
        }
    }

    public function create()
    {
        $session = Session::getInstance();
        $role = $session->getUserRole();
        if ($role == '1') {
            View::renderTemplate('Roles/create.html');
        } else {
            $session->message("You dont have permission for this action!");
            header('Location: /admin-roles');
        }
    }

    public function store()
    {

        $role = new Role();
        $role->name = $_POST['name'];
        $role->description = $_POST['description'];
        if ($role->save()) {
            header('Location:/admin-roles');
        } else {
            echo "Deshtoi!";
            dd($role);
        }
    }

    public function edit()
    {
        $session = Session::getInstance();
        $roles = $session->getUserRole();
        if ($roles == '1') {
            $id = $_POST['id'];
            $role = Role::findOrFail($id);
            View::renderTemplate('Roles/edit.html', ['role' => $role]);
        } else {
            header('Location: /login-form');
        }
    }

    public function update()
    {


        $id = $_POST['id'];
        $role = Role::findOrFail($id);
        $role->name = $_POST['name'];
        $role->description = $_POST['description'];
        if ($role->save()) {
            header('Location:/admin-roles');
        } else {
            echo "Deshtoi!";
            dd($role);
        }

    }

    public function destroy()
    {
        $session = Session::getInstance();
        $roles = $session->getUserRole();
        if ($roles == '1') {
            $id = $_POST['id'];
            $role = Role::findOrFail($id);
            if ($role->delete()) {
                header('Location:/admin-roles');
            } else {
                echo "Deshtoi!";
                dd($role);
            }
        } else {
            header('Location: /login-form');
        }
    }


}
