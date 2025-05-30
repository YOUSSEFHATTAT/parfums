@extends('layouts.master')

@section('title', 'Accueil')

@section('main')
<style>
    .welcome-container,body{color:var(--text-light)}.feature-box,.welcome-container{overflow:hidden;position:relative;display:flex}.feature-box .btn,.welcome-btn{text-decoration:none;font-weight:600}:root{--primary-color:#D4AF37;--primary-light:#F8E9A1;--primary-dark:#A67C00;--accent-color:#D4AF37;--text-light:#F8E9A1;--text-dark:#000000;--text-muted:#A67C00;--bg-light:#000000;--bg-gray:#111111;--shadow-sm:0 2px 10px rgba(212, 175, 55, 0.15);--shadow-md:0 4px 20px rgba(212, 175, 55, 0.2);--shadow-lg:0 10px 30px rgba(212, 175, 55, 0.3);--radius-sm:8px;--radius-md:12px;--radius-lg:20px;--transition:all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1)}.feature-box,.feature-box .btn,.feature-box img,.welcome-btn{transition:var(--transition)}body{background-color:var(--bg-light)}.welcome-full{width:100%;margin-bottom:60px}.welcome-container{height:550px;width:100%;flex-direction:column;justify-content:center;align-items:center;text-align:center;padding:60px 20px;background-image:url('{{ asset('images/acc.webp') }}');background-size:cover;background-position:center;background-repeat:no-repeat;border-radius:var(--radius-lg);box-shadow:var(--shadow-lg)}.welcome-container::before{content:"";position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(135deg,rgba(0,0,0,.8) 0,rgba(0,0,0,.7) 100%);z-index:0;border-radius:var(--radius-lg)}.welcome-container>*{position:relative;z-index:1;animation:.8s ease-out forwards fadeInUp;opacity:0}.welcome-container h1{font-size:4rem;margin-bottom:20px;font-weight:800;letter-spacing:1px;text-shadow:2px 2px 4px rgba(0,0,0,.3);animation-delay:.2s;color:var(--primary-color)}.welcome-container p{font-size:1.4rem;max-width:700px;margin-bottom:35px;font-weight:500;text-shadow:1px 1px 3px rgba(0,0,0,.3);animation-delay:.4s;line-height:1.6}.welcome-btn{background-color:var(--primary-color);color:var(--bg-light);border:2px solid var(--primary-color);padding:15px 32px;border-radius:var(--radius-sm);font-size:1.1rem;box-shadow:0 4px 15px rgba(212,175,55,.4);animation-delay:.6s;text-transform:uppercase;letter-spacing:.5px}.welcome-btn:hover{background-color:transparent;color:var(--primary-color);transform:translateY(-3px);box-shadow:0 6px 20px rgba(212,175,55,.6)}.info-section{padding:80px 20px;text-align:center;position:relative}.info-section:nth-of-type(2){background-color:var(--bg-gray);border-radius:var(--radius-lg);margin:0 20px 60px;box-shadow:var(--shadow-sm);border:1px solid var(--primary-color)}.info-section h2{font-size:2.5rem;margin-bottom:25px;color:var(--primary-color);font-weight:700;position:relative;display:inline-block}.info-section h2::after{content:'';position:absolute;bottom:-10px;left:50%;transform:translateX(-50%);width:80px;height:2px;background:var(--primary-color);border-radius:2px}.info-section p{max-width:800px;margin:0 auto 50px;font-size:1.2rem;color:var(--text-light);font-weight:400;line-height:1.7}.features{display:flex;flex-wrap:wrap;justify-content:center;gap:40px;margin-top:30px}.feature-box{flex:1 1 300px;max-width:350px;background-color:var(--bg-gray);padding:0;border-radius:var(--radius-md);box-shadow:var(--shadow-md);text-align:left;min-height:420px;flex-direction:column;border:1px solid var(--primary-color)}.feature-box img{width:100%;height:200px;object-fit:cover;filter:sepia(20%) contrast(110%)}.feature-box-content{padding:25px;display:flex;flex-direction:column;flex:1}.feature-box h4{margin-top:0;margin-bottom:15px;color:var(--primary-color);font-weight:700;font-size:1.4rem}.feature-box p{color:var(--text-light);font-size:1rem;flex:1;margin-bottom:20px;line-height:1.6}.feature-box .btn{margin-top:auto;background-color:transparent;color:var(--primary-color);border:2px solid var(--primary-color);padding:10px 20px;border-radius:var(--radius-sm);text-align:center;display:inline-block}.feature-box .btn:hover,.feature-box::before{background-color:var(--primary-color);color:var(--bg-light)}.feature-box:hover{transform:translateY(-10px);box-shadow:var(--shadow-lg)}.feature-box:hover img{transform:scale(1.05)}.feature-box::before{content:"Populaire";position:absolute;top:15px;right:15px;padding:5px 12px;border-radius:20px;font-size:.8rem;font-weight:600;z-index:1;box-shadow:0 2px 10px rgba(0,0,0,.2)}@keyframes fadeInUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}.animate-fade-in{animation:.8s ease-out forwards fadeInUp;opacity:0}.delay-1{animation-delay:.1s}.delay-2{animation-delay:.3s}.delay-3{animation-delay:.5s}@media (max-width:992px){.welcome-container h1{font-size:3rem}}@media (max-width:768px){.welcome-container{height:450px;padding:40px 20px}.welcome-container h1{font-size:2.5rem}.info-section p,.welcome-container p{font-size:1.1rem}.info-section h2{font-size:2rem}.features{flex-direction:column;align-items:center;gap:30px}.feature-box{max-width:100%}}@media (max-width:480px){.welcome-container h1{font-size:2rem}.welcome-btn,.welcome-container p{font-size:1rem}.welcome-btn{padding:12px 25px}.info-section{padding:60px 15px}.info-section h2{font-size:1.8rem}}
</style>

<div class="welcome-full">
    <div class="welcome-container">
        <h1>Bienvenue chez Youssef & Abduh</h1>
        <p>Plongez dans un univers de parfums raffinés, où chaque senteur raconte une histoire. Que vous cherchiez la fraîcheur, la séduction ou le luxe, nos collections soigneusement sélectionnées éveilleront vos sens.</p>
        <a href="{{ route('produits.index') }}" class="welcome-btn">Découvrir nos produits</a>
    </div>
</div>

<div class="info-section">
    <h2 class="animate-fade-in">Votre parfum avec Youssef & Abduh</h2>
    <p class="animate-fade-in delay-1">Youssef & Abduh est votre destination pour des parfums de qualité supérieure, soigneusement sélectionnés pour hommes et femmes. Nos collections allient élégance, caractère et originalité, pour sublimer chaque instant de votre vie. Trouvez la fragrance qui vous ressemble.</p>
</div>

<div class="info-section">
    <h2 class="animate-fade-in">Nos Parfums Populaires</h2>
    <p class="animate-fade-in delay-1">Découvrez les fragrances les plus appréciées par nos clients et laissez-vous séduire par des senteurs uniques, élégantes et intemporelles.</p>

    <div class="features">
        <div class="feature-box animate-fade-in delay-1">
            <img src="{{ asset('images/dior.webp') }}" alt="Caméra de Surveillance">
            <div class="feature-box-content">
                <h4>Dior Sauvage </h4>
                <p>Un parfum emblématique pour homme, à la fois frais et sauvage. Il mêle la bergamote de Calabre à des notes boisées et poivrées, créant une senteur masculine, intense et très reconnaissable. Parfait pour un usage quotidien ou en soirée.</p>
               
            </div>
        </div>

        <div class="feature-box animate-fade-in delay-2">
            <img src="{{ asset('images/chanel.webp') }}" alt="Thermostat Intelligent">
            <div class="feature-box-content">
                <h4>Chanel Bleu de Chanel</h4>
                <p>Un parfum élégant et sophistiqué qui mélange fraîcheur citronnée, encens, bois de santal et cèdre. Il incarne la liberté et la confiance. Idéal pour un homme charismatique et moderne.</p>
               
            </div>
        </div>

        <div class="feature-box animate-fade-in delay-3">
            <img src="{{ asset('images/baccarat.webp') }}" alt="Alarme Connectée">
            <div class="feature-box-content">
                <h4>Baccarat Rouge 540 by Maison Francis Kurkdjian</h4>
                <p>Un parfum mixte ultra-luxueux et très tendance. Il se distingue par des notes ambrées, boisées et légèrement sucrées, avec du jasmin et du safran. Une senteur unique, très longue tenue et souvent remarquée.</p>
               
            </div>
        </div>
    </div>
</div>
@endsection