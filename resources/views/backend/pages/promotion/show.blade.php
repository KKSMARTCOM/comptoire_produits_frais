@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="card-title">Détails du Code Promo</h2>
                        <a href="{{ route('panel.promotions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>

                    <!-- Informations du code -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Code Promo</h5>
                                    <p class="card-text display-4" style="color: #004200; font-weight: bold;">
                                        {{ $promotion->codePromo }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Réduction</h5>
                                    <p class="card-text display-4" style="color: #004200; font-weight: bold;">
                                        {{ $promotion->pourcentage_reduction }}%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques principales -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card border-left-primary">
                                <div class="card-body">
                                    <div class="text-primary font-weight-bold text-uppercase mb-1">
                                        <i class="fas fa-check-circle"></i> Total d'utilisations
                                    </div>
                                    <div class="h3 mb-0" style="color: #004200;">{{ $totalUsages }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-left-success">
                                <div class="card-body">
                                    <div class="text-success font-weight-bold text-uppercase mb-1">
                                        <i class="fas fa-users"></i> Clients uniques
                                    </div>
                                    <div class="h3 mb-0" style="color: #28a745;">{{ $uniqueClients }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-left-warning">
                                <div class="card-body">
                                    <div class="text-warning font-weight-bold text-uppercase mb-1">
                                        <i class="fas fa-money-bill"></i> Total économisé
                                    </div>
                                    <div class="h3 mb-0" style="color: #ffc107;">
                                        {{ number_format($totalSavings, 0, ',', ' ') }} FCFA
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-left-info">
                                <div class="card-body">
                                    <div class="text-info font-weight-bold text-uppercase mb-1">
                                        <i class="fas fa-sync"></i> Réutilisable
                                    </div>
                                    <div class="h3 mb-0">
                                        @if ($promotion->is_reusable)
                                            <span class="badge badge-success">OUI</span>
                                        @else
                                            <span class="badge badge-danger">NON</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations de la promotion -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Catégorie</h5>
                                </div>
                                <div class="card-body">
                                    @if ($promotion->category)
                                        <p class="card-text">{{ $promotion->category->name }}</p>
                                    @else
                                        <p class="text-muted">Aucune catégorie spécifiée</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Produits associés</h5>
                                </div>
                                <div class="card-body">
                                    @if ($promotion->products->isNotEmpty())
                                        <ul class="list-unstyled">
                                            @foreach ($promotion->products as $product)
                                                <li class="mb-2">
                                                    <i class="fas fa-cube"></i> {{ $product->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted">Tous les produits de la catégorie</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Historique d'utilisation -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Historique d'utilisation</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Commande</th>
                                            <th>Adresse IP</th>
                                            <th>Date d'utilisation</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($usages && $usages->count() > 0)
                                            @foreach ($usages as $usage)
                                                <tr>
                                                    <td>
                                                        @if ($usage->order)
                                                            <a href="{{ route('panel.order.show', $usage->order->id) }}"
                                                                class="badge badge-primary">
                                                                {{ $usage->order->order_no }}
                                                            </a>
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <code>{{ $usage->client_ip }}</code>
                                                    </td>
                                                    <td>
                                                        <small>
                                                            {{ $usage->created_at->format('d/m/Y H:i') }}
                                                        </small>
                                                    </td>
                                                    <td>
                                                        @if ($usage->order)
                                                            @if ($usage->order->status == '0')
                                                                <span class="badge badge-warning">En attente</span>
                                                            @elseif ($usage->order->status == '1')
                                                                <span class="badge badge-success">Traitée</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-secondary">{{ $usage->order->status }}</span>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-secondary">Aucun ordre</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($usage->order)
                                                            <a href="{{ route('panel.order.show', $usage->order->id) }}"
                                                                class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Voir
                                                            </a>
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">
                                                    Aucune utilisation enregistrée
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            @if ($usages && $usages->hasPages())
                                <div class="mt-4 d-flex justify-content-end">
                                    {{ $usages->links('pagination::custom') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .border-left-primary {
            border-left: 4px solid #007bff;
        }

        .border-left-success {
            border-left: 4px solid #28a745;
        }

        .border-left-warning {
            border-left: 4px solid #ffc107;
        }

        .border-left-info {
            border-left: 4px solid #17a2b8;
        }
    </style>
@endsection
