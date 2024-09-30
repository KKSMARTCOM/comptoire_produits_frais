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
                            <input type="text" name="codePromo" class="form-control"
                                placeholder="Laisser vide pour générer automatiquement">
                        </div>

                        <!-- Champ pour le pourcentage de réduction -->
                        <div class="form-group mb-3">
                            <label for="pourcentage_reduction">Pourcentage de Réduction</label>
                            <input type="number" name="pourcentage_reduction" class="form-control" min="0"
                                max="100" required>
                        </div>

                        <!-- Champ pour sélectionner une catégorie -->
                        <div class="form-group mb-3">
                            <label for="category_id">Sélectionner une Catégorie</label>
                            <select id="category" name="category_id" class="form-control" required>
                                <option value="all">Toutes les catégories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Champ pour sélectionner des produits -->
                        <div class="form-group mb-3">
                            <label for="products">Sélectionner des Produits</label>
                            <select id="products" name="products[]" class="form-control" multiple>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success"
                            style="background-color: #004200;">Enregistrer</button>
                        <a href="{{ route('panel.promotions.index') }}" class="btn btn-light"
                            style="background-color: #d8d8e4 !important;">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('category').addEventListener('change', function() {
            var categoryId = this.value;
            var productsDropdown = document.getElementById('products');

            // Réinitialiser la liste des produits
            productsDropdown.innerHTML = '';

            // Si aucune catégorie n'est sélectionnée (ou 'Toutes les catégories'), charger tous les produits
            if (categoryId === 'all') {
                fetch('/get-products')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function(product) {
                            var option = document.createElement('option');
                            option.value = product.id;
                            option.text = product.name;
                            productsDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Erreur:', error));
            } else {
                // Requête AJAX pour récupérer les produits selon la catégorie
                fetch('/get-products/' + categoryId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function(product) {
                            var option = document.createElement('option');
                            option.value = product.id;
                            option.text = product.name;
                            productsDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Erreur:', error));
            }
        });

        // Charger tous les produits au chargement de la page
        window.addEventListener('DOMContentLoaded', (event) => {
            var productsDropdown = document.getElementById('products');
            fetch('/get-products')
                .then(response => response.json())
                .then(data => {
                    data.forEach(function(product) {
                        var option = document.createElement('option');
                        option.value = product.id;
                        option.text = product.name;
                        productsDropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur:', error));
        });
    </script>
@endsection
