@extends('layouts.app')
@push('css')
    <link href="{{ asset('module/booking/css/checkout.css?_ver=' . config('app.asset_version')) }}" rel="stylesheet">
@endpush
@section('content')
    <div class="bravo-booking-page padding-content padding-content pt-40 pb-40">
        <div class="container">
            <!-- Custom Dark Theme Success Banner -->
            <div
                style="background-color: #172033; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 99999; display: flex; align-items: center; justify-content: center; flex-direction: column; overflow: hidden; padding: 40px; color: #fff;">

                <!-- Top Right Abstract Shape -->
                <svg style="position: absolute; top: -50px; right: -50px; transform: rotate(15deg); opacity: 0.8;"
                    width="400" height="400" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50 0 L95 35 L75 90 L25 90 L5 35 Z" fill="rgba(255,255,255,0.1)" />
                    <path d="M50 5 L88 35 L72 85 L28 85 L12 35 Z" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"
                        fill="none" style="transform: translate(-10px, 10px);" />
                </svg>

                <!-- Bottom Left Abstract Shape -->
                <svg style="position: absolute; bottom: -50px; left: -50px; transform: rotate(-25deg); opacity: 0.8;"
                    width="400" height="400" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50 0 L95 35 L75 90 L25 90 L5 35 Z" fill="rgba(255,255,255,0.1)" />
                    <path d="M50 5 L88 35 L72 85 L28 85 L12 35 Z" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"
                        fill="none" style="transform: translate(15px, -15px);" />
                </svg>

                <div style="position: relative; z-index: 2; text-align: center; max-width: 800px; width: 100%;">
                    <h2
                        style="color: #fff; font-family: 'Tajawal', 'Cairo', sans-serif; font-weight: 700; font-size: 48px; margin-bottom: 30px;">
                        تهانينا!! تم الحجز
                    </h2>
                    <div
                        style="height: 1px; background-color: rgba(255,255,255,0.2); width: 100%; margin: 0 auto 40px auto;">
                    </div>

                    <!-- Booking info removed per requested design -->

                    <div class="mt-50 text-center">
                        <a href="{{route('user.booking_history')}}"
                            class="button h-60 px-40 mt-30 -dark-1 bg-blue-1 text-white"
                            style="font-family: Tajawal, Cairo, sans-serif; font-size: 18px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center;">
                            عودة لقائمة الحجوزات
                            <div class="icon-arrow-top-right ml-15"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection