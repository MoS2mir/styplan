@extends('layouts.user')
@section('content')
    <div class="booking-history-container">


        <h3 class="text-28 fw-700 text-center mb-30">{{ __("حجوزاتي") }}</h3>

        @include('admin.message')

        <div class="booking-list-cards">
            @if(!empty($bookings) && $bookings->total() > 0)
                @foreach($bookings as $key => $booking)
                    @php
                        $service = $booking->service;
                        if (!$service) continue;
                        $translation = $service->translate(app()->getLocale());
                        $imageUrl = $service->image_id ? get_file_url($service->image_id, 'full') : asset('images/default.jpg');
                    @endphp
                    <div class="booking-history-card mb-30 shadow-sm rounded-12 bg-white overflow-hidden d-flex">
                        <div class="card-image col-md-4 p-0">
                            <img src="{{ $imageUrl }}" alt="{{ $translation->title }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="card-content col-md-8 p-30 d-flex flex-column justify-between">
                            <div class="card-top">
                                <h4 class="text-20 fw-700 mb-15">{{ $translation->title }}</h4>
                                <div class="booking-details">
                                    <div class="d-flex items-center mb-10">
                                        <i class="fa fa-folder-open text-16 mr-10 text-dark-1 ml-10"></i>
                                        <span class="text-15 fw-500">{{ __("رقم الحجز") }} ({{ $booking->id }})</span>
                                    </div>
                                    <div class="d-flex items-center mb-10">
                                        <i class="fa fa-flag text-16 mr-10 text-dark-1 ml-10"></i>
                                        <span class="text-15 fw-500">{{ __("حالة الحجز") }} ({{ $booking->statusName }})</span>
                                    </div>
                                    <div class="d-flex items-center">
                                        <i class="fa fa-calendar text-16 mr-10 text-dark-1 ml-10"></i>
                                        <span class="text-15 fw-500">{{ __("تاريخ الحجز") }} ({{ display_date($booking->start_date) }})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer-info d-flex justify-between items-end mt-20">
                                <div class="booking-summary text-right" style="direction: rtl;">
                                    <div class="text-14 fw-600 text-dark-1">{{ __("ملخص الحجز") }}</div>
                                    <div class="text-14 text-dark-1">{{ __("الإجمالي") }}: <span class="fw-700 text-18">{{ format_money($booking->total) }}</span></div>
                                </div>
                                <div class="booking-actions">
                                    <a href="{{route('user.booking.invoice',['code'=>$booking->code])}}" class="button -blue-1 bg-blue-1-05 text-blue-1 py-10 px-20 text-14" target="_blank">{{ __("Invoice") }}</a>
                                    @if($booking->status == 'unpaid')
                                        <a href="{{route('booking.checkout',['code'=>$booking->code])}}" class="button -dark-1 bg-blue-1 text-white py-10 px-20 text-14 ml-10">{{ __("Pay Now") }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="bravo-pagination pt-30">
                    {{$bookings->appends(request()->query())->links()}}
                </div>
            @else
                <div class="text-center py-60">
                    <p class="text-18 text-light-1">{{ __("No Booking History Found") }}</p>
                </div>
            @endif
        </div>
    </div>

    <style>
        .booking-history-card {
            border: 1px solid #e0e6ed;
            transition: box-shadow 0.3s ease;
        }
        .booking-history-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important;
        }
        .card-image img {
            min-height: 250px;
            border-radius: 0 12px 12px 0;
        }
        .is-rtl .card-image img {
            border-radius: 0 12px 12px 0;
        }
        .is-rtl .card-content {
            text-align: right;
        }
        /* Match image exact layout */
        .is-ltr .booking-history-card {
            flex-direction: row-reverse; /* In LTR, flip to put image on right */
        }
        .is-rtl .booking-history-card {
            flex-direction: row; /* In RTL, first child is already on right */
        }
        .booking-details .fa {
            font-size: 18px;
            color: #000;
        }

        @media (max-width: 768px) {
            .booking-history-card {
                flex-direction: column;
            }
            .card-image img {
                height: 200px;
                border-radius: 12px 12px 0 0;
            }
            .is-rtl .card-image img {
                border-radius: 12px 12px 0 0;
            }
        }
    </style>
@endsection

@push('js')
    <script>
        jQuery(function ($){
            $('#modal_booking_detail').on('show.bs.modal',function (e){
                var btn = $(e.relatedTarget);
                $(this).find('.user_id').html(btn.data('id'));
                $(this).find('.modal-body').html('<div class="d-flex justify-content-center">{{__("Loading...")}}</div>');
                var modal = $(this);
                $.get(btn.data('ajax'), function (html){
                        modal.find('.modal-body').html(html);
                    }
                )
            })
        })
    </script>
@endpush

