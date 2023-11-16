<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'regular_price',
        'description',
        'short_description',
        'categories',
        'images'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getCategoriesAttribute($value) {
        return json_decode($value, true);
    }

    public function getImagePathAttribute()
    {
        return env('APP_URL') ."/storage/products/". $this->attributes['image_path'];
    }
}
