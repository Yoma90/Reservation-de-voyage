<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'phone',
        'agency_id',
        'location',
        'status',
        'image_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function agency()
    {
        return $this->belongsTo('App\Models\Agency');
    }

    public function villes()
    {
        return $this->hasMany('App\Models\AgencyVille');
    }


    public function bus()
    {
        return $this->hasMany('App\Models\Bus', 'agency_id');
    }

    public function histories()
    {
        return $this->belongsTo('App\Models\Histories');
    }

    public function getImagePathAttribute()
    {
        return env('APP_URL') ."/storage/villes/". $this->attributes['image_path'];
    }
}
