<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = true;

   
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'created_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');

    }
}
