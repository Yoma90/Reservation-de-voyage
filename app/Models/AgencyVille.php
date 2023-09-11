<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyVille extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'agency_id',
        'ville_id'
    ];

    public function agency(){
        return $this->belongsTo('App\Models\Agency');
    }

    public function ville(){
        return $this->belongsTo('App\Models\Ville');
    }
}
