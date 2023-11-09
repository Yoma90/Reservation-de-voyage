<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory;
    protected $fillable=[
        'from',
        'to',
        'details',
        'price',
        'status'
    ];

    public function arrival(){
        return $this->belongsTo('App\Models\Ville', 'to');
    }
    public function departure(){
        return $this->belongsTo('App\Models\Ville', 'from');
    }
}
