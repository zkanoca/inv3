@extends('layouts.app')

@section('content')
    @include('partials._search_form')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <h1>{{ $faturaHTML['ID'] }} numaralı fatura bilgileri</h1>
                    </div>
                    <div class="col-md-6 text-end">Fatura Tarihi ve Saati:
                        <b>{{ DateTime::createFromFormat('Y-m-d\TH:i:s.u', $faturaHTML['CDATE'])->format('d.m.Y H:i:s') }}</b>
                    </div>
                </div>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Malzeme/Hizmet Açıklaması</th>
                            <th>Serbest Açıklama</th>
                            <th class="text-end">Miktar</th>
                            <th class="text-end">Birim Fiyat ({{ $faturaHTML['PARABIRIMI'] }})</th>
                            <th class="text-end">Tutar ({{ $faturaHTML['PARABIRIMI'] }})</th>
                            <th> Barkod Yazdır</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoiceItems as $in)
                            <tr id="invoiceItem_{{ $in['ID'] }}">

                                <td>{{ $in['name'] }}</td>
                                <td>{{ $in['description'] }}</td>
                                <td class="text-end">{{ $in['invoicedQuantity'] }}</td>
                                <td class="text-end">{{ $in['priceAmount'] }} {{ $faturaHTML['PARABIRIMI'] }}</td>
                                <td class="text-end">{{ $in['lineExtensionAmount'] }} {{ $faturaHTML['PARABIRIMI'] }}</td>
                                <td><a class="btn btn-primary" href="#" 
                                    title="Barkod Yazdır">
                                    <i class="bi bi-upc"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <hr>
                <h2>Fatura XML</h2>
                {{ $faturaXML }} --}}
                <hr>
                <h1>Fatura</h1>

                {!! $faturaHTML['CONTENT'] !!}
                {{-- <hr>
                <h1>Fatura</h1>

                {{  var_dump($faturaHTML) }} --}}

            </div>
        </div>
    </div>
@endsection
