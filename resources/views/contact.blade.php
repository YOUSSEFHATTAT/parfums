@extends('layouts.master')

@section('title', 'Contact')

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
        height: 100%;
        margin: 0;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background-color: var(--bg-light);
        background-attachment: fixed;
    }

    .page-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .content-wrap {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .contact-form {
        width: 100%;
        max-width: 580px;
        background-color: var(--bg-gray);
        padding: 40px;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid var(--primary-dark);
    }

    .contact-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-dark), var(--primary-color), var(--primary-light));
    }

    .contact-form:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    .contact-form h1 {
        text-align: center;
        margin-bottom: 30px;
        color: var(--primary-color);
        font-weight: 700;
        font-size: 2rem;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .form-group {
        margin-bottom: 22px;
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

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-row {
        display: flex;
        gap: 16px;
        margin-bottom: 22px;
    }

    .form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    .btn-primary {
        display: block;
        width: 100%;
        background: linear-gradient(90deg, var(--primary-dark), var(--primary-color));
        border: none;
        color: var(--text-dark);
        font-weight: 600;
        padding: 16px;
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

    /* Animation pour les champs de formulaire */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-group, .form-row {
        animation: fadeIn 0.5s ease forwards;
        opacity: 0;
    }

    .form-row:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
    .form-group:nth-child(5) { animation-delay: 0.5s; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 22px;
        }
        
        .contact-form {
            padding: 30px 25px;
        }
        
        .contact-form h1 {
            font-size: 1.75rem;
        }
    }
</style>

<div class="page-container">
    <div class="content-wrap">
        <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
            @csrf
            <h1>Contactez-nous</h1>

            <div class="form-row">
                <div class="form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="sujet" class="form-label">Sujet</label>
                <input type="text" class="form-control" id="sujet" name="sujet" value="{{ old('sujet') }}" required>
            </div>

            <div class="form-group">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required>{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="btn-primary">Envoyer le message</button>
        </form>
    </div>
</div>
@endsection