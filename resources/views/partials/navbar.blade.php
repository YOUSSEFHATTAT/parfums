<style>
   .luxury-navbar {
    background-color: #111;
    color: #fff;
    padding: 15px 0;
}

.luxury-navbar .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.navbar-brand img {
    height: 40px;
    margin-right: 20px;
    border-radius: 8px; /* Ajout du border-radius au logo */
    transition: transform 0.3s ease;
}

.navbar-brand img:hover {
    transform: scale(1.05);
}

/* Liens de navigation */
.navbar-menu {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 20px;
    flex: 1;
}

.navbar-menu li a {
    color: #f4c842;
    text-decoration: none;
    font-weight: 500;
    padding: 8px 12px;
    border-radius: 4px; /* Ajout du border-radius aux liens */
    transition: all 0.3s ease;
}

.navbar-menu li a:hover {
    background-color: rgba(244, 200, 66, 0.1);
}

.navbar-menu li a.active {
    background: #333;
    border-radius: 4px;
}

/* Zone d'auth à droite */
.navbar-auth {
    display: flex;
    gap: 10px;
    align-items: center;
}

.btn {
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline {
    border: 1px solid #f4c842;
    color: #f4c842;
    background: transparent;
}

.btn-outline:hover {
    background-color: rgba(244, 200, 66, 0.1);
}

.btn-primary {
    background-color: #f4c842;
    color: #000;
    border: none;
}

.btn-primary:hover {
    background-color: #e5b93a;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(244, 200, 66, 0.2);
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
    border: none;
}

.btn-danger:hover {
    background-color: #bb2d3b;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
}

/* Style global pour toutes les images */
img {
    border-radius: 8px; /* Ajout du border-radius à toutes les images */
}

/* Responsive */
@media screen and (max-width: 768px) {
    .luxury-navbar .container {
        flex-direction: column;
        align-items: flex-start;
    }

    .navbar-menu {
        flex-direction: column;
        width: 100%;
        margin-top: 15px;
    }

    .navbar-auth {
        margin-top: 15px;
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }

    .btn {
        width: 100%;
        text-align: center;
        margin-bottom: 5px;
    }
}
</style>

<nav class="luxury-navbar">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('images/dmlogo.png') }}" alt="Logo" class="navbar-logo">
        </a>

        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a></li>
            <li><a href="{{ route('produits.index') }}" class="{{ request()->routeIs('produits.index') ? 'active' : '' }}">Produits</a></li>

            @auth
                @if(auth()->user()->role !== 'user')
                    <li><a href="{{ route('add') }}" class="{{ request()->routeIs('add') ? 'active' : '' }}">Ajouter Produit</a></li>
                    <li><a href="{{ route('commandes.liste') }}" class="{{ request()->routeIs('commandes.liste') ? 'active' : '' }}">Commandes</a></li>
                    <li><a href="{{ route('messages') }}" class="{{ request()->routeIs('messages') ? 'active' : '' }}">Boîte de réception</a></li>
                @else
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                    <li><a href="{{ route('panier.index') }}" class="{{ request()->routeIs('panier.index') ? 'active' : '' }}">Panier</a></li>
                @endif
            @endauth
        </ul>
        <div class="navbar-auth">
            @guest
                <a href="{{ route('inscription') }}" class="btn btn-outline">S'inscrire</a>
                <a href="{{ route('connexion') }}" class="btn btn-primary">Se connecter</a>
            @else
                <form action="{{ route('deconnecter') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Se déconnecter</button>
                </form>
            @endguest
        </div>
    </div>
</nav>