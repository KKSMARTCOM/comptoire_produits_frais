@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des catégories</h4>
                    <p class="card-description">
                        <a href="{{ route('panel.category.create') }}" class="btn btn-primary"
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
                                    {{-- <th>Image</th> --}}
                                    <th>Libellé</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($categories) && $categories->count() > 0)
                                    @foreach ($categories as $category)
                                        <tr class="item" item-id="{{ $category->id }}">
                                            {{-- <td class="py-1">
                                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" />
                                            </td> --}}
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->category->name ?? '' }}</td>
                                            {{-- <td>{{ \Illuminate\Support\Str::limit($category->category->name ?? '', 100) }}</td> --}}

                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="durum" data-on="Disponible"
                                                            data-off="Indisponible" data-onstyle="success"
                                                            data-offstyle="danger" data-toggle="toggle"
                                                            {{ $category->status == '1' ? 'checked' : '' }}>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('panel.category.edit', $category->id) }}"
                                                    class="btn btn-primary mr-2">Modifier
                                                </a>
                                                <button type="button" class="deleteBtn btn btn-danger"
                                                    style="background-color: #FF281C !important">Supprimer</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="item" item-id="1">
                                        {{-- <td class="py-1">
                                            <img src="{{ asset('backend/images/carousel/banner_10.jpg') }}"
                                                alt="" />
                                        </td> --}}
                                        <td>Vin</td>
                                        <td>Blanc; Rouge</td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Disponible"
                                                        data-off="Indisponible" data-onstyle="success"
                                                        data-offstyle="danger" data-toggle="toggle" checked>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('panel.category.edit', 1) }}"
                                                class="btn btn-primary mr-2">Modifier
                                            </a>
                                            <button type="button" class="deleteBtn btn btn-danger"
                                                style="background-color: #FF281C !important">Supprimer</button>
                                        </td>
                                    </tr>

                                    <tr class="item" item-id="2">
                                        {{-- <td class="py-1">
                                            <img src="{{ asset('backend/images/carousel/banner_9.jpg') }}"
                                                alt="" />
                                        </td> --}}
                                        <td>Viandes</td>
                                        <td>Volailles; Autres viandes</td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Disponible"
                                                        data-off="Indisponible" data-onstyle="success"
                                                        data-offstyle="danger" data-toggle="toggle">
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('panel.category.edit', 1) }}"
                                                class="btn btn-primary mr-2">Modifier
                                            </a>
                                            <button type="button" class="deleteBtn btn btn-danger"
                                                style="background-color: #FF281C !important">Supprimer</button>
                                        </td>
                                    </tr>

                                    <tr class="item" item-id="3">
                                        {{--  <td class="py-1">
                                            <img src="{{ asset('backend/images/carousel/banner_8.jpg') }}"
                                                alt="" />
                                        </td> --}}
                                        <td>Fruits & légumes frais</td>
                                        <td>Fruits; légumes frais</td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Disponible"
                                                        data-off="Indisponible" data-onstyle="success"
                                                        data-offstyle="danger" data-toggle="toggle" checked>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('panel.category.edit', 1) }}"
                                                class="btn btn-primary mr-2">Modifier
                                            </a>
                                            <button type="button" class="deleteBtn btn btn-danger"
                                                style="background-color: #FF281C !important">Supprimer</button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script>
        // basmalı olduğu için change kullanıldı
        // buton olsaydı click kullanılması gerekiyordu
        $(document).on('change', '.durum', function(e) {
            // alert('test')
            id = $(this).closest('.item').attr('item-id');
            statu = $(this).prop('checked');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('panel.category.status') }}",
                data: {
                    id: id,
                    statu: statu
                },
                success: function(response) {
                    if (response.status == 'true') {
                        alertify.success("Status activated")
                    } else {
                        alertify.error('Status deactivated')
                    }
                }
            });
        });

        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            var item = $(this).closest('.item');
            id = item.attr('item-id');

            alertify.confirm("Are you sure?", "You won't be able to revert this!",
                function() {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "{{ route('panel.category.destroy') }}",
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
                    alertify.error('Deletion canceled.');
                });
        });

    </script>
@endsection
