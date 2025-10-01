@extends('backend.layout.app')

@section('customcss')
    <style>
        .ck-content {
            height: 300px !important;
        }
    </style>
@endsection

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

                    @if (!empty($product->id))
                        @php
                            $routeLink = route('panel.product.update', $product->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.product.store');
                        @endphp
                    @endif

                    <form class="forms-sample" action="{{ $routeLink }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (!empty($product->id))
                            @method('PUT')
                        @endif

                        @if (!empty($product->image))
                            <div class="form-group">
                                <div class="input-group col-xs-12 d-flex justify-content-center">
                                    <div style="height: 310px; width:250px;overflow:hidden;">
                                        <img src="{{ asset($product->image ?? 'img/noimage.webp') }}"
                                            style="height: 100%; width:100%; object-fit:cover;" alt="">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Nom</label><span style="color: red"> *</span>
                            <input type="text" class="form-control text-capitalize" id="name"
                                value="{{ $product->name ?? old('name') }}" name="name" placeholder="Nom du produit">
                            @error('name')
                                <p class="text-danger fs-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Description</label>
                            <input type="text" class="form-control" id="content"
                                value="{{ $product->content ?? old('content') }}" name="content"
                                placeholder="Description du produit" maxlength="100">
                            <small id="charLimitMessage" class="form-text text-danger" style="display: none;">Nombre de
                                caractères atteint</small>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Categorie</label><span style="color: red"> *</span>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">Selectionner la categorie</option>
                                @if ($categories)
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ isset($product) && $product->category_id == $item->id ? 'selected' : '' }}>
                                            {{ ucfirst($item->name) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('category_id')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group type" style="display: none">
                            <label for="type">Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value="">Selectionner le type</option>
                                @if ($types)
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}"
                                            {{ isset($product) && $product->type == $item->id ? 'selected' : '' }}>
                                            {{ ucfirst($item->name) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('type')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group region" style="display: none">
                            <label for="region">Région</label>
                            <select class="form-control" name="region" id="region">
                                <option value="">Selectionner la région</option>
                                @if ($regions)
                                    @foreach ($regions as $item)
                                        <option value="{{ $item->id }}"
                                            {{ isset($product) && $product->region == $item->id ? 'selected' : '' }}>
                                            {{ ucfirst($item->name) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('region')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Prix</label><span style="color: red"> *</span>
                            <input type="number" class="form-control" id="price" name="price"
                                value="{{ $product->price ?? old('price') }}" placeholder="Prix du produit">
                            @error('price')
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantité</label>
                            <input type="number" class="form-control" id="quantity"
                                value="{{ $product->quantity ?? old('quantity') }}" name="quantity"
                                placeholder="Quantité en stock">
                            @error('quantity')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Image</label><span style="color: red"> *</span>
                            <input type="file" name="image" class="file-upload-default" id="imageInput"
                                style="display:none;">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" id="imagePlaceholder"
                                    placeholder="Télécharger l'image du produit" readonly>
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button"
                                        style="background-color: #004200 !important">Télécharger</button>
                                </span>
                            </div>
                            @error('image')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            @php
                                $status = $product->status ?? '0';
                            @endphp
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ $status == '0' ? 'selected' : '' }}>Illimité</option>
                                <option value="1" {{ $status == '1' ? 'selected' : '' }}>En stock</option>
                                <option value="2" {{ $status == '2' ? 'selected' : '' }}>Épuisé</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2"
                            style="background-color: #004200 !important">{{ isset($product) ? 'Mettre à jour' : 'Enregistrer' }}</button>
                        <a href="{{ route('panel.product.index') }}" class="btn btn-light">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/translations/tr.js"></script> // dili tr olsun --}}

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

        $(document).ready(function() {
            $('#category_id').on('change', function() {
                $category = $(this).val();
                if ($category == 4) {
                    $('.type').css({
                        'display': 'block'
                    })
                    $('.region').css({
                        'display': 'block'
                    })
                } else {
                    $('.type').css({
                        'display': 'none'
                    })
                    $('.region').css({
                        'display': 'none'
                    })
                }

            })
        })
    </script>

    {{-- <script>
        const option = {
            // language: 'tr',
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
        }

        ClassicEditor
            .create(document.querySelector('#editor'), option)
            .catch(error => {
                console.error(error);
            });
    </script> --}}
@endsection
