<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bus(){
        return $this->hasMany('App\Models\Bus');
    }

    public function user(){
        return $this->hasOne('App\Models\User');
    }

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }

    public function agency_ville(){
        return $this->hasMany('App\Models\AgencyVille');
    }


    public function villes()
    {
        return $this->belongsToMany('App\Models\Ville', 'AgencyVille', 'agency_id', 'ville_id');
    }
}
