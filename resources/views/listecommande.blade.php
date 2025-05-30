@extends('layouts.master')

@section('title', 'Liste des Commandes')

@section('main')
<style>
    .order-card,.products-list{overflow:hidden}:root{--primary-color:#D4AF37;--primary-light:#F8E9A1;--primary-dark:#A67C00;--accent-color:#D4AF37;--text-light:#F8E9A1;--text-dark:#000000;--text-muted:#A67C00;--bg-light:#000000;--bg-gray:#111111;--shadow-sm:0 2px 10px rgba(212, 175, 55, 0.15);--shadow-md:0 4px 20px rgba(212, 175, 55, 0.2);--shadow-lg:0 10px 30px rgba(212, 175, 55, 0.3)}body{background-color:var(--bg-light);color:var(--text-light)}.container{max-width:1200px;margin:0 auto;padding:40px 20px}.page-title{font-size:2rem;font-weight:700;color:var(--primary-color);margin-bottom:30px;border-bottom:1px solid var(--primary-dark);padding-bottom:15px;text-transform:uppercase;letter-spacing:1px}.badge,.info-label,.products-title{text-transform:uppercase;letter-spacing:.5px}.order-card{box-shadow:var(--shadow-md);margin-bottom:30px;border:1px solid var(--primary-dark);transition:transform .2s,box-shadow .2s;background-color:var(--bg-gray)}.order-card:hover{transform:translateY(-3px);box-shadow:var(--shadow-lg);border-color:var(--primary-color)}.order-header{display:flex;justify-content:space-between;align-items:center;padding:15px 20px;background:linear-gradient(135deg,var(--primary-dark),var(--bg-gray));color:var(--text-light);border-bottom:1px solid var(--primary-color)}.order-id{font-weight:700;font-size:1.1rem;color:var(--primary-color)}.order-customer{font-size:.95rem;opacity:.9}.order-body{padding:25px;background-color:var(--bg-gray)}.badge-danger,.badge-primary,.badge-success,.badge-warning{background-color:transparent}.order-info{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:25px}.info-item{margin-bottom:10px}.info-label{font-weight:600;color:var(--text-muted);margin-bottom:5px;display:block;font-size:.85rem}.info-value{font-size:1rem;color:var(--text-light)}.badge{display:inline-flex;align-items:center;padding:6px 12px;font-size:.85rem;font-weight:500}.badge-warning{color:#ffc107;border:1px solid #ffc107}.badge-primary{color:var(--primary-color);border:1px solid var(--primary-color)}.badge-success{color:#28a745;border:1px solid #28a745}.badge-danger{color:#dc3545;border:1px solid #dc3545}.form-select,.products-list{border:1px solid var(--primary-dark)}.form-select{cursor:pointer;padding:10px 30px 10px 15px;background-color:var(--bg-light);color:var(--text-light);font-size:.875rem;appearance:none;background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23D4AF37' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");background-position:right .5rem center;background-repeat:no-repeat;background-size:1.5em 1.5em;transition:.2s}.form-select:focus{outline:0;border-color:var(--primary-color);box-shadow:0 0 0 3px rgba(212,175,55,.1)}.products-title{font-size:1.1rem;font-weight:600;margin:25px 0 15px;color:var(--primary-color);display:flex;align-items:center;gap:10px}.product-item{padding:12px 15px;display:flex;justify-content:space-between;border-bottom:1px solid var(--primary-dark);background-color:var(--bg-gray)}.product-item:last-child{border-bottom:none}.product-item:nth-child(odd){background-color:rgba(212,175,55,.05)}.product-name{font-weight:500;color:var(--text-light)}.product-price{font-weight:600;color:var(--primary-color)}.alert{padding:15px;margin-bottom:25px;border-left:4px solid transparent}.alert-success{background-color:rgba(40,167,69,.1);color:#28a745;border-left-color:#28a745}.alert-info{background-color:rgba(212,175,55,.1);color:var(--primary-color);border-left-color:var(--primary-color)}@media (max-width:768px){.order-header{flex-direction:column;align-items:flex-start;gap:10px}.order-info{grid-template-columns:1fr;gap:15px}}
</style>

<div class="container">
    <h1 class="page-title">GESTION DES COMMANDES</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($commandes->isEmpty())
        <div class="alert alert-info">Aucune commande pour le moment.</div>
    @else
        @foreach ($commandes as $commande)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <span class="order-id">COMMANDE #{{ $commande->id }}</span>
                    </div>
                    <div class="order-customer">
                        {{ $commande->nom }} ({{ $commande->email }})
                    </div>
                </div>
                <div class="order-body">
                    <div class="order-info">
                        <div class="info-item">
                            <span class="info-label">ADRESSE</span>
                            <div class="info-value">{{ $commande->adresse }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">TOTAL</span>
                            <div class="info-value">{{ number_format($commande->total, 2) }} MAD</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">STATUT</span>
                            <div class="info-value">
                                @if($commande->statut === 'en attente')
                                    <span class="badge badge-warning">EN ATTENTE</span>
                                @elseif($commande->statut === 'en cours')
                                    <span class="badge badge-primary">EN COURS</span>
                                @elseif($commande->statut === 'livrée')
                                    <span class="badge badge-success">LIVRÉE</span>
                                @elseif($commande->statut === 'annulée')
                                    <span class="badge badge-danger">ANNULÉE</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">MODIFIER LE STATUT</span>
                            <form method="POST" action="{{ route('commande.update.statut', ['id' => $commande->id]) }}">
                                @csrf
                                @method('PUT')
                                <select name="statut" onchange="this.form.submit()" class="form-select">
                                    <option {{ $commande->statut == 'en attente' ? 'selected' : '' }}>en attente</option>
                                    <option {{ $commande->statut == 'en cours' ? 'selected' : '' }}>en cours</option>
                                    <option {{ $commande->statut == 'livrée' ? 'selected' : '' }}>livrée</option>
                                    <option {{ $commande->statut == 'annulée' ? 'selected' : '' }}>annulée</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    
                    <h5 class="products-title">PRODUITS COMMANDÉS</h5>
                    <ul class="products-list">
                        @foreach ($commande->items as $item)
                            <li class="product-item">
                                <span class="product-name">{{ $item->produit }} (x{{ $item->quantite }})</span>
                                <span class="product-price">{{ number_format($item->prix_unitaire * $item->quantite, 2) }} MAD</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection