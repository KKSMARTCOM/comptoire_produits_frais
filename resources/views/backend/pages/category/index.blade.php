@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des catégories</h4>
                    <p class="card-description">
                        <a href="{{ route('panel.category.create') }}" class="btn btn-primary"
                            style="background-color: #004200 !important">Ajouter</a>
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
                                    <th>Libellé</th>
                                    <th>Description</th>
                                    <th>Catégorie</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($categories) && $categories->count() > 0)
                                    @foreach ($categories as $category)
                                        <tr class="item" item-id="{{ $category->id }}">
                                            <td>{{ ucfirst($category->name) }}</td>
                                            <td>{{ Str::limit($category->content ?? '/', 50) }}</td>
                                            <td>{{ $category->category->name ?? '/' }}
                                            </td>

                                            <td class="d-flex">
                                                <a href="{{ route('panel.category.edit', $category->id) }}"
                                                    class="btn btn-primary mr-2">Modifier
                                                </a>
                                                <button type="button" class="deleteBtn btn btn-danger"
                                                    style="background-color: #FF281C !important">Supprimer</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">Aucune catégorie disponible</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $categories->links('pagination::custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script>
        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            var item = $(this).closest('.item');
            id = item.attr('item-id');

            alertify.confirm("Etes vous sûre ?",
                "Vous vous apprêtez à supprimer une catégorie, cette action est irréverssible !",
                function() {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "{{ route('panel.category.destroy') }}",
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
                    alertify.error('Suppression annulée.');
                });
        });
    </script>
@endsection
