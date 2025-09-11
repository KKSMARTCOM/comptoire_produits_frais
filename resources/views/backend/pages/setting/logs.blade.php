@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="my-4">Logs des actions des utilisateurs</h4>

                    <div>
                        <form action="{{ route('panel.setting.logs') }}" method="GET"
                            class="mb-3 d-block d-md-flex justify-content-between">
                            <!-- Recherche par nom d'utilisateur -->
                            <div class="mb-3 mb-md-0">
                                <input type="text" class="form-control" name="search"
                                    placeholder="Rechercher par nom d'utilisateur" value="{{ request('search') }}">
                            </div>

                            <div class="d-block d-sm-flex">
                                <!-- Sélection du mois avec une option pour tout afficher -->
                                <div class="mb-3 mb-sm-0">
                                    <select name="month" class="form-control">
                                        <option value="all" {{ $month == 'all' ? 'selected' : '' }}>Tous les mois
                                        </option>
                                        @for ($m = 1; $m <= 12; $m++)
                                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <!-- Sélection de l'année avec une option pour tout afficher -->
                                <div class="mb-3 mb-sm-0 pl-0 pl-sm-3">
                                    <select name="year" class="form-control">
                                        <option value="all" {{ $year == 'all' ? 'selected' : '' }}>Toutes les années
                                        </option>
                                        @for ($y = 2024; $y <= \Carbon\Carbon::now()->year; $y++)
                                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <!-- Bouton de recherche -->
                                <div class="pl-0 pl-sm-3">
                                    <button type="submit" class="btn btn-primary">Filtrer</button>
                                </div>
                            </div>

                        </form>
                    </div>
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
                                @if ($activities && $activities->count() > 0)
                                    @foreach ($activities as $activity)
                                        <tr>
                                            <td>{{ $activity->causer->name ?? 'N/A' }}</td>
                                            <td>{{ isset($activity->causer->is_admin) && $activity->causer->is_admin == 0 ? 'Administrateur' : 'Utilisateur' }}
                                            </td>
                                            <td>{{ $activity->properties['menu'] ?? 'N/A' }}</td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ Carbon::parse($activity->created_at)->format('d.m.Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Pas d'enregistrement correspondant</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $activities->links('pagination::custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
