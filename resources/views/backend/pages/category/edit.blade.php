@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Catégorie</h4>

                    {{--  @if ($errors)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif --}}

                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if (!empty($category->id))
                        @php
                            $routeLink = route('panel.category.update', $category->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.category.store');
                        @endphp
                    @endif

                    <form class="forms-sample" action="{{ $routeLink }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (!empty($category->id))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="content">Libellé</label>
                            <input type="text" class="form-control text-capitalize" id="name"
                                value="{{ $category->name ?? old('name') }}" name="name"
                                placeholder="Nom de la catégorie (Volailles, Poissons, etc...)" maxlength="100">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description (optionnelle) </label>
                            <input type="text" class="form-control" id="description"
                                value="{{ $category->content ?? '' }}" name="content"
                                placeholder="Description de la catégorie" maxlength="100">
                            <small id="charLimitMessage" class="form-text text-danger" style="display: none;">Nombre de
                                caractères atteint</small>
                        </div>

                        <div class="form-group">
                            <label for="content">Catégorie (A selectionner si vous ajoutez une sous-catégorie)</label>
                            <select class="form-control" name="category_id" id="">
                                <option value="">Selectionner la catégorie</option>
                                @if ($categories)
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ isset($category) && $category->category_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn text-light mr-2"
                            style="background-color: #004200 !important">Enregistrer</button>
                        <a href="{{ route('panel.category.index') }}" class="btn btn-light">Annuler</a>
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
    </script>
@endsection
