<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    protected $guarded = [];

    use SoftDeletes;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
