<?php

namespace App\Http\Controllers;

use App\Models\produits;
use Illuminate\Http\Request;

class produitsController extends Controller
{
    public function index(Request $request)
    {
        $query = produits::query();
        
        // Recherche par titre
        if ($request->filled('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }
        
        // Filtre par catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }
        
        $produits = $query->paginate(10);
        
        return view('produits', compact('produits'));
    }

    public function add()
    {
        return view('ajouterproduit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255|unique:produits,titre',
            'description' => 'required|string|max:1000',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'categorie' => 'required|string',
            'taille' => 'required|string',
        ]);

        $produit = produits::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'image' => $request->file('image')->store('produit', 'public'),
            'categorie' => $request->categorie,
            'taille' => $request->taille,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

public function show(produits $produit)
{
    return view('produit', compact('produit'));
}

public function supprimer(produits $produit)

{
    $produit->delete();
    return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
}

public function modifierform(produits $produit)
{
    return view('modifier', compact('produit'));
}

public function modifier(produits $produit, Request $request)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'prix' => 'required|numeric|min:0',
        'quantite' => 'required|integer|min:1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        'categorie' => 'required|string',
        'taille' => 'required|string',
    ]);

    $data = [
        'titre' => $request->titre,
        'description' => $request->description,
        'prix' => $request->prix,
        'quantite' => $request->quantite,
        'categorie' => $request->categorie,
        'taille' => $request->taille,
    ];

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('produits', 'public');
    }


    $produit->update($data);
    


    return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès.');
}



} 
