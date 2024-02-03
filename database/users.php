<?php
require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function ($table) {
    $table->id();
    $table->string('name', 30);
    $table->string('surname', 30);
    $table->string('email')->unique();
    $table->string('password');
    $table->integer('role_id');
    $table->timestamps();
});