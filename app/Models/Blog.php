<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'blog_faq' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
