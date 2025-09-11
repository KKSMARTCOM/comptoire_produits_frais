@extends('frontend.layout.layout')

@section('content')
    {{-- <div class="site-blocks-cover" data-aos="fade-down">
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
    </div> --}}

    <div class="site-section-cave" style="background-image: url('{{ asset('images/others/cpf.jpg') }}')">
        {{-- <div class="site-section-cave-opacity"></div>
        <div class="container">
            <div class="site-section-cave-text p-2">
                <h1>Cave à vin</h1>
                <p>Découvrez notre cave en ligne, où vins, champagnes et spiritueux d'exception vous attendent. Chaque
                    bouteille est sélectionnée avec soin pour offrir une expérience unique, que ce soit pour un repas ou une
                    célébration. Laissez-vous séduire par notre gamme de produits raffinés et authentiques.</p>
                <a href="{{ route('categories', 'la-cave') }}">Découvrir</a>
            </div>
        </div> --}}
    </div>

    <div class="container px-[1rem] md:px-[3rem] mx-auto flex justify-center py-[4rem]">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[2rem]">
            <div class="cursor-pointer shadow-md bg-white rounded-lg">
                <div class="w-full h-[18rem] overflow-hidden">
                    <img src="{{ asset('images/others/vin2.jpg') }}" class="object-cover w-full h-full rounded-t-lg"
                        alt="">
                </div>
                <div class="p-[1.5rem] space-y-4">
                    <h1 class="font-bold text-lg md:text-xl">La Cave à Vin : Un espace dédié aux plaisirs du vin.</h1>
                    <p class="text-sm md:text-lg">Notre cave à vin rassemble une sélection soigneusement choisie de crus
                        prestigieux et de découvertes uniques. Laissez-vous séduire par l’élégance,
                        le caractère et l’authenticité de nos vins d’exception.</p>
                </div>
            </div>

            <div class="cursor-pointer shadow-md bg-white rounded-lg">
                <div class="w-full h-[18rem] overflow-hidden">
                    <img src="{{ asset('images/store1.jpg') }}" class="object-cover w-full h-full rounded-t-lg"
                        alt="">
                </div>
                <div class="p-[1.5rem] space-y-4">
                    <h1 class="font-bold text-lg md:text-xl">Nos Produits Locaux : Le goût authentique de notre terroir.
                    </h1>
                    <p class="text-sm md:text-lg">Dans notre espace Produits locaux, retrouvez la fraîcheur et la richesse
                        de notre région. Fruits et légumes de saison, spécialités artisanales et produits du quotidien vous
                        attendent.</p>
                </div>
            </div>

            <div class="cursor-pointer shadow-md bg-white rounded-lg">
                <div class="w-full h-[18rem] overflow-hidden">
                    <img src="{{ asset('images/others/lounge.jpg') }}" class="object-cover w-full h-full rounded-t-lg"
                        alt="">
                </div>
                <div class="p-[1.5rem] space-y-4">
                    <h1 class="font-bold text-lg md:text-xl">Le Lounge : Un espace où élégance et détente se rencontrent.
                    </h1>
                    <p class="text-sm md:text-lg">Le lounge offre une atmosphère raffinée et chaleureuse, idéale pour
                        savourer un instant de détente entre amis ou en toute intimité. Un lieu unique et propice
                        aux échanges.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-[1rem] md:px-[3rem] mx-auto mb-[4rem]">
        <div class="relative rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 shadow-xl">
            <!-- Dégradé décoratif -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#004200] to-green-600 opacity-80 rounded-2xl"></div>

            <!-- Badge en absolute -->
            <div class="absolute -top-5 left-1/2 -translate-x-1/2 rotate-[-3deg] bg-white px-6 py-2 rounded-lg shadow-lg">
                <h1 class="text-sm md:text-lg font-extrabold text-[#000000] text-nowrap tracking-wide">
                    Rejoignez la famille <span class="text-[#004200]">CPF</span>
                </h1>
            </div>

            <div class="relative z-10 block md:flex items-center gap-4 p-[1rem] sm:p-[2rem] mt-[1rem] sm:mt-[0px]">
                <p class="text-white/90 text-sm md:text-lg ">
                    Découvrez nos sélections exclusives, profitez de nos promotions et vivez une expérience unique autour de
                    nos produits.
                </p>
                <div class="mt-[1rem] md:mt-[0px]">
                    <a href="#offres"
                        class="inline-block px-[20px] py-[8px] bg-[#000000] text-[#FFFFFF] font-semibold rounded-lg text-nowrap shadow-md hover:bg-white hover:text-black">
                        Découvrez nos offres
                    </a>
                </div>
            </div>
        </div>
    </div>



    <div class="site-section-store container px-[1rem] md:px-[3rem] mx-auto">
        <div class="block md:flex justify-between items-center">
            <div class="site-section-store-left flex items-center">
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
                <div class="space-y-6">
                    <h1>CPF Store</h1>
                    <p class="mt-0">Explorez notre sélection de produits alimentaires, alliant qualité et saveurs
                        authentiques. Des
                        viandes fraîches aux fruits et légumes bio, en passant par les poissons et produits d'épicerie fine,
                        chaque article est choisi pour garantir une expérience culinaire exceptionnelle. Appréciez des
                        produits frais, locaux et soigneusement sélectionnés pour toutes vos envies.
                    </p>
                    <div>
                        <a href="{{ route('categories', 'cpf-store') }}">Découvrir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section-box container px-[1rem] md:px-[3rem] mx-auto" id="pack-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-box-title text-center pt-3 pb-3">
                    <h2 class="text-xl md:text-2xl">NOS COFFRETS & PANIERS DE FÊTES</h2>
                </div>
            </div>
            <div class="row p-2 gap-4 mb-4 justify-content-center" id="packList">
                @include('frontend.ajax.packList', ['packs' => $packs])
            </div>
        </div>
        <div class="row gap-4 mb-4 justify-content-center more-coffret">

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
