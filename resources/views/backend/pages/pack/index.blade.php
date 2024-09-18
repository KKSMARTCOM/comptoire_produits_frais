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
                                            {{-- <td class="py-1">
                                                <img src="{{ asset($pack->image) }}" alt="{{ $pack->name }}" />
                                            </td> --}}
                                            <td>
                                                {{-- <label
                                                    class="badge badge-{{ $slider->status == '1' ? 'success' : 'danger' }}">
                                                    {{ $slider->status == '1' ? 'Active' : 'Passive' }}
                                                </label> --}}
                                                {{-- <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="durum" data-on="Illimité"
                                                            data-off="Epuisé" data-onstyle="success" data-offstyle="danger"
                                                            data-toggle="toggle"
                                                            {{ $slider->status == '1' ? 'checked' : '' }}>
                                                    </label>
                                                </div> --}}
                                                <div class="form-group">
                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                        <label
                                                            class="btn btn-warning {{ $pack->status == '0' ? 'active' : '' }}">
                                                            <input type="radio" name="status" value="0"
                                                                id="optionIllimite" autocomplete="off" class="durum"
                                                                {{ $pack->status == '0' ? 'checked' : '' }}>
                                                            Indisponible
                                                        </label>
                                                        <label
                                                            class="btn btn-success {{ $pack->status == '1' ? 'active' : '' }}">
                                                            <input type="radio" name="status" value="1"
                                                                id="optionEnStock" autocomplete="off" class="durum"
                                                                {{ $pack->status == '1' ? 'checked' : '' }}> Disponible
                                                        </label>
                                                    </div>
                                                </div>

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
        $(document).on('change', '.durum', function(e) {
            // alert('test')
            id = $(this).closest('.item').attr('item-id');
            status = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('panel.pack.status') }}",
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    if (response.status == '1') {
                        alertify.success("Coffret disponible")
                    } else {
                        alertify.error('Coffret indisponible')
                    }
                }
            });
        });

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
