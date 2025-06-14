@extends('layouts.master')

@section('title', 'Passer la commande')

@section('main')
<style>
   .btn-primary,.form-label{font-weight:600;text-transform:uppercase}.btn-primary,.checkout-form h2,.form-label{text-transform:uppercase}:root{--primary-color:#D4AF37;--primary-light:#F8E9A1;--primary-dark:#A67C00;--accent-color:#D4AF37;--text-light:#F8E9A1;--text-dark:#000000;--text-muted:#A67C00;--bg-light:#000000;--bg-gray:#111111;--shadow-sm:0 2px 10px rgba(212, 175, 55, 0.15);--shadow-md:0 4px 20px rgba(212, 175, 55, 0.2);--shadow-lg:0 10px 30px rgba(212, 175, 55, 0.3)}body,html{margin:0;padding:0;font-family:Inter,'Segoe UI',sans-serif;background-color:var(--bg-light);background-attachment:fixed;height:100%}.checkout-container{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px 20px}.checkout-form{width:100%;max-width:600px;background-color:var(--bg-gray);padding:40px;border-radius:20px;box-shadow:var(--shadow-md);transition:.3s;position:relative;overflow:hidden;border:1px solid var(--primary-dark)}.checkout-form::before{content:'';position:absolute;top:0;left:0;width:100%;height:6px;background:linear-gradient(90deg,var(--primary-dark),var(--primary-color),var(--primary-light))}.checkout-form:hover{transform:translateY(-5px);box-shadow:var(--shadow-lg);border-color:var(--primary-color)}.checkout-form h2{text-align:center;margin-bottom:30px;color:var(--primary-color);font-weight:700;font-size:1.8rem;letter-spacing:1px}.form-group{margin-bottom:24px;position:relative;animation:.5s forwards fadeIn;opacity:0}.form-label{display:block;margin-bottom:8px;color:var(--text-muted);font-size:.85rem;letter-spacing:.5px}.form-control{width:100%;padding:14px 16px;border-radius:12px;border:1.5px solid var(--primary-dark);background-color:var(--bg-light);font-size:1rem;color:var(--text-light);transition:.25s}.form-control:focus{border-color:var(--primary-color);background-color:var(--bg-gray);box-shadow:0 0 0 4px rgba(212,175,55,.15);outline:0}textarea.form-control{min-height:120px;resize:vertical}.btn-container{display:flex;justify-content:center;margin-top:30px;animation:.5s .4s forwards fadeIn;opacity:0}.btn-primary{display:inline-block;background:linear-gradient(90deg,var(--primary-dark),var(--primary-color));border:none;color:var(--text-dark);padding:14px 30px;border-radius:12px;cursor:pointer;font-size:1.05rem;transition:.3s;letter-spacing:1px}.btn-primary:hover{background:linear-gradient(90deg,var(--primary-color),var(--primary-light));transform:translateY(-2px);box-shadow:var(--shadow-md)}.btn-primary:active{transform:translateY(0)}@keyframes fadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}.form-group:first-child{animation-delay:.1s}.form-group:nth-child(2){animation-delay:.2s}.form-group:nth-child(3){animation-delay:.3s}@media (max-width:576px){.checkout-form{padding:30px 20px}.checkout-form h2{font-size:1.6rem}}
</style>

<div class="checkout-container">
    <form action="{{ route('commande.submit') }}" method="POST" class="checkout-form">
        @csrf
        <h2>📝 Informations de commande</h2>

        <div class="form-group">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        

        <div class="form-group">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="adresse" class="form-label">Adresse de livraison</label>
            <textarea name="adresse" id="adresse" class="form-control" rows="3" required></textarea>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn-primary">Confirmer la commande</button>
        </div>
    </form>
</div>
@endsection