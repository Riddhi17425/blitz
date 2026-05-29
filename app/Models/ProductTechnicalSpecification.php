<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTechnicalSpecification extends Model
{
    protected $table = 'product_technical_specifications';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
