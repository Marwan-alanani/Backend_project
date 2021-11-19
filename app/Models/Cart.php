<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'Product_id',
        'Total'
    ];
    protected $with=[
        'user',
        'product'
    ];
    use HasFactory;
    public function product(){
        return $this->belongsTo(Products::class,'Product_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
