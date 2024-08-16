@if (!empty($products) && count($products) > 0)
    @foreach ($products as $product)
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image p-1">
                    <a href=""><img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}"
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">{{ strtoupper($product['category']) }}</a></h3>
                    <p class="mb-0">{{ ucfirst($product['name']) }}</p>
                    <p class="text-primary font-weight-bold">
                        {{ $product['price'] }}.00 FCFA</p>

                    @php
                        $encrypt = encryptData($product['id']);
                    @endphp

                    {{-- {{ sifrelecoz($sifrele) }} --}}

                    <form id="addForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value={{ $encrypt }}>
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
    @endforeach
@else
    {{-- A enlever --}}
    <div class="row">
        <!-- Premier bloc image un-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                    <a href=""><img src="{{ asset('images/Sardines.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Poissons</a></h3>
                    <p class="mb-0">Sardine</p>
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
                    <a href=""><img src="{{ asset('images/Cabillaud.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Poissons</a></h3>
                    <p class="mb-0">Cabillaud</p>
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
                    <a href=""><img src="{{ asset('images/Saumon.jpg') }}" alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Poissons</a></h3>
                    <p class="mb-0">Saumon</p>
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
                    <a href=""><img src="{{ asset('images/canard.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Volailles</a></h3>
                    <p class="mb-0">Canard</p>
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
                    <a href=""><img src="{{ asset('images/dinde.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Volailles</a></h3>
                    <p class="mb-0">Dinde</p>
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
                    <a href=""><img src="{{ asset('images/poulet.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Volailles</a></h3>
                    <p class="mb-0">Poulet</p>
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
                    <a href=""><img src="{{ asset('images/pomme.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Fruits & Légumes</a></h3>
                    <p class="mb-0">Pomme de terre bio</p>
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
                    <a href=""><img src="{{ asset('images/carotte.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Fruits & Légumes</a></h3>
                    <p class="mb-0">Carottes fraîches</p>
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
                    <a href=""><img src="{{ asset('images/tomate.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Fruits & Légumes</a></h3>
                    <p class="mb-0">Tomates Cerises</p>
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
                    <a href=""><img src="{{ asset('images/bordeau.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Vins</a></h3>
                    <p class="mb-0">Vin Rouge Bordeaux</p>
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
                    <a href=""><img src="{{ asset('images/champagne.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Vins</a></h3>
                    <p class="mb-0">Champagne Brut</p>
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
                    <a href=""><img src="{{ asset('images/whisky.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Vins</a></h3>
                    <p class="mb-0">Whisky Écossais</p>
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
                    <a href=""><img src="{{ asset('images/huileolive.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">CPF Store</a></h3>
                    <p class="mb-0">Huile d'Olive Extra Vierge</p>
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
                    <a href=""><img src="{{ asset('images/miel.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">CPF Store</a></h3>
                    <p class="mb-0">Miel de Montagne</p>
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
                    <a href=""><img src="{{ asset('images/cafee.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">CPF Store</a></h3>
                    <p class="mb-0">Café Arabica</p>
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
                    <a href=""><img src="{{ asset('images/boeuf.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Autres Viandes</a></h3>
                    <p class="mb-0">Bœuf Wagyu</p>
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
                    <a href=""><img src="{{ asset('images/porc.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Autres Viandes</a></h3>
                    <p class="mb-0">Porc Fermier</p>
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
