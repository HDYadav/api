<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Seller extends User
{
    //use HasFactory;

    public function prodcuts(){
        return $this->hasMany(Product::class);
    }
}
