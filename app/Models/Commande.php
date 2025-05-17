<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'email',
        'adresse',
        'total',
        'statut',
    ];
    public function items() {
        return $this->hasMany(CommandeItem::class);
    }
    public function produits()
{
    return $this->belongsToMany(Produits::class)->withPivot('quantite');
}
    
}
