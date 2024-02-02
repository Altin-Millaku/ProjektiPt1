<?php
require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('products', function ($table) {
    $table->id();
    $table->string('name', 30);
    $table->string('description');
    $table->decimal('price',10,2);
    $table->string('path');
    $table->timestamps();
});