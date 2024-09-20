@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
    <h4>Créer une Promotion</h4>

    <form action="{{ route('panel.promotions.store') }}" method="POST">
        @csrf

        {{-- <div class="form-group mb-3">
            <label for="codePromo">Code Promo</label>
            <input type="text" name="codePromo" class="form-control" placeholder="Généré automatiquement" readonly>
        </div> --}}
        <div class="form-group mb-3">
            <label for="codePromo">Code Promo (optionnel)</label>
            <input type="text" name="codePromo" class="form-control" placeholder="Laisser vide pour générer automatiquement">
        </div>
        
        <div class="form-group mb-3">
            <label for="pourcentage_reduction">Pourcentage de Réduction</label>
            <input type="number" name="pourcentage_reduction" class="form-control" min="0" max="100" required>
        </div>

        <!-- Champs pour les catégories et les produits -->
        <div class="form-group mb-3">
            <label for="category_id">Sélectionner une Catégorie</label>
            <select name="category_id" class="form-control" required>
                <option value="">Sélectionner</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label for="product_id">Sélectionner un Produit</label>
            <select name="product_id" class="form-control" required>
                <option value="">Sélectionner</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        
        
        <button type="submit" class="btn btn-success" style="background-color: #004200;">Enregistrer</button>
        <a href="{{ route('panel.promotions.index') }}" class="btn btn-light" style="background-color: #d8d8e4 !important;">Fermer</a>
    </form>
</div>
</div>
</div>
</div>
@endsection
