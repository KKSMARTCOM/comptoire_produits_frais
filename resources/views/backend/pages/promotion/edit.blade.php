@extends('backend.layout.app')

@section('content')
<div class="container">
    <h1>Modifier la Promotion</h1>

    <form action="{{ route('panel.promotions.update', $promotion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="codePromo">Code Promo</label>
            <input type="text" name="codePromo" class="form-control" value="{{ $promotion->codePromo }}">
        </div>

        <div class="form-group mb-3">
            <label for="pourcentage_reduction">Pourcentage de Réduction</label>
            <input type="number" name="pourcentage_reduction" class="form-control" min="0" max="100" value="{{ $promotion->pourcentage_reduction }}" required>
        </div>

        <!-- Sélection de la catégorie -->
        <div class="form-group mb-3">
            <label for="category_id">Sélectionner une Catégorie</label>
            <select name="category_id" class="form-control" required>
                <option value="">Sélectionner</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == $promotion->category_id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sélection multiple pour les produits -->
        <div class="form-group mb-3">
            <label for="products">Sélectionner des Produits</label>
            <select name="products[]" class="form-control" multiple>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" @if($promotion->products->contains($product->id)) selected @endif>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success" style="background-color: #004200;">Mettre à jour</button>
        <a href="{{ route('panel.promotions.index') }}" class="btn btn-light" style="background-color: #d8d8e4 !important;">Fermer</a>
    </form>
</div>
@endsection
