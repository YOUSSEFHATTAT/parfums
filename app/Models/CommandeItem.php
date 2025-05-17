<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'commande_id',
        'produit',
        'quantite',
        'prix_unitaire',
    ];
    public function commande() {
        return $this->belongsTo(Commande::class);
    }
    
}
