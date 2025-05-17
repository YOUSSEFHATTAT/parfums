@extends('layouts.master')

@section('title', 'Mes Commandes')

@section('main')
<div class="container my-5">
    <h2 class="mb-4">🧾 Mes Commandes</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($commandes->isEmpty())
        <div class="alert alert-info">Vous n'avez passé aucune commande pour le moment.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Nom</th>
                    <th>Produits</th>
                    <th>Total (MAD)</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                        <td>{{ $commande->nom }}</td>
                        <td>
                            <ul>
                                @foreach ($commande->produits as $produit)
                                    <li>{{ $produit->titre }} (x{{ $produit->pivot->quantite }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ number_format($commande->total, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $commande->statut == 'en attente' ? 'warning' : ($commande->statut == 'livré' ? 'success' : 'secondary') }}">
                                {{ ucfirst($commande->statut) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $commandes->links() }}
        </div>
    @endif
</div>
@endsection
