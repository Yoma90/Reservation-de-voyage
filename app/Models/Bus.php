<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'immatriculation',
        'agency_id',
        'status'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function bus()
    {
        return $this->belongsTo('App\Models\User', 'agency_id');
    }

    public function agency()
    {
        return $this->belongsTo('App\Models\Agency');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeVip($query)
    {
        return $query->where('type', 'VIP');
    }

    public function scopeClassic($query)
    {
        return $query->where('type', 'Classic');
    }


}
