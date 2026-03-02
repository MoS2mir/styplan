@extends('layouts.app')
@push('css')
    <link href="{{ asset('themes/gotrip/dist/frontend/module/hotel/css/hotel.css?_ver=' . config('app.asset_version')) }}"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}" />
@endpush
@php $disable_subscribe_default = true; @endphp
@section('content')
    <div class="bravo_search bravo_search_hotel">

        <section class="layout-pt-md layout-pb-lg">
            <div class="container">
                <div class="row">
                    <div class="col-12 w-100">
                        @include('Hotel::frontend.layouts.search.custom-filter-box')
                    </div>

                    <div class="col-12 w-100">
                        @include('Hotel::frontend.layouts.search.list-item', ['layout' => $layout])
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset('js/filter.js?_ver=' . config('app.asset_version')) }}"></script>
    <script type="text/javascript"
        src="{{ asset('module/hotel/js/hotel.js?_ver=' . config('app.asset_version')) }}"></script>
@endpush