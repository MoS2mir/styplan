@extends('layouts.app')
@push('css')
    <link href="{{ asset('module/booking/css/checkout.css?_ver=' . config('app.asset_version')) }}" rel="stylesheet">
@endpush
@section('content')
    <div class="bravo-booking-page padding-content pt-40 pb-40">
        <div class="container">
            <div id="bravo-checkout-page">
                <div class="row y-gap-40">
                    <!-- Booking Review (Now on top and full width) -->
                    <div class="col-12">
                        <div class="booking-review-wrapper">
                            @include ($service->checkout_booking_detail_file ?? '', ['disable_lazyload' => 1])
                        </div>
                    </div>

                    <!-- Booking Form (Now below and full width) -->
                    <div class="col-12">
                        @if(!auth()->user())
                            <div class="py-15 px-20 mb-40 md:md-24 rounded-4 text-15 bg-blue-1-05">
                                <a data-bs-toggle="modal" href="#login" class="text-blue-1 fw-500">{{__('Sign in')}}</a>
                                {{__('to book with your saved details or')}}
                                <a data-bs-toggle="modal" href="#register" class="text-blue-1 fw-500">{{__('register')}}</a>
                                {{__('to manage your bookings on the go!')}}
                            </div>
                        @endif
                        <div style="display: flex; align-items: center; justify-content: flex-start; margin-bottom: 25px;">
                         
                            <div style="display: flex; align-items: center; justify-content: center; margin-right: -15px;">
                                <svg width="86" height="83" viewBox="0 0 86 83" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                                    <g filter="url(#filter0_d_65_101)">
                                        <rect x="20" y="16" width="45.6061" height="43" rx="15" fill="white" />
                                    </g>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M48.7846 39.2756L41.3881 46.6215L39.552 44.7727L46.024 38.3448L39.5962 31.8727L41.445 30.0366L48.7909 37.4331C49.0344 37.6783 49.1705 38.0101 49.1693 38.3556C49.1681 38.7011 49.0297 39.032 48.7846 39.2756Z"
                                        fill="#1B263B" />
                                    <defs>
                                        <filter id="filter0_d_65_101" x="0" y="0" width="85.606" height="83"
                                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dy="4" />
                                            <feGaussianBlur stdDeviation="10" />
                                            <feComposite in2="hardAlpha" operator="out" />
                                            <feColorMatrix type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix"
                                                result="effect1_dropShadow_65_101" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_65_101"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </div>
                               <h2 style="font-size: 24px; font-weight: 700; color: #111; margin: 0; padding-left: 5px;">مرحلة
                                الدفع</h2>
                        </div>
                        <div class="booking-form mt-20">
                            @include ($service->checkout_form_file ?? 'Booking::frontend/booking/checkout-form', ['disable_lazyload' => 1])
                            @if(!empty($token = request()->input('token')))
                                <input type="hidden" name="token" value="{{$token}}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('module/booking/js/checkout.js') }}"></script>
    <script type="text/javascript">
        jQuery(function () {
            $.ajax({
                'url': bookingCore.url + '{{$is_api ? '/api' : ''}}/booking/{{$booking->code}}/check-status',
                'cache': false,
                'type': 'GET',
                success: function (data) {
                    if (data.redirect !== undefined && data.redirect) {
                        window.location.href = data.redirect
                    }
                }
            });
        })

        $('.deposit_amount').on('change', function () {
            checkPaynow();
        });

        $('input[type=radio][name=how_to_pay]').on('change', function () {
            checkPaynow();
        });

        function checkPaynow() {
            var credit_input = $('.deposit_amount').val();
            var how_to_pay = $("input[name=how_to_pay]:checked").val();
            var convert_to_money = credit_input * {{ setting_item('wallet_credit_exchange_rate', 1)}};

            if (how_to_pay == 'full') {
                var pay_now_need_pay = parseFloat({{floatval($booking->total)}}) - convert_to_money;
            } else {
                var pay_now_need_pay = parseFloat({{floatval($booking->deposit == null ? $booking->total : $booking->deposit)}}) - convert_to_money;
            }

            if (pay_now_need_pay < 0) {
                pay_now_need_pay = 0;
            }
            $('.convert_pay_now').html(bravo_format_money(pay_now_need_pay));
            $('.convert_deposit_amount').html(bravo_format_money(convert_to_money));
        }


        jQuery(function () {
            $(".bravo_apply_coupon").click(function () {
                var parent = $(this).closest('.section-coupon-form');
                parent.find(".group-form .fa-spin").removeClass("d-none");
                parent.find(".message").html('');
                $.ajax({
                    'url': bookingCore.url + '/booking/{{$booking->code}}/apply-coupon',
                    'data': parent.find('input,textarea,select').serialize(),
                    'cache': false,
                    'method': "post",
                    success: function (res) {
                        parent.find(".group-form .fa-spin").addClass("d-none");
                        if (res.reload !== undefined) {
                            window.location.reload();
                        }
                        if (res.message && res.status === 1) {
                            parent.find('.message').html('<div class="alert alert-success">' + res.message + '</div>');
                        }
                        if (res.message && res.status === 0) {
                            parent.find('.message').html('<div class="alert alert-danger">' + res.message + '</div>');
                        }
                    }
                });
            });
            $(".bravo_remove_coupon").click(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.section-coupon-form');
                var parentItem = $(this).closest('.item');
                parentItem.find(".fa-spin").removeClass("d-none");
                $.ajax({
                    'url': bookingCore.url + '/booking/{{$booking->code}}/remove-coupon',
                    'data': {
                        coupon_code: $(this).attr('data-code')
                    },
                    'cache': false,
                    'method': "post",
                    success: function (res) {
                        parentItem.find(".fa-spin").addClass("d-none");
                        if (res.reload !== undefined) {
                            window.location.reload();
                        }
                        if (res.message && res.status === 0) {
                            parent.find('.message').html('<div class="alert alert-danger">' + res.message + '</div>');
                        }
                    }
                });
            });
        })
    </script>
@endpush