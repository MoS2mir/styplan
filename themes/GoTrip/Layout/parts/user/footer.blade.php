<footer class="footer -type-custom py-60" style="background-color: #151F30; color: white;">
    <div class="container">
        <div class="row y-gap-40 justify-between items-start">

            <div class="col-xl-7 col-lg-8" style="width: 37.33333%;">
                <div class="row y-gap-30 text-center" style="text-align: center;">
                    <div class="col-sm-6">
                        <ul class="y-gap-15">
                            <li><a href="/ شروط الأستخدام" style="color: white; font-size: 18px; font-weight: 400;">شروط
                                    الأستخدام</a></li>
                            <li><a href="/ الاسئلة المتكررة"
                                    style="color: white; font-size: 18px; font-weight: 400;">الاسئلة المتكررة</a></li>
                            <li><a href="/ تواصل معنا" style="color: white; font-size: 18px; font-weight: 400;">تواصل
                                    معنا</a></li>
                            <li class="mt-15">
                                <a href="/login?register=1" class="button px-30 py-15 rounded-8 text-black"
                                    style="background-color: #555555; color: white; min-width: 140px; display: inline-flex; justify-content: center;">
                                    اضف عقارك
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="y-gap-15">
                            <li><a href="#" style="color: white; font-size: 18px; font-weight: 400;">شقق و بيوت</a></li>
                            <li><a href="#" style="color: white; font-size: 18px; font-weight: 400;">استراحات و
                                    شاليهات</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-auto text-left">
                <div class="footer-logo">
                    <img src="{{ url('/uploads/0000/6/2024/08/11/logo-light.png') }}" alt="StayPlan | ستاي بلان"
                        style="max-height: 60px;">
                </div>
            </div>
        </div>


        <div class="pt-60 mt-60">
            <div class="row justify-between items-center y-gap-20">
                <div class="col-auto">
                    <div class="text-white-50 text-15 fw-400">
                        جميع الحقوق محفوظة 2026 StayPlan | ستاي بلان
                    </div>
                </div>
                <div class="col-auto">
                    <div class="social-capsule d-flex x-gap-25 items-center bg-white px-25 py-10 rounded-20">
                        <a href="#" class="text-black text-22"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="text-black text-22"><i class="fa fa-instagram"></i></a>
                        <a href="#" class="text-black text-22"><i class="fa fa-youtube-play"></i></a>
                        <a href="#" class="text-black text-22"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@include('Popup::frontend.popup')
@if(Auth::id())
    @include('Media::browser')
@endif

<!-- Custom script for all pages -->
<script src="{{ asset('libs/lodash.min.js') }}"></script>
<script src="{{ asset('libs/jquery-3.6.3.min.js') }}"></script>

{!! App\Helpers\MapEngine::scripts() !!}

<script src="{{ asset('libs/vue/vue' . (!env('APP_DEBUG') ? '.min' : '') . '.js') }}"></script>
<script type="text/javascript" src="{{asset('themes/gotrip/libs/bs/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('libs/bootbox/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{asset('themes/gotrip/js/vendors.js')}}"></script>
<script type="text/javascript" src="{{asset('themes/gotrip/js/main.js')}}"></script>
@if(Auth::id())
    <script src="{{ asset('module/media/js/browser.js?_ver=' . config('app.version')) }}"></script>
@endif
<script src="{{ asset('libs/carousel-2/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset("libs/daterange/moment.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("libs/daterange/daterangepicker.min.js") }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('module/user/js/user.js?_ver=' . config('app.asset_version')) }}"></script>


{{-- home.js --}}
<script src="{{ asset('themes/gotrip/dist/frontend/js/gotrip.js?_ver=' . config('app.version')) }}"></script>

@php \App\Helpers\ReCaptchaEngine::scripts() @endphp
@if(setting_item('user_enable_2fa'))
    @include('auth.confirm-password-modal')
    <script src="{{asset('/module/user/js/2fa.js')}}"></script>
@endif
@stack('js')