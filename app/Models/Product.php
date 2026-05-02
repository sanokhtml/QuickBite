<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['restaurant_id', 'name', 'price', 'description'];

    public function imageUrl() {
        return $this->getFirstMediaUrl('images') ?: asset('images/default-food.png');
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}