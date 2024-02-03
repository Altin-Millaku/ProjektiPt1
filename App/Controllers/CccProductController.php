<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Costumer;
use App\Models\Employee;
use App\Models\Product;
use \Core\View;
use \Core\Controller;

class CccProductController extends Controller
{
    
    public function index()
    {
        $session = Session::getInstance();
        $isLoggdin = $session->isUserSignedin();
        $getUserRole = $session->getUserRole();
        $message = '';
        $products = Product::orderBy('id','desc')->get();
        if(!empty($session->message)){
            $message = $session->message;
        }

        View::renderTemplate('ccc/index.html', [
            'products' => $products,
            'isLoggdin'=>$isLoggdin,
            'role'=>$getUserRole,
            'message'=>$message]);
    }

    public function create()
    {
        View::renderTemplate('Products/login.html');
    }

    public function store()
    {
        $products = new Product();
        $products->name = $_POST['name'];
        $products->description = $_POST['description'];
        $products->price = $_POST['price'];
        $products->path = $_POST['path'];
        if($products->save()){
            header('Location:/products');
        }else{
            echo "Deshtoi!";
            dd($products);
        }
    }

    public function edit()
    {
        $id = $_POST['id'];
        $products = Product::findOrFail($id);
        View::renderTemplate('Products/edit.html', ['products'=>$products]);
    }

    public function update()
    {
        $id = $_POST['id'];
        $products = Product::findOrFail($id);
        $products->name = $_POST['name'];
        $products->description = $_POST['description'];
        $products->price = $_POST['price'];
        $products->path = $_POST['path'];
        if($products->save()){
            header('Location:/products');
        }else{
            echo "Deshtoi!";    
            dd($products);
        }
    }

    public function destroy()
    {
        $id = $_POST['id'];
        $products = Product::findOrFail($id);
        if($products->delete()){
            header('Location:/products');
        }else{
            echo "Deshtoi!";
            dd($products);
        }
    }
}
