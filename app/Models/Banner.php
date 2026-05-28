<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'status',
        'alt_tag', 
        'updated_at',
        'deleted_at'
    ];
}
