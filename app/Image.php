<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    //

    protected $guarded = [];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
