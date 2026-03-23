<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'price',
        'sale_price',
        'stock',
        'description',
        'image',
        'is_active',
        'is_delete',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
