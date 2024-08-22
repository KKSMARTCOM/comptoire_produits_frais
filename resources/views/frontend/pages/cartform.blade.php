@extends('frontend.layout.layout')

@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">

            </div>
            <form method="POST" action="{{ route('cart.save') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Détail de livraison</h2>
                        <div class="p-3 p-lg-5 border">
                            <div class="form-group">
                                <label for="c_country" class="text-black">Pays <span class="text-danger">*</span></label>
                                <select id="c_country" name="country" class="form-control">
                                    <option value="">Veuillez choisir un pays</option>
                                    <option value="Turkey" selected>Türkiye</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Nom Prénom<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_companyname" class="text-black">Nom d'entreprise </label>
                                    <input type="text" class="form-control" id="c_companyname" name="company_name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Adresse <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_address" name="address"
                                        placeholder="Adresse de la ville">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_state_country" class="text-black">Ville<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_state_country" name="city">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_state_country" class="text-black">Quartier<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_state_country" name="district">
                                </div>
                                <div class="col-md-12">
                                    <label for="c_postal_zip" class="text-black">Code postal <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_postal_zip" name="zip_code">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label for="c_email_address" class="text-black">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_email_address" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_phone" class="text-black">Téléphone <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_phone" name="phone"
                                        placeholder="Numéro de téléphone">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="c_order_notes" class="text-black">Note</label>
                                <textarea name="note" id="c_order_notes" cols="30" rows="5" class="form-control"
                                    placeholder="Ecrivez votre note ici..."></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Code coupon</h2>
                                <div class="p-3 p-lg-5 border">

                                    <label for="c_code" class="text-black mb-3">Veuillez entrer le code de votre coupon
                                        si vous en avez</label>
                                    <div class="input-group w-75">
                                        <input type="text" class="form-control" id="c_code"
                                            placeholder="Coupon Code" value="{{ session()->get('couponCode') ?? '' }}"
                                            aria-label="Coupon Code" aria-describedby="button-addon2" readonly>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Votre commande</h2>
                                <div class="p-3 p-lg-5 border">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <th>Produit</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>

                                            @if (session()->get('cart'))
                                                @foreach (session()->get('cart') as $key => $cart)
                                                    @php
                                                        $kdvOrani = $cart['kdv'] ?? 0;
                                                        $price = $cart['product']['price'];
                                                        $qty = $cart['quantity'];

                                                        $kdvTutar = $price * $qty * ($kdvOrani / 100);
                                                        $toplamTutar = $price * $qty + $kdvTutar;
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $cart['product']['name'] }} <strong
                                                                class="mx-2">x</strong>
                                                            {{ $cart['quantity'] }}</td>
                                                        <td>$ {{ $toplamTutar }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Prix du coupon</strong>
                                                </td>
                                                <td class="text-black font-weight-bold"><strong>$
                                                        {{ session()->get('couponPrice') ?? 0 }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Total de la
                                                        commande</strong></td>
                                                <td class="text-black font-weight-bold"><strong>$
                                                        {{ array_sum(array_column(session()->get('cart'), 'total')) ?? 0 }}</strong>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    {{-- <div class="border p-3 mb-3">
                                        <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse"
                                                href="#collapsebank" role="button" aria-expanded="false"
                                                aria-controls="collapsebank">Direct Bank
                                                Transfer</a></h3>

                                        <div class="collapse" id="collapsebank">
                                            <div class="py-2">
                                                <p class="mb-0">Make your payment directly into our bank account. Please
                                                    use
                                                    your Order ID as the payment reference. Your order won’t be shipped
                                                    until
                                                    the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border p-3 mb-3">
                                        <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse"
                                                href="#collapsecheque" role="button" aria-expanded="false"
                                                aria-controls="collapsecheque">Cheque
                                                Payment</a></h3>

                                        <div class="collapse" id="collapsecheque">
                                            <div class="py-2">
                                                <p class="mb-0">Make your payment directly into our bank account. Please
                                                    use
                                                    your Order ID as the payment reference. Your order won’t be shipped
                                                    until
                                                    the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border p-3 mb-5">
                                        <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse"
                                                href="#collapsepaypal" role="button" aria-expanded="false"
                                                aria-controls="collapsepaypal">Paypal</a></h3>

                                        <div class="collapse" id="collapsepaypal">
                                            <div class="py-2">
                                                <p class="mb-0">Make your payment directly into our bank account. Please
                                                    use
                                                    your Order ID as the payment reference. Your order won’t be shipped
                                                    until
                                                    the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-lg py-3 btn-block">Commander</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <!-- </form> -->
        </div>
    </div>
@endsection
