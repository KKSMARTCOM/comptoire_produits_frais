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

                        @if ($products)
                            <div class="form-group">
                                <label for="content">Catégorie</label>
                                <select class="form-control" name="products[]">
                                    <option value="">Sélectionner la catégorie</option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item['id'] }}"
                                            {{ isset($pack) && $pack->products->contains($item->id) ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if ($products)
                            <div class="form-group">
                                <label for="content">Produits</label>
                                <select class="form-control" name="products[]" multiple>
                                    <option value="">Sélectionner les produits</option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item['id'] }}"
                                            {{ isset($pack) && $pack->products->contains($item->id) ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="link">Prix</label>
                            <input type="text" class="form-control" id="link" name="price"
                                value="{{ old('price', $pack->price ?? '') }}" placeholder="Prix du coffret">
                        </div>
                        {{-- <div class="form-group">
                            <label for="qty">Qtité</label>
                            <input type="text" class="form-control" id="qty" value="{{ $slider->qty ?? '' }}"
                                name="qty" placeholder="Qtité en stock">
                        </div> --}}
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
