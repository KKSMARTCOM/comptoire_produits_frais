@extends('frontend.layout.layout')

@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-12 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4">
                                <h2 class="text-black h5">NOS PRODUITS</h2>
                            </div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto"></div>
                                <div class="btn-group">
                                    <select class="form-control" id="orderList">
                                        <option class="dropdown-item" value="id-asc">Catégorie
                                        </option>
                                        <option class="dropdown-item" value="id-desc">Produit
                                        </option>
                                        <div class="dropdown-divider"></div>
                                        <option class="dropdown-item" value="price-asc">Prix</option>
                                    </select>
                                </div>
                                <div class="dropdown mr-1 ml-md-auto"></div>
                                <div class="btn-group">
                                    <select class="form-control" id="orderList">
                                        <option class="dropdown-item" value="id-asc">Produit
                                        </option>
                                        <option class="dropdown-item" value="id-desc">Catégorie
                                        </option>
                                        <div class="dropdown-divider"></div>
                                        <option class="dropdown-item" value="price-asc">Prix</option>
                                    </select>
                                </div>
                                <div class="dropdown mr-1 ml-md-auto"></div>
                                <div class="btn-group">
                                    <select class="form-control" id="orderList">
                                        <option class="dropdown-item" value="id-asc">Prix
                                        </option>
                                        <option class="dropdown-item" value="id-desc">Produit
                                        </option>
                                        <div class="dropdown-divider"></div>
                                        <option class="dropdown-item" value="price-asc">catégorie</option>
                                    </select>
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


                    <div class="row mb-5 productContent">

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
                        <div class="row justify-content-center text-center mb-5">
                            <div class="col-md-7 site-section-heading pt-4">
                                <h2>Catégories</h2>
                            </div>
                        </div>
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
                                                <img src="{{ asset(/* $category->image */'images/shoe_1.jpg') }}" alt="" class="img-fluid">
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

{{-- @section('customjs')
    <script>
        var maxPrice = "{{ $maxPrice }}";
        var defaultMinPrice = "{{ request()->min ?? 0 }}"; // varsa minprice yoksa 0
        var defaultMaxPrice = "{{ request()->max ?? $maxPrice }}";

        var url = new URL(window.location.href); //baseURL alır - düzenlenebilir hala getirir
        $(document).on('click', '.filterBtn', function(e) {
            filter();
        });

        function filter() {
            let colorList = $(".colorList:checked").map((_, chk) => chk.value).get();
            let sizeList = $(".sizeList:checked").map((_, chk) => chk.value).get();

            if (colorList.length > 0) {
                url.searchParams.set("color", colorList.join(","));
            } else {
                url.searchParams.delete("color");
            }

            if (sizeList.length > 0) {
                url.searchParams.set("size", sizeList.join(","));
            } else {
                url.searchParams.delete("size");
            }

            var price = $('#priceBetween').val().split('-');
            url.searchParams.set("min", price[0])

            url.searchParams.set("max", price[1])

            newUrl = url.href;
            window.history.pushState({}, '', newUrl);
            // location.reload(); // sayfayı refresh etme

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: newUrl,
                success: function(response) {

                    $('.productContent').html(response.data);
                    $('.paginateButtons').html(response.paginate)
                }
            });
        }

        $(document).on('change', '#orderList', function(e) {
            var order = $(this).val();

            if (order != '') {
                orderby = order.split('-');
                url.searchParams.set("order", orderby[0])
                url.searchParams.set("sort", orderby[1])
            } else {
                url.searchParams.delete('order');
                url.searchParams.delete('sort');
            }

            filter();
        });

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
                    $('.count').text(response.sepetCount);
                }
            });
        })
    </script>
@endsection --}}
