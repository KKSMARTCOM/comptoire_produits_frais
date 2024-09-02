@if (!empty($products) && count($products) > 0)
    @foreach ($products as $product)
        <div class="col-sm-6 col-lg-3 mb-4 aos-init aos-animate" data-aos="fade-up">
            <div class="block-4 text-center">
                <div class="block-4-image">
                    <a class="block-4-image-content" href={{ route('productdetail', $product['id']) }}><img
                            src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}"></a>
                </div>
                <div class="block-4-text p-4">
                    <h3 class="text-dark">{{ strtoupper($product['category']) }}</h3>
                    <h2><a href={{ route('productdetail', $product['id']) }}
                            class="text-dark font-weight-bold">{{ ucfirst($product['name']) }}</a></h2>
                    <p class="text-dark font-weight-bold">
                        {{ $product['price'] }} FCFA</p>
                    @php
                        $encrypt = encryptData($product['id']);
                    @endphp
                    <div class="d-flex gap-2 justify-content-center align-items-center">
                        <form id="addForm" method="POST" action="{{ route('cartadd', $encrypt) }}">
                            @csrf
                            <input type="hidden" name="product_id" value={{ $encrypt }}>
                            <p>
                                <button type="submit" id="panier" class="buy-now btn border-1 border-black">
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
    <div class="row text-center">
        <h3>Aucun produit disponible</h3>
    </div>
@endif
