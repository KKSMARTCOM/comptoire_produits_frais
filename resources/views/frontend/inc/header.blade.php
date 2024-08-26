<header class="site-navbar" role="banner">
    <div class="site-navbar-top" style="background-image: url('{{ asset('images/banner2.jpeg') }}')">


        {{-- <img src="{{ asset('images/banner2.jpeg') }}" class="site-navbar-top-image" alt=""> --}}
        {{-- <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                    <form action="" class="site-block-top-search">
                        <span class="icon icon-search2"></span>
                        <input type="text" class="form-control border-0" placeholder="Rechercher">
                    </form>
                </div>

                <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                    <div class="site-logo">
                        <a href="{{ route('index') }}" class="js-logo-clone">{{ config('app.name') }}</a>
                    </div>
                </div>

                <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                    <div class="site-top-icons">
                        <ul>
                            <li>
                                <a href="{{ route('cart') }}" class="site-cart">
                                    <span class="icon icon-shopping_cart"></span>
                                    <span class="count">{{  session()->get('cart') ? count(session('cart')) : 0 }}</span>
                                    <span class="count">{{ $countQty }}</span>
                                </a>
                            </li>
                            <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                    class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                        </ul>
                    </div>
                </div> --}}



    </div>
    <nav class="site-navigation text-center" id="site-navigation" role="navigation">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="text-dark">LOGO</h2>
                </div>
                <ul class="site-menu js-clone-nav">
                    <li class="active"><a href="{{ route('index') }}">Accueil</a></li>
                    <li class="has-children">
                        <a href="javascript:void(0)" class="d-flex align-items-center">Nos categories <span
                                class="mdi mdi-chevron-down"></span></a>
                    </li>
                    {{-- <li><a href="{{ route('product') }}">Volailles</a></li>
                    <li><a href="{{ route('product') }}">Poissons </a></li>
                    <li><a href="{{ route('product') }}">Autres viandes</a></li>
                    <li><a href="{{ route('product') }}">La cave</a></li>
                    <li><a href="{{ route('product') }}">Fruits & Légumes</a></li>
                    <li><a href="{{ route('product') }}">CPF Store</a></li> --}}
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <div class="site-top-icons ">
                    <ul>
                        <li>
                            <a href="{{ route('cart') }}" class="site-cart">
                                <span class="mdi mdi-cart"></span>
                                <span class="count">{{ session()->get('cart') ? count(session('cart')) : 0 }}</span>
                                {{-- <span class="count">{{ $countQty }}</span> --}}
                            </a>
                        </li>
                        <li class="d-block ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span
                                    class="mdi mdi-menu"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="site-category-dropdown">
                <ul>
                    <li><a href="{{ route('product') }}">Volailles</a></li>
                    <li><a href="{{ route('product') }}">Poissons </a></li>
                    <li><a href="{{ route('product') }}">Autres viandes</a></li>
                    <li><a href="{{ route('product') }}">La cave</a></li>
                    <li><a href="{{ route('product') }}">Fruits & Légumes</a></li>
                    <li><a href="{{ route('product') }}">CPF Store</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
