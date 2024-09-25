@extends('backend.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
    <h4 class="my-4">Logs du Système</h4>

    @if (count($logs) > 0)
    <!-- Conteneur avec défilement horizontal -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Environnement</th>
                    <th>Niveau</th>
                    <th>Message</th>
                    <th>Utilisateur</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr>
                    <td>{{ $log['date'] }}</td>
                    <td>{{ $log['env'] }}</td>
                    <td>
                        <span class="badge badge-{{ $log['level'] == 'error' ? 'danger' : ($log['level'] == 'warning' ? 'warning' : 'info') }}">
                            {{ strtoupper($log['level']) }}
                        </span>
                    </td>
                    <td>{{ $log['message'] }}</td>
                    @if(isset($log['user_id']))
                        <td>{{ $log['user_name'] }} (ID: {{ $log['user_id'] }})</td>
                        <td>{{ $log['email'] }}</td>
                    @else
                        <td colspan="2">Information utilisateur non disponible</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info">
        Aucun log disponible.
    </div>
    @endif
</div>
</div>
</div>
</div>


@endsection
