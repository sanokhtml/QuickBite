<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clap extends Model
{
    public const UPDATED_AT = null;
    protected $fillable = ['post_id', 'user_id'];
    public $timestamps = false;

    public function post()
    {
        return $this->belongsto(Post::class);
    }

    public function user()
    {
        return $this->belongsto(User::class);
    }
}
