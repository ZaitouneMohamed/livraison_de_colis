<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class couli extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination',
        'telephone',
        'prix',
        'ville',
        'adresse',
        'produit',
        'note',
        'autre',
        'statue',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->hasMany(order::class);
    }
}
