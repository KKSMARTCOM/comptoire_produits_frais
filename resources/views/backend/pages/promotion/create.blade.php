@extends('backend.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4>Créer une Promotion</h4>

                <form action="{{ route('panel.promotions.store') }}" method="POST">
                    @csrf

                    <!-- Champ pour le code promo (optionnel) -->
                    <div class="form-group mb-3">
                        <label for="codePromo">Code Promo (optionnel)</label>
                        <input type="text" name="codePromo" class="form-control" placeholder="Laisser vide pour générer automatiquement">
                    </div>
                    
                    <!-- Champ pour le pourcentage de réduction -->
                    <div class="form-group mb-3">
                        <label for="pourcentage_reduction">Pourcentage de Réduction</label>
                        <input type="number" name="pourcentage_reduction" class="form-control" min="0" max="100" required>
                    </div>

                    <!-- Champ pour sélectionner une catégorie -->
                    <div class="form-group mb-3">
                        <label for="category_id">Sélectionner une Catégorie</label>
                        <select id="category" name="category_id" class="form-control" required>
                            <option value="all">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Champ pour sélectionner des produits -->
                    <div class="form-group mb-3">
                        <label for="products">Sélectionner des Produits</label>
                        <select id="products" name="products[]" class="form-control" multiple required>
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

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Sélectionner les produits',
            theme: 'classic',
        });

        $('#category').on('change', function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '/panel/get-products/' + categoryId,
                    type: 'GET',
                    success: function(response) {
                        $('#products').empty().append(
                            '<option value="">Sélectionner un produit</option>'
                        );
                        $.each(response, function(key, product) {
                            $('#products').append('<option value="' + product.id + '">' +
                                product.name + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.error('Erreur:', xhr);
                    }
                });
            } else {
                $('#products').empty().append(
                    '<option value="">Sélectionner un produit</option>'
                );
            }
        });
    });
</script>


@endsection
