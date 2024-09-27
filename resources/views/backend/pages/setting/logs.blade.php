@extends('backend.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
    <h4 class="my-4">Logs des actions des utilisateurs</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Rôle</th>
                    <th>Menu</th>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                    <tr>
                        <td>{{ $activity->causer->name }}</td>
                        <td>{{ $activity->causer->isSuperAdmin() ? 'Super-Admin' : 'Admin' }}</td>
                        <td>{{ $activity->properties['menu'] ?? 'N/A' }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</div>
</div>
</div>


@endsection
