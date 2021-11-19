<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable= ['Product_name','Main_type','absolute_path','relative_path','Price','category_id'];
    protected $with=[
        'category'
    ];
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
