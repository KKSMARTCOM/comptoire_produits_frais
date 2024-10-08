@extends('frontend.layout.layout')

@section('content')
    <div class="site-blocks-cover" data-aos="fade-down">
        <div class="container">
            <div class="row web-category">
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="">
                    <a href="{{ route('categories', 'volailles') }}" class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/poultry.png') }}" alt="">
                        </div>
                        <h1>VOLAILLES</h1>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('categories', 'poissons') }}" class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/fish.png') }}" alt="">
                        </div>
                        <h1>POISSONS & FRUITS DE MER</h1>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('categories', 'autres-viandes') }}" class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/viandes.png') }}" alt="">
                        </div>
                        <h1>AUTRES VIANDES</h1>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('categories', 'fruits-legumes') }}" class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/fruit.png') }}" alt="">
                        </div>
                        <h1>FRUITS & LÉGUMES</h1>
                    </a>
                </div>
            </div>

            <div class="mobile-category">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="" data-aos="fade-up" data-aos-delay="">
                            <a href="{{ route('categories', 'volailles') }}" class="site-category-card">
                                <div class="site-category-card-image">
                                    <img src="{{ asset('images/poultry.png') }}" alt="">
                                </div>
                                <h1>VOLAILLES</h1>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ route('categories', 'poissons') }}" class="site-category-card">
                                <div class="site-category-card-image">
                                    <img src="{{ asset('images/fish.png') }}" alt="">
                                </div>
                                <h1>POISSONS & FRUITS DE MER</h1>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="" data-aos="fade-up" data-aos-delay="300">
                            <a href="{{ route('categories', 'autres-viandes') }}" class="site-category-card">
                                <div class="site-category-card-image">
                                    <img src="{{ asset('images/viandes.png') }}" alt="">
                                </div>
                                <h1>AUTRES VIANDES</h1>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ route('categories', 'fruits-legumes') }}" class="site-category-card">
                                <div class="site-category-card-image">
                                    <img src="{{ asset('images/fruit.png') }}" alt="">
                                </div>
                                <h1>FRUITS & LÉGUMES</h1>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="site-section-cave" style="background-image: url('{{ asset('images/cave.jpg') }}')">
        <div class="site-section-cave-opacity"></div>
        <div class="container">
            <div class="site-section-cave-text p-2">
                <h1>Cave à vin</h1>
                <p>Découvrez notre cave en ligne, où vins, champagnes et spiritueux d'exception vous attendent. Chaque
                    bouteille est sélectionnée avec soin pour offrir une expérience unique, que ce soit pour un repas ou une
                    célébration. Laissez-vous séduire par notre gamme de produits raffinés et authentiques.</p>
                <a href="{{ route('categories', 'la-cave') }}">Découvrir</a>
            </div>
        </div>
    </div>

    <div class="site-section-store">
        <div class="container d-flex justify-content-between">
            <div class="site-section-store-left">
                <div class="site-section-store-left-double-image">
                    <div class="site-section-store-left-image">
                        <img src="{{ asset('images/store1.jpg') }}" alt="">
                    </div>
                    <div class="site-section-store-left-image absolute-image">
                        <img src="{{ asset('images/store2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="site-section-store-right p-2">
                <div>
                    <h1>CPF Store</h1>
                    <p>Explorez notre sélection de produits alimentaires, alliant qualité et saveurs authentiques. Des
                        viandes fraîches aux fruits et légumes bio, en passant par les poissons et produits d'épicerie fine,
                        chaque article est choisi pour garantir une expérience culinaire exceptionnelle. Appréciez des
                        produits frais, locaux et soigneusement sélectionnés pour toutes vos envies.
                    </p>
                    <a href="{{ route('categories', 'cpf-store') }}">Découvrir</a>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section-box" id="pack-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-box-title text-center pt-3 pb-3">
                    <h2>NOS COFFRETS & PANIERS DE FÊTES</h2>
                </div>
            </div>
            <div class="row p-2 gap-4 mb-4 justify-content-center" id="packList">
                @include('frontend.ajax.packList', ['packs' => $packs])
            </div>
        </div>
        <div class="row gap-4 mb-4 justify-content-center more-coffret">
            {{-- <div class="col-lg-4 col-md-6 site-section-box-container">
                    <div class="site-section-box-image">
                        <img src="{{ asset('images/coffret1.jpg') }}" alt="">
                    </div>
                    <div class="site-section-box-bottom">
                        <div class="site-section-box-bottom-text">
                            <h3>Coffret Gourmand</h3>
                            <p>20 000 FCFA</p>
                            <p>Savourez un mélange exquis de délices sucrés et salés dans notre coffret gourmet...</p>

                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="{{ route('cart') }}"><span class="mdi mdi-eye-outline"></span></a>
                        </div>
                    </div>
                    <div class="mt-4 d-flex align-items-end justify-content-end">
                        <a href="javascript:void(0)" class="button-link">Commander</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 site-section-box-container">
                    <div class="site-section-box-image">
                        <img src="{{ asset('images/coffret2.jpg') }}" alt="">
                    </div>
                    <div class="site-section-box-bottom">
                        <div class="site-section-box-bottom-text">
                            <h3>Panier Délices Artisanaux</h3>
                            <p>20 000 FCFA</p>
                            <p>Savourez des produits artisanaux soigneusement choisis pour éveiller vos papilles...</p>

                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="{{ route('cart') }}"><span class="mdi mdi-eye-outline"></span></a>
                        </div>
                    </div>
                    <div class="mt-4 d-flex align-items-end justify-content-end">
                        <a href="javascript:void(0)" class="button-link">Commander</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 site-section-box-container">
                    <div class="site-section-box-image">
                        <img src="{{ asset('images/coffret3.jpg') }}" alt="">
                    </div>
                    <div class="site-section-box-bottom">
                        <div class="site-section-box-bottom-text">
                            <h3>Coffret Épicurien</h3>
                            <p>20 000 FCFA</p>
                            <p>Profitez d'un assortiment de spécialités gastronomiques pour ravir les amateurs de bonne
                                cuisine...</p>

                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="{{ route('cart') }}"><span class="mdi mdi-eye-outline"></span></a>
                        </div>
                    </div>
                    <div class="mt-4 d-flex align-items-end justify-content-end">
                        <a href="javascript:void(0)" class="button-link">Commander</a>
                    </div>
                </div> --}}
        </div>
        @if ($remaining)
            <div class="site-section-box-more">
                <a class="site-section-box-more-button" id="loadMoreBtn" href="">Voir plus</a>
            </div>
        @endif
    </div>
    </div>
@endsection
@section('customjs')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            dots: true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                536: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        })

        $(document).ready(function() {
            let offset = 3;
            $('#loadMoreBtn').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('index') }}",
                    type: 'GET',
                    data: {
                        offset: offset,
                    },
                    beforeSend: function() {
                        $('#loadMoreBtn').prop('disabled', true).text('Chargement...');
                    },
                    success: function(response) {
                        $('#packList').append(response.packs)

                        offset += 3;

                        // Cacher le bouton "Voir plus" s'il n'y a plus de coffrets à charger
                        if (!response.remaining) {
                            $('#loadMoreWrapper').hide();
                        } else {
                            // Réactiver le bouton et remettre le texte par défaut
                            $('#loadMoreBtn').prop('disabled', false).text('Voir plus');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        // Réactiver le bouton en cas d'erreur
                        $('#loadMoreBtn').prop('disabled', false).text('Voir plus');
                    }
                })
            })
        })
    </script>
@endsection
