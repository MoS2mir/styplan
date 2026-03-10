@php
    $translation = $row->translate();
    $layout_style = $layout_style ?? '';
@endphp

@if($layout_style != 'home_2')
<div class="item-loop {{$wrap_class ?? ''}}">
@endif
    <div class="hotelsCard -type-1 ">
        <div class="hotelsCard__image">
            <div class="cardImage ratio ratio-1:1">
                <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl()}}">
                    <div class="cardImage__content">
                        @if($row->image_url)
                            @if(!empty($disable_lazyload))
                                <img  src="{{$row->image_url}}" class="img-responsive rounded-4 col-12 js-lazy" alt="">
                            @else
                                {!! get_image_tag($row->image_id,'medium',['class'=>'img-responsive rounded-4 col-12 js-lazy','alt'=>$translation->title]) !!}
                            @endif
                        @endif
                    </div>
                </a>
                <div class="service-wishlist {{$row->isWishList()}}" data-id="{{ $row->id }}" data-type="{{ $row->type }}" style="right: 15px !important; left: auto !important;">
                    <div class="cardImage__wishlist">
                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                            <i class="icon-heart text-12"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="hotelsCard__content mt-10">
            {{-- 1. Title --}}
            <h4 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                <a class="text-dark-1-i" @if(!empty($blank)) target="_blank" @endif href="{{ $row->getDetailUrl() }}"> <span>{{ $translation->title }}</span></a>
            </h4>

            {{-- 2. Star Rating --}}
            @if(setting_item('space_enable_review'))
                @php $reviewData = $row->getScoreReview(); $score_total = $reviewData['score_total']; @endphp
                <div class="d-flex items-center mt-5">
                    <div class="d-flex x-gap-5 items-center">
                        @for($i = 5; $i >= 1; $i--)
                            @if($i <= (int)$score_total)
                                <i class="icon-star text-10 text-yellow-1"></i>
                            @else
                                <i class="icon-star text-10 text-light-2"></i>
                            @endif
                        @endfor
                    </div>
                    <div class="text-14 text-light-1 ml-10">
                        {{ $reviewData['total_review'] }} {{ __("تقييم") }}
                    </div>
                </div>
            @endif

            {{-- 3. Location --}}
            @if(!empty($row->location->name))
                @php $location =  $row->location->translate() @endphp
                <p class="text-light-1 lh-14 text-14 mt-5">
                    <i class="icon-location-2 mr-5"></i>{{$location->name ?? ''}}
                </p>
            @endif

            {{-- 4. Price --}}
            <div class="mt-5">
                <div class="text-light-1 align-baseline">
                    <div class="d-inline-flex justify-content-md-end align-baseline">
                        @if($row->discount_percent)
                            <div class="text-16 text-red-1 line-through mr-5">{{ $row->display_sale_price }}</div>
                        @endif
                        <div class="text-18 fw-500 text-dark-1">{{ $row->display_price }}</div>
                    </div>
                    - {{ __('per night') }}
                </div>
            </div>
        </div>
    </div>
@if($layout_style != 'home_2')
</div>
@endif
