<?php

namespace App\Http\Controllers;
use App\Models\Produits;

use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function index()
    {
        $panier = session()->get('panier', []);
        return view('panier', compact('panier'));
    }

    public function ajouter(Request $request, $produit_id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);

        $quantite = $request->input('quantite');
        
        // Vérifier si le produit existe
        $produit = Produits::findOrFail($produit_id);
        
        // Vérifier si la quantité demandée est disponible
        if ($quantite > $produit->quantite) {
            return redirect()->back()->with('error', 'Quantité non disponible. Seulement ' . $produit->quantite . ' unités disponibles.');
        }

        // Récupérer le panier depuis la session
        $panier = session()->get('panier', []);
        
        // Vérifier si le produit est déjà dans le panier
        if (isset($panier[$produit_id])) {
            // Mettre à jour la quantité
            $panier[$produit_id]['quantite'] += $quantite;
        } else {
            // Ajouter le produit au panier
            $panier[$produit_id] = [
                'titre' => $produit->titre,
                'prix' => $produit->prix,
                'quantite' => $quantite,
                'image' => $produit->image,
                'categorie' => $produit->categorie,
                'taille' => $produit->taille,
            ];
        }

        // Sauvegarder le panier mis à jour
        session()->put('panier', $panier);

        // Mettre à jour le total du panier
        $total = 0;
        foreach ($panier as $item) {
            $total += $item['prix'] * $item['quantite'];
        }
        session()->put('panier_total', $total);

        return redirect()->route('panier.index')->with('success', 'Produit ajouté au panier avec succès.');
    }

    public function supprimer($id)
    {
        $panier = session()->get('panier', []);
        if (isset($panier[$id])) {
            unset($panier[$id]);
            session()->put('panier', $panier);
        }

        return redirect()->back()->with('success', 'Produit supprimé du panier.');
    }

    public function update(Request $request, $id)
    {
        $panier = session()->get('panier', []);
        if (isset($panier[$id])) {
            $panier[$id]['quantite'] = $request->quantite;
            session()->put('panier', $panier);
        }

        return redirect()->route('panier.index')->with('success', 'Quantité mise à jour.');
    }
}
