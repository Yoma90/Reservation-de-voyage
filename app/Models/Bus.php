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
        'status'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
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
