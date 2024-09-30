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
                                <select id="c_country" name="country" class="form-control" disabled>
                                    <option value="">Veuillez choisir un pays</option>
                                    <option value="Bénin" selected>Bénin</option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Nom<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="lastname"
                                        value="{{ old('lastname') }}">
                                </div>
                                @error('lastname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Prénom<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="firstname"
                                        value="{{ old('lastname') }}">
                                </div>
                                @error('firstname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_companyname" class="text-black">Nom d'entreprise (facultatif) </label>
                                    <input type="text" class="form-control" id="c_companyname" name="company_name"
                                        value="{{ old('company_name') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Adresse (Indication précise) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_address" name="address"
                                        value="{{ old('address') }}" placeholder="Adresse de la ville">
                                </div>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_state_country" class="text-black">Ville<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_state_country" name="city"
                                        value="{{ old('city') }}">
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="c_state_country" class="text-black">Quartier<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_state_country" name="district"
                                        value="{{ old('district') }}">
                                    @error('district')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-12">
                                    <label for="c_postal_zip" class="text-black">Code postal <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_postal_zip" name="zip_code">
                                </div> --}}
                            </div>

                            <div class="form-group row mb-4">
                                {{-- <div class="col-md-6">
                                    <label for="c_email_address" class="text-black">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_email_address" name="email">
                                </div> --}}
                                <div class="col-md-12">
                                    <label for="c_phone" class="text-black">Téléphone <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_phone" name="phone"
                                        placeholder="Numéro de téléphone" value="{{ old('phone') }}">
                                </div>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="c_order_notes" class="text-black">Note</label>
                                <textarea name="note" id="c_order_notes" cols="30" rows="5" class="form-control"
                                    placeholder="Ecrivez votre note ici..." value="{{ old('note') }}"></textarea>
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
                                                        <td>{{ ucfirst($cart['product']['name']) }} <strong
                                                                class="mx-2">x</strong>
                                                            {{ $cart['quantity'] }}</td>
                                                        <td>{{ $toplamTutar }} FCFA</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Prix du coupon</strong>
                                                </td>
                                                <td class="text-black font-weight-bold">
                                                    <strong>{{ session()->get('couponPrice') ?? 0 }} FCFA</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Total de la
                                                        commande</strong></td>
                                                <td class="text-black font-weight-bold"><strong>
                                                        {{ array_sum(array_column(session()->get('cart'), 'total')) ?? 0 }}
                                                        FCFA</strong>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg py-3 border-0">Commander</button>
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
