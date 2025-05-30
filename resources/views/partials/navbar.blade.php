<style>
.btn,.navbar-menu li a{border-radius:4px;text-decoration:none;transition:.3s}.luxury-navbar{background-color:#111;color:#fff;padding:15px 0}.luxury-navbar .container{display:flex;align-items:center;justify-content:space-between}.navbar-brand img{height:40px;margin-right:20px;border-radius:8px;transition:transform .3s}.navbar-brand img:hover{transform:scale(1.05)}.navbar-menu{display:flex;list-style:none;margin:0;padding:0;gap:20px;flex:1}.navbar-menu li a{color:#f4c842;font-weight:500;padding:8px 12px}.btn-outline:hover,.navbar-menu li a:hover{background-color:rgba(244,200,66,.1)}.navbar-menu li a.active{background:#333;border-radius:4px}.navbar-auth{display:flex;gap:10px;align-items:center}.btn{padding:6px 12px;font-weight:600}.btn-outline{border:1px solid #f4c842;color:#f4c842;background:0 0}.btn-primary{background-color:#f4c842;color:#000;border:none}.btn-primary:hover{background-color:#e5b93a;transform:translateY(-2px);box-shadow:0 4px 8px rgba(244,200,66,.2)}.btn-danger{background-color:#dc3545;color:#fff;border:none}.btn-danger:hover{background-color:#bb2d3b;transform:translateY(-2px);box-shadow:0 4px 8px rgba(220,53,69,.2)}img{border-radius:8px}@media screen and (max-width:768px){.navbar-auth,.navbar-menu{margin-top:15px;width:100%}.luxury-navbar .container{flex-direction:column;align-items:flex-start}.navbar-menu{flex-direction:column}.navbar-auth{flex-direction:column;align-items:flex-start}.btn{width:100%;text-align:center;margin-bottom:5px}}
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
                    <li><a href="{{ route('usersliste') }}" class="{{ request()->routeIs('usersliste') ? 'active' : '' }}">Gestion des utilisateurs</a></li>
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