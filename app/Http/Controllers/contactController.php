<?php

namespace App\Http\Controllers;
use App\Models\Contact;

use Illuminate\Http\Request;

class contactController extends Controller
{
    public function create()
    {
        return view('contact');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'sujet' => 'required',
            'message' => 'required',
        ]);
        $nom = $request->nom ;
        $email = $request->email;
        $sujet = $request->sujet;
        $message = $request->message;


        contact::create([
            'nom' => $nom,
            'email' => $email,
            'sujet' => $sujet,
            'message' => $message,
        ]);

        return redirect()->route('home')->with('success', 'Message envoyé avec succès!');
    }
   public function messages()
    {
        $messages = contact::paginate(10);
        return view('messages', compact('messages'));
    }

    public function destroy($id)
    {
        $message = contact::findOrFail($id);
        $message->delete();
        
        return redirect()->route('messages')->with('success', 'Message marqué comme traité avec succès!');
    }
    
}
