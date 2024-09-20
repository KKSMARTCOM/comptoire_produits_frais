@extends('backend.layout.app')

@section('content')
<div class="container">
    <h1>Modifier la Promotion</h1>

    <form action="{{ route('panel.promotions.update', $promotion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Champ pour le code promo (modifiable) -->
        <div class="form-group mb-3">
            <label for="codePromo">Code Promo</label>
            <input type="text" name="codePromo" class="form-control" value="{{ old('codePromo') ?: $promotion->codePromo }}">
        </div>

        <div class="form-group mb-3">
            <label for="pourcentage_reduction">Pourcentage de Réduction</label>
            <input type="number" name="pourcentage_reduction" class="form-control" min="0" max="100" value="{{ $promotion->pourcentage_reduction }}" required>
        </div>

        <!-- Champs pour les catégories et les produits -->
        <div class="form-group mb-3">
            <label for="category_id">Modifier la Catégorie</label>
            <select name="category_id" class="form-control" required>
                <option value="">Sélectionner</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $promotion->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label for="product_id">Modifier le Produit</label>
            <select name="product_id" class="form-control" required>
                <option value="">Sélectionner</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $promotion->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
