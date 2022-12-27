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
        'B_liv_id',
        'B_ram_id',
        'B_dis_id',
        'B_pay_id',
        'B_ret_id',
        'place_now',
        'statue',
        'note',
        'user_id',
        'livreur_id',
        'order_id',
        'admin_id',
        'admin_at',
        'livreur_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function admin(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(order::class);
    }

}
