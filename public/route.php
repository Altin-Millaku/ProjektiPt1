<?php

$router = new Core\Router();

$router->add('admin', ['controller' => 'Home', 'action' => 'index']);

$router->add('admin-costumers', ['controller' => 'CostumerController', 'action' => 'index']);
$router->add('admin-costumers-create', ['controller' => 'CostumerController', 'action' => 'create']);
$router->add('admin-costumers-store', ['controller' => 'CostumerController', 'action' => 'store']);
$router->add('admin-costumers-edit', ['controller' => 'CostumerController', 'action' => 'edit']);
$router->add('admin-costumers-update', ['controller' => 'CostumerController', 'action' => 'update']);
$router->add('admin-costumers-delete', ['controller' => 'CostumerController', 'action' => 'destroy']);

$router->add('admin-employees', ['controller' => 'EmployeeController', 'action' => 'index']);
$router->add('admin-employees-create', ['controller' => 'EmployeeController', 'action' => 'create']);
$router->add('admin-employees-store', ['controller' => 'EmployeeController', 'action' => 'store']);
$router->add('admin-employees-edit', ['controller' => 'EmployeeController', 'action' => 'edit']);
$router->add('admin-employees-update', ['controller' => 'EmployeeController', 'action' => 'update']);
$router->add('admin-employees-delete', ['controller' => 'EmployeeController', 'action' => 'destroy']);

$router->add('admin-orders', ['controller' => 'OrderController', 'action' => 'index']);
$router->add('admin-orders-create', ['controller' => 'OrderController', 'action' => 'create']);
$router->add('admin-orders-store', ['controller' => 'OrderController', 'action' => 'store']);
$router->add('admin-orders-edit', ['controller' => 'OrderController', 'action' => 'edit']);
$router->add('admin-orders-update', ['controller' => 'OrderController', 'action' => 'update']);
$router->add('admin-orders-delete', ['controller' => 'OrderController', 'action' => 'destroy']);

$router->add('admin-products', ['controller' => 'ProductController', 'action' => 'index']);
$router->add('admin-products-create', ['controller' => 'ProductController', 'action' => 'create']);
$router->add('admin-products-store', ['controller' => 'ProductController', 'action' => 'store']);
$router->add('admin-products-edit', ['controller' => 'ProductController', 'action' => 'edit']);
$router->add('admin-products-update', ['controller' => 'ProductController', 'action' => 'update']);
$router->add('admin-products-delete', ['controller' => 'ProductController', 'action' => 'destroy']);

$router->add('admin-roles', ['controller' => 'RoleController', 'action' => 'index']);
$router->add('admin-roles-create', ['controller' => 'RoleController', 'action' => 'create']);
$router->add('admin-roles-store', ['controller' => 'RoleController', 'action' => 'store']);
$router->add('admin-roles-edit', ['controller' => 'RoleController', 'action' => 'edit']);
$router->add('admin-roles-update', ['controller' => 'RoleController', 'action' => 'update']);
$router->add('admin-roles-delete', ['controller' => 'RoleController', 'action' => 'destroy']);

$router->add('admin-users', ['controller' => 'UserController', 'action' => 'index']);
$router->add('admin-users-create', ['controller' => 'UserController', 'action' => 'create']);
$router->add('admin-users-store', ['controller' => 'UserController', 'action' => 'store']);
$router->add('admin-users-edit', ['controller' => 'UserController', 'action' => 'edit']);
$router->add('admin-users-update', ['controller' => 'UserController', 'action' => 'update']);
$router->add('admin-users-delete', ['controller' => 'UserController', 'action' => 'destroy']);



$router->add('settings', ['controller' => 'UserController', 'action' => 'settings']);
$router->add('login-form', ['controller' => 'UserController', 'action' => 'loginForm']);
$router->add('login', ['controller' => 'UserController', 'action' => 'login']);
$router->add('logout', ['controller' => 'UserController', 'action' => 'logout']);
$router->add('signup-form', ['controller' => 'UserController', 'action' => 'signupForm']);
$router->add('signup', ['controller' => 'UserController', 'action' => 'signup']);

$router->add('', ['controller' => 'CccController', 'action' => 'index']);
$router->add('about', ['controller' => 'CccAboutController', 'action' => 'index']);
$router->add('location', ['controller' => 'CccLocationController', 'action' => 'index']);
$router->add('products', ['controller' => 'CccProductController', 'action' => 'index']);
$router->add('store', ['controller' => 'CccStoreController', 'action' => 'index']);
$router->add('contact', ['controller' => 'CccContactController', 'action' => 'index']);




$router->dispatch($_SERVER['QUERY_STRING']);












?>