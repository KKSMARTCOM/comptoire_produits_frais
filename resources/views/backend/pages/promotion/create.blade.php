@extends('backend.layout.app')

@section('content')
<div class="container">
    <h1>Créer une Promotion</h1>

    <form action="{{ route('panel.promotions.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="pourcentage_reduction">Pourcentage de Réduction</label>
            <input type="number" name="pourcentage_reduction" class="form-control" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-success" style="background-color: #004200;">Enregistrer</button>
        <a href="{{ route('panel.promotions.index') }}" class="btn btn-light" style="background-color: #d8d8e4 !important;">Fermer</a>
    </form>
</div>
@endsection
