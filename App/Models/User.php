<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    public function role(){
        return $this->belongsTo(Role::class);
    }
}