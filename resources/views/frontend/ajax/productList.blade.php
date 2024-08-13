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
                                <span class="icon icon-shopping_cart"></span>
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
                <a href=""><img src="{{ asset('images/volaille1.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Volaille</a></h3>
                    <p class="mb-0">Viande de pintade</p>
                    <p class="text-primary font-weight-bold">
                        $ 100</p>

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
                                <span class="icon icon-shopping_cart"></span>
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
                <a href=""><img src="{{ asset('images/ruminant1.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Ruminant</a></h3>
                    <p class="mb-0">Viande de boeuf</p>
                    <p class="text-primary font-weight-bold">
                        $ 100</p>

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
                                <span class="icon icon-shopping_cart"></span>
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
                <a href=""><img src="{{ asset('images/poisson1.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Poisson</a></h3>
                    <p class="mb-0">Poisson sardine</p>
                    <p class="text-primary font-weight-bold">
                        $ 100</p>

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
                                <span class="icon icon-shopping_cart"></span>
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
                <a href=""><img src="{{ asset('images/fruitsdemer1.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Fruit de mer</a></h3>
                    <p class="mb-0">crevette frais</p>
                    <p class="text-primary font-weight-bold">
                        $ 100</p>

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
                                <span class="icon icon-shopping_cart"></span>
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
                <a href=""><img src="{{ asset('images/fruitsdemer1.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Fruit de mer</a></h3>
                    <p class="mb-0">crevette frais</p>
                    <p class="text-primary font-weight-bold">
                        $ 100</p>

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
                                <span class="icon icon-shopping_cart"></span>
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
                <a href=""><img src="{{ asset('images/men.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Viande</a></h3>
                    <p class="mb-0">Bonne viande</p>
                    <p class="text-primary font-weight-bold">
                        $ 100</p>

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
                                <span class="icon icon-shopping_cart"></span>
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
                <a href=""><img src="{{ asset('images/men.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Viande</a></h3>
                    <p class="mb-0">Bonne viande</p>
                    <p class="text-primary font-weight-bold">
                        $ 100</p>

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
                                <span class="icon icon-shopping_cart"></span>
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
                <a href=""><img src="{{ asset('images/men.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Viande</a></h3>
                    <p class="mb-0">Bonne viande</p>
                    <p class="text-primary font-weight-bold">
                        $ 100</p>

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
                                <span class="icon icon-shopping_cart"></span>
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
                <a href=""><img src="{{ asset('images/men.jpg') }}"
                alt="" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Viande</a></h3>
                    <p class="mb-0">Bonne viande</p>
                    <p class="text-primary font-weight-bold">
                        $ 100</p>

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
                                <span class="icon icon-shopping_cart"></span>
                            </button>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Passer commande</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>



    </div>

@endif

