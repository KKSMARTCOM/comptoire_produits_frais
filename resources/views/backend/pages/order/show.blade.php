@extends('backend.layout.app')

@section('customcss')
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
            font-family: system-ui;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #d3d3d3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        .center {
            text-align: center;
        }

        h2 {
            font-size: 36px;
            font-weight: 500;
        }

        .header-img {
            width: 100px;
            height: 100px;
        }

        .invoice {
            display: flex;
            justify-content: space-between;
        }

        .invoice-header {
            font-size: 24px;
        }

        .font-size-14 {
            font-size: 14px;
            line-height: 10px;
        }

        .bold-text {
            font-weight: 800;
        }

        table.unstyledTable {
            width: 100%;
            margin-top: 30px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0 5px;
            table-layout: fixed;
        }

        thead tr th {
            border-bottom: 2px solid #DCDCDC;
            font-weight: 800;
        }

        tbody tr {
            border-bottom: 1px solid #DCDCDC;
            text-align: start;
        }

        tbody tr td {
            padding: 8px;
        }

        .last-row {
            border: 0;
        }

        .footer {
            text-align: end;
        }

        .font-weight-400 {
            font-weight: 400;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <h4 class="card-title">Commande</h4>
                    <button class="btn btn-success" style="background-color: #004200;">Exporter</button>
                    @if ($errors)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>

                <div class="page">
                    <div class="subpage">
                        <div class="header center"><img class="header-img"
                                src="{{ asset('backend/images/KKSMARTDESIGN_CPF_LOGO_prop9.svg') }}" />
                            <h2 class="font-weight-400">{{ $order->Fullname ?? '' }}</h2>
                        </div>

                        <div class="invoice">
                            <div class="invoce-from">
                                <p class="invoice-header">Commande</p>
                                <div class="font-size-14">
                                    <p>No : {{ $order->order_no ?? '' }}</p>
                                </div>
                            </div>
                            <div class="font-size-14">
                                <p class="bold-text">Date de la commande :
                                    {{ isset($order->created_at) ? Carbon::parse($order->created_at)->format('d.m.Y H:i') : '' }}
                                </p>
                                <p>Date de confirmation :
                                    {{ isset($order->updated_at) ? Carbon::parse($order->updated_at)->format('d.m.Y H:i') : '' }}
                                </p>
                            </div>
                        </div>
                        <div class="invoice">
                            <div class="invoce-from">
                                <div class="font-size-14">
                                </div>
                            </div>
                            <div class="font-size-14">
                                <p>{{ $order->phone }}</p>
                                <p>{{ $order->address }}</p>
                                {{-- <p> {{ $order->email }} </p> --}}
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <h2 class="center font-weight-400">Détail de la commande</h2>
                        <p class="font-size-14">{{ $order->company_name ?? '' }}</p>
                        <p class="font-size-14">{{ $order->country ?? 'Bénin' }}</p>
                        <p class="font-size-14">{{ $order->city }}</p>
                        <p class="font-size-14">{{ $order->district }}</p>
                        <p class="font-size-14">{{ $order->note ?? 'Pas de note' }}
                        </p>

                        <table class="unstyledTable">
                            <thead>
                                <tr>
                                    <th>Produits</th>
                                    <th>Quantité</th>
                                    <th>Prix U</th>
                                    {{--  <th>Rate of VAT</th> --}}
                                    <th>Prix total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $allTotal = 0;
                                @endphp
                                @if (!empty($order->orderItems))
                                    @foreach ($order->orderItems as $item)
                                        @php
                                            $vatRate = $item['vat'] ?? 0;
                                            $price = $item['price'];
                                            $qty = $item['quantity'];

                                            $vatAmount = $price * $qty * ($vatRate / 100);
                                            $totalAmount = $price * $qty + $vatAmount;
                                        @endphp
                                        <tr data-id="{{ $item['product_id'] }}">
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>{{ $item['price'] }}</td>
                                            {{-- <td>{{ $item['kdv'] }}</td> --}}
                                            <td class="total">{{ $totalAmount }} FCFA</td>
                                            @php
                                                $allTotal += $totalAmount;
                                            @endphp
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>Vin</td>
                                        <td>2</td>
                                        <td>15000 FCFA</td>
                                        <td>30000 FCFA</td>
                                    </tr>
                                @endif
                            </tbody>
                            </tr>
                        </table>

                        <div class="footer">
                            <h2 class="font-weight-400 allTotal">Total : {{ $allTotal ?? '10000' }} FCFA
                                <h2 />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
