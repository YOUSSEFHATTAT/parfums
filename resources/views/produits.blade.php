@extends('layouts.master')

@section('title', 'Produits')

@section('main')
<div class="container my-5">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="page-title">COLLECTION DE PRODUITS</h1>
            
            @if(auth()->user() && auth()->user()->role !== 'user')
            <a href="{{ route('add') }}" class="add-btn">
                <i class="fas fa-plus"></i> Ajouter un produit
            </a>
            @endif
        </div>
        
        <div class="mt-4">
            <form method="GET" action="{{ route('produits.index') }}" class="search-form">
                <div class="search-container">
                    <input type="text" name="search" class="form-control search-input" 
                           placeholder="Rechercher par titre..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <select name="categorie" class="form-select category-select" onchange="this.form.submit()">
                    <option value="">Toutes les catégories</option>
                    <option value="homme" {{ request('categorie') == 'homme' ? 'selected' : '' }}>Homme</option>
                    <option value="femme" {{ request('categorie') == 'femme' ? 'selected' : '' }}>Femme</option>
                </select>
            </form>
        </div>
    </div>

    <div class="products-grid">
        @foreach ($produits as $index => $produit)
        <div class="product-card animate-fade-in" style="animation-delay: {{ $index * 0.1 }}s">
            <div class="product-image-container">
                <img src="{{ asset('storage/' . $produit->image) }}" 
                     class="product-image" 
                     alt="{{ $produit->titre }}"
                     loading="lazy">
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
                        <span class="product-info-value price">{{ number_format($produit->prix, 2) }} MAD</span>
                    </div>
                    <div class="product-info-item">
                        <span class="product-info-label">Quantité</span>
                        <span class="product-info-value">{{ $produit->quantite }}</span>
                    </div>
                    <div class="product-info-item">
                        <span class="product-info-label">Catégorie</span>
                        <span class="product-info-value">{{ ucfirst($produit->categorie) }}</span>
                    </div>
                    <div class="product-info-item">
                        <span class="product-info-label">Taille</span>
                        <span class="product-info-value">{{ $produit->taille }} mL</span>
                    </div>
                </div>
                
                <a href="{{ route('produits.show', $produit->id) }}" class="view-details">
                    <i class="fas fa-eye"></i> Découvrir
                </a>
            </div>

            @if(auth()->user() && auth()->user()->role !== 'user')
            <div class="product-footer">
                <a href="{{ route('modifier', $produit->id) }}" class="btn-edit">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <form method="POST" action="{{ route('supprimer', $produit->id) }}" 
                      class="delete-form" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn-delete">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    @if($produits->isEmpty())
    <div class="empty-state">
        <i class="fas fa-box-open"></i>
        <h3>Aucun produit trouvé</h3>
        <p>Aucun produit ne correspond à vos critères de recherche.</p>
    </div>
    @endif

    <div class="pagination-wrapper">
        {{ $produits->appends(request()->query())->links() }}
    </div>
</div>

<style>
.add-btn,.page-title{color:var(--primary-color);text-transform:uppercase}.add-btn:hover,.page-header{box-shadow:var(--shadow-md)}.add-btn,.page-title,.stock-badge,.view-details{text-transform:uppercase}:root{--primary-color:#D4AF37;--primary-light:#F8E9A1;--primary-dark:#A67C00;--accent-color:#D4AF37;--text-light:#F8E9A1;--text-dark:#000000;--text-muted:#A67C00;--bg-light:#000000;--bg-gray:#111111;--bg-card:#1a1a1a;--danger-color:#dc3545;--success-color:#28a745;--warning-color:#ffc107;--shadow-sm:0 2px 10px rgba(212, 175, 55, 0.15);--shadow-md:0 4px 20px rgba(212, 175, 55, 0.2);--shadow-lg:0 10px 30px rgba(212, 175, 55, 0.3);--radius-sm:4px;--radius-md:8px;--radius-lg:12px;--transition:all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1)}.add-btn,.btn-search,.product-card{transition:var(--transition)}body{background-color:var(--bg-light);color:var(--text-light);font-family:Inter,-apple-system,BlinkMacSystemFont,sans-serif}.page-header{background:linear-gradient(135deg,var(--bg-gray) 0,var(--bg-card) 100%);border-radius:var(--radius-lg);padding:2rem;margin-bottom:2.5rem;border:1px solid var(--primary-color);position:relative;overflow:hidden}.page-header::before{content:'';position:absolute;top:0;left:0;width:4px;height:100%;background:linear-gradient(to bottom,var(--primary-color),var(--primary-light))}.page-title{font-size:2.5rem;font-weight:800;margin:0;letter-spacing:2px}.add-btn{background:linear-gradient(135deg,transparent,rgba(212,175,55,.1));border:2px solid var(--primary-color);padding:12px 24px;border-radius:var(--radius-md);font-weight:600;display:flex;align-items:center;gap:8px;letter-spacing:1px;text-decoration:none}.category-select,.search-input{border:1px solid var(--primary-dark);padding:12px 16px}.product-title,.stock-badge{font-weight:700;letter-spacing:.5px}.add-btn:hover{background:var(--primary-color);color:var(--bg-light);transform:translateY(-2px)}.category-select:focus,.search-input:focus{box-shadow:0 0 0 .2rem rgba(212,175,55,.25);border-color:var(--primary-color)}.search-form{display:flex;gap:1rem;flex-wrap:wrap;align-items:center}.search-container{display:flex;flex:1;min-width:300px;position:relative}.search-input{background-color:var(--bg-card);color:var(--text-light);border-radius:var(--radius-md) 0 0 var(--radius-md);flex:1}.search-input:focus{background-color:var(--bg-gray)}.btn-search{background-color:var(--primary-color);border:1px solid var(--primary-color);color:var(--bg-light);padding:12px 16px;border-radius:0 var(--radius-md) var(--radius-md) 0}.btn-search:hover{background-color:var(--primary-dark);transform:scale(1.05)}.category-select{background-color:var(--bg-card);color:var(--text-light);border-radius:var(--radius-md);min-width:200px}.products-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:2rem;margin-bottom:3rem}.product-card{background:linear-gradient(145deg,var(--bg-gray),var(--bg-card));border:1px solid var(--primary-dark);border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-sm);height:100%;display:flex;flex-direction:column;opacity:0}.product-card:hover{transform:translateY(-8px) scale(1.02);box-shadow:var(--shadow-lg);border-color:var(--primary-color)}.product-image-container{position:relative;overflow:hidden;height:280px;background:linear-gradient(45deg,var(--bg-gray),var(--bg-card))}.product-image{width:100%;height:100%;object-fit:cover;transition:transform .6s;filter:contrast(110%) brightness(95%)}.product-card:hover .product-image{transform:scale(1.1) rotate(1deg)}.product-overlay{position:absolute;top:0;left:0;width:100%;height:100%;background:linear-gradient(to bottom,rgba(0,0,0,0) 40%,rgba(0,0,0,.3) 70%,rgba(0,0,0,.8) 100%);opacity:.6;transition:var(--transition)}.product-card:hover .product-overlay{opacity:.8}.stock-badge{position:absolute;top:1rem;right:1rem;padding:6px 12px;border-radius:var(--radius-sm);font-size:.75rem;z-index:10;backdrop-filter:blur(10px)}.in-stock{background:rgba(40,167,69,.9);color:#fff;border:1px solid var(--success-color)}.low-stock{background:rgba(255,193,7,.9);color:var(--bg-light);border:1px solid var(--warning-color)}.out-of-stock{background:rgba(220,53,69,.9);color:#fff;border:1px solid var(--danger-color)}.product-body{padding:1.5rem;flex-grow:1;display:flex;flex-direction:column}.product-title{font-size:1.25rem;color:var(--primary-color);margin-bottom:1rem;line-height:1.3;transition:var(--transition)}.product-card:hover .product-title{color:var(--primary-light);transform:translateX(4px)}.product-info{display:flex;flex-direction:column;gap:.75rem;margin-bottom:1.5rem}.product-info-item{display:flex;justify-content:space-between;align-items:center;padding:.5rem 0;border-bottom:1px solid rgba(212,175,55,.2)}.product-info-label{font-weight:600;color:var(--text-muted);font-size:.9rem}.product-info-value{font-weight:700;color:var(--text-light)}.btn-delete,.btn-edit,.view-details{font-weight:600;text-decoration:none;text-align:center;display:flex;transition:var(--transition)}.btn-edit,.product-info-value.price,.view-details{color:var(--primary-color)}.product-info-value.price{font-size:1.1rem}.view-details{align-items:center;justify-content:center;gap:.5rem;background:linear-gradient(135deg,transparent,rgba(212,175,55,.1));padding:12px 20px;border-radius:var(--radius-md);margin-top:auto;border:1px solid var(--primary-color);letter-spacing:.5px}.view-details:hover{background:var(--primary-color);color:var(--bg-light);transform:translateY(-2px)}.product-footer{background:rgba(212,175,55,.05);padding:1rem 1.5rem;display:flex;gap:.75rem;border-top:1px solid rgba(212,175,55,.2)}.btn-delete,.btn-edit{flex:1;padding:10px 16px;border-radius:var(--radius-md);align-items:center;justify-content:center;gap:.5rem;font-size:.9rem}.btn-edit{background:0 0;border:1px solid var(--primary-color)}.btn-edit:hover{background:var(--primary-color);color:var(--bg-light)}.btn-delete{background:0 0;color:var(--danger-color);border:1px solid var(--danger-color)}.btn-delete:hover{background:var(--danger-color);color:#fff}.delete-form{flex:1}.empty-state{text-align:center;padding:4rem 2rem;color:var(--text-muted)}.empty-state i{font-size:4rem;color:var(--primary-dark);margin-bottom:1rem}.empty-state h3{color:var(--primary-color);margin-bottom:.5rem}.pagination-wrapper{display:flex;justify-content:center;margin-top:3rem}.pagination .page-item.active .page-link{background-color:var(--primary-color);border-color:var(--primary-color);color:var(--bg-light)}.pagination .page-link{color:var(--primary-color);padding:12px 16px;background-color:var(--bg-gray);border:1px solid var(--primary-dark);margin:0 2px;border-radius:var(--radius-md);transition:var(--transition)}.pagination .page-link:hover{color:var(--bg-light);background-color:var(--primary-dark);transform:translateY(-2px)}@keyframes fadeInUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}.animate-fade-in{animation:.8s ease-out forwards fadeInUp}@media (max-width:1200px){.products-grid{grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem}}@media (max-width:768px){.page-header{padding:1.5rem;margin-bottom:2rem}.page-title{font-size:2rem}.search-form{flex-direction:column;gap:1rem}.category-select,.search-container{min-width:100%}.products-grid{grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:1rem}.product-body{padding:1rem}.product-title{font-size:1.1rem}.product-footer{padding:.75rem 1rem;flex-direction:column;gap:.5rem}.btn-delete,.btn-edit{width:100%}}@media (max-width:576px){.products-grid{grid-template-columns:1fr}.product-image-container{height:220px}.page-header .d-flex{flex-direction:column;gap:1rem;align-items:stretch}}
</style>
@endsection