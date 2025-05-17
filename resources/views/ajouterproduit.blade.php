@extends('layouts.master')

@section('title', 'Ajouter un Produit')

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

    .form-container {
        max-width: 650px;
        margin: 50px auto;
        padding: 40px;
        background-color: var(--bg-gray);
        box-shadow: var(--shadow-md);
        border-radius: 20px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid var(--primary-dark);
    }

    .form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--primary-dark), var(--primary-color), var(--primary-light));
    }

    .form-container:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    h2 {
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

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    input[type="file"].form-control {
        padding: 10px 16px;
        color: var(--text-light);
    }

    .btn-success {
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

    .btn-success:hover {
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-success:active {
        transform: translateY(0);
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
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
    .form-group:nth-child(5) { animation-delay: 0.5s; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .form-container {
            margin: 30px 15px;
            padding: 30px 20px;
        }
        
        h2 {
            font-size: 1.6rem;
        }
    }

    /* Style pour l'aperçu de l'image */
    .image-preview {
        width: 100%;
        height: 200px;
        border-radius: 12px;
        border: 2px dashed var(--primary-dark);
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: rgba(212, 175, 55, 0.05);
        transition: all 0.3s ease;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .image-preview-text {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    /* Style pour les champs numériques */
    input[type="number"].form-control {
        -moz-appearance: textfield;
    }

    input[type="number"].form-control::-webkit-outer-spin-button,
    input[type="number"].form-control::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Style pour les deux champs numériques côte à côte */
    .numeric-inputs {
        display: flex;
        gap: 16px;
    }

    .numeric-inputs .form-group {
        flex: 1;
    }

    /* Style pour le file input */
    input[type="file"].form-control::file-selector-button {
        background-color: var(--primary-dark);
        color: var(--text-dark);
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        margin-right: 16px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    input[type="file"].form-control::file-selector-button:hover {
        background-color: var(--primary-color);
    }
</style>

<div class="form-container">
    <h2>🛒 Ajouter un Produit</h2>
    
    <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="titre" class="form-label">Titre du produit</label>
            <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre') }}" required>
            @error('titre')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="numeric-inputs">
            <div class="form-group">
                <label for="prix" class="form-label">Prix (MAD)</label>
                <input type="number" class="form-control" id="prix" name="prix" step="0.01" min="0" value="{{ old('prix') }}" required>
                @error('prix')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="number" class="form-control" id="quantite" name="quantite" min="1" value="{{ old('quantite') }}" required>
                @error('quantite')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="form-label">Image du produit</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            <div class="image-preview" id="imagePreview">
                <span class="image-preview-text">L'aperçu de l'image apparaîtra ici</span>
            </div>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-success">Ajouter le produit</button>
    </form>
</div>

<script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewText = imagePreview.querySelector('.image-preview-text');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            previewText.style.display = "none";
            
            reader.addEventListener('load', function() {
                const img = document.createElement('img');
                img.src = this.result;
                imagePreview.innerHTML = '';
                imagePreview.appendChild(img);
            });
            
            reader.readAsDataURL(file);
        } else {
            previewText.style.display = "block";
            imagePreview.innerHTML = '<span class="image-preview-text">L\'aperçu de l\'image apparaîtra ici</span>';
        }
    });
</script>
@endsection