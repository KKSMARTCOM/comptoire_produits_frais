@if (!empty($products) && count($products) > 0)
    @foreach ($products as $product)
        <div
            class="bg-white shadow-md rounded-xl text-center overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <!-- Image -->
            <div class="overflow-hidden">
                <a href="{{ route('productdetail', $product->slug) }}">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-60 object-contain hover:scale-105 transition-transform duration-300">
                </a>
            </div>

            <!-- Texte -->
            <div class="p-[1rem]">
                <h3 class="text-gray-700 text-sm font-semibold tracking-wide uppercase">
                    {{ strtoupper($product->category->name) }}
                </h3>
                <h2 class="mt-1 text-lg font-bold text-gray-900">
                    <a href="{{ route('productdetail', $product->slug) }}">
                        {{ ucfirst($product->name) }}
                    </a>
                </h2>
                <p class="mt-2 text-gray-900 font-semibold">
                    {{ $product->price }} FCFA
                </p>

                @php
                    $encrypt = encryptData($product->id);
                @endphp

                <!-- Boutons -->
                <div class="mt-4 flex items-center justify-center gap-3">
                    <form method="POST" action="{{ route('cartadd', $encrypt) }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $encrypt }}">
                        <button type="submit"
                            class="flex items-center justify-center w-10 h-10 rounded-full border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white transition">
                            <span class="mdi mdi-cart-plus text-xl"></span>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('cartadd', $encrypt) }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $encrypt }}">
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg hover:bg-blue-700 transition">
                            Passer commande
                        </button>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="w-full sm:w-1/2 lg:w-1/4 mb-6" data-aos="fade-up">
        </div> --}}
    @endforeach
@else
    <div class="w-full text-center py-8">
        <h3 class="text-lg font-semibold text-gray-600">Aucun produit disponible</h3>
    </div>
@endif
