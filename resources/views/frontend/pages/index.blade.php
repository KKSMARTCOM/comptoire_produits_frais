@extends('frontend.layout.layout')

@section('content')
    <div class="site-blocks-cover" data-aos="fade-down">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="">
                    <div class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/volaille.jpeg') }}" alt="">
                        </div>
                        <h1>VOLAILLES</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
                    <div class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/poisson.jpg') }}" alt="">
                        </div>
                        <h1>POISSONS & FRUITS DE MER</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/fruits.jpg') }}" alt="">
                        </div>
                        <h1>FRUITS & LÉGUMES</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="site-category-card">
                        <div class="site-category-card-image">
                            <img src="{{ asset('images/viandes.jpeg') }}" alt="">
                        </div>
                        <h1>AUTRES VIANDES</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section-cave" style="background-image: url('{{ asset('images/cave.jpg') }}')">
        <div class="site-section-cave-opacity"></div>
        <div class="container">
            <div class="site-section-cave-text">
                <h1>Cave à vin</h1>
                <p>Une cave qui prône la pérennité, le savoir, la culture, mais surtout qui vous garantit l’authenticité
                    de
                    ses produits et la qualité.</p>
                <a href="#">Découvrir</a>
            </div>
        </div>
    </div>

    <div class="site-section-store">
        <div class="container d-flex justify-content-between">
            <div class="site-section-store-left">
                <div>
                    <h1>CPF Store</h1>
                    <p>Une large varieté de produits alimentaires et divers Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Aspernatur recusandae, ratione totam sequi soluta eligendi dicta ullam dignissimos
                        assumenda error explicabo laudantium et obcaecati molestiae reiciendis iure quidem vitae ipsa?...
                    </p>
                    <a href="#">Voir plus</a>
                </div>
            </div>
            <div class="site-section-store-right">
                <div class="site-section-store-right-double-image">
                    <div class="site-section-store-right-image">
                        <img src="{{ asset('images/store1.jpg') }}" alt="">
                    </div>
                    <div class="site-section-store-right-image absolute-image">
                        <img src="{{ asset('images/store2.jpg') }}" alt="">
                    </div>
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
            <div class="row gap-4 justify-content-center">
                <div class="col-lg-4 col-md-6 site-section-box-container">
                    <div class="site-section-box-image">
                        <img src="{{ asset('images/coffret1.jpg') }}" alt="">
                    </div>
                    <div class="site-section-box-bottom">
                        <div class="site-section-box-bottom-text">
                            <h3>Coffret1</h3>
                            <p>20 000 FCFA</p>
                            <p>Composé de ...</p>
                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="#"><span class="mdi mdi-eye-outline"></span></a>
                            <a href="#" class="button-link">COMMANDER</a>
                        </div>
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
                            <p>Composé de ...</p>
                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="#"><span class="mdi mdi-eye-outline"></span></a>
                            <a href="#" class="button-link">COMMANDER</a>
                        </div>
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
                            <p>Composé de ...</p>
                        </div>
                        <div class="site-section-box-bottom-link">
                            <a href="#"><span class="mdi mdi-eye-outline"></span></a>
                            <a href="#" class="button-link">COMMANDER</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-section-box-more">
                <a href="">Voir plus</a>
            </div>
        </div>
    </div>
@endsection
