@extends('backend.layout.app')

@section('content')
<div class="container">
    <h1>Modifier la Promotion</h1>

    <form action="{{ route('panel.promotions.update', $promotion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="pourcentage_reduction">Pourcentage de Réduction</label>
            <input type="number" name="pourcentage_reduction" class="form-control" min="0" max="100" value="{{ $promotion->pourcentage_reduction }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
