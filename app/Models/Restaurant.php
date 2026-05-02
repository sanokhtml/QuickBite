<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Restaurant extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name', 
        'slug', 
        'description', 
        'category_id',
        'delivery_time',
        'delivery_price'
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}
}