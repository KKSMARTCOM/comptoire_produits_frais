@extends('frontend.layout.layout')

@section('content')
    @if (empty($slider))
        <div class="site-blocks-cover" style="background-image: url({{ asset(/* $slider->image ??  */'images/children.jpg') }});" data-aos="fade">
            <div class="container">
                <div class="row align-items-start align-items-md-center justify-content-end">
                    <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                        <h1 class="mb-2">{{ $slider->name ?? __('Welcome') }}</h1>
                        <div class="intro-text text-center text-md-left">
                            <p class="mb-4">{{ $slider->content ?? __('') }}</p>
                            <p>
                                <a href="{{ $slider->link ?? '' }}" class="btn btn-sm btn-primary">Shop Now</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="site-section site-section-sm site-blocks-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                    <div class="icon mr-4 align-self-start">
                        <span class="icon-truck"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">FREE SHIPPING</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon mr-4 align-self-start">
                        <span class="icon-refresh2"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">FREE RETURNS</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon mr-4 align-self-start">
                        <span class="icon-help"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">CUSTOMER SUPPORT</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section site-blocks-2">
        <div class="container">
            <div class="row">
                @if (!empty($categories) && $categories->count() > 0)
                    @foreach ($categories->where('cat_ust', null) as $category)
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-2" data-aos="fade" data-aos-delay="">
                            <a class="block-2-item" href="{{ url($category->slug) }}">
                                <figure class="image">
                                    <img src="{{ asset(/* $category->image */'images/men.jpg') }}" alt="" class="img-fluid">
                                </figure>
                                <div class="text">
                                    <h3>{{ $category->name }} Hiiii</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-2" data-aos="fade" data-aos-delay="">
                            <a class="block-2-item" href="">
                                <figure class="image">
                                    <img src="{{ asset(/* $category->image */'images/men.jpg') }}" alt="" class="img-fluid">
                                </figure>
                                <div class="text">
                                    <h3>Viande</h3>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-2" data-aos="fade" data-aos-delay="">
                            <a class="block-2-item" href="">
                                <figure class="image">
                                    <img src="{{ asset(/* $category->image */'images/men.jpg') }}" alt="" class="img-fluid">
                                </figure>
                                <div class="text">
                                    <h3>Viande</h3>
                                </div>
                            </a>
                        </div>

                @endif
            </div>
        </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Featured Products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        @if (!empty($lastProducts) && $lastProducts->count() > 0)
                            @foreach ($lastProducts as $item)
                                <div class="item">
                                    <div class="block-4 text-center">
                                        <figure class="block-4-image">
                                            <img src="{{ asset(/* $item->image */'images/cloth_1.jpg') }}" alt="Image placeholder" class="img-fluid">
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="#">{{ $item->name }}</a></h3>
                                            <p class="mb-0">{{ $item->category->name ?? '' }}</p>
                                            <p class="text-primary font-weight-bold">$ {{ $item->price }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <div class="item">
                                    <div class="block-4 text-center">
                                        <figure class="block-4-image">
                                            <img src="{{ asset(/* $item->image */'images/cloth_1.jpg') }}" alt="Image placeholder" class="img-fluid">
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="#">Viande de boeuf</a></h3>
                                            <p class="mb-0">Viande</p>
                                            <p class="text-primary font-weight-bold">$ 100</p>
                                        </div>
                                    </div>
                        </div>
                        <div class="item">
                                    <div class="block-4 text-center">
                                        <figure class="block-4-image">
                                            <img src="{{ asset(/* $item->image */'images/cloth_1.jpg') }}" alt="Image placeholder" class="img-fluid">
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="#">Viande de boeuf</a></h3>
                                            <p class="mb-0">Viande</p>
                                            <p class="text-primary font-weight-bold">$ 100</p>
                                        </div>
                                    </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section block-8">
        <div class="container">
            <div class="row justify-content-center  mb-5">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Big Sale!</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-7 mb-5">
                    <a href="#"><img src="{{ /* $settings['campaign_image'] ?? '' */ asset('images/shoe.png') }}" alt="Image placeholder"
                            class="img-fluid rounded"></a>
                </div>
                <div class="col-md-12 col-lg-5 text-center pl-md-5">
                    <h4>
                        <a href="#">{{ $settings['campaign_title'] ?? '' }}</a>
                    </h4>
                    <p>{!! $settings['campaign_text'] ?? '' !!}</p>
                    <p><a href="{{ route('sale-product') }}" class="btn btn-primary btn-sm">Shop Now</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
