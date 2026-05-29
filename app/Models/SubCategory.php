<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'cta_icon' => 'array',
        'cta_title' => 'array',
        'cta_description' => 'array',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function hasAssociations(): bool
    {
        return $this->products()->exists();
    }
}
