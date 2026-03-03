@include('Layout::parts.footer-style.index')
@include('Layout::parts.login-register-modal')
@include('Popup::frontend.popup')
@if(Auth::id())
    @include('Media::browser')
@endif
<!-- Custom script for all pages -->
<script src="{{ asset('libs/lodash.min.js') }}"></script>
<script src="{{ asset('libs/jquery-3.6.3.min.js') }}"></script>
<script src="{{ asset('libs/vue/vue' . (!env('APP_DEBUG') ? '.min' : '') . '.js') }}"></script>
<script type="text/javascript" src="{{asset('themes/gotrip/libs/bs/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('libs/bootbox/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{asset('themes/gotrip/js/vendors.js')}}"></script>
<script type="text/javascript" src="{{asset('themes/gotrip/js/main.js?_ver=' . config('app.asset_version'))}}"></script>

{!! App\Helpers\MapEngine::scripts() !!}
@if(Auth::id())
    <script src="{{ asset('module/media/js/browser.js?_ver=' . config('app.version')) }}"></script>
@endif
<script src="{{ asset('libs/carousel-2/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset("libs/daterange/moment.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("libs/daterange/daterangepicker.min.js") }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>


{{-- home.js --}}
<script src="{{ asset('themes/gotrip/dist/frontend/js/gotrip.js?_ver=' . config('app.asset_version')) }}"></script>

@php \App\Helpers\ReCaptchaEngine::scripts() @endphp
@stack('js')