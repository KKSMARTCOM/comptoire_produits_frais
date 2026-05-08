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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Code Promo</th>
                                    <th>Pourcentage de Réduction</th>
                                    <th>Catégories</th>
                                    <th>Réutilisable</th>
                                    <th>Produits</th>
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
                                                @if ($promotion->is_reusable)
                                                    <span class="badge badge-success">Oui</span>
                                                @else
                                                    <span class="badge badge-danger">Non (une seule fois)</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($promotion->products->isNotEmpty())
                                                    <ul>
                                                        @foreach ($promotion->products as $product)
                                                            <li>{{ $product->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    Tous les produits de cette catégorie
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Bouton Voir les détails avec une icône -->
                                                <a href="{{ route('panel.promotions.show', $promotion->id) }}"
                                                    class="btn btn-info" title="Voir les détails">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <!-- Bouton Modifier avec une icône -->
                                                <a href="{{ route('panel.promotions.edit', $promotion->id) }}"
                                                    class="btn btn-warning" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Bouton Supprimer avec une icône -->
                                                <form action="{{ route('panel.promotions.destroy', $promotion->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Supprimer">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Aucune promotion disponible</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $promotions->links('pagination::custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
