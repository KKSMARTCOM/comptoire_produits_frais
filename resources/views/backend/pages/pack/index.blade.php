@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des coffrets</h4>
                    <p class="card-description">
                        <a href="{{ route('panel.pack.create') }}" class="btn btn-primary"
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
                                    <th>Prix</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($packs) && $packs->count() > 0)
                                    @foreach ($packs as $pack)
                                        <tr class="item" item-id="{{ $pack->id }}">
                                            <td>{{ $pack->name }}</td>
                                            <td>{{ $pack->description ?? '' }}</td>
                                            <td>{{ $pack->price ?? '' }} FCFA</td>
                                            <td>

                                                @if ($pack->status == '0')
                                                    <div class="badge badge-danger">Indisponible</div>
                                                @else
                                                    <div class="badge badge-success">Disponible</div>
                                                @endif

                                            </td>
                                            <td class="d-flex">
                                                <!-- Lien pour modifier avec une icône de crayon -->
                                                <a href="{{ route('panel.pack.edit', $pack->id) }}"
                                                    class="btn btn-primary mr-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- Bouton pour supprimer avec une icône de corbeille -->
                                                <button type="submit" class="deleteBtn btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Aucun coffret disponible</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $packs->links('pagination::custom') }}
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
                "Vous vous apprêtez à supprimer un coffret, cette action est irréverssible !",
                function() {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "{{ route('panel.pack.destroy') }}",
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
