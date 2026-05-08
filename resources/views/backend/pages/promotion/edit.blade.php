@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Modifier la Promotion</h4>

                    <form action="{{ route('panel.promotions.update', $promotion->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="codePromo">Code Promo</label>
                            <input type="text" name="codePromo" class="form-control" value="{{ $promotion->codePromo }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="pourcentage_reduction">Pourcentage de Réduction</label>
                            <input type="number" name="pourcentage_reduction" class="form-control" min="0"
                                max="100" value="{{ $promotion->pourcentage_reduction }}" required>
                        </div>

                        <!-- Champ pour la réutilisabilité du code -->
                        <div class="form-group mb-3">
                            <label for="is_reusable" class="d-flex align-items-center">
                                <input type="checkbox" name="is_reusable" id="is_reusable" value="1"
                                    class="form-check-input" @if ($promotion->is_reusable) checked @endif
                                    style="width: 20px; height: 20px; margin-right: 10px;">
                                <span>Code réutilisable par plusieurs clients</span>
                            </label>
                            <small class="form-text text-muted d-block mt-2">
                                <strong>Coché:</strong> Le code peut être utilisé par plusieurs clients différents<br>
                                <strong>Décoché:</strong> Le code ne peut être utilisé qu'une seule fois au total
                            </small>
                        </div>

                        <!-- Sélection de la catégorie -->
                        <div class="form-group mb-3">
                            <label for="category_id">Sélectionner une Catégorie</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Sélectionner</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $promotion->category_id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sélection multiple pour les produits -->
                        <div class="form-group mb-3">
                            <label for="products">Sélectionner des Produits</label>
                            <select name="products[]" class="form-control" multiple>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" @if ($promotion->products->contains($product->id)) selected @endif>
                                        {{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success" style="background-color: #004200;">Mettre à
                            jour</button>
                        <a href="{{ route('panel.promotions.index') }}" class="btn btn-light"
                            style="background-color: #d8d8e4 !important;">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
