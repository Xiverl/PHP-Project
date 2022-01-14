<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryFiles extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description'
    ];
}
