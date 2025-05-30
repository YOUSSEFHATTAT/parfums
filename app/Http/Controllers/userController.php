<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{
     public function show()
     {
        return view('inscription');
     }

     public function inscrire(Request $request)
     {
        $request->validate([
            'nom' => 'required|min:2|',
            'email' => 'required|email|unique:utilisateurs,email',
            'mot_de_passe' => 'required|min:8|confirmed',
        ]);
        $nom = $request->nom;
        $email = $request->email;
        $mot_de_passe = $request->mot_de_passe;

        Utilisateur::create([
            'nom' => $nom,
            'email' => $email,
            'mot_de_passe' => Hash::make($mot_de_passe),
        ]);
        

        return redirect()->route('home')->with('success', 'Utilisateur ajouté avec succès.');
     }
     public function connexion(Request $request)
     {
        return view('connecter');
     }

     public function connexionSend(Request $request)
      { 
      
        
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ]);
        $email = $request->email;
        $mot_de_passe = $request->mot_de_passe;
    
        $user = Utilisateur::where('email', $email)->first();
    
        if ($user && Hash::check($mot_de_passe, $user->mot_de_passe)) {
            
            Auth::login($user);
            $request->session()->regenerate();
            return to_route('home')->with('success', 'Connexion réussie.');
        } else {
            return back()->withErrors([
                'email' => 'Email ou mot de passe incorrect.',
            ])->onlyInput('email');
        }
     }
     public function deconnecter(Request $request) {
        Session::flush();
        Auth::logout();
        return redirect()->route('connexion')->with('success', 'Vous avez été déconnecté.');
     }
     
     public function usersliste(Request $request) {
        $searchTerm = $request->input('search');
        
        $users = Utilisateur::when($searchTerm, function ($query) use ($searchTerm) {
            return $query->where(function($q) use ($searchTerm) {
                $q->where('nom', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        })->paginate(10);

        return view('users', compact('users', 'searchTerm'));
     }

     public function updateRole(Request $request, $id)
     {
        $user = Utilisateur::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Rôle mis à jour avec succès');
     }
    }