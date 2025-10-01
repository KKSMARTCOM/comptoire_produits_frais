@extends('backend.layout.app')
{{-- @php
    $status = isset($products) ? $products->status : 'illimite'; // Remplacez 'illimite' par l'état par défaut souhaité
@endphp --}}

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des produits</h4>
                    <p class="card-description">
                        <a href="{{ route('panel.product.create') }}" class="btn btn-primary"
                            style="background-color: #004200 !important">Ajouter</a>
                    </p>

                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Catégorie</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($products) && $products->count() > 0)
                                    @foreach ($products as $product)
                                        <tr class="item" item-id="{{ $product->id }}">
                                            <td>{{ ucfirst($product->name) }}</td>
                                            <td>{{ Str::Limit(ucfirst($product->content), 50) ?? '/' }}</td>
                                            <td>{{ ucfirst($product->productCategory->name) }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td class="">
                                                <div style="height: 50px; width:50px;">

                                                    <img style="height: 100%;width:100%; object-fit:cover;"
                                                        src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                                                </div>
                                            </td>
                                            <td>

                                                @if ($product->status == '0')
                                                    <div class="badge badge-success">Illimité</div>
                                                @elseif ($product->status == '1')
                                                    <div class="badge badge-warning">En stock</div>
                                                @else
                                                    <div class="badge badge-danger">Épuisé</div>
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                <!-- Lien pour modifier avec une icône de crayon -->
                                                <a href="{{ route('panel.product.edit', $product->id) }}"
                                                    class="btn btn-primary mr-2"
                                                    style="align-items: center; justify-content: center; display: flex; height: 42px; width: 42px; padding: 0;">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- Bouton pour supprimer avec une icône de corbeille -->
                                                <button type="submit" class="btn btn-danger btn-icon deleteBtn">
                                                    <span class="fas fa-trash-alt"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">Aucun produit disponible</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $products->links('pagination::custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@section('customjs')
    <script>
        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            var item = $(this).closest('.item');
            id = item.attr('item-id');

            alertify.confirm("Etes vous sûre ?",
                "Vous vous apprêtez à supprimer un produit, cette action est irréverssible !",
                function() {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "{{ route('panel.product.destroy') }}",
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            if (response.error == false) {
                                item.remove();
                                alertify.success(response.message)
                            } else {
                                alertify.error("Something went wrong");
                            }
                        }
                    });
                },
                function() {
                    alertify.error('Suppression annulée.');
                });
        });
    </script>
@endsection
