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
                                <div class="d-block d-md-flex gap-4">
                                    <div class="position-relative filterOption mt-3 mt-lg-0">
                                        <select class="form-control border-0" name="category" id="category">
                                            <option class="dropdown-item" value="">Catégories
                                            </option>
                                            <option class="dropdown-item" value="volailles">Volailles
                                            </option>
                                            <option class="dropdown-item" value="poissons">Poissons
                                            </option>
                                            <option class="dropdown-item" value="autres viandes">Autres viandes
                                            </option>
                                            <option class="dropdown-item" value="fruits/legumes">Fruits & légumes
                                            </option>
                                            <option class="dropdown-item" value="cave">Cave
                                            </option>
                                            <option class="dropdown-item" value="cpf store">CPF Store
                                            </option>
                                        </select>
                                        <span class="position-absolute filterChevron mdi mdi-chevron-down"></span>
                                    </div>
                                    <div class="mt-3 mt-lg-0">
                                        <label for="price_range">Prix :</label>
                                        <span id="price_range_label">0 FCFA - 700000 FCFA</span>
                                        <div id="price_slider"></div>
                                        <input type="hidden" id="min_price" name="min_price" value="0">
                                        <input type="hidden" id="max_price" name="max_price" value="5000">
                                    </div>
                                    <div class="position-relative filterOption mt-3 mt-lg-0">
                                        <select class="form-control border-0" id="sort" name="sort">
                                            <option class="dropdown-item" value="">Trier par
                                            </option>
                                            <option class="dropdown-item" value="price_asc">Prix croissant
                                            </option>
                                            <option class="dropdown-item" value="price_desc">Prix décroissant
                                            </option>
                                            <option class="dropdown-item" value="promotion">En promotion
                                            </option>
                                        </select>
                                        <span class="position-absolute filterChevron mdi mdi-chevron-down"></span>
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
                    <div id="activeFilters" class="mb-4">
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

            <div class="row">
                <div class="col-md-12">
                    <div class="site-section site-blocks-2">

                        <div class="row">
                            @if (!empty($categories))
                                {{-- collect: dizi oluştur --}}
                                {{-- @php
                                    $allcategories = collect($categories);
                                @endphp --}}
                                {{-- @foreach ($allcategories->where('cat_ust', null) as $category) --}}
                                @foreach ($categories->where('cat_ust', null) as $category)
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                                        <a class="block-2-item" href="{{-- {{ route($category->slug . 'product') }} --}}">
                                            <figure class="image">
                                                <img src="{{ asset(/* $category->image */ 'images/shoe_1.jpg') }}"
                                                    alt="" class="img-fluid">
                                            </figure>
                                            <div class="text">
                                                <span class="text-uppercase">Collections</span>
                                                <h3>{{ $category->name }}</h3>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                        </div>

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
            const priceRangeLabel = document.getElementById('price_range_label');
            const priceSlider = document.getElementById('price_slider');
            var filtersList = document.getElementById('filtersList');

            // Initialisation du range slider avec noUiSlider
            noUiSlider.create(priceSlider, {
                start: [0, 700000],
                connect: true,
                range: {
                    'min': 0,
                    'max': 700000
                },
                step: 10,
                //tooltips: [true, true],
                format: {
                    to: function(value) {
                        return parseInt(value) + ' FCFA';
                    },
                    from: function(value) {
                        return Number(value.replace(' FCFA', ''))
                    }
                }
            });

            // Met à jour les inputs cachés avec les valeurs du slider
            priceSlider.noUiSlider.on('update', function(values, handle) {
                const minPrice = parseInt(values[0].replace(' FCFA', ''));
                const maxPrice = parseInt(values[1].replace(' FCFA', ''));

                minPriceInput.value = minPrice;
                maxPriceInput.value = maxPrice;

                // Met à jour l'affichage du label avec la plage de prix actuelle
                priceRangeLabel.textContent = minPrice + ' FCFA - ' + maxPrice + ' FCFA';

                // Appel de la fonction pour mettre à jour les produits
                fetchProduct()
            });


            $(document).on('change', '#filterForm', function(event) {
                //console.log(event.target.id)
                fetchProduct()
                updateFilters(event.target.id);
            })

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
                let category = $('#category').val();
                let minPrice = $('#min_price').val();
                let maxPrice = $('#max_price').val();
                let sort = $('#sort').val();


                let newUrl = "{{ route('product') }}?category=" + category + "&min_price=" + minPrice +
                    "&max_price=" +
                    maxPrice + "&sort=" + sort;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: newUrl,
                    success: function(response) {
                        //console.log(response.products)
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

        $(document).on('submit', '#add&OpenCartForm', function(e) {
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
