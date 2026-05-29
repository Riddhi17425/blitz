<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'detail_images' => 'array',
    ];

    public function technicalSpecifications()
    {
        return $this->hasMany(ProductTechnicalSpecification::class, 'product_id');
    }
}
