<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //use HasFactory;
    const AVALABLE_PRODCUT ="available";
    const UNAVALABLE_PRODCUT ="unavailable";
    protected $fillable =[
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id'
    ];

    public function isAvalable(){

    return $this->status == Product::AVALABLE_PRODCUT;
    
    }
    public function sellers(){
        return $this->belongsTo(Seller::class);
    }
    public function transactions(){
        
        return $this->hasMany(Transaction::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

}
