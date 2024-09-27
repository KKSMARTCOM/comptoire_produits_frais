@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Liste des Promotions</h4>
                    <a href="{{ route('panel.promotions.create') }}" class="btn btn-primary mb-3">Créer une Promotion</a>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Code Promo</th>
                                <th>Pourcentage de Réduction</th>
                                <th>Catégories</th>
                                <th>Produits</th> <!-- Ajouter une colonne pour les produits -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($promotions && $promotions->count() > 0)
                                @foreach ($promotions as $promotion)
                                    <tr>
                                        <td>{{ $promotion->codePromo }}</td>
                                        <td>{{ $promotion->pourcentage_reduction }}%</td>
                                        <td>{{ $promotion->category ? $promotion->category->name : 'Aucune catégorie' }}
                                        </td>
                                        <td>
                                            @if ($promotion->products->isNotEmpty())
                                                <ul>
                                                    @foreach ($promotion->products as $product)
                                                        <li>{{ $product->name }}</li> <!-- Lister les produits associés -->
                                                    @endforeach
                                                </ul>
                                            @else
                                                Aucun produit
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Bouton Modifier avec une icône -->
                                            <a href="{{ route('panel.promotions.edit', $promotion->id) }}"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Bouton Supprimer avec une icône -->
                                            <form action="{{ route('panel.promotions.destroy', $promotion->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Aucune promotion disponible</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
