@extends('layouts.master')

@section('title', 'Se connecter')

@section('main')
<style>
   .forgot-password a,.register-link a{text-decoration:none;transition:color .2s}:root{--primary-color:#D4AF37;--primary-light:#F8E9A1;--primary-dark:#A67C00;--accent-color:#D4AF37;--text-light:#F8E9A1;--text-dark:#000000;--text-muted:#A67C00;--bg-light:#000000;--bg-gray:#111111;--shadow-sm:0 2px 10px rgba(212, 175, 55, 0.15);--shadow-md:0 4px 20px rgba(212, 175, 55, 0.2);--shadow-lg:0 10px 30px rgba(212, 175, 55, 0.3)}body,html{margin:0;padding:0;font-family:Inter,'Segoe UI',sans-serif;background-color:var(--bg-light);background-attachment:fixed;height:100%}.login-container{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px 20px}.btn-primary,.form-label{display:block;text-transform:uppercase}.login-form{width:100%;max-width:440px;background-color:var(--bg-gray);padding:40px;border-radius:20px;box-shadow:var(--shadow-md);transition:.3s;position:relative;overflow:hidden;border:1px solid var(--primary-dark)}.login-form::before{content:'';position:absolute;top:0;left:0;width:100%;height:6px;background:linear-gradient(90deg,var(--primary-dark),var(--primary-color),var(--primary-light))}.login-form:hover{transform:translateY(-5px);box-shadow:var(--shadow-lg);border-color:var(--primary-color)}.login-form h2{text-align:center;margin-bottom:30px;color:var(--primary-color);font-weight:700;font-size:1.8rem;letter-spacing:1px;text-transform:uppercase}.form-group{margin-bottom:24px;position:relative;animation:.5s forwards fadeIn;opacity:0}.form-label{margin-bottom:8px;font-weight:600;color:var(--text-muted);font-size:.85rem;letter-spacing:.5px}.forgot-password,.remember-me{margin-bottom:20px;animation:.5s .3s forwards fadeIn;opacity:0}.form-control{width:100%;padding:14px 16px;border-radius:12px;border:1.5px solid var(--primary-dark);background-color:var(--bg-light);font-size:1rem;color:var(--text-light);transition:.25s}.form-control:focus{border-color:var(--primary-color);background-color:var(--bg-gray);box-shadow:0 0 0 4px rgba(212,175,55,.15);outline:0}.btn-primary{width:100%;background:linear-gradient(90deg,var(--primary-dark),var(--primary-color));border:none;color:var(--text-dark);font-weight:600;padding:14px;border-radius:12px;cursor:pointer;font-size:1.05rem;transition:.3s;margin-top:10px;letter-spacing:1px}.btn-primary:hover{background:linear-gradient(90deg,var(--primary-color),var(--primary-light));transform:translateY(-2px);box-shadow:var(--shadow-md)}.btn-primary:active{transform:translateY(0)}.register-link{text-align:center;margin-top:24px;color:var(--text-muted);font-size:.95rem}.register-link a{color:var(--primary-color);font-weight:600}.register-link a:hover{color:var(--primary-light);text-decoration:underline}.alert-danger{background-color:rgba(220,53,69,.1);border-left:4px solid #dc3545;color:#dc3545;padding:10px 12px;border-radius:8px;font-size:.9rem;margin-top:8px}@keyframes fadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}.form-group:first-child{animation-delay:.1s}.form-group:nth-child(2){animation-delay:.2s}@media (max-width:576px){.login-form{padding:30px 20px}.login-form h2{font-size:1.6rem}}.remember-me{display:flex;align-items:center}.remember-me input[type=checkbox]{margin-right:8px;width:16px;height:16px;accent-color:var(--primary-color)}.remember-me label{color:var(--text-muted);font-size:.95rem}.forgot-password{text-align:right;margin-top:-16px}.forgot-password a{color:var(--text-muted);font-size:.9rem}.forgot-password a:hover{color:var(--primary-color);text-decoration:underline}
</style>

<div class="login-container">
    <form action="{{ route('connexion.send') }}" method="POST" class="login-form" novalidate>
        @csrf
        <h2>Se connecter</h2>

        <div class="form-group">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
            @error('mot_de_passe')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div> 
        <button type="submit" class="btn-primary">Se connecter</button>

        <div class="register-link">
            Pas encore inscrit ? <a href="{{ route('inscription') }}">Créer un compte</a>
        </div>
    </form>
</div>
@endsection