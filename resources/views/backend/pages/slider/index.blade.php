@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des produits</h4>
                    <p class="card-description">
                        <a href="{{ route('panel.slider.create') }}" class="btn btn-primary" style="background-color: #004200 !important">Ajouter</a>
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
                                    <th>Image</th>
                                    {{-- <th>Title</th> --}}
                                    {{-- <th>Content</th> --}}
                                    {{-- <th>Link</th> --}}
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($sliders) && $sliders->count() > 0)
                                    @foreach ($sliders as $slider)
                                        <tr class="item" item-id="{{ $slider->id }}">
                                            <td>{{ $slider->name }}</td>
                                            <td>{{ $slider->content ?? '' }}</td>
                                            <td>{{ $slider->link }}</td>
                                            <td class="py-1">
                                                <img src="{{ asset($slider->image) }}" alt="{{ $slider->name }}" />
                                            </td>
                                            {{-- <td>{{ $slider->name }}</td> --}}
                                            {{-- <td>{{ $slider->content ?? '' }}</td> --}}
                                            {{-- <td>{{ $slider->link }}</td> --}}
                                            <td>
                                                {{-- <label
                                                    class="badge badge-{{ $slider->status == '1' ? 'success' : 'danger' }}">
                                                    {{ $slider->status == '1' ? 'Active' : 'Passive' }}
                                                </label> --}}
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="durum" data-on="Active"
                                                            data-off="Passive" data-onstyle="success" data-offstyle="danger"
                                                            data-toggle="toggle"
                                                            {{ $slider->status == '1' ? 'checked' : '' }}>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('panel.slider.edit', $slider->id) }}"
                                                    class="btn btn-primary mr-2">Modifier
                                                </a>
                                                {{-- <form action="{{ route('panel.slider.destroy', $slider->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form> --}}

                                                <button type="button" class="deleteBtn btn btn-danger">Supprimer</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="item" item-id="1">
                                        <td>Poulet Fermier</td>
                                        <td>Le Poulet Fermier est une option de choix pour ceux qui recherchent une viande de meilleure qualité, tant sur le plan gustatif que nutritionnel.</td>
                                        <td>1250.00 FCFA</td>
                                        <td class="py-1">
                                            <img src="{{ asset('backend/images/carousel/banner_1.jpg') }}"
                                                alt="" />
                                        </td>
                                        {{-- <td>Lorem, ipsum.</td> --}}
                                        {{-- <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ipsum?</td>
                                        <td>http://Loremipsumdolor</td> --}}
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Disponible"
                                                        data-off="Indisponible" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle" checked>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('panel.slider.edit', 1) }}" class="btn btn-primary mr-2">Modifier
                                            </a>
                                            <form action="{{ route('panel.slider.destroy', 1) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <tr class="item" item-id="2">
                                        <td>Saumon Fumé</td>
                                        <td>Le saumon fumé est un produit de la mer d'une grande finesse, apprécié pour son goût fumé délicat et sa texture fondante</td>
                                        <td>1800.00 FCFA</td>
                                        <td class="py-1">
                                            <img src="{{ asset('backend/images/carousel/banner_3.jpg') }}"
                                                alt="" />
                                        </td>
                                        {{-- <td>Lorem, ipsum.</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ipsum?</td>
                                        <td>http://Loremipsumdolor</td> --}}
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Disponible"
                                                        data-off="Indisponible" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle" checked>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('panel.slider.edit', 1) }}" class="btn btn-primary mr-2">Modifier
                                            </a>
                                            <form action="{{ route('panel.slider.destroy', 1) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <tr class="item" item-id="3">
                                        <td>Tomates Bio</td>
                                        <td>Les tomates bio représentent une option savoureuse, nutritive et respectueuse de l'environnement.</td>
                                        <td>300.00 FCFA</td>
                                        <td class="py-1">
                                            <img src="{{ asset('backend/images/carousel/banner_4.jpg') }}"
                                                alt="" />
                                        </td>
                                        {{-- <td>Lorem, ipsum.</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ipsum?</td>
                                        <td>http://Loremipsumdolor</td> --}}
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Disponible"
                                                        data-off="Indisponible" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle">
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('panel.slider.edit', 2) }}" class="btn btn-primary mr-2">Modifier
                                            </a>
                                            <form action="{{ route('panel.slider.destroy', 2) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <tr class="item" item-id="4">
                                        <td>Vin Rouge</td>
                                        <td>Le vin rouge est une boisson riche et complexe, offrant une grande variété de saveurs et d'arômes.</td>
                                        <td>1500.00 FCFA</td>
                                        <td class="py-1">
                                            <img src="{{ asset('backend/images/carousel/banner_5.jpg') }}"
                                                alt="" />
                                        </td>
                                        {{-- <td>Lorem, ipsum.</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ipsum?</td>
                                        <td>http://Loremipsumdolor</td> --}}
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Disponible"
                                                        data-off="Indisponible" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle" checked>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('panel.slider.edit', 3) }}"
                                                class="btn btn-primary mr-2">Modifier
                                            </a>
                                            <form action="{{ route('panel.slider.destroy', 3) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <tr class="item" item-id="5">
                                        <td>Boeuf Angus</td>
                                        <td>Le Bœuf Angus est une viande de premier choix, prisée pour son goût riche, sa tendreté exceptionnelle, et son persillage généreux.</td>
                                        <td>2500.00 FCFA</td>
                                        <td class="py-1">
                                            <img src="{{ asset('backend/images/carousel/banner_6.jpg') }}"
                                                alt="" />
                                        </td>
                                        {{-- <td>Lorem, ipsum.</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ipsum?</td>
                                        <td>http://Loremipsumdolor</td> --}}
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Disponible"
                                                        data-off="Indisponible" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle" checked>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('panel.slider.edit', 4) }}"
                                                class="btn btn-primary mr-2">Modifier
                                            </a>
                                            <form action="{{ route('panel.slider.destroy', 4) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
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
                url: "{{ route('panel.slider.status') }}",
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
                        url: "{{ route('panel.slider.destroy') }}",
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
