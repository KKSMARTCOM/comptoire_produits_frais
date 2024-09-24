@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des commandes</h4>

                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Client </th>
                                    <th>Date</th>
                                    {{-- <th>Email du client</th> --}}
                                    <th>Numéro de téléphone du client</th>
                                    <th>Adresse de livraison</th>
                                    {{-- <th>Produits commandés</th> --}}
                                    {{-- <th>Qtité</th> --}}
                                    <th>Nombre de produits </th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($orders) && $orders->count() > 0)
                                    @foreach ($orders as $order)
                                        <tr class="item" item-id="{{ $order->id }}">
                                            <td>{{ $order->order_no }}</td>
                                            <td>{{ $order->Fullname }}</td>
                                            <td>{{ isset($order->created_at) ? Carbon::parse($order->created_at)->format('d.m.Y H:i') : '' }}
                                            </td>
                                            {{-- <td>{{ $order->email ?? '' }}</td> --}}
                                            <td>{{ $order->phone ?? '' }}</td>
                                            <td>{!! strLimit($order->address, 20, route('panel.order.edit', $order->id)) !!}</td>
                                            <td>{{ $order->order_items_count ?? '' }}</td>
                                            <td>
                                                @if ($order->status == '0')
                                                    <div class="badge badge-warning">En cours</div>
                                                @else
                                                    <div class="badge badge-success">Livré</div>
                                                @endif
                                            </td>
                                            {{-- <td>{{ $order->product }}</td> --}}
                                            {{-- <td>{{ $order->Qtite }}</td> --}}
                                            {{-- <td>{{ $order->price }}</td> --}}
                                            {{-- <td class="d-flex">
                                                <a href="{{ route('panel.order.edit', $order->id) }}"
                                                    class="btn btn-primary mr-2">Modifier
                                                </a>
                                                <button type="button" class="deleteBtn btn btn-danger">Supprimer</button>
                                            </td> --}}
                                            <td class="d-flex">
                                                <!-- Lien pour modifier avec une icône de crayon -->
                                                <a href="{{ route('panel.order.edit', $order->id) }}"
                                                    class="btn btn-primary mr-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- Bouton pour afficher les détails avec une icône d'œil -->
                                                <a href="{{ route('panel.order.show', $order->id) }}"
                                                    class="btn btn-info mr-2">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <!-- Bouton pour supprimer avec une icône de corbeille -->
                                                <button type="button" class="deleteBtn btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>


                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">Aucune commande disponible</td>
                                    </tr>
                                    <tr class="item" item-id="1">
                                        <td>23455678</td>
                                        <td>Toto</td>
                                        <td>23-08-2024</td>
                                        <td>toto@email.com</td>
                                        <td>96241841</td>
                                        <td>Cotonou</td>
                                        <td>Chateau Rouge, dinde</td>
                                        <td>5</td>
                                        <td>45.000FCFA</td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Livrée"
                                                        data-off="En cours" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle" checked>
                                                </label>
                                            </div>
                                        </td>
                                        {{-- <td class="d-flex">
                                            <a href="{{ route('panel.order.edit', 1) }}" class="btn btn-primary mr-2">Modifier
                                            </a>
                                            <button type="button" class="deleteBtn btn btn-danger">Supprimer</button>
                                        </td> --}}
                                        <td class="d-flex">
                                            <!-- Lien pour modifier avec une icône de crayon -->
                                            <a href="{{ route('panel.order.edit', 1) }}" class="btn btn-primary mr-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- Lien pour afficher les détails avec une icône d'œil -->
                                            <a href="{{ route('panel.order.edit', 1) }}" class="btn btn-info mr-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <!-- Bouton pour supprimer avec une icône de corbeille -->
                                            <button type="button" class="deleteBtn btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>


                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            {{ $orders->links('pagination::custom') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script>
        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            var item = $(this).closest('.item');
            id = item.attr('item-id');

            alertify.confirm("Etes vous sûre ?",
                "Vous vous apprêtez à supprimer une commande, cette action est irréverssible !",
                function() {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "{{ route('panel.order.destroy') }}",
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
