<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillables = [
        'name'
    ];

    public function bus(){
        return $this->hasMany('App\Models\Bus');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
