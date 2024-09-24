@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Coffret</h4>

                    @if ($errors)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if (!empty($pack->id))
                        @php
                            $routeLink = route('panel.pack.update', $pack->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.pack.store');
                        @endphp
                    @endif

                    <form class="forms-sample" action="{{ $routeLink }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (!empty($pack->id))
                            @method('PUT')
                        @endif

                        @if (!empty($pack->image))
                            <div class="form-group">
                                <div class="input-group col-xs-12 d-flex justify-content-center">
                                    <div style="height: 310px; width:250px;overflow:hidden;">
                                        <img src="{{ asset($pack->image ?? 'img/noimage.webp') }}"
                                            style="height: 100%; width:100%; object-fit:cover;" alt="">
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name"
                                value="{{ old('name', $pack->name ?? '') }}" name="name" placeholder="Nom du coffret">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description"
                                value="{{ old('description', $pack->description ?? '') }}" name="description"
                                placeholder="Description du coffret" maxlength="100">
                            <small id="charLimitMessage" class="form-text text-danger" style="display: none;">Nombre de
                                caractères atteint</small>
                        </div>

                        {{-- Un truc compliqué à faire ici --}}

                        @if ($categories)
                            <div class="form-group">
                                <label for="category">Catégorie</label>
                                <select id="category" class="form-control">
                                    <option value="">Selectionner une catégorie</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item['id'] }}">
                                            {{ ucfirst($item->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="products">Produits</label>
                            <select class="form-control" id="products" name="">
                                <option value="">Sélectionner les produits</option>
                            </select>
                        </div>

                        <div class="table-responsive mb-4">
                            <table id="selected-products" class="table">
                                <thead>
                                    <tr>
                                        <th>Produits sélectionnés</th>
                                        <th>Prix</th>
                                        <th>Quantités</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="product-table-body">
                                    @if (!empty($pack->id))
                                        @foreach ($pack->products as $item)
                                            <tr class="item">
                                                <td><input type="text" class="form-control text-capitalize"
                                                        id="product_id" value="{{ $item->name }}" readonly>
                                                    <input type="hidden" name="product_id[]"
                                                        value="{{ $item->pivot->product_id }}">
                                                </td>
                                                <td>{{ $item->price }} FCFA
                                                </td>
                                                <td><input type="number" class="form-control text-capitalize"
                                                        id="quantity" value="{{ $item->pivot->quantity }}"
                                                        name="quantity[]">
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-danger remove-product">Supprimer</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>

                        <div class="form-group">
                            <label for="link">Prix</label>
                            <input type="text" class="form-control" id="link" name="price"
                                value="{{ old('price', $pack->price ?? '') }}" placeholder="Prix du coffret">
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="file-upload-default" id="imageInput"
                                style="display:none;">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" id="imagePlaceholder"
                                    placeholder="Télécharger l'image du coffret" readonly>
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button"
                                        style="background-color: #004200 !important">Télécharger</button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            @php
                                $status = $pack->status ?? '1';
                            @endphp
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ $status == '0' ? 'selected' : '' }}>Indisponible</option>
                                <option value="1" {{ $status == '1' ? 'selected' : '' }}>Disponible</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2"
                            style="background-color: #004200 !important">{{ isset($pack) ? 'Mettre à jour' : 'Enregistrer' }}</button>
                        <a href="{{ route('panel.pack.index') }}" class="btn btn-light">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Selectionner les produits',
                theme: 'classic',
            })

            $('#category').on('change', function() {
                var categorieId = $(this).val();
                //console.log(categorieId);
                if (categorieId) {
                    $.ajax({
                        url: '/panel/get-products/' + categorieId,
                        type: 'GET',
                        success: function(response) {
                            //console.log(response);
                            $('#products').empty().append(
                                '<option value="">Sélectionner un produit</option>');
                            $.each(response, function(key, product) {
                                $('#products').append('<option value="' + product.id +
                                    '" data-price="' + product.price + '">' +
                                    product.name + '</option>');
                            });

                        }
                    })
                }
            })

            $('#products').on('change', function() {
                var productId = $(this).val();
                var productName = $('#products option:selected').text()
                var quantity = 1
                var price = $('#products option:selected').data('price');

                // Récupérer le prix du produit
                var productExists = false;

                $('#selected-products tbody tr').each(function() {
                    var existingProductId = $(this).find('input[name="product_id[]"]').val().trim();

                    console.log(existingProductId);
                    if (existingProductId == productId) {
                        productExists = true;
                    }
                });

                if (productExists) {
                    alertify.error('Produit déjà ajouté')
                } else if (productId) {
                    var newRow = `
                                        <tr class="item">
                                            <td>
                                                <input type="text" class="form-control" value="${productName}" readonly>
                                                <input type="hidden" name="product_id[]" value="${productId}">
                                            </td>
                                            <td>
                                                ${price} FCFA
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" value="${quantity}" name="quantity[]">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger remove-product">Supprimer</button>
                                            </td>
                                        </tr>
                                    `;

                    $('#product-table-body').append(newRow);

                    // Réinitialiser les champs
                    //$('#quantity').val('');
                }

            })

            // Supprimer un produit du tableau
            $(document).on('click', '.remove-product', function() {
                $(this).closest('tr').remove(); // Supprimer la ligne du tableau
            });
        })

        document.addEventListener('DOMContentLoaded', function() {
            const descriptionField = document.getElementById('description');
            const charLimitMessage = document.getElementById('charLimitMessage');

            descriptionField.addEventListener('input', function() {
                const currentLength = descriptionField.value.length;

                if (currentLength >= 100) {
                    charLimitMessage.style.display = 'block';
                    // Empêche la saisie de plus de 100 caractères
                    descriptionField.value = descriptionField.value.substring(0, 100);
                } else {
                    charLimitMessage.style.display = 'none';
                }
            });
        });

        document.getElementById('imageInput').addEventListener('change', function() {
            var fileName = this.files[0].name;
            document.getElementById('imagePlaceholder').value = fileName;
        });
    </script>
@endsection
