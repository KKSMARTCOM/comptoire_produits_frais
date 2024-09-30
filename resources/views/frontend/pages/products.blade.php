@extends('frontend.layout.layout')

@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 order-2">
                    <form id="filterForm" action="">
                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <div class="d-block d-md-flex flex-wrap align-items-start gap-4">
                                    {{-- Categories --}}
                                    <div class="filterOption mt-3 mt-lg-0">
                                        <select class="form-select border-0" name="category" id="category">
                                            <option class="dropdown-item" value="">Tous
                                            </option>
                                            @if ($categories && $categories->count() > 0)
                                                @foreach ($categories as $item)
                                                    <option class="dropdown-item"
                                                        {{ isset($category) && $category->slug == $item->slug ? 'selected' : '' }}
                                                        value="{{ $item->slug }}">{{ $item->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option class="dropdown-item" value="volailles">Volailles
                                                </option>
                                                <option class="dropdown-item" value="poissons">Poissons
                                                </option>
                                                <option class="dropdown-item" value="autres viandes">Autres viandes
                                                </option>
                                                <option class="dropdown-item" value="fruits/legumes">Fruits & légumes
                                                </option>
                                                <option class="dropdown-item" value="la cave">La cave
                                                </option>
                                                <option class="dropdown-item" value="cpf store">CPF Store
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                    {{-- Prix --}}
                                    <div class="mt-3 mt-lg-0 p-2">
                                        <label for="price_range">Prix :</label>
                                        <span id="price_range_label">0 FCFA - 700000 FCFA</span>
                                        {{-- <div id="price_slider"></div> --}}
                                        <div class="d-flex gap-2 price_range mt-3">
                                            <div class="price_range_input">
                                                <label for="min_price">Min</label>
                                                <input type="number" id="min_price" name="min_price" value="0"
                                                    min="0" max="700000">
                                            </div>
                                            <div class="price_range_input">
                                                <label for="max_price">Max</label>
                                                <input type="number" id="max_price" name="max_price" value=""
                                                    placeholder="700000">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Sous-categories des vins --}}
                                    <div id="subcategories" style="visibility: hidden" class="d-flex gap-3">
                                        <!-- Filtre par type de vin -->
                                        <div class="filterOption mt-3 mt-lg-0">
                                            <select class="form-select border-0" id="wine_type">
                                                <option value="">Type de vin</option>
                                                @if ($types && $types->count() > 0)
                                                    @foreach ($types as $item)
                                                        <option class="dropdown-item" value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="vin rouge">Vin Rouge</option>
                                                    <option value="vin blanc">Vin Blanc</option>
                                                    <option value="vin rosé">Vin Rosé</option>
                                                    <option value="champagne">Champagne</option>
                                                @endif
                                            </select>
                                        </div>

                                        <!-- Filtre par région de vin -->
                                        <div class="filterOption mt-3 mt-lg-0">
                                            <select class="form-select border-0" id="wine_region">
                                                <option value="">Région</option>
                                                @if ($regions && $regions->count() > 0)
                                                    @foreach ($regions as $item)
                                                        <option class="dropdown-item" value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="Bordeaux">Bordeaux</option>
                                                    <option value="Champagne">Champagne</option>
                                                    <option value="Provence">Provence</option>
                                                    <option value="Bourgogne">Bourgogne</option>
                                                    <option value="Côtes du Rhône">Côtes du Rhône</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="filterOption mt-3 mt-lg-0">
                                        <select class="form-select border-0" id="sort" name="sort">
                                            <option class="dropdown-item" value="">Trier par
                                            </option>
                                            <option class="dropdown-item" value="price_asc">Prix croissant
                                            </option>
                                            <option class="dropdown-item" value="price_desc">Prix décroissant
                                            </option>
                                            <option class="dropdown-item" value="alpha_asc">Alphabétique de A à Z
                                            </option>
                                            <option class="dropdown-item" value="alpha_desc">Alphabétique de Z à A
                                            </option>
                                            <option class="dropdown-item" value="promotion">En promotion
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-lg-12">
                            @if (session()->get('success'))
                                <div class="alert alert-success">{{ session()->get('success') }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Zone où seront affichés les filtres appliqués -->
                    <div id="activeFilters" class="">
                        <ul id="filtersList" class="list-unstyled">
                            <!-- Les filtres appliqués seront ajoutés ici -->
                        </ul>
                    </div>


                    <div class="row mb-3 productContent" id="productList">

                        @include('frontend.ajax.productList', ['products' => $products])

                    </div>

                    {{-- "withQueryString()" tüm sayfalarda mevcut filtrelemeyi kullanmak için  --}}
                    <div class="row paginateButtons" data-aos="fade-up">
                        {{-- {{ $products->withQueryString()->links('vendor.pagination.custom') }} --}}
                        {{-- <div class="col-md-12 text-center">
                            <div class="site-block-27">
                                <ul>
                                    <li><a href="#">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&gt;</a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('customjs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const minPriceInput = document.getElementById('min_price');
            const maxPriceInput = document.getElementById('max_price');
            const priceSlider = document.getElementById('price_slider');
            const category = document.getElementById('category');
            const subcategoriesDiv = document.getElementById('subcategories');
            let priceRangeLabel = document.getElementById('price_range_label');
            var filtersList = document.getElementById('filtersList');


            $(document).on('change', '#filterForm', function(event) {
                //console.log(event.target.value)
                fetchProduct()
                updateFilters(event.target.value);
            })

            if (category.value == 'la-cave') {
                subcategoriesDiv.style.visibility = 'visible'; // Afficher sous-catégories
            } else {
                subcategoriesDiv.style.visibility = 'hidden'; // Masquer sous-catégories
            }

            category.addEventListener('change', function() {
                if (this.value === 'la-cave') {
                    subcategoriesDiv.style.visibility = 'visible'; // Afficher sous-catégories
                } else {
                    subcategoriesDiv.style.visibility = 'hidden'; // Masquer sous-catégories
                }
            })

            minPriceInput.addEventListener('input', function() {
                fetchProduct();
                priceRangeLabel.textContent = `${minPriceInput.value} FCFA - ${maxPriceInput.value} FCFA`

            });
            maxPriceInput.addEventListener('input', function() {
                fetchProduct();
                priceRangeLabel.textContent = `${minPriceInput.value} FCFA - ${maxPriceInput.value} FCFA`
            });

            // Fonction pour mettre à jour les filtres affichés
            function updateFilters(type) {
                let filterItem;
                let filterText;

                if (type === 'category') {
                    filterText = $('#category option:selected').text();
                    filterItem =
                        `<li id="filter_category">${filterText} <button class="btn btn-sm btn-danger" onclick="removeFilter('category')">X</button></li>`;
                    disableOption('category', $('#category').val());
                } else if (type === 'sort') {
                    filterText = $('#sort option:selected').text();
                    filterItem =
                        `<li id="filter_sort">${filterText} <button class="btn btn-sm btn-danger" onclick="removeFilter('sort')">X</button></li>`;
                    disableOption('sort', $('#sort').val());
                }

                // Mettre à jour la liste des filtres affichés
                $('#filtersList').append(filterItem);
            }

            // Fonction pour supprimer un filtre
            window.removeFilter = function(type) {
                if (type === 'category') {
                    $('#category').val('');
                    $('#filtersList').find('#filter_category').remove();
                } else if (type === 'sort') {
                    $('#sort').val('');
                    $('#filtersList').find('#filter_sort').remove();
                }
                fetchProducts();
            }

            function fetchProduct() {
                let slug = $('#category').val() ? $('#category').val() : ''; // slug de la catégorie courante
                let minPrice = $('#min_price').val();
                let maxPrice = $('#max_price').val();
                let wineType = $('#wine_type').val();
                let wineRegion = $('#wine_region').val();
                let sort = $('#sort').val();

                //console.log(winType, winRegion);

                let newUrl = slug !== '' ? '/categorie/' + slug : '/categorie/';

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        wineType: wineType,
                        wineRegion: wineRegion,
                        sort: sort,
                        minPrice: minPrice,
                        maxPrice: maxPrice
                    },
                    url: newUrl,
                    success: function(response) {
                        console.log(response)
                        $('.productContent').html(response.products);
                        // Si besoin, mettre à jour la pagination ici
                        // $('.paginateButtons').html(response.paginate);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        })

        $(document).on('submit', '#addForm', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('cartadd') }}",
                data: formData,
                success: function(response) {
                    toastr.success(response.message);
                    $('.count').text(response.productNumber);
                }
            });
        })

        $(document).on('submit', '#addOpenCartForm', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('cartadd') }}",
                data: formData,
                success: function(response) {
                    toastr.success(response.message);
                    $('.count').text(response.productNumber);
                    window.location.href = "{{ route('cart') }}";
                }
            });
        })
    </script>
@endsection
