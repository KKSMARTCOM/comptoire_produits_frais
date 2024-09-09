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
                                    <th>Libellé</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Image</th>
                                    {{-- <th>Title</th> --}}
                                    {{-- <th>Content</th> --}}
                                    {{-- <th>Link</th> --}}
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($products) && $products->count() > 0)
                                    @foreach ($products as $product)
                                        <tr class="item" item-id="{{ $product->id }}">
                                            <td>{{ ucfirst($product->name) }}</td>
                                            <td>{{ Str::Limit(ucfirst($product->content), 50) ?? '' }}</td>
                                            <td>{{ $product->productCategory->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td class="py-1">
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                                            </td>
                                            {{-- <td>{{ $slider->name }}</td> --}}
                                            {{-- <td>{{ $slider->content ?? '' }}</td> --}}
                                            {{-- <td>{{ $slider->link }}</td> --}}
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
                                                            class="btn btn-success {{ $product->status == 'illimite' ? 'active' : '' }}">
                                                            <input type="radio" name="status" value="illimite"
                                                                id="optionIllimite" autocomplete="off"
                                                                {{ $product->status == 'illimite' ? 'checked' : '' }}>
                                                            Illimité
                                                        </label>
                                                        <label
                                                            class="btn btn-warning {{ $product->status == 'en_stock' ? 'active' : '' }}">
                                                            <input type="radio" name="status" value="en_stock"
                                                                id="optionEnStock" autocomplete="off"
                                                                {{ $product->status == 'en_stock' ? 'checked' : '' }}> En
                                                            stock
                                                        </label>
                                                        <label
                                                            class="btn btn-danger {{ $product->status == 'epuise' ? 'active' : '' }}">
                                                            <input type="radio" name="status" value="epuise"
                                                                id="optionEpuise" autocomplete="off"
                                                                {{ $product->status == 'epuise' ? 'checked' : '' }}> Épuisé
                                                        </label>
                                                    </div>
                                                </div>

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
                                    <tr class="item" item-id="1">
                                        <td>Poulet Fermier</td>
                                        <td>Le Poulet Fermier est une option de choix pour ceux qui recherchent une viande
                                            de meilleure qualité, tant sur le plan gustatif que nutritionnel.</td>
                                        <td>Volailles</td>
                                        <td>1250.00 FCFA</td>
                                        <td>125</td>
                                        <td class="py-1">
                                            <img src="{{ asset('backend/images/carousel/banner_1.jpg') }}"
                                                alt="" />
                                        </td>
                                        {{-- <td>Lorem, ipsum.</td> --}}
                                        {{-- <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ipsum?</td>
                                        <td>http://Loremipsumdolor</td> --}}
                                        {{-- <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Disponible"
                                                        data-off="Indisponible" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle" checked>
                                                </label>
                                            </div>
                                        </td> --}}
                                        {{-- <td>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-success {{ $status == 'illimite' ? 'active' : '' }}">
                                                    <input type="radio" name="status" id="illimite" value="illimite" {{ $status == 'illimite' ? 'checked' : '' }}> Illimité
                                                </label>
                                                <label class="btn btn-warning {{ $status == 'en_stock' ? 'active' : '' }}">
                                                    <input type="radio" name="status" id="en_stock" value="en_stock" {{ $status == 'en_stock' ? 'checked' : '' }}> En stock
                                                </label>
                                                <label class="btn btn-danger {{ $status == 'epuise' ? 'active' : '' }}">
                                                    <input type="radio" name="status" id="epuise" value="epuise" {{ $status == 'epuise' ? 'checked' : '' }}> Épuisé
                                                </label>
                                            </div>
                                        </td> --}}
                                        <td>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-success">
                                                    <input type="radio" name="status" id="illimite" value="illimite">
                                                    Illimité
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="status" id="en_stock" value="en_stock"> En
                                                    stock
                                                </label>
                                                <label class="btn btn-danger">
                                                    <input type="radio" name="status" id="epuise" value="epuise">
                                                    Épuisé
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <!-- Lien pour modifier avec une icône de crayon -->
                                            <a href="{{ route('panel.slider.edit', 1) }}"
                                                class="btn btn-primary mr-2 btn-icon">
                                                <span class="fas fa-edit"></span>
                                            </a>
                                            <!-- Formulaire pour supprimer avec une icône de corbeille -->
                                            <form action="{{ route('panel.slider.destroy', 1) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-icon">
                                                    <span class="fas fa-trash-alt"></span>
                                                </button>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                url: "{{ route('panel.product.status') }}",
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
