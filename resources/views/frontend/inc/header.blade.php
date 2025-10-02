<header class="site-navbar" role="banner">
    {{--  <div class="site-navbar-top">
    </div> --}}

    <nav class="site-navigation text-center fixed" id="site-navigation" role="navigation">
        <div class="container px-[1rem] md:px-[3rem] mx-auto">
            <div class="flex justify-between items-center">
                <div class="site-logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('images/svg/KKSMARTDESIGN_CPF_LOGO_prop9.svg') }}"
                            alt="LOGO"></a>
                </div>
                <ul class="site-menu js-clone-nav">
                    <li class="{{ Route::is('index') ? 'active' : '' }}">
                        <a href="{{ route('index') }}">Accueil</a>
                    </li>
                    <li
                        class="{{ Route::is('cave') || (request()->routeIs('sections') && request()->route('section') === 'la-cave') ? 'active' : '' }}">
                        <a href="{{ route('cave') }}">La Cave</a>
                    </li>
                    <li
                        class="{{ Route::is('local.products') || (request()->routeIs('sections') && request()->route('section') === 'produits-locaux') ? 'active' : '' }}">
                        <a href="{{ route('local.products') }}">Produits locaux </a>
                    </li>
                    <li><a href="javascript:void(0)">CPF Lounge</a></li>
                    <li><a href="/#pack-section">Coffrets & Paniers</a></li>
                    <li class="{{ Route::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a>
                    </li>
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
                    <li class="{{ Route::is('index') ? 'active' : '' }}">
                        <a href="{{ route('index') }}">Accueil</a>
                    </li>
                    <li
                        class="{{ Route::is('cave') || (request()->routeIs('sections') && request()->route('section') === 'la-cave') ? 'active' : '' }}">
                        <a href="{{ route('cave') }}">La Cave</a>
                    </li>
                    <li
                        class="{{ Route::is('local.products') || (request()->routeIs('sections') && request()->route('section') === 'produits-locaux') ? 'active' : '' }}">
                        <a href="{{ route('local.products') }}">Produits locaux </a>
                    </li>
                    <li><a href="javascript:void(0)">CPF Lounge</a></li>
                    <li><a href="/#pack-section">Coffrets & Paniers</a></li>
                    <li class="{{ Route::is('contact') ? 'active' : '' }}"><a
                            href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
