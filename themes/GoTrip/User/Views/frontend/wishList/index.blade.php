@extends('layouts.user')
@section('content')
    <div class="wishlist-container">

        <h3 class="text-28 fw-700 text-center mb-30">{{ __("مفضلتي") }}</h3>

        @include('admin.message')

        <div class="wishlist-list-cards">
            @if($rows->total() > 0)
                @foreach($rows as $row)
                    @php
                        $service = $row->service;
                        if (!$service) continue;
                        $translation = $service->translate();
                        $imageUrl = $service->image_id ? get_file_url($service->image_id, 'full') : asset('images/default.jpg');
                    @endphp
                    <div class="wishlist-history-card mb-30 shadow-sm rounded-12 bg-white overflow-hidden d-flex position-relative">
                        <!-- Heart Icon -->
                        <div class="service-wishlist {{$service->isWishList()}} position-absolute" data-id="{{ $service->id }}" data-type="{{ $service->type }}" style="top: 20px; left: 20px; z-index: 10;">
                            <i class="fa fa-heart text-24" style="color: #ff0000; cursor: pointer;"></i>
                        </div>

                        <div class="card-image col-md-4 p-0">
                            <img src="{{ $imageUrl }}" alt="{{ $translation->title }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="card-content col-md-8 p-30 d-flex flex-column justify-between">
                            <div class="card-top">
                                <h4 class="text-20 fw-700 mb-15 text-right">{{ $translation->title }}</h4>
                                <div class="wishlist-details text-right" style="direction: rtl;">
                                    @if(!empty($service->location->name))
                                        <div class="d-flex items-center mb-5">
                                            <i class="fa fa-map-marker text-16 ml-10"></i>
                                            <span class="text-15 fw-500">{{ $service->location->name }}</span>
                                        </div>
                                    @endif

                                    <div class="d-flex items-center mb-5">
                                        <i class="fa fa-bed text-16 ml-10"></i>
                                        <span class="text-15 fw-500">{{ $service->bed ?? 0 }} {{ __("غرفة") }}</span>
                                    </div>

                                    <div class="d-flex items-center mb-5">
                                        <i class="fa fa-users text-16 ml-10"></i>
                                        <span class="text-15 fw-500">{{ $service->max_guests ?? 0 }} {{ __("أشخاص") }}</span>
                                    </div>

                                    <div class="d-flex items-center mb-10">
                                        <i class="fa fa-money text-16 ml-10"></i>
                                        <span class="text-15 fw-500">{{ format_money($service->price) }} - {{ __("ليلة") }}</span>
                                    </div>

                                    @if($service->getReviewEnable())
                                        <div class="rate-stars">
                                            @php $reviewData = $service->getScoreReview(); $score_total = $reviewData['score_total']; @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star text-14 {{ $i <= $score_total ? 'text-yellow-1' : 'text-light-3' }}"></i>
                                            @endfor
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="bravo-pagination pt-30 text-center">
                    {{$rows->appends(request()->query())->links()}}
                </div>
            @else
                <div class="text-center py-60">
                    <p class="text-18 text-light-1">{{ __("بيانات المفضلة فارغة") }}</p>
                </div>
            @endif
        </div>
    </div>

    <style>
        .wishlist-history-card {
            border: 1px solid #e0e6ed;
            transition: box-shadow 0.3s ease;
        }
        .wishlist-history-card:hover {
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
        .is-ltr .wishlist-history-card {
            flex-direction: row-reverse; /* In LTR, flip to put image on right */
        }
        .is-rtl .wishlist-history-card {
            flex-direction: row; /* In RTL, first child is already on right */
        }
        .wishlist-details .fa {
            font-size: 18px;
            color: #000;
        }
        .text-yellow-1 {
            color: #fabb05 !important;
        }

        @media (max-width: 768px) {
            .wishlist-history-card {
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
