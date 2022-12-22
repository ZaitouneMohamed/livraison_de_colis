<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_now',
        'livreur_id',
        'ramasser_at',
        'statue',
        'emballe_at',
        'encours_at',
        'livrée_at',
        'anuller_at',
        'retourner_at',
    ];

    public function coli(){
        return $this->hasMany(coli::class);
    }

    public function livreur(){
        return $this->belongsTo(User::class);
    }

}
