<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Product;
use \Core\View;
use \Core\Controller;


class ProductController extends Controller
{

    public function __construct()
    {
        $session = Session::getInstance();
        $role = $session->getUserRole();
        if (!$session->isSignedIn() ) {
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
        $products = Product::orderBy('id','desc')->get();
        $session = Session::getInstance();
        $role = $session->getUserRole();
        View::renderTemplate('Products/index.html', ['products' => $products, 'role'=>$role]);
    }

    public function create()
    {
        View::renderTemplate('Products/create.html');
    }

    public function store()
    {
        $products = new Product();
        $products->name = $_POST['name'];
        $products->description = $_POST['description'];
        $products->price = $_POST['price'];
        $products->path = $_POST['path'];
        if($products->save()){
            header('Location:/admin-products');
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
            header('Location:/admin-products');
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
            header('Location:/admin-products');
        }else{
            echo "Deshtoi!";
            dd($products);
        }
    }
}
