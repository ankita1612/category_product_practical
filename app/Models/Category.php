<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id'];
    
    public function subcategory()
    {
        return $this->hasMany(\App\Models\Category::class, 'category_id')->with('subcategory');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'category_id');
    }
}