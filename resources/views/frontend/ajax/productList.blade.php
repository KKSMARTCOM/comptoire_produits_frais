@if (!empty($products) && count($products) > 0)
    @foreach ($products as $product)
        <!-- Modal de validation de commande -->
        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Valider la commande</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="orderForm" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" id="modalProductId">
                            <div class="mb-3">
                                <label for="name" class="form-label text-dark">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label text-dark">Adresse</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-dark">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label text-dark">Numéro de téléphone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" form="orderForm" class="btn btn-primary">Valider commande</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center">
                <div class="block-4-image p-1">
                    <a href={{ route('productdetail', $product['id']) }}><img
                            src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}"></a>
                </div>
                <div class="block-4-text p-4">
                    <h3 class="text-dark">{{ strtoupper($product['category']) }}</h3>
                    <h2><a href={{ route('productdetail', $product['id']) }}
                            class="text-dark font-weight-bold">{{ ucfirst($product['name']) }}</a></h2>
                    <p class="text-dark font-weight-bold">
                        {{ $product['price'] }}.00 FCFA</p>
                    @php
                        $encrypt = encryptData($product['id']);
                    @endphp
                    <div class="d-flex gap-2 justify-content-center align-items-center">
                        <form id="addForm" method="POST" action="{{ route('cartadd', $encrypt) }}">
                            @csrf
                            <input type="hidden" name="product_id" value={{ $encrypt }}>
                            <p>
                                <button type="submit" id="panier" class="buy-now btn">
                                    <span class="mdi mdi-cart-plus"></span>
                                </button>
                            </p>
                        </form>
                        <form id="add&OpenCartForm" method="POST" action="{{ route('cartadd', $encrypt) }}">
                            @csrf
                            <input type="hidden" name="product_id" value={{ $encrypt }}>
                            <p>
                                <button type="submit"
                                    class="buy-now btn btn-sm btn-primary showOrderForm border-0">Passer commande
                                </button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <!-- Modal de validation de commande -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Valider la commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="orderForm" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" id="modalProductId">
                        <div class="mb-3">
                            <label for="name" class="form-label text-dark">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label text-dark">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text-dark">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label text-dark">Numéro de téléphone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" form="orderForm" class="btn btn-primary">Valider commande</button>
                </div>
            </div>
        </div>
    </div>

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
                    <p class="text-primary font-weight-bold">Sardine</p>
                    <p class="text-primary font-weight-bold">6.000 FCFA</p>
                    <p>
                        <button type="submit" id="panier" class="buy-now btn">
                            <span class="mdi mdi-cart-plus"></span>
                        </button>
                        <button type="button" class="buy-now btn btn-sm btn-primary showOrderForm"
                            data-toggle="modal" data-target="#orderModal" data-product-id="1">Passer commande
                        </button>
                    </p>
                </div>
            </div>
        </div>

        <!-- Premier bloc image trois-->
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                    <a href=""><img src="{{ asset('images/Saumon.jpg') }}" alt=""
                            class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="#">Poissons</a></h3>
                    <p class="text-primary font-weight-bold">Saumon</p>
                    <p class="text-primary font-weight-bold">12.000 FCFA</p>
                    <p>
                        <button type="submit" id="panier" class="buy-now btn">
                            <span class="mdi mdi-cart-plus"></span>
                        </button>
                        <button type="button" class="buy-now btn btn-sm btn-primary showOrderForm"
                            data-toggle="modal" data-target="#orderModal" data-product-id="3">Passer
                            commande
                        </button>
                    </p>
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
                    <p class="text-primary font-weight-bold">Canard</p>
                    <p class="text-primary font-weight-bold">15.000 FCFA</p>
                    <p>
                        <button type="submit" id="panier" class="buy-now btn">
                            <span class="mdi mdi-cart-plus"></span>
                        </button>
                        <button type="button" class="buy-now btn btn-sm btn-primary showOrderForm"
                            data-toggle="modal" data-target="#orderModal" data-product-id="4">Passer
                            commande
                        </button>
                    </p>
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
                    <p class="text-primary font-weight-bold">Dinde</p>
                    <p class="text-primary font-weight-bold">18.000 FCFA</p>
                    <p>
                        <button type="submit" id="panier" class="buy-now btn">
                            <span class="mdi mdi-cart-plus"></span>
                        </button>
                        <button type="button" class="buy-now btn btn-sm btn-primary showOrderForm"
                            data-toggle="modal" data-target="#orderModal" data-product-id="5">Passer
                            commande
                        </button>
                    </p>
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
                    <p class="text-primary font-weight-bold">Poulet</p>
                    <p class="text-primary font-weight-bold">9.000 FCFA</p>
                    <p>
                        <button type="submit" id="panier" class="buy-now btn">
                            <span class="mdi mdi-cart-plus"></span>
                        </button>
                        <button type="button" class="buy-now btn btn-sm btn-primary showOrderForm"
                            data-toggle="modal" data-target="#orderModal" data-product-id="6">Passer
                            commande
                        </button>
                    </p>
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
                    <p class="text-primary font-weight-bold">Pomme de terre bio</p>
                    <p class="text-primary font-weight-bold">4.000 FCFA</p>
                    <p>
                        <button type="submit" id="panier" class="buy-now btn">
                            <span class="mdi mdi-cart-plus"></span>
                        </button>
                        <button type="button" class="buy-now btn btn-sm btn-primary showOrderForm"
                            data-toggle="modal" data-target="#orderModal" data-product-id="7">Passer
                            commande
                        </button>
                    </p>
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
                    <p class="text-primary font-weight-bold">Carottes fraîches</p>
                    <p class="text-primary font-weight-bold">2.500 FCFA</p>
                    <p>
                        <button type="submit" id="panier" class="buy-now btn">
                            <span class="mdi mdi-cart-plus"></span>
                        </button>
                        <button type="button" class="buy-now btn btn-sm btn-primary showOrderForm"
                            data-toggle="modal" data-target="#orderModal" data-product-id="8">Passer
                            commande
                        </button>
                    </p>
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
                    <p class="text-primary font-weight-bold">Tomates Cerises</p>
                    <p class="text-primary font-weight-bold">1.000 FCFA</p>
                    <p>
                        <button type="submit" id="panier" class="buy-now btn">
                            <span class="mdi mdi-cart-plus"></span>
                        </button>
                        <button type="button" class="buy-now btn btn-sm btn-primary showOrderForm"
                            data-toggle="modal" data-target="#orderModal" data-product-id="9">Passer
                            commande
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
