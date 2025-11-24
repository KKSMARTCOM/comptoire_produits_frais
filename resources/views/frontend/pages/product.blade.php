@extends('frontend.layout.layout')

@section('title', $product->name . ' - Comptoir des Produits Frais')
@section('meta_description', Str::limit($product->description, 150))
@section('og_title', $product->name)
@section('og_description', Str::limit($product->description, 150))

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
                <div class="col-md-6 d-flex flex-column align-items-center p-1">

                    {{-- IMAGE PRINCIPALE --}}
                    <div class="product-detail-image mb-3">
                        <img id="mainImage" src="{{ asset($product->image) }}" class="w-full h-full"
                            style="width: 100%; max-height: 400px; object-fit: contain;" alt="Image principale">
                    </div>

                    {{-- IMAGES ADDITIONNELLES --}}
                    @php
                        $additionals = $product->additionals_images
                            ? json_decode($product->additionals_images, true)
                            : [];
                    @endphp

                    @if (!empty($additionals))
                        <div class="d-flex gap-2 flex-wrap justify-content-center">
                            @foreach ($additionals as $img)
                                <img src="{{ asset($img) }}" class="thumb-image"
                                    style="width: 80px; height: 80px; cursor: pointer; object-fit: cover; border-radius: 6px; border: 2px solid #eee;"
                                    onclick="changeMainImage('{{ asset($img) }}')">
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-md-6 space-y-4">
                    <h2 class="text-black text-lg md:text-2xl">{{ ucfirst($product->name) }}</h2>
                    <p class="text-black">{!! $product->content ?? '' !!}</p>
                    <p><strong class="h4">{{ $product->price }} FCFA</strong></p>
                    @php
                        $encrypt = encryptData($product->id);
                    @endphp
                    <form method="POST" action="{{ route('cartadd') }}">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $encrypt }}>

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
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                class="w-full h-full object-fit-contain">
                                        </div>
                                        <div class="block-4-text p-4">
                                            <h3><a href="{{ route('productdetail', $product->slug) }}">{{ ucfirst($product->name) }}
                                                </a>
                                            </h3>
                                            <p class="font-weight-bold">{{ $product->price }} FCFA</p>
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
@push('styles')
    <style>
        .thumb-image:hover {
            border-color: #0d6efd;
            transform: scale(1.05);
            transition: 0.2s;
        }
    </style>
@endpush
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

        function changeMainImage(url) {
            document.getElementById('mainImage').src = url;
        }
    </script>
@endsection
