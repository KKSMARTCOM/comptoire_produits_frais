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
                    <h4 class="card-title">Modifier commande</h4>

                    {{-- @if ($errors)
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


                    <form class="forms-sample" action="{{ route('panel.order.update', $order->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        @method('PUT')

                        <div class="form-group">
                            <label for="order_no">Numéro</label>
                            <input type="text" class="form-control text-capitalize" id="order_no"
                                value="{{ $order->order_no ?? '' }}" name="order_no" readonly>

                        </div>

                        <div class="form-group">
                            <label for="name">Nom et prénom du client</label>
                            <input type="text" class="form-control text-capitalize" id="name"
                                value="{{ $order->Fullname ?? '' }}" name="name" disabled>
                        </div>

                        <div class="form-group">
                            <label for="">Date de la commande</label>
                            <input type="text" class="form-control text-capitalize" id=""
                                value="{{ isset($order->created_at) ? Carbon::parse($order->created_at)->format('d.m.Y H:i') : '' }}"
                                name="" disabled>
                        </div>

                        <div class="form-group">
                            <label for="">Nom d'entreprise</label>
                            <input type="text" class="form-control text-capitalize" id=""
                                value="{{ $order->company_name ?? '' }}" name="" disabled>
                        </div>

                        {{-- <div class="form-group">
                            <label for="">Adresse complète</label>
                            <input type="text" class="form-control text-capitalize" id=""
                                value="{{ $order->address ?? '' }}" name="" disabled>
                        </div>

                        <div class="form-group">
                            <label for="">Ville</label>
                            <input type="text" class="form-control text-capitalize" id=""
                                value="{{ $order->city ?? '' }}" name="" disabled>
                        </div>

                        <div class="form-group">
                            <label for="">Quatier</label>
                            <input type="text" class="form-control text-capitalize" id=""
                                value="{{ $order->district ?? '' }}" name="" disabled>
                        </div> --}}
                        <div class="table-responsive">
                            @if ($order->orderItems)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nom</th>
                                            <th>Quantités</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $items)
                                            <tr class="item">
                                                <td><input type="text" class="form-control text-capitalize"
                                                        id="product_id" value="{{ $items->product_id ?? $items->pack_id }}"
                                                        name="product_id[]" readonly>
                                                <td><input type="text" class="form-control text-capitalize"
                                                        id="" value="{{ $items->name ?? '' }}" name=""
                                                        disabled>
                                                </td>
                                                <td><input type="number" class="form-control text-capitalize"
                                                        id="quantity" value="{{ $items->quantity ?? 1 }}"
                                                        name="quantity[]">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="motif">Motif (à renseigner en cas de modification de la commande)</label>
                            <input type="text" class="form-control" id="motif"
                                value="{{ $product->content ?? old('motif') }}" name="motif"
                                placeholder="Veuillez entrer le motif de la modification de la commande" maxlength="100">
                            <small id="charLimitMessage" class="form-text text-danger" style="display: none;">Nombre de
                                caractères atteint</small>
                        </div>

                        <div class="form-group">
                            <label for="status">Statut</label>
                            <select class="form-control" name="status" id="status">
                                <option value="0" {{ isset($order) && $order->status == '0' ? 'selected' : '' }}>En
                                    cours
                                </option>
                                <option value="1" {{ isset($order) && $order->status == '1' ? 'selected' : '' }}>
                                    Livrée
                                </option>
                            </select>
                            @error('status')
                                <p class="text-danger fs-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="content">Description</label>
                            <textarea class="form-control" id="editor" rows="4" name="content" placeholder="Description du produit">
                                {!! $product->content ?? '' !!}
                            </textarea>
                        </div> --}}


                        <button type="submit" class="btn btn-primary mr-2"
                            style="background-color: #004200 !important">Mettre à jour</button>
                        <a href="{{ route('panel.order.index') }}" class="btn btn-light">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
