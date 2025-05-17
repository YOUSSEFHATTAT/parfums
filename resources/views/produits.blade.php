@extends('layouts.master')

@section('title', 'Produits')

@section('main')
<style>
    :root {
        --primary-color: #D4AF37;
        --primary-light: #F8E9A1;
        --primary-dark: #A67C00;
        --accent-color: #D4AF37;
        --text-light: #F8E9A1;
        --text-dark: #000000;
        --text-muted: #A67C00;
        --bg-light: #000000;
        --bg-gray: #111111;
        --shadow-sm: 0 2px 10px rgba(212, 175, 55, 0.15);
        --shadow-md: 0 4px 20px rgba(212, 175, 55, 0.2);
        --shadow-lg: 0 10px 30px rgba(212, 175, 55, 0.3);
        --radius-sm: 0;
        --radius-md: 0;
        --radius-lg: 0;
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
        background-color: var(--bg-light);
        color: var(--text-light);
    }

    .page-header {
        background-color: var(--bg-gray);
        border-radius: var(--radius-md);
        padding: 30px;
        margin-bottom: 40px;
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
        border: 1px solid var(--primary-color);
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background-color: var(--primary-color);
    }

    .page-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0;
        letter-spacing: 1px;
    }

    .add-btn {
        background-color: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        padding: 10px 20px;
        border-radius: var(--radius-sm);
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .add-btn:hover {
        background-color: var(--primary-color);
        transform: translateY(-2px);
        color: var(--bg-light);
    }

    .add-btn i {
        font-size: 0.9rem;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .product-card {
        border: 1px solid var(--primary-color);
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        background-color: var(--bg-gray);
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-light);
    }

    .product-image-container {
        position: relative;
        overflow: hidden;
        height: 250px;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
        filter: contrast(110%) brightness(90%);
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 60%, rgba(0,0,0,0.8) 100%);
        opacity: 0.3;
        transition: var(--transition);
    }

    .product-card:hover .product-overlay {
        opacity: 0.5;
    }

    .product-body {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 15px;
        line-height: 1.3;
        transition: var(--transition);
        letter-spacing: 0.5px;
    }

    .product-card:hover .product-title {
        color: var(--primary-light);
    }

    .product-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 20px;
    }

    .product-info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--primary-dark);
    }

    .product-info-label {
        font-weight: 600;
        color: var(--text-muted);
    }

    .product-info-value {
        font-weight: 700;
        color: var(--text-light);
    }

    .product-info-value.price {
        color: var(--primary-color);
        font-size: 1.2rem;
    }

    .product-footer {
        background-color: rgba(212, 175, 55, 0.1);
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        border-top: 1px solid var(--primary-dark);
    }

    .btn-edit {
        background-color: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        padding: 8px 16px;
        border-radius: var(--radius-sm);
        font-weight: 600;
        transition: var(--transition);
        flex: 1;
        text-align: center;
    }

    .btn-edit:hover {
        background-color: var(--primary-color);
        color: var(--bg-light);
    }

    .btn-delete {
        background-color: transparent;
        color: #dc3545;
        border: 1px solid #dc3545;
        padding: 8px 16px;
        border-radius: var(--radius-sm);
        font-weight: 600;
        transition: var(--transition);
        flex: 1;
        text-align: center;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        color: var(--bg-light);
    }

    .stock-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 5px 12px;
        border-radius: 0;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .in-stock {
        background-color: var(--primary-color);
        color: var(--bg-light);
    }

    .low-stock {
        background-color: var(--primary-dark);
        color: var(--bg-light);
    }

    .out-of-stock {
        background-color: #111;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
    }

    .view-details {
        display: inline-block;
        background-color: transparent;
        color: var(--primary-color);
        padding: 10px 20px;
        border-radius: var(--radius-sm);
        font-weight: 600;
        transition: var(--transition);
        text-align: center;
        margin-top: auto;
        text-decoration: none;
        border: 1px solid var(--primary-color);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .view-details:hover {
        background-color: var(--primary-color);
        color: var(--bg-light);
    }

    .pagination {
        margin-top: 40px;
        justify-content: center;
    }

    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--bg-light);
    }

    .page-link {
        color: var(--primary-color);
        padding: 10px 15px;
        background-color: var(--bg-gray);
        border-color: var(--primary-dark);
    }

    .page-link:hover {
        color: var(--bg-light);
        background-color: var(--primary-dark);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .product-card {
        opacity: 0;
        animation: fadeInUp 0.8s ease-out forwards;
    }

    @media (max-width: 992px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 1.8rem;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .product-body {
            padding: 15px;
        }

        .product-title {
            font-size: 1.1rem;
        }

        .product-footer {
            padding: 10px 15px;
        }
    }

    @media (max-width: 576px) {
        .products-grid {
            grid-template-columns: 1fr;
        }

        .product-image-container {
            height: 200px;
        }
    }
</style>

<div class="container my-5">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h1>COLLECTION DE PRODUITS</h1>

        @if(auth()->user() && auth()->user()->role !== 'user')
        <a href="{{ route('add') }}" class="add-btn">
            <i class="fas fa-plus"></i> Ajouter un produit
        </a>
        @endif
    </div>

    <div class="products-grid">
        @foreach ($produits as $index => $produit)
        <div class="product-card" style="animation-delay: {{ $index * 0.1 }}s">
            <div class="product-image-container">
                <img src="{{ asset('storage/' . $produit->image) }}" class="product-image" alt="{{ $produit->titre }}">
                <div class="product-overlay"></div>
                
                @if($produit->quantite > 10)
                    <div class="stock-badge in-stock">Disponible</div>
                @elseif($produit->quantite > 0)
                    <div class="stock-badge low-stock">Édition limitée</div>
                @else
                    <div class="stock-badge out-of-stock">Indisponible</div>
                @endif
            </div>

            <div class="product-body">
                <h5 class="product-title">{{ $produit->titre }}</h5>
                
                <div class="product-info">
                    <div class="product-info-item">
                        <span class="product-info-label">Prix</span>
                        <span class="product-info-value price">{{ $produit->prix }} MAD</span>
                    </div>
                    <div class="product-info-item">
                        <span class="product-info-label">Quantité</span>
                        <span class="product-info-value">{{ $produit->quantite }}</span>
                    </div>
                </div>
                
                <a href="{{ route('produits.show', $produit->id) }}" class="view-details">
                    Découvrir
                </a>
            </div>

            @if(auth()->user() && auth()->user()->role !== 'user')
            <div class="product-footer">
                <a href="{{ route('modifier', $produit->id) }}" class="btn-edit">Modifier</a>
                <form method="POST" action="{{ route('supprimer', $produit->id) }}" class="d-inline" style="flex: 1;">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn-delete w-100">Supprimer</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $produits->links() }}
    </div>
</div>
@endsection