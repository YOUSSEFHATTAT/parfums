@extends('layouts.master')

@section('title', 'Mon Panier')

@section('main')
<style>
    :root {
        --primary-color: #D4AF37;
        --primary-light: #F8E9A1;
        --primary-dark: #A67C00;
        --accent-color: #D4AF37;
        --success-color: #D4AF37;
        --danger-color: #A67C00;
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

    .cart-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px 60px;
    }

    .page-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 30px;
        position: relative;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 2px;
        background: var(--primary-color);
    }

    .cart-card {
        background: var(--bg-gray);
        border: 1px solid var(--primary-color);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .cart-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .cart-table th {
        background-color: var(--primary-dark);
        color: var(--text-light);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        padding: 15px;
        text-align: left;
    }

    .cart-table th:last-child {
        text-align: center;
    }

    .cart-table td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid var(--primary-dark);
    }

    .cart-table tr:last-child td {
        border-bottom: none;
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid var(--primary-color);
    }

    .product-image:hover {
        transform: scale(1.05);
    }

    .product-title {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 1.1rem;
        transition: var(--transition);
        text-decoration: none;
    }

    .product-title:hover {
        color: var(--primary-light);
    }

    .product-price {
        font-weight: 700;
        color: var(--text-light);
        font-size: 1.1rem;
    }

    .quantity-display {
        width: 70px;
        height: 40px;
        border: 1px solid var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: var(--text-light);
        margin: 0 auto;
        background-color: var(--bg-light);
    }

    .subtotal {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    .remove-btn {
        background-color: transparent;
        color: var(--danger-color);
        border: 1px solid var(--danger-color);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        cursor: pointer;
    }

    .remove-btn:hover {
        background-color: var(--danger-color);
        color: var(--bg-light);
    }

    .remove-icon {
        font-size: 1.2rem;
    }

    .cart-total-row {
        background-color: rgba(212, 175, 55, 0.1);
    }

    .cart-total-label {
        text-align: right;
        font-weight: 600;
        font-size: 1.2rem;
        color: var(--text-light);
        padding-right: 20px !important;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .cart-total-value {
        font-weight: 800;
        font-size: 1.3rem;
        color: var(--primary-color);
    }

    .checkout-btn {
        background-color: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        padding: 15px 30px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .checkout-btn:hover {
        background-color: var(--primary-color);
        color: var(--bg-light);
        transform: translateY(-2px);
    }

    .checkout-icon {
        font-size: 1.2rem;
    }

    .empty-cart {
        background-color: var(--bg-gray);
        padding: 40px 20px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--primary-color);
    }

    .empty-cart-message {
        font-size: 1.3rem;
        color: var(--text-light);
        margin-bottom: 20px;
    }

    .continue-shopping-btn {
        background-color: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        padding: 12px 25px;
        font-weight: 600;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .continue-shopping-btn:hover {
        background-color: var(--primary-color);
        color: var(--bg-light);
        transform: translateY(-2px);
    }

    .alert-success {
        background-color: rgba(212, 175, 55, 0.1);
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        padding: 15px;
        margin-bottom: 20px;
        position: relative;
    }

    .btn-close {
        position: absolute;
        right: 15px;
        top: 15px;
        background: none;
        border: none;
        color: var(--primary-color);
        font-size: 1.2rem;
        cursor: pointer;
    }

    @media (max-width: 992px) {
        .cart-container {
            padding: 30px 15px 50px;
        }

        .page-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 768px) {
        .product-title {
            font-size: 1rem;
        }

        .product-price, .subtotal {
            font-size: 1rem;
        }

        .cart-total-label {
            font-size: 1.1rem;
        }

        .cart-total-value {
            font-size: 1.2rem;
        }

        .checkout-btn {
            padding: 12px 25px;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .cart-table {
            display: block;
            overflow-x: auto;
        }

        .cart-table th, .cart-table td {
            padding: 10px;
        }

        .product-image {
            width: 60px;
            height: 60px;
        }

        .quantity-display {
            width: 60px;
            height: 35px;
        }

        .remove-btn {
            width: 35px;
            height: 35px;
        }

        .empty-cart-message {
            font-size: 1.1rem;
        }
    }
</style>

<div class="cart-container">
    <h1 class="page-title">VOTRE PANIER</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @endif

    @if (count($panier) > 0)
        <div class="cart-card">
            <div class="table-responsive">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th style="width: 100px;">IMAGE</th>
                            <th>PRODUIT</th>
                            <th style="width: 120px;">PRIX</th>
                            <th style="width: 120px; text-align: center;">QUANTITÉ</th>
                            <th style="width: 150px;">SOUS-TOTAL</th>
                            <th style="width: 80px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($panier as $id => $item)
                            @php $total += $item['prix'] * $item['quantite']; @endphp
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['titre'] }}" class="product-image">
                                </td>
                                <td>
                                    <a href="{{ route('produits.show', $id) }}" class="product-title">
                                        {{ $item['titre'] }}
                                    </a>
                                </td>
                                <td class="product-price">
                                    {{ number_format($item['prix'], 2, ',', ' ') }} MAD
                                </td>
                                <td style="text-align: center;">
                                    <div class="quantity-display">
                                        {{ $item['quantite'] }}
                                    </div>
                                </td>
                                <td class="subtotal">
                                    {{ number_format($item['prix'] * $item['quantite'], 2, ',', ' ') }} MAD
                                </td>
                                <td style="text-align: center;">
                                    <form action="{{ route('panier.supprimer', $id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit du panier ?');">
                                        @csrf
                                        <button type="submit" class="remove-btn" title="Supprimer">
                                            <i class="bi bi-trash remove-icon"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="cart-total-row">
                            <td colspan="4" class="cart-total-label">TOTAL</td>
                            <td colspan="2" class="cart-total-value">
                                {{ number_format($total, 2, ',', ' ') }} MAD
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('produits.index') }}" class="continue-shopping-btn">
                <i class="bi bi-arrow-left"></i> RETOUR AUX PRODUITS
            </a>
            <a href="{{ route('commande.form') }}" class="checkout-btn">
                FINALISER LA COMMANDE <i class="bi bi-arrow-right checkout-icon"></i>
            </a>
        </div>
    @else
        <div class="empty-cart">
            <p class="empty-cart-message">VOTRE PANIER EST VIDE</p>
            <a href="{{ route('produits.index') }}" class="continue-shopping-btn">
                <i class="bi bi-cart"></i> DÉCOUVRIR NOS PRODUITS
            </a>
        </div>
    @endif
</div>
@endsection