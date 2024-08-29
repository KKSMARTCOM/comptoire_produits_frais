@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Produit</h4>

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

                    @if (!empty($slider->id))
                        @php
                            $routeLink = route('panel.slider.update', $slider->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.slider.store');
                        @endphp
                    @endif

                    <form class="forms-sample" action="{{ $routeLink }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (!empty($slider->id))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <div class="input-group col-xs-12">
                                <img src="{{ asset($slider->image ?? 'img/noimage.webp') }}" alt="">
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" value="{{ $slider->name ?? '' }}"
                                name="name" placeholder="Nom du produit">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" value="{{ $slider->name ?? '' }}"
                                name="description" placeholder="Description du produit" maxlength="100">
                            <small id="charLimitMessage" class="form-text text-danger" style="display: none;">Nombre de caractères atteint</small>
                        </div>
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
                        </script>
                        <div class="form-group">
                            <label for="content">Catégorie</label>
                            <select class="form-control" name="cat_ust" id="">
                                <option value="">Sélectionner la catégorie</option>
                                <option value="1">
                                    Volailles
                                </option>
                                <option value="2">
                                    Fruits & légumes
                                </option>
                                <option value="3">
                                    Vins
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="link">Prix</label>
                            <input type="text" class="form-control" id="link" name="link"
                                value="{{ $slider->link ?? '' }}" placeholder="Prix du produit">
                        </div>
                        <div class="form-group">
                            <label for="qty">Qtité</label>
                            <input type="text" class="form-control" id="qty" value="{{ $slider->qty ?? '' }}"
                                name="qty" placeholder="Qtité en stock">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="télécharger image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button" style="background-color: #004200 !important">Télécharger</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            @php
                                $status = $slider->status ?? '1';
                            @endphp
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ $status == '0' ? 'selected' : '' }}>Indisponible</option>
                                <option value="1" {{ $status == '1' ? 'selected' : '' }}>Disponible</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" style="background-color: #004200 !important">Enregistrer</button>
                        <a href="{{ route('panel.slider.index') }}" class="btn btn-light">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
