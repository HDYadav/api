<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Transaction extends Model
{
   // use HasFactory;
    protected $fillable =[
        'quantity',
        'buyer_id',
        'product_id'
    ];

    public function buyers(){
        return $this->belongsTo(Buyer::class);
    }
    public function prodcuts(){
        return $this->belongsTo(Product::class);
    }
}
