<header class="site-navbar" role="banner">
    <div class="site-navbar-top">
    </div>

    <nav class="site-navigation text-center" id="site-navigation" role="navigation">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="site-logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('images/svg/KKSMARTDESIGN_CPF_LOGO_prop9.svg') }}"
                            alt="LOGO"></a>
                </div>
                <ul class="site-menu js-clone-nav">
                    <li class="active"><a href="{{ route('index') }}">Accueil</a></li>
                    @if ($categories && $categories->count() > 0)
                        @foreach ($categories as $item)
                            <li><a href="{{ route('categories', $item->slug) }}">{{ $item->name }}</a></li>
                        @endforeach
                    @else
                        <li><a href="{{ route('product') }}">Volailles</a></li>
                        <li><a href="{{ route('product') }}">Poissons </a></li>
                        <li><a href="{{ route('product') }}">Autres viandes</a></li>
                        <li><a href="{{ route('product') }}">La cave</a></li>
                        <li><a href="{{ route('product') }}">Fruits & Légumes</a></li>
                        <li><a href="{{ route('product') }}">Coffrets & Paniers</a></li>
                        <li><a href="{{ route('product') }}">CPF Store</a></li>
                    @endif
                    {{-- <li class="has-children">
                            <a href="javascript:void(0)" class="d-flex align-items-center">Produits <span
                                    class="mdi mdi-chevron-down"></span></a>
                            <div class="site-category-dropdown">
                                <ul>
                                    <li><a href="{{ route('product') }}">Volailles</a></li>
                                    <li><a href="{{ route('product') }}">Poissons </a></li>
                                    <li><a href="{{ route('product') }}">Autres viandes</a></li>
                                    <li><a href="{{ route('product') }}">La cave</a></li>
                                    <li><a href="{{ route('product') }}">Fruits & Légumes</a></li>
                                    <li><a href="{{ route('product') }}">Coffrets & Paniers</a></li>
                                    <li><a href="{{ route('product') }}">CPF Store</a></li>
                                </ul>
                            </div>
                        </li> --}}

                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <div class="site-top-icons">
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
        </div>
    </nav>

    <div class="site-mobile">
        <div class="site-mobile-menu-bg"></div>
        <div class="site-mobile-menu">
            <div class="site-mobile-menu-header">
                <div class='site-mobile-menu-close'><span class='mdi mdi-close js-menu-toggle'></span></div>
                <div class="site-mobile-menu-logo">
                    <div class="site-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('images/svg/KKSMARTDESIGN_CPF_LOGO_prop9.svg') }}" alt='LOGO'></a>
                    </div>
                </div>
            </div>
            <div class='site-mobile-menu-body'>
                <ul>
                    <li class="active"><a href="{{ route('index') }}">Accueil</a></li>
                    @if ($categories && $categories->count() > 0)
                        @foreach ($categories as $item)
                            <li><a href="{{ route('categories', $item->slug) }}">{{ $item->name }}</a></li>
                        @endforeach
                    @else
                        <li><a href="{{ route('product') }}">Volailles</a></li>
                        <li><a href="{{ route('product') }}">Poissons </a></li>
                        <li><a href="{{ route('product') }}">Autres Viandes</a></li>
                        <li><a href="{{ route('product') }}">La cave</a></li>
                        <li><a href="{{ route('product') }}">Fruits & Légumes</a></li>
                        <li><a href="{{ route('product') }}">Coffrets & Paniers</a></li>
                        <li><a href="{{ route('product') }}">CPF Store</a></li>
                    @endif
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
