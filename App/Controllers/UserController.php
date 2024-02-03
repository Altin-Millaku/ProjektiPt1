<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Role;
use App\Models\User;
use \Core\View;
use \Core\Controller;
use http\Message;

class UserController extends Controller
{
    public function index()
    {
        $session = Session::getInstance();
        $session_role = $session->getUserRole();
        if ($session->isSignedIn()) {
            if ($session_role != '2') {
                $message = '';
                if (!empty($session->message)) {
                    $message = $session->message;
                }
                $users = User::orderBy('id', 'desc')
                    ->with('role')->get();
                View::renderTemplate('Users/index.html', [
                    'users' => $users,
                    'session_role' => $session_role,
                    'message' => $message
                ]);
            }else{
                $session->message("You dont have permission for this action!");
                header('Location: /');
            }
        } else {
            $session->message("You need to sign in first");
            header('Location: /login-form');
        }
    }

    public function create()
    {
        $session = Session::getInstance();
        $session_role = $session->getUserRole();
        if ($session->isSignedIn()) {
            if ($session_role == '1') {
                $roles = Role::orderBy('name')->get();
                View::renderTemplate('Users/create.html', ['roles' => $roles]);
            } else {
                $session->message("You dont have permission for this action!");
                header('Location: /admin-users');
            }
        } else {
            $session->message("You need to sign in first!");
            header('Location: /login-form');
        }

    }

    public function store()
    {
        $session = Session::getInstance();
        $session_role = $session->getUserRole();
        if ($session->isSignedIn()) {
            if ($session_role == '1') {
                $user = new User();
                $user->name = $_POST['name'];
                $user->surname = $_POST['surname'];
                $user->email = $_POST['email'];
                $user->password = $_POST['password'];
                $user->role_id = "2";
                if ($user->save()) {
                    header('Location:/admin-users');
                } else {
                    echo "Deshtoi!";
                    dd($user);
                }
            } else {
                $session->message("You dont have permission for this action!");
                header('Location: /admin-users');
            }
        } else {
            $session->message("You need to sign in first!");
            header('Location: /login-form');
        }
    }

    public function edit()
    {
        $session = Session::getInstance();
        $session_role = $session->getUserRole();
        if ($session->isSignedIn()) {
            if ($session_role == '1') {
                $id = $_POST['id'];
                $user = User::findOrFail($id);
                $roles = Role::orderBy('name')->get();
                View::renderTemplate('Users/edit.html', ['user' => $user,
                    'roles' => $roles]);
            } else {
                $session->message("You dont have permission for this action!");
                header('Location: /admin-users');
            }
        } else {
            $session->message("You need to sign in first!");
            header('Location: /login-form');
        }

    }

    public function update()
    {
        $session = Session::getInstance();
        $session_role = $session->getUserRole();
        if ($session->isSignedIn()) {
            if ($session_role == '1') {
                $id = $_POST['id'];
                $user = User::findOrFail($id);
                $user->name = $_POST['name'];
                $user->surname = $_POST['surname'];
                $user->email = $_POST['email'];
                $user->password = $_POST['password'];
                $user->role_id = $_POST['role_id'];
                if ($user->save()) {
                    header('Location:/admin-users');
                } else {
                    echo "Deshtoi!";
                    dd($user);
                }
            } else {
                $session->message("You dont have permission for this action!");
                header('Location: /admin-users');
            }
        } else {
            $session->message("You need to sign in first!");
            header('Location: /login-form');
        }
    }

    public function destroy()
    {
        $session = Session::getInstance();
        $session_role = $session->getUserRole();
        if ($session->isSignedIn()) {
            if ($session_role == '1') {
                $id = $_POST['id'];
                $user = User::findOrFail($id);
                if ($user->delete()) {
                    header('Location:/admin-users');
                } else {
                    echo "Deshtoi!";
                    dd($user);
                }
            } else {
                $session->message("You dont have permission for this action!");
                header('Location: /admin-users');
            }
        } else {
            $session->message("You need to sign in first!");
            header('Location: /login-form');
        }
    }

    public function loginForm()
    {

        $session = Session::getInstance();
        $message = '';
        if (!$session->isSignedIn()) {
            if (!empty($session->message)) {
                $message = $session->message;
            }
            View::renderTemplate('Auth/login.html', ['message' => $message]);
        } else {
            $session->message("You are already signed-in");
            header('Location: /');

        }
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = User::where('email', $email)->where('password', $password)->latest()->first();
        $session = Session::getInstance();
        if ($user) {
            $session->login($user);
            header('Location: /');
            exit;
        } else {
            $session->message("Your email or password is incorrent");
            header('Location: /login-form');
        }
    }

    public function logout()
    {
        $session = Session::getInstance();
        $session->logout();
        header('Location: /');

    }

    public function signup()
    {

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        
        $confirm_password = $_POST['confirm_password'];
        $session = Session::getInstance();

    
        if (empty($name) || empty($surname) || empty($email) || empty($password)) {
            $session->message("Please fill in all fields.");
            $this->signupForm();
            return;
        }

        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            $session->message("This email is already registered.");
            $this->signupForm();
            return;
        }
        $newUser = new User();
        $newUser->name = $name;
        $newUser->surname = $surname;
        $newUser->email = $email;
        $newUser->password = $password;

        
        $newUser->role_id = 2;

        $newUser->save();

        $session->login($newUser);

        header('Location: /');
        exit;
    }

    public function signupForm()
    {
        $session = Session::getInstance();
        $message = '';
        if (!$session->isSignedIn()) {
            if (!empty($session->message)) {
                $message = $session->message;
            }
            View::renderTemplate('Auth/signup.html', ['message' => $message]);

        } else {
            $session->message("You are already signed-in ");
            header('Location: /');
        }
    }
    public function settings(){
        $session = Session::getInstance();
        if ($session->isSignedIn()) {
            $userid = $session->getUserId();
            View::renderTemplate('Settings/settings.html', ['userid' => $userid]);
        }
    }
}