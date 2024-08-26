@extends('frontend.layout.layout')

@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 order-2">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="d-flex gap-2">
                                <div class="dropdown mr-1 ml-md-auto"></div>
                                <div class="btn-group">
                                    <select class="form-control bordered-select border-0" id="orderList">
                                        <option class="dropdown-item" value="id-desc">Catégories
                                        </option>
                                        <option class="dropdown-item" value="id-desc">Volailles
                                        </option>
                                        <option class="dropdown-item" value="id-desc">Poissons
                                        </option>
                                        <option class="dropdown-item" value="id-desc">Fruits & légumes
                                        </option>
                                        <option class="dropdown-item" value="id-desc">Cave
                                        </option>
                                        <option class="dropdown-item" value="id-desc">Autres viandes
                                        </option>
                                        <option class="dropdown-item" value="id-desc">CPF Store
                                        </option>
                                    </select>
                                    <span class="mdi mdi-chevron-down select-arrow"></span>
                                </div>
                                <div class="dropdown mr-1 ml-md-auto"></div>
                                <div class="btn-group">
                                    <select class="form-control bordered-select border-0" id="orderList">
                                        <option class="dropdown-item" value="id-asc">Produits
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Poulet Fermier
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Dinde Bio
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Canard à l'Orange
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Saumon Fumé
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Cabillaud Frais
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Sardines à l'Huile
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Pommes Bio
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Carottes Fraîches
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Tomates Cerises
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Vin Rouge Bordeaux
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Champagne Brut
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Whisky Écossais
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Huile d'Olive Extra Vierge
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Miel de Montagne
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Café Arabica
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Bœuf Wagyu
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Agneau Bio
                                        </option>
                                        <option class="dropdown-item" value="id-asc">Porc Fermier
                                    </select>
                                    <span class="mdi mdi-chevron-down select-arrow"></span>
                                </div>
                                <div class="dropdown mr-1 ml-md-auto"></div>
                                <div class="btn-group">
                                    <select class="form-control bordered-select border-0" id="orderList">
                                        <option class="dropdown-item" value="price-asc">Prix
                                        </option>
                                        <option class="dropdown-item" value="id-asc">9.000 - 12.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">18.000 - 22.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">15.000 - 20.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">12.000 - 15.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">10.000 - 12.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">4.000 - 6.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">2.500 - 4.000 FCFA/kg
                                        </option>
                                        <option class="dropdown-item" value="id-asc">1.500 - 2.500 FCFA/kg
                                        </option>
                                        <option class="dropdown-item" value="id-asc">2.000 - 3.000 FCFA/kg
                                        </option>
                                        <option class="dropdown-item" value="id-asc">15.000 - 20.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">30.000 - 35.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">25.000 - 30.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">9.000 - 12.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">7.000 - 10.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">6.000 - 8.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">30.000 - 40.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">20.000 - 25.000 FCFA
                                        </option>
                                        <option class="dropdown-item" value="id-asc">12.000 - 15.000 FCFA
                                    </select>
                                    <span class="mdi mdi-chevron-down select-arrow"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            @if (session()->get('success'))
                                <div class="alert alert-success">{{ session()->get('success') }}</div>
                            @endif
                        </div>
                    </div>


                    <div class="row mb-3 productContent">

                        @include('frontend.ajax.productList')

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
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade"
                                        data-aos-delay="">
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
