<?php

namespace App\Models\bons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class livraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'livreur_id',
        'admin_statue',
        'livreur_statue',
        'admin_at',
        'livreur_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bon_livraison(){
        return $this->hasMany(coli::class);
    }


}
