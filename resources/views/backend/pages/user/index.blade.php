@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des utilisateurs</h4>
                    <p class="card-description">
                        <a href="{{ route('panel.user.create') }}" class="btn btn-primary" style="background-color: #004200 !important">Ajouter</a>
                    </p>

                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom d'utilisateur</th>
                                    <th>Email</th>
                                    <th>Mot de passe</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($users) && $users->count() > 0)
                                    @foreach ($users as $user)
                                        <tr class="item" item-id="{{ $user->id }}">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email ?? '' }}</td>
                                            <td>{{ $user->password ?? '' }}</td>
                                            <td class="d-flex">
                                                <button type="button" class="deleteBtn btn btn-danger">Supprimer</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="item" item-id="1">
                                        <td>toto</td>
                                        <td>toto@gmail.com</td>
                                        <td>é&ezaèytrçèiuyàçoiu"</td>
                                        <td class="d-flex">
                                            <button type="button" class="deleteBtn btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            {{-- {{ $contacts->links('pagination::custom') }} --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script>
        // basmalı olduğu için change kullanıldı
        // buton olsaydı click kullanılması gerekiyordu
        $(document).on('change', '.durum', function(e) {
            // alert('test')
            id = $(this).closest('.item').attr('item-id');
            statu = $(this).prop('checked');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('panel.contact.status') }}",
                data: {
                    id: id,
                    statu: statu
                },
                success: function(response) {
                    if (response.status == 'true') {
                        alertify.success("Status activated")
                    } else {
                        alertify.error('Status deactivated')
                    }
                }
            });
        });

        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            var item = $(this).closest('.item');
            id = item.attr('item-id');

            alertify.confirm("Are you sure?", "You won't be able to revert this!",
                function() {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "{{ route('panel.contact.destroy') }}",
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            if (response.error == false) {
                                item.remove();
                                alertify.success(response.message)
                            } else {
                                alertify.error("Something went wrong");
                            }
                        }
                    });
                },
                function() {
                    alertify.error('Deletion canceled.');
                });
        });
    </script>
@endsection
