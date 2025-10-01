@extends('frontend.layout.layout')

@section('content')
    @include('frontend.inc.breadcrumb')


    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-5 d-flex justify-content-center">
                    @if (session()->get('success'))
                        <div class="alert alert-success">{{ session()->get('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    @endif

                    @if (session()->get('error'))
                        <div class="alert alert-danger">{{ session()->get('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center p-1">
                    <div class="product-detail-image">
                        <img src="{{ asset($pack->image) }}" alt="Image">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ ucfirst($pack->name) }}</h2>
                    <p class="text-black">{!! $product->description ?? '' !!}</p>
                    <h4>Produits</h4>
                    <ul>
                        @foreach ($pack->products as $product)
                            <li>{{ ucfirst($product['name']) }} (x{{ $product->pivot->quantity }})</li>
                        @endforeach
                    </ul>
                    <p><strong class="h4">{{ $pack->price }} FCFA</strong></p>
                    @php
                        $encrypt = encryptData($pack->id);
                    @endphp
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('cart.form') }}" method="GET">
                                @csrf
                                <input type="hidden" name="pack_id" value="{{ $encrypt }}">
                                <button type="submit"
                                    class="btn btn-primary btn-lg py-3 btn-block text-nowrap border-0">Passer
                                    commande</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="site-section">
        <div class="container">
            <div class="row">
            </div>
            <div class="mb-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Coffret</th>
                            <th>Produits</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="orderItem">
                            <td>{{ ucfirst($pack->name) }}</td>
                            <td>
                                <ul>
                                    @foreach ($pack->products as $product)
                                        <li>{{ ucfirst($product['name']) }} (x{{ $product->pivot->quantity }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $pack->price }} FCFA</td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7 mt-4 mt-md-0">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <span class="text-black text-nowrap h4 text-uppercase">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="newTotalPrice text-black text-nowrap">
                                        {{ $pack->price }}
                                        FCFA</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button
                                        class="paymentButton btn btn-primary btn-lg py-3 btn-block text-nowrap border-0">Passer
                                        commande</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
