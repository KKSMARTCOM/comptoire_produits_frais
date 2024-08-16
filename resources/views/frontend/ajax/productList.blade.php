@if (!empty($products) && $products->count() > 0)
    @foreach ($products as $product)
        <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                    <a href="{{ route('productdetail', $product->slug) }}"><img src="{{ asset($product->image) }}"
                            alt="{{ $product->name }}" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="{{ route('productdetail', $product->slug) }}">{{ $product->name }}</a>
                    </h3>
                    <p class="mb-0">{{ $product->short_text }}</p>
                    <p class="text-primary font-weight-bold">
                        ${{ number_format($product->price, 0) }}</p>

                    @php
                        $sifrele = sifrele($product->id);
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value={{ $product->size }}>
                        <p>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@else


    <div class="row">
        <!-- Premier bloc image un-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/Sardines.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Poissons</a></h3>
                    <p class="text-primary font-weight-bold">Sardine</p>
                    <p class="text-primary font-weight-bold">
                        6.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Premier bloc image deux-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/Cabillaud.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Poissons</a></h3>
                    <p class="text-primary font-weight-bold">Cabillaud</p>
                    <p class="text-primary font-weight-bold">
                        10.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Premier bloc image trois-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/Saumon.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Poissons</a></h3>
                    <p class="text-primary font-weight-bold">Saumon</p>
                    <p class="text-primary font-weight-bold">
                        12.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Premier bloc image quatre-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/canard.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Volailles</a></h3>
                    <p class="text-primary font-weight-bold">Canard</p>
                    <p class="text-primary font-weight-bold">
                        15.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Premier bloc image cinq-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/dinde.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Volailles</a></h3>
                    <p class="text-primary font-weight-bold">Dinde</p>
                    <p class="text-primary font-weight-bold">
                        18.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <!-- Deuxième bloc image un-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/poulet.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Volailles</a></h3>
                    <p class="text-primary font-weight-bold">Poulet</p>
                    <p class="text-primary font-weight-bold">
                        9.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Deuxième bloc image deux-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/pomme.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Fruits & Légumes</a></h3>
                    <p class="text-primary font-weight-bold">Pomme de terre bio</p>
                    <p class="text-primary font-weight-bold">
                        4.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Deuxième bloc image trois-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/carotte.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Fruits & Légumes</a></h3>
                    <p class="text-primary font-weight-bold">Carottes fraîches</p>
                    <p class="text-primary font-weight-bold">
                        2.500 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Deuxième bloc image quatre-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/tomate.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Fruits & Légumes</a></h3>
                    <p class="text-primary font-weight-bold">Tomates Cerises</p>
                    <p class="text-primary font-weight-bold">
                        1.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <!-- Troisième bloc image un-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/bordeau.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Vins</a></h3>
                    <p class="text-primary font-weight-bold">Vin Rouge Bordeaux</p>
                    <p class="text-primary font-weight-bold">
                        20.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Troisième bloc image deux-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/champagne.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Vins</a></h3>
                    <p class="text-primary font-weight-bold">Champagne Brut</p>
                    <p class="text-primary font-weight-bold">
                        35.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Troisième bloc image trois-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/whisky.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Vins</a></h3>
                    <p class="text-primary font-weight-bold">Whisky Écossais</p>
                    <p class="text-primary font-weight-bold">
                        30.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Troisième bloc image quatre-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/huileolive.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">CPF Store</a></h3>
                    <p class="text-primary font-weight-bold">Huile d'Olive Extra Vierge</p>
                    <p class="text-primary font-weight-bold">
                        9.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quatrième bloc image un-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/miel.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">CPF Store</a></h3>
                    <p class="text-primary font-weight-bold">Miel de Montagne</p>
                    <p class="text-primary font-weight-bold">
                        7.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Quatrième bloc image deux-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/cafee.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">CPF Store</a></h3>
                    <p class="text-primary font-weight-bold">Café Arabica</p>
                    <p class="text-primary font-weight-bold">
                        6.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Quatrième bloc image trois-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/boeuf.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Autres Viandes</a></h3>
                    <p class="text-primary font-weight-bold">Bœuf Wagyu</p>
                    <p class="text-primary font-weight-bold">
                        30.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Quatrième bloc image quatre-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                <a href=""><img src="{{ asset('images/porc.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Autres Viandes</a></h3>
                    <p class="text-primary font-weight-bold">Porc Fermier</p>
                    <p class="text-primary font-weight-bold">
                        15.000 FCFA</p>

                    @php
                        $sifrele = sifrele('1');
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $sifrele }}>
                        <input type="hidden" name="size" value="1">
                        <p>
                            <button type="submit" id="panier" class="buy-now btn">
                                <span class="mdi mdi-cart-plus"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>



    </div>

@endif

