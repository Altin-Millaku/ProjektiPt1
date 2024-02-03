<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Role extends Eloquent
{
    public function user(){
        return $this->hasMany(User::class);
    }
}