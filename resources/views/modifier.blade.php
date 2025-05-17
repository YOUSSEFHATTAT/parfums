@extends('layouts.master')

@section('title', 'Modifier un Produit')

@section('main')
<style>
    :root {
        --primary-color: #D4AF37;
        --primary-light: #F8E9A1;
        --primary-dark: #A67C00;
        --accent-color: #D4AF37;
        --success-color: #D4AF37;
        --danger-color: #A67C00;
        --text-light: #F8E9A1;
        --text-dark: #000000;
        --text-muted: #A67C00;
        --bg-light: #000000;
        --bg-gray: #111111;
        --shadow-sm: 0 2px 10px rgba(212, 175, 55, 0.15);
        --shadow-md: 0 4px 20px rgba(212, 175, 55, 0.2);
        --shadow-lg: 0 10px 30px rgba(212, 175, 55, 0.3);
        --radius-sm: 0;
        --radius-md: 0;
        --radius-lg: 0;
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
        background-color: var(--bg-light);
        color: var(--text-light);
    }

    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px 60px;
    }

    .form-container {
        max-width: 700px;
        margin: 0 auto;
        background-color: var(--bg-gray);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        border: 1px solid var(--primary-color);
    }

    .form-header {
        background-color: var(--primary-dark);
        color: var(--text-light);
        padding: 25px 30px;
        position: relative;
        border-bottom: 1px solid var(--primary-color);
    }

    .form-header h2 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--primary-color);
    }

    .form-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-light);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 12px 15px;
        font-size: 1rem;
        line-height: 1.5;
        color: var(--text-light);
        background-color: var(--bg-light);
        background-clip: padding-box;
        border: 1px solid var(--primary-color);
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary-light);
        outline: 0;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }

    .form-control::placeholder {
        color: #555;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .image-preview {
        background-color: var(--bg-light);
        padding: 20px;
        text-align: center;
        margin-bottom: 25px;
        position: relative;
        border: 1px solid var(--primary-color);
    }

    .image-preview img {
        max-width: 100%;
        max-height: 250px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .image-preview img:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-md);
    }

    .image-preview-label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: var(--primary-color);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }

    .file-input-container {
        position: relative;
        margin-bottom: 25px;
    }

    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px 20px;
        background-color: var(--bg-light);
        border: 1px dashed var(--primary-color);
        cursor: pointer;
        transition: var(--transition);
        color: var(--primary-color);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .file-input-label:hover {
        border-color: var(--primary-light);
        background-color: rgba(212, 175, 55, 0.05);
    }

    .file-input-label i {
        margin-right: 8px;
        font-size: 1.2rem;
    }

    .file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .file-name {
        margin-top: 8px;
        font-size: 0.9rem;
        color: var(--text-muted);
        text-align: center;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 25px;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: var(--transition);
        cursor: pointer;
        border: none;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-primary {
        background-color: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-color);
        color: var(--bg-light);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: transparent;
        color: var(--text-light);
        border: 1px solid var(--text-light);
    }

    .btn-secondary:hover {
        background-color: var(--text-light);
        color: var(--bg-light);
        transform: translateY(-2px);
    }

    .btn i {
        margin-right: 8px;
    }

    .alert {
        padding: 10px 15px;
        margin-top: 8px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid #dc3545;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 20px 15px 40px;
        }

        .form-header {
            padding: 20px;
        }

        .form-header h2 {
            font-size: 1.5rem;
        }

        .form-body {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="page-container">
    <div class="form-container">
        <div class="form-header">
            <h2>MODIFIER LE PRODUIT</h2>
        </div>
        
        <div class="form-body">
            <form action="{{ route('modifier.produit', $produit->id) }}" method="POST" enctype="multipart/form-data" id="editProductForm">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="titre" class="form-label">TITRE DU PRODUIT</label>
                    <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $produit->titre) }}" required>
                    @error('titre')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">DESCRIPTION</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $produit->description) }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prix" class="form-label">PRIX (MAD)</label>
                            <input type="number" class="form-control" id="prix" name="prix" step="0.01" min="0" value="{{ old('prix', $produit->prix) }}" required>
                            @error('prix')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantite" class="form-label">QUANTITÉ</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" min="0" value="{{ old('quantite', $produit->quantite) }}" required>
                            @error('quantite')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                @if ($produit->image)
                <div class="image-preview">
                    <span class="image-preview-label">IMAGE ACTUELLE</span>
                    <img src="{{ asset('storage/' . $produit->image) }}" alt="Image du produit" id="currentImage">
                </div>
                @endif

                <div class="file-input-container">
                    <label for="image" class="file-input-label">
                        <i class="bi bi-cloud-arrow-up"></i> CHOISIR UNE NOUVELLE IMAGE
                    </label>
                    <input type="file" name="image" id="image" class="file-input" accept="image/*">
                    <div class="file-name" id="fileName">Aucun fichier sélectionné</div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> ANNULER
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> ENREGISTRER
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('image');
        const fileNameDisplay = document.getElementById('fileName');
        const currentImage = document.getElementById('currentImage');
        
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileNameDisplay.textContent = this.files[0].name;
                
                // Preview the new image
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (currentImage) {
                        currentImage.src = e.target.result;
                    }
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                fileNameDisplay.textContent = 'Aucun fichier sélectionné';
            }
        });
    });
</script>
@endsection