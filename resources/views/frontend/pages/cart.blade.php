@extends('frontend.layout.layout')

@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container">
            @if ($cart && count($cart) > 0)
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
                {{-- WEB --}}
                <div class="row mb-5 d-none d-lg-block">
                    <div class="col-lg-12 site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">Produit</th>
                                    <th class="product-price">Prix Unitaire</th>
                                    <th class="product-quantity">Quantité</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Retirer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $key => $cartItem)
                                    <tr class="orderItem" data-id="{{ $key }}">
                                        <td class="product-thumbnail">
                                            <div class="product-thumbnail-image">
                                                <img src="{{ asset('images/' . $cartItem['product']['image']) }}"
                                                    alt="{{ $cartItem['product']['name'] }}">
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $cartItem['product']['name'] ?? '' }}</h2>
                                        </td>
                                        <td>{{ $cartItem['product']['price'] }}.00 FCFA</td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="input-group mb-3 align-items-center gap-2"
                                                    style="max-width: 130px;">
                                                    <div class="input-group-prepend">
                                                        <button class="decreaseBtn btn btn-outline-success js-btn-minus"
                                                            type="button">&minus;</button>
                                                    </div>
                                                    <input type="text" class="qtyItem form-control text-center"
                                                        value="{{ $cartItem['quantity'] }}" placeholder=""
                                                        aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1">
                                                    <div class="input-group-append">
                                                        <button class="increaseBtn btn btn-outline-success js-btn-plus"
                                                            type="button">&plus;</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>

                                        <td class="itemTotal">{{ $cartItem['total'] }}.00 FCFA</td>
                                        <td>
                                            <form class="removeItem" method="POST">
                                                @csrf
                                                @php
                                                    $encrypt = encryptData($key);
                                                @endphp

                                                <input type="hidden" name="product_id" value="{{ $encrypt }}">
                                                <button type="submit" class="btn btn-primary btn-sm border-0"><span
                                                        style="font-size: 16px" class="mdi mdi-delete"></span></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- MOBILE --}}
                <div class="row mb-5 d-block d-lg-none">
                    <ul>
                        @foreach ($cart as $key => $cartItem)
                            <li class="orderItem align-items-center d-flex gap-4 pt-1 pb-4 border-bottom border-dark-subtle"
                                data-id="{{ $key }}">
                                <div class="product-mobile-thumbnail">
                                    <div class="product-thumbnail-image">
                                        <img src="{{ asset('images/' . $cartItem['product']['image']) }}"
                                            alt="{{ $cartItem['product']['name'] }}">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h2>{{ $cartItem['product']['name'] ?? '' }}</h2>
                                        <p>{{ $cartItem['product']['price'] }}.00 FCFA</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="input-group align-items-center gap-2" style="max-width: 130px;">
                                                <div class="input-group-prepend">
                                                    <button class="decreaseBtn btn btn-outline-success js-btn-minus"
                                                        type="button">&minus;</button>
                                                </div>
                                                <input type="text" class="qtyItem form-control text-center"
                                                    value="{{ $cartItem['quantity'] }}" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1">
                                                <div class="input-group-append">
                                                    <button class="increaseBtn btn btn-outline-success js-btn-plus"
                                                        type="button">&plus;</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <form class="removeItem" method="POST">
                                                @csrf
                                                @php
                                                    $encrypt = encryptData($key);
                                                @endphp

                                                <input type="hidden" name="product_id" value="{{ $encrypt }}">
                                                <button type="submit" class="border-0 btn btn-light"><span
                                                        style="font-size: 16px"
                                                        class="text-success fs-2 mdi mdi-delete"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <p class="mb-5">Vous n'avez pas tous les produits désirés dans le panier ? <a
                            href="{{ route('product') }}">cliquez ici</a> pour ajouter
                        plus !</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('coupon.check') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-black h4" for="coupon">Coupon</label>
                                    <p>Veuillez entrez le code de votre coupon ici si vous en avez un.</p>
                                </div>
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <input type="text" class="form-control py-3" name="coupon_name"
                                        value="{{ session()->get('couponCode') ?? '' }}" id="coupon"
                                        placeholder="Coupon Code">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-sm border-0">Appliquer</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7 mt-4 mt-md-0">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black text-nowrap h4 text-uppercase">Total du panier </h3>
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Sous-total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">{{ $totalCartPrice }}.00 FCFA</strong>
                                </div>
                            </div> --}}
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="newTotalPrice text-black text-nowrap">
                                            {{ $totalCartPrice }}.00 FCFA</strong>
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
            @else
                <div>
                    <h3 class="text-dark">Votre panier est actuellement vide ! Veuillez <a class="text-primary"
                            href="{{ route('product') }}">cliquer ici</a>
                        pour ajouter des produits.</h3>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('customjs')
    <script>
        $(document).on('click', '.paymentButton', function(e) {
            var url = "{{ route('cart.form') }}";

            @if (!empty(session()->get('cart')))
                window.location.href = url;
            @endif

        });

        $(document).on('click', '.decreaseBtn', function(e) {
            $('.orderItem').removeClass('selected');
            $(this).closest('.orderItem').addClass('selected');
            sepetUpdate();
        });

        $(document).on('click', '.increaseBtn', function(e) {
            $('.orderItem').removeClass('selected');
            $(this).closest('.orderItem').addClass('selected');
            sepetUpdate();
        });

        function sepetUpdate() {
            var product_id = $('.selected').closest('.orderItem').attr('data-id');
            var quantity = $('.selected').closest('.orderItem').find('.qtyItem').val();
            console.log(product_id, quantity);


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('cartnewQty') }}",
                data: {
                    product_id: product_id,
                    quantity: quantity,
                },
                success: function(response) {

                    $('.selected').find('.itemTotal').text(response.productTotal + ' FCFA');
                    if (quantity == 0) {
                        $('.selected').remove();
                    }
                    $('.newTotalPrice').text(response.totalCartPrice + ' FCFA');
                }
            });
        }

        $(document).on('click', '.removeItem', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            var item = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('cartremove') }}",
                data: formData,
                success: function(response) {
                    toastr.success(response.message);
                    $('.count').text(response.productNumber);
                    $('.newTotalPrice').text(response.totalCartPrice + ' FCFA');
                    item.closest('.orderItem').remove();
                }
            });

        });
    </script>
@endsection
