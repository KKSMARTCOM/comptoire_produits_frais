@extends('frontend.layout.layout')

@section('title', $product->name . ' - Comptoir des Produits Frais')
@section('meta_description', Str::limit($product->description, 150))
@section('og_title', $product->name)
@section('og_description', Str::limit($product->description, 150))

@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>{{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row mt-4">
                {{-- GALERIE D'IMAGES ET VIDÉO --}}
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="product-gallery">
                        {{-- IMAGE PRINCIPALE --}}
                        <div class="main-image-container mb-3"
                            style="background: #f8f9fa; border-radius: 12px; overflow: hidden; display: flex; align-items: center; justify-content: center; min-height: 500px;">
                            <img id="mainImage" src="{{ asset($product->image) }}" class="img-fluid"
                                style="max-width: 100%; max-height: 500px; object-fit: contain; padding: 20px;"
                                alt="Image principale">
                        </div>

                        {{-- MINIATURES --}}
                        @php
                            $additionals = $product->additionals_images
                                ? json_decode($product->additionals_images, true)
                                : [];
                        @endphp

                        <div class="thumbnails-wrapper">
                            <div class="d-flex gap-2 overflow-auto pb-2" style="flex-wrap: wrap;">
                                {{-- Miniature de l'image principale --}}
                                <div class="thumbnail-item" style="cursor: pointer; flex-shrink: 0;">
                                    <img src="{{ asset($product->image) }}" class="thumbnail-img active"
                                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 3px solid #004200; transition: all 0.3s ease;"
                                        onclick="changeMainImage('{{ asset($product->image) }}')" alt="Vignette principale">
                                </div>

                                {{-- Miniatures des images additionnelles --}}
                                @foreach ($additionals as $img)
                                    <div class="thumbnail-item" style="cursor: pointer; flex-shrink: 0;">
                                        <img src="{{ asset($img) }}" class="thumbnail-img"
                                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 3px solid #e9ecef; transition: all 0.3s ease;"
                                            onclick="changeMainImage('{{ asset($img) }}')" alt="Vignette">
                                    </div>
                                @endforeach

                                {{-- Miniature de la vidéo si disponible --}}
                                @if ($product->video)
                                    <div class="thumbnail-item"
                                        style="cursor: pointer; flex-shrink: 0; position: relative;">
                                        <div style="width: 100px; height: 100px; background: #000; border-radius: 8px; border: 3px solid #e9ecef; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
                                            onclick="scrollToVideo()">
                                            <i class="mdi mdi-play" style="color: white; font-size: 24px;"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- VIDÉO --}}
                        @if ($product->video)
                            <div class="video-section mt-4" id="videoSection">
                                <h5 class="mb-3" style="color: #333; font-weight: 600;">Vidéo du produit</h5>
                                <div style="background: #000; border-radius: 12px; overflow: hidden; aspect-ratio: 16/9;">
                                    <video id="productVideo" width="100%" height="auto" controls
                                        style="width: 100%; height: 100%;">
                                        <source src="{{ asset($product->video) }}" type="video/mp4">
                                        Votre navigateur ne supporte pas la balise vidéo.
                                    </video>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- INFORMATIONS DU PRODUIT --}}
                <div class="col-lg-6">
                    <div class="product-info">
                        {{-- TITRE ET STATUT --}}
                        <div class="mb-4">
                            <h1 class="product-title mb-3" style="font-size: 2rem; font-weight: 700; color: #1a1a1a;">
                                {{ ucfirst($product->name) }}
                            </h1>

                            {{-- Badge de status --}}
                            <div class="d-flex gap-2 align-items-center mb-3">
                                @if ($product->status == '0')
                                    <span class="badge badge-success"
                                        style="padding: 8px 12px; font-size: 12px; background-color: #28a745;">Illimité en
                                        stock</span>
                                @elseif ($product->status == '1')
                                    <span class="badge badge-warning"
                                        style="padding: 8px 12px; font-size: 12px; background-color: #ffc107; color: #333;">En
                                        stock</span>
                                @else
                                    <span class="badge badge-danger"
                                        style="padding: 8px 12px; font-size: 12px; background-color: #dc3545;">Épuisé</span>
                                @endif
                            </div>
                        </div>

                        {{-- PRIX --}}
                        <div class="price-section mb-4 pb-4" style="border-bottom: 1px solid #e9ecef;">
                            <p class="product-price" style="font-size: 2rem; font-weight: 700; color: #004200; margin: 0;">
                                {{ number_format($product->price, 0, '.', ' ') }} FCFA
                            </p>
                            <p class="text-muted" style="font-size: 14px; margin-top: 5px;">Prix unitaire</p>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="description-section mb-4 pb-4" style="border-bottom: 1px solid #e9ecef;">
                            <h5 style="font-weight: 600; color: #333; margin-bottom: 12px;">Description</h5>
                            <p class="text-muted" style="line-height: 1.6; font-size: 15px;">
                                {!! $product->content ?? 'Aucune description disponible' !!}
                            </p>
                        </div>

                        {{-- CATÉGORIE ET DÉTAILS --}}
                        @if ($product->category)
                            <div class="details-section mb-4 pb-4" style="border-bottom: 1px solid #e9ecef;">
                                <h5 style="font-weight: 600; color: #333; margin-bottom: 12px;">Détails du produit</h5>
                                <div class="row" style="font-size: 14px;">
                                    <div class="col-6">
                                        <p class="text-muted mb-2"><strong>Catégorie:</strong></p>
                                        <p style="color: #333;">{{ ucfirst($product->category->name) }}</p>
                                    </div>
                                    @if ($product->type)
                                        <div class="col-6">
                                            <p class="text-muted mb-2"><strong>Type:</strong></p>
                                            <p style="color: #333;">{{ $product->type }}</p>
                                        </div>
                                    @endif
                                </div>
                                @if ($product->region)
                                    <div class="row" style="font-size: 14px;">
                                        <div class="col-6">
                                            <p class="text-muted mb-2"><strong>Région:</strong></p>
                                            <p style="color: #333;">{{ $product->region }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- PANIER --}}
                        <div class="add-to-cart-section">
                            @php
                                $encrypt = encryptData($product->id);
                            @endphp
                            <form method="POST" action="{{ route('cartadd') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $encrypt }}">

                                <div class="row align-items-end">
                                    <div class="col-auto">
                                        <label
                                            style="display: block; margin-bottom: 8px; font-weight: 600; color: #333; font-size: 14px;">Quantité</label>
                                        <div class="input-group quantity-selector"
                                            style="width: fit-content; border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden;">
                                            <button class="btn btn-light js-btn-minus" type="button"
                                                style="border: none; padding: 10px 15px; background: #f8f9fa;">
                                                <i class="mdi mdi-minus"></i>
                                            </button>
                                            <input type="text" class="form-control text-center quantity-input"
                                                value="1" name="quantity"
                                                style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; width: 60px; font-weight: 600;">
                                            <button class="btn btn-light js-btn-plus" type="button"
                                                style="border: none; padding: 10px 15px; background: #f8f9fa;">
                                                <i class="mdi mdi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col flex-grow-1">
                                        <button type="submit" class="btn btn-primary w-100"
                                            style="background-color: #004200; border: none; padding: 12px 30px; font-weight: 600; font-size: 16px; border-radius: 8px; transition: all 0.3s ease;">
                                            <i class="mdi mdi-cart mr-2"></i>Ajouter au panier
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PRODUITS SIMILAIRES --}}
    <div class="site-section block-3 site-blocks-2 bg-light py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 site-section-heading text-center">
                    <h2 style="font-size: 2rem; font-weight: 700; color: #1a1a1a;">Produits similaires</h2>
                    <p class="text-muted">Découvrez d'autres produits de notre collection</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel owl-theme">
                        @if ($productFeatures && count($productFeatures) > 0)
                            @foreach ($productFeatures as $product)
                                <div class="item">
                                    <div class="block-4 text-center"
                                        style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                                        <div class="block-4-image d-flex justify-content-center"
                                            style="background: #f8f9fa; min-height: 280px; display: flex; align-items: center;">
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                class="img-fluid"
                                                style="max-height: 280px; object-fit: contain; padding: 15px;">
                                        </div>
                                        <div class="block-4-text p-4">
                                            <h3 style="margin-bottom: 10px;">
                                                <a href="{{ route('productdetail', $product->slug) }}"
                                                    style="color: #333; text-decoration: none; font-size: 1.1rem; font-weight: 600; transition: color 0.3s ease;">
                                                    {{ ucfirst($product->name) }}
                                                </a>
                                            </h3>
                                            <p class="font-weight-bold"
                                                style="color: #004200; font-size: 1.2rem; margin: 0;">
                                                {{ number_format($product->price, 0, '.', ' ') }} FCFA
                                            </p>
                                            <a href="{{ route('productdetail', $product->slug) }}"
                                                class="btn btn-sm mt-3"
                                                style="background-color: #004200; color: white; border: none; border-radius: 6px; padding: 8px 16px; text-decoration: none; transition: background-color 0.3s ease;">
                                                Voir détails
                                            </a>
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
        .product-title {
            letter-spacing: -0.5px;
        }

        .thumbnail-img {
            transition: all 0.3s ease;
        }

        .thumbnail-img:hover {
            transform: scale(1.05);
        }

        .thumbnail-img.active {
            border-color: #004200 !important;
        }

        .main-image-container img {
            transition: opacity 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #003000 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 66, 0, 0.3);
        }

        .quantity-selector .btn:hover {
            background-color: #e9ecef !important;
        }

        .block-4:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15) !important;
            transform: translateY(-4px);
        }

        .product-gallery {
            position: sticky;
            top: 80px;
        }

        @media (max-width: 768px) {
            .product-gallery {
                position: relative;
                top: auto;
            }

            .product-title {
                font-size: 1.5rem !important;
            }
        }
    </style>
@endpush

@section('customjs')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 15,
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
            const mainImage = document.getElementById('mainImage');
            mainImage.style.opacity = '0.5';
            setTimeout(() => {
                mainImage.src = url;
                mainImage.style.opacity = '1';
            }, 100);

            // Mettre à jour le style des miniatures
            document.querySelectorAll('.thumbnail-img').forEach(thumb => {
                if (thumb.src === url) {
                    thumb.classList.add('active');
                } else {
                    thumb.classList.remove('active');
                }
            });
        }

        function scrollToVideo() {
            const videoSection = document.getElementById('videoSection');
            if (videoSection) {
                videoSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // Gestion des boutons +/-
        document.querySelectorAll('.js-btn-plus').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.closest('.quantity-selector').querySelector('.quantity-input');
                input.value = parseInt(input.value) ++;
            });
        });

        document.querySelectorAll('.js-btn-minus').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.closest('.quantity-selector').querySelector('.quantity-input');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) --;
                }
            });
        });

        // Transition fluide pour les images principales
        document.getElementById('mainImage').style.transition = 'opacity 0.3s ease';
    </script>
@endsection
