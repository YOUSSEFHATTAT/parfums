@extends('layouts.master')

@section('title', 'Détails du Produit')

@section('main')
<style>
  :root{--primary-color:#D4AF37;--primary-light:#F8E9A1;--primary-dark:#A67C00;--accent-color:#D4AF37;--text-light:#F8E9A1;--text-dark:#000000;--text-muted:#A67C00;--bg-light:#000000;--bg-gray:#111111;--shadow-sm:0 2px 10px rgba(212, 175, 55, 0.15);--shadow-md:0 4px 20px rgba(212, 175, 55, 0.2);--shadow-lg:0 10px 30px rgba(212, 175, 55, 0.3);--radius-sm:0;--radius-md:0;--radius-lg:0;--transition:all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1)}.product-detail,.product-image-section{overflow:hidden;border:1px solid var(--primary-color);position:relative}body{background-color:var(--bg-light);color:var(--text-light)}.product-container{max-width:1200px;margin:0 auto;padding:40px 20px}.breadcrumb{display:flex;align-items:center;margin-bottom:30px;font-size:.9rem}.breadcrumb a,.breadcrumb-current{font-size:.8rem;letter-spacing:1px;text-transform:uppercase}.breadcrumb a{color:var(--text-muted);text-decoration:none;transition:var(--transition)}.breadcrumb a:hover{color:var(--primary-color)}.breadcrumb-separator{margin:0 10px;color:var(--text-muted)}.breadcrumb-current{color:var(--primary-color);font-weight:600}.product-detail{background:var(--bg-gray)}.product-image-section{box-shadow:var(--shadow-sm);height:100%}.product-detail-img{width:100%;height:100%;object-fit:cover;transition:transform .5s;filter:contrast(110%) brightness(90%)}.product-image-section:hover .product-detail-img{transform:scale(1.03)}.image-gallery-dots{display:flex;justify-content:center;margin-top:15px;gap:8px}.gallery-dot{width:10px;height:10px;background-color:var(--text-muted);opacity:.5;cursor:pointer;transition:var(--transition)}.add-to-cart-btn:hover,.btn-admin:hover,.gallery-dot.active,.in-stock{background-color:var(--primary-color)}.gallery-dot.active{opacity:1;transform:scale(1.2)}.gallery-dot:hover{opacity:.8}.product-info-section{padding:30px;display:flex;flex-direction:column;height:100%}.product-title{font-size:2.2rem;font-weight:700;color:var(--primary-color);margin-bottom:20px;line-height:1.2;letter-spacing:1px}.product-description{font-size:1.1rem;color:var(--text-light);line-height:1.6;margin-bottom:25px}.product-attributes{margin-bottom:30px}.product-attribute{display:flex;justify-content:space-between;padding:15px 0;border-bottom:1px solid var(--primary-dark)}.out-of-stock,.quantity-input{border:1px solid var(--primary-color)}.product-attribute:last-child{border-bottom:none}.attribute-label{font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:1px;font-size:.9rem}.attribute-value{font-weight:700;color:var(--text-light)}.attribute-value.price{font-size:1.5rem;color:var(--primary-color)}.stock-badge{display:inline-block;padding:5px 12px;font-size:.85rem;font-weight:600;margin-left:10px;text-transform:uppercase;letter-spacing:.5px}.btn-admin:hover,.in-stock{color:var(--bg-light)}.low-stock{background-color:var(--primary-dark);color:var(--bg-light)}.out-of-stock{background-color:var(--bg-light);color:var(--primary-color)}.quantity-input,.quantity-label{color:var(--text-light);font-weight:600}.add-to-cart-section{background-color:rgba(212,175,55,.1);padding:25px;margin-top:20px;border:1px solid var(--primary-dark)}.quantity-selector{display:flex;align-items:center;margin-bottom:20px}.quantity-label{margin-right:15px;text-transform:uppercase;letter-spacing:1px;font-size:.9rem}.quantity-input{width:120px;padding:10px 15px;background-color:var(--bg-light);font-size:1rem;text-align:center;transition:var(--transition)}.add-to-cart-btn,.btn-admin{background-color:transparent;border:1px solid var(--primary-color);transition:var(--transition);gap:10px}.add-to-cart-btn,.btn-admin,.section-title{color:var(--primary-color);text-transform:uppercase;letter-spacing:1px}.quantity-input:focus{border-color:var(--primary-light);outline:0;box-shadow:0 0 0 3px rgba(212,175,55,.2)}.add-to-cart-btn{padding:15px 25px;font-weight:600;font-size:1.1rem;display:flex;align-items:center;justify-content:center;width:100%;cursor:pointer}.add-to-cart-btn:hover{color:var(--bg-light);transform:translateY(-2px)}.add-to-cart-btn:active{transform:translateY(0)}.cart-icon{font-size:1.2rem}.related-products{margin-top:60px}.section-title{font-size:1.8rem;font-weight:700;margin-bottom:30px;position:relative;display:inline-block}.section-title::after{content:'';position:absolute;bottom:-10px;left:0;width:60px;height:2px;background:var(--primary-color)}.btn-admin{padding:10px 20px;font-weight:600;display:flex;align-items:center;justify-content:center;text-decoration:none}.btn-admin.delete{color:#dc3545;border-color:#dc3545}.btn-admin.delete:hover{background-color:#dc3545;color:var(--bg-light)}@keyframes fadeIn{from{opacity:0}to{opacity:1}}.animate-fade-in{animation:.8s ease-out forwards fadeIn}@media (max-width:992px){.product-title{font-size:1.8rem}}@media (max-width:768px){.add-to-cart-section,.product-container,.product-info-section{padding:20px}.product-title{font-size:1.6rem;margin-bottom:15px}.product-description{font-size:1rem;margin-bottom:20px}}@media (max-width:576px){.breadcrumb{margin-bottom:20px}.product-attribute{padding:10px 0}.attribute-value.price{font-size:1.3rem}.add-to-cart-btn{padding:12px 20px;font-size:1rem}}
</style>

<div class="product-container">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">ACCUEIL</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('produits.index') }}">COLLECTION</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">{{ $produit->titre }}</span>
    </div>

    <div class="product-detail animate-fade-in">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="product-image-section m-3">
                    <img src="{{ asset('storage/' . $produit->image) }}" class="product-detail-img" alt="{{ $produit->titre }}">
                </div>
                <div class="image-gallery-dots">
                    <div class="gallery-dot active"></div>
                    <div class="gallery-dot"></div>
                    <div class="gallery-dot"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="product-info-section">
                    <h1 class="product-title">{{ $produit->titre }}</h1>
                    <p class="product-description">{{ $produit->description }}</p>

                    <div class="product-attributes">
                        <div class="product-attribute">
                            <span class="attribute-label">PRIX</span>
                            <span class="attribute-value price">{{ $produit->prix }} MAD</span>
                        </div>
                        <div class="product-attribute">
                            <span class="attribute-label">CATEGORIE</span>
                            <span class="attribute-value">{{ $produit->categorie }}</span>
                        </div>
                        <div class="product-attribute">
                            <span class="attribute-label">TAILLE</span>
                            <span class="attribute-value">{{ $produit->taille }} mL</span>
                        </div>
                        <div class="product-attribute">
                            <span class="attribute-label">DISPONIBILITÉ</span>
                            <span class="attribute-value">
                                @if($produit->quantite > 10)
                                    <span class="stock-badge in-stock">DISPONIBLE</span>
                                @elseif($produit->quantite > 0)
                                    <span class="stock-badge low-stock">ÉDITION LIMITÉE ({{ $produit->quantite }})</span>
                                @else
                                    <span class="stock-badge out-of-stock">INDISPONIBLE</span>
                                @endif
                            </span>
                        </div>
                        
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="product-attribute">
                            <span class="attribute-label">QUANTITÉ EN STOCK</span>
                            <span class="attribute-value">{{ $produit->quantite }}</span>
                        </div>
                        @endif
                    </div>

                    @if(auth()->check() && auth()->user()->role !== 'admin' && $produit->quantite > 0)
                    <div class="add-to-cart-section">
                        <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST">
                            @csrf
                            <div class="quantity-selector">
                                <label for="quantite" class="quantity-label">QUANTITÉ</label>
                                <input
                                    type="number"
                                    id="quantite"
                                    name="quantite"
                                    class="quantity-input"
                                    value="1"
                                    min="1"
                                    max="{{ $produit->quantite }}"
                                    required
                                >
                            </div>
                            <button type="submit" class="add-to-cart-btn">
                                <i class="fas fa-shopping-cart cart-icon"></i>
                                AJOUTER AU PANIER
                            </button>
                        </form>
                    </div>
                    @elseif(auth()->check() && auth()->user()->role !== 'admin' && $produit->quantite <= 0)
                    <div class="add-to-cart-section">
                        <p class="text-center mb-0 fw-bold" style="color: var(--primary-color);">CE PRODUIT EST ACTUELLEMENT INDISPONIBLE</p>
                    </div>
                    @endif

                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('modifier', $produit->id) }}" class="btn-admin flex-grow-1">
                            <i class="fas fa-edit me-2"></i> MODIFIER
                        </a>
                        <form method="POST" action="{{ route('supprimer', $produit->id) }}" class="flex-grow-1">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn-admin delete w-100">
                                <i class="fas fa-trash-alt me-2"></i> SUPPRIMER
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="related-products">
        <h2 class="section-title">PRODUITS SIMILAIRES</h2>
    </div>
</div>
@endsection