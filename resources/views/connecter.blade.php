@extends('layouts.master')

@section('title', 'Se connecter')

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
    }

    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background-color: var(--bg-light);
        background-attachment: fixed;
        height: 100%;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .login-form {
        width: 100%;
        max-width: 440px;
        background-color: var(--bg-gray);
        padding: 40px;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid var(--primary-dark);
    }

    .login-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--primary-dark), var(--primary-color), var(--primary-light));
    }

    .login-form:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    .login-form h2 {
        text-align: center;
        margin-bottom: 30px;
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.8rem;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .form-group {
        margin-bottom: 24px;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-muted);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        border-radius: 12px;
        border: 1.5px solid var(--primary-dark);
        background-color: var(--bg-light);
        font-size: 1rem;
        color: var(--text-light);
        transition: all 0.25s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        background-color: var(--bg-gray);
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.15);
        outline: none;
    }

    .btn-primary {
        display: block;
        width: 100%;
        background: linear-gradient(90deg, var(--primary-dark), var(--primary-color));
        border: none;
        color: var(--text-dark);
        font-weight: 600;
        padding: 14px;
        border-radius: 12px;
        cursor: pointer;
        font-size: 1.05rem;
        transition: all 0.3s ease;
        margin-top: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .register-link {
        text-align: center;
        margin-top: 24px;
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .register-link a {
        text-decoration: none;
        color: var(--primary-color);
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .register-link a:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        border-left: 4px solid #dc3545;
        color: #dc3545;
        padding: 10px 12px;
        border-radius: 8px;
        font-size: 0.9rem;
        margin-top: 8px;
    }

    /* Animation pour les champs de formulaire */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-group {
        animation: fadeIn 0.5s ease forwards;
        opacity: 0;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .login-form {
            padding: 30px 20px;
        }
        
        .login-form h2 {
            font-size: 1.6rem;
        }
    }

    /* Option pour se souvenir de moi */
    .remember-me {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        animation: fadeIn 0.5s ease forwards;
        animation-delay: 0.3s;
        opacity: 0;
    }

    .remember-me input[type="checkbox"] {
        margin-right: 8px;
        width: 16px;
        height: 16px;
        accent-color: var(--primary-color);
    }

    .remember-me label {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    /* Lien mot de passe oublié */
    .forgot-password {
        text-align: right;
        margin-top: -16px;
        margin-bottom: 20px;
        animation: fadeIn 0.5s ease forwards;
        animation-delay: 0.3s;
        opacity: 0;
    }

    .forgot-password a {
        color: var(--text-muted);
        font-size: 0.9rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .forgot-password a:hover {
        color: var(--primary-color);
        text-decoration: underline;
    }
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