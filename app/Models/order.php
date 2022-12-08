<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'couli_id',
        'livreur_id',
        'time',
        'total',
        'statue',
        'place_now',
        'return_raison',
    ];

    public function colis(){
        return $this->belongsTo(couli::class);
    }

    public function livreur(){
        return $this->belongsTo(User::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
