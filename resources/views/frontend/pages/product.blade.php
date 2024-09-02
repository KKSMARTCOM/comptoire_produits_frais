@extends('frontend.layout.layout')

@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->get('success'))
                        <div class="alert alert-success">{{ session()->get('success') }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center p-1">
                    <div class="product-detail-image">
                        <img src="{{ asset('images/' . $product[0]['image']) }}" alt="Image">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $product[0]['name'] }}</h2>
                    <p class="text-black">{{-- {!! $product->content ?? '' !!} --}} Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Dolor animi magnam,
                        dolorum maiores libero molestiae numquam quaerat ratione nobis ab?</p>
                    <p><strong class="h4">{{ $product[0]['price'] }} FCFA</strong></p>
                    @php
                        $encrypt = encryptData($product[0]['id']);
                    @endphp
                    <form method="POST" action="{{ route('cartadd') }}">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $encrypt }}>
                        {{-- <div class="mb-1 d-flex">
                            <label for="option-xs" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-xs" name='size'
                                        {{ $product->size == 'XS' ? 'checked' : '' }} value="XS"></span> <span
                                    class="d-inline-block text-black">XS</span>
                            </label>
                            <label for="option-s" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-s" name='size'
                                        {{ $product->size == 'S' ? 'checked' : '' }} value="S"></span> <span
                                    class="d-inline-block text-black">S</span>
                            </label>
                            <label for="option-m" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-m" name='size'
                                        {{ $product->size == 'M' ? 'checked' : '' }} value="M"></span> <span
                                    class="d-inline-block text-black">M</span>
                            </label>
                            <label for="option-l" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-l" name='size'
                                        {{ $product->size == 'L' ? 'checked' : '' }} value="L"></span> <span
                                    class="d-inline-block text-black">L</span>
                            </label>
                            <label for="option-xl" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-xl" name='size'
                                        {{ $product->size == 'XL' ? 'checked' : '' }} value="XL"></span> <span
                                    class="d-inline-block text-black">XL</span>
                            </label>
                        </div> --}}

                        <div class="mb-4">
                            <div class="input-group mb-3 align-items-center gap-2" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-success js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="text" class="form-control text-center" value="1" name="quantity"
                                    placeholder="" aria-label="Example text with button addon"
                                    aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>

                        </div>
                        <p><button type="submit" class="buy-now btn btn-sm btn-primary border-0">Ajouter au panier</button>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Produits similaires</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel owl-theme">
                        @if ($productFeatures && count($productFeatures) > 0)
                            @foreach ($productFeatures as $product)
                                <div class="item">
                                    <div class="block-4 text-center">
                                        <div class="block-4-image d-flex justify-content-center">
                                            <img src="{{ asset('images/' . $product['image']) }}"
                                                alt="{{ $product['name'] }}" class="object-fit-contain">
                                        </div>
                                        <div class="block-4-text p-4">
                                            <h3><a href="{{ route('productdetail', $product['id']) }}">{{ $product['name'] }}
                                                </a>
                                            </h3>
                                            <p class="font-weight-bold">{{ $product['price'] }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
@endsection
