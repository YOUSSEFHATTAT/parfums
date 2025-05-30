<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\CommandeItem;

class CommandeController extends Controller
{
    public function form()
    {
        $panier = session()->get('panier', []);
        return view('commande', compact('panier'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'adresse' => 'required|string',
        ]);

        $panier = session()->get('panier', []);
        if (!$panier || count($panier) == 0) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($panier as $item) {
            $total += $item['prix'] * $item['quantite'];
        }

        $commande = Commande::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'total' => $total,
            'user_id' => auth()->id(),
        ]);

        foreach ($panier as $item) {
            CommandeItem::create([
                'commande_id' => $commande->id,
                'produit' => $item['titre'],
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix'],
                'categorie' => $item['categorie'],
                'taille' => $item['taille'],
            ]);
        }

        session()->forget('panier');

        return redirect()->route('panier.index')->with('success', 'Commande passée avec succès !');
    }
    public function listeCommandes()
    {
        $commandes = Commande::with('items')->get();
        return view('listecommande', compact('commandes'));
    }

    public function updateStatut(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->statut = $request->statut;
        
        if ($request->statut === 'annulée') {
            $commande->delete();
            return redirect()->back()->with('success', 'Commande annulée et supprimée avec succès.');
        }
        
        $commande->save();
        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }
   public function mesCommandes() 
{
    $commandes = Commande::where('id', auth()->id())->with('produits')->paginate(10);
    return view('mescommandes', compact('commandes'));
}


}
