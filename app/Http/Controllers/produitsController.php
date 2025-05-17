<?php

namespace App\Http\Controllers;

use App\Models\produits;
use Illuminate\Http\Request;

class produitsController extends Controller
{
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
    ]);
        $titre = $request->titre;
        $description = $request->description;
        $prix = $request->prix;
        $quantite = $request->quantite;
        $image =$request->file('image')->store('produit', 'public');
        
;

        produits::create([
        'titre' => $titre,
        'description' => $description,
        'prix' => $prix,
        'quantite' => $quantite,
        'image' => $image,
    ]);

    return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
}



public function index()
{
    
    $produits = produits::paginate(8);

    return view('produits', compact('produits'));
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
    ]);

    $data = [
        'titre' => $request->titre,
        'description' => $request->description,
        'prix' => $request->prix,
        'quantite' => $request->quantite,
    ];

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('produits', 'public');
    }


    $produit->update($data);
    


    return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès.');
}



} 
