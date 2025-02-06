<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'colorOptions',
        'sizeOptions',
    ];


    protected $casts = [
        'colorOptions' => 'array',
        'sizeOptions' => 'array',
    ];

    // Relationship with Product Images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Relationship with OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
