@extends('frontend.layout.layout')

@section('content')
    <div class="site-blocks-cover" data-aos="fade-down">
        <div class="container">
            <div class="row web-category">
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="">
                    <a href="{{ route('product') }}" class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/poultry.png') }}" alt="">
                        </div>
                        <h1>VOLAILLES</h1>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('product') }}" class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/fish.png') }}" alt="">
                        </div>
                        <h1>POISSONS & FRUITS DE MER</h1>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('product') }}" class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/viandes.png') }}" alt="">
                        </div>
                        <h1>AUTRES VIANDES</h1>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('product') }}" class="site-category-card">
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
                            <a href="{{ route('product') }}" class="site-category-card">
                                <div class="site-category-card-image">
                                    <img src="{{ asset('images/poultry.png') }}" alt="">
                                </div>
                                <h1>VOLAILLES</h1>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ route('product') }}" class="site-category-card">
                                <div class="site-category-card-image">
                                    <img src="{{ asset('images/fish.png') }}" alt="">
                                </div>
                                <h1>POISSONS & FRUITS DE MER</h1>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="" data-aos="fade-up" data-aos-delay="300">
                            <a href="{{ route('product') }}" class="site-category-card">
                                <div class="site-category-card-image">
                                    <img src="{{ asset('images/viandes.png') }}" alt="">
                                </div>
                                <h1>AUTRES VIANDES</h1>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ route('product') }}" class="site-category-card">
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
                <p>Une cave qui prône la pérennité, le savoir, la culture, mais surtout qui vous garantit l’authenticité
                    de
                    ses produits et la qualité.</p>
                <a href="{{ route('product') }}">Découvrir</a>
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
                    <p>Une large varieté de produits alimentaires et divers Lorem ipsum dolor sit amet
                        consectetur
                        adipisicing elit. Aspernatur recusandae, ratione totam sequi soluta eligendi dicta ullam dignissimos
                        assumenda error explicabo laudantium et obcaecati molestiae reiciendis iure quidem vitae ipsa?...
                    </p>
                    <a href="{{ route('product') }}">Découvrir</a>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-box-title text-center pt-3 pb-3">
                    <h2>NOS COFFRETS & PANIERS DE FÊTES</h2>
                </div>
            </div>
            <div class="row p-2 gap-4 mb-4 justify-content-center">
                <div class="col-lg-4 col-md-6 site-section-box-container">
                    <div class="site-section-box-image">
                        <img src="{{ asset('images/coffret1.jpg') }}" alt="">
                    </div>
                    <div class="site-section-box-bottom">
                        <div class="site-section-box-bottom-text">
                            <h3>Coffret1</h3>
                            <p>20 000 FCFA</p>
                            <p>Composé de Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, magnam...</p>

                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="{{ route('cart') }}"><span class="mdi mdi-eye-outline"></span></a>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="javascript:void(0)" class="button-link">Commander</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 site-section-box-container">
                    <div class="site-section-box-image">
                        <img src="{{ asset('images/coffret2.jpg') }}" alt="">
                    </div>
                    <div class="site-section-box-bottom">
                        <div class="site-section-box-bottom-text">
                            <h3>Coffret2</h3>
                            <p>20 000 FCFA</p>
                            <p>Composé de Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, magnam ...</p>

                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="{{ route('cart') }}"><span class="mdi mdi-eye-outline"></span></a>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="javascript:void(0)" class="button-link">Commander</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 site-section-box-container">
                    <div class="site-section-box-image">
                        <img src="{{ asset('images/coffret3.jpg') }}" alt="">
                    </div>
                    <div class="site-section-box-bottom">
                        <div class="site-section-box-bottom-text">
                            <h3>Coffret3</h3>
                            <p>20 000 FCFA</p>
                            <p>Composé de Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, magnam ...</p>

                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="{{ route('cart') }}"><span class="mdi mdi-eye-outline"></span></a>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="javascript:void(0)" class="button-link">Commander</a>
                    </div>
                </div>
            </div>
            <div class="row gap-4 mb-4 justify-content-center more-coffret">
                <div class="col-lg-4 col-md-6 site-section-box-container">
                    <div class="site-section-box-image">
                        <img src="{{ asset('images/coffret1.jpg') }}" alt="">
                    </div>
                    <div class="site-section-box-bottom">
                        <div class="site-section-box-bottom-text">
                            <h3>Coffret4</h3>
                            <p>20 000 FCFA</p>
                            <p>Composé de Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, magnam...</p>

                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="{{ route('cart') }}"><span class="mdi mdi-eye-outline"></span></a>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="javascript:void(0)" class="button-link">Commander</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 site-section-box-container">
                    <div class="site-section-box-image">
                        <img src="{{ asset('images/coffret2.jpg') }}" alt="">
                    </div>
                    <div class="site-section-box-bottom">
                        <div class="site-section-box-bottom-text">
                            <h3>Coffret5</h3>
                            <p>20 000 FCFA</p>
                            <p>Composé de Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, magnam ...</p>

                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="{{ route('cart') }}"><span class="mdi mdi-eye-outline"></span></a>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="javascript:void(0)" class="button-link">Commander</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 site-section-box-container">
                    <div class="site-section-box-image">
                        <img src="{{ asset('images/coffret3.jpg') }}" alt="">
                    </div>
                    <div class="site-section-box-bottom">
                        <div class="site-section-box-bottom-text">
                            <h3>Coffret6</h3>
                            <p>20 000 FCFA</p>
                            <p>Composé de Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, magnam ...</p>

                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="{{ route('cart') }}"><span class="mdi mdi-eye-outline"></span></a>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="javascript:void(0)" class="button-link">Commander</a>
                    </div>
                </div>
            </div>
            <div class="site-section-box-more">
                <a class="site-section-box-more-button" href="">Voir plus</a>
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
    </script>
@endsection
