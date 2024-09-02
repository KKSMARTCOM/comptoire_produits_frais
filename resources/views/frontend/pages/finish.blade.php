@extends('frontend.layout.layout')

@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="site-order">
                    <div class="site-order-content">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="site-order-icon">
                                <img src="{{ asset('images/svg/success.svg') }}" alt="">
                            </div>
                        </div>
                        <div class="site-order-text p-2">
                            <h2>Votre commande a bien été effectuée !</h2>
                            <p>Votre commande vous sera livrée dans les plus brefs délais. En attendant, si vous avez besoin
                                de produits supplémentaires, vous pouvez consulter la liste des produits.</p>
                            <div class="text-center">
                                <a href="{{ route('product') }}">ICI</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
