<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coli extends Model
{
    use HasFactory;

    protected $fillable = [
        'destinataire',
        'telephone',
        'ville',
        'prix',
        'adresse',
        'products',
        'total',
        'place_now',
        'statue',
        'note',
        'user_id',
        'livreur_id',
        'admin_id',
        'admin_at',
        'livreur_at',
        'ramasser_at',
        'emballe_at',
        'encours_at',
        'livrée_at',
        'anuller_at',
        'retourner_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function admin(){
        return $this->belongsTo(User::class);
    }
}
