<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'description',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function manager(){
        return $this->hasOne('App\Models\User');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function agency_ville(){
        return $this->hasMany('App\Models\AgencyVille');
    }

    public function getImagePathAttribute()
    {
        return env('APP_URL') ."/storage/villes/". $this->attributes['image_path'];
    }

    public function agency()
    {
        return $this->belongsToMany('App\Models\Agency', 'agency_ville');
    }
}
