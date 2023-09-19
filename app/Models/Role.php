<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "description"
    ];


    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function bus(){
        return $this->hasMany('App\Models\Bus');
    }

    public function agency(){
        return $this->hasMany('App\Models\Agency');
    }
}
