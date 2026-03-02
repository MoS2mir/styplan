<section class="pt-40 g-header">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-12">
                <div class="row justify-between items-end">
                    <div class="col-auto">
                        <h1 class="text-26 fw-600">{{$translation->title}}</h1>

                        <div class="row x-gap-20 y-gap-20 items-center pt-10">
                            <div class="col-auto">
                                <div class="row x-gap-10 items-center">
                                    <div class="col-auto">
                                        <div class="d-flex x-gap-5 items-center">
                                            <svg width="18" height="18" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px;">
                                                <path d="M6.3462 12.0531L20.4354 5.34444C22.4895 4.36569 24.6331 6.51049 23.6556 8.56586L16.9469 22.6538C16.0298 24.5787 13.2506 24.4603 12.5015 22.4629L11.2617 19.1533C11.1406 18.8304 10.9517 18.5372 10.7079 18.2933C10.464 18.0495 10.1708 17.8607 9.84795 17.7395L6.53712 16.4986C4.54095 15.7494 4.42133 12.9702 6.3462 12.0531Z" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <div class="text-15 text-light-1">{{$translation->address}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            $reviewData = $row->getScoreReview();
                            $score_total = $reviewData['score_total'];
                            if ($score_total > 5) {
                                $score_total = $score_total / 2;
                            }
                        @endphp
                        @if($score_total > 0)
                            <div class="row x-gap-10 items-center pt-5">
                                <div class="col-auto">
                                    <div class="d-flex x-gap-5 items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            @php $rev_i = 6 - $i; @endphp
                                            @if($rev_i <= floor($score_total))
                                                <i class="fa fa-star" style="font-size: 18px; color: #FFC700;"></i>
                                            @elseif($rev_i - $score_total <= 0.5)
                                                <i class="fa fa-star-half-o" style="font-size: 18px; color: #FFC700;"></i>
                                            @else
                                                <i class="fa fa-star-o" style="font-size: 18px; color: #FFC700;"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-auto">
                        <div class="row x-gap-10 y-gap-10">
                            <div class="col-auto">
                                <div class="dropdown">
                                    <button class="button px-15 py-10 -blue-1 dropdown-toggle" type="button" id="dropdownMenuShare" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-share mr-10"></i>
                                        {{__('Share')}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuShare">
                                        <a class="dropdown-item facebook" href="https://www.facebook.com/sharer/sharer.php?u={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" target="_blank" rel="noopener" original-title="{{__("Facebook")}}">
                                            <i class="fa fa-facebook"></i> {{ __('Facebook') }}
                                        </a>
                                        <a class="dropdown-item twitter" href="https://twitter.com/share?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" target="_blank" rel="noopener" original-title="{{__("Twitter")}}">
                                            <i class="fa fa-twitter"></i> {{ __('Twitter') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                                    <button class="button px-15 py-10 -blue-1 bg-light-2">
                                        <i class="icon-heart mr-10"></i>
                                        {{__('Save')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($row->getGallery())
    @include('Layout::common.detail.gallery2',['galleries' => $row->getGallery()])
@endif

<section class="pt-40">
    <div class="container js-pin-container">
        <div class="row y-gap-30">
            <div class="col-lg-8">
                <div>
                    <h3 class="text-22 fw-500">{{ __('Property highlights') }}</h3>

                    <div class="row y-gap-30 justify-between pt-20">
                        @if(!empty($row->bed))
                            <div class="col-md-auto col-6">
                                <div class="d-flex">
                                    <i class="icon-bed text-22 text-blue-1 mr-10"></i>
                                    <div class="text-15 lh-15">
                                        {{ __('Bedrooms') }}<br> {{$row->bed}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($row->bathroom)
                            <div class="col-md-auto col-6">
                                <div class="d-flex">
                                    <i class="icon-bathtub text-22 text-blue-1 mr-10"></i>
                                    <div class="text-15 lh-15">
                                        {{ __('Bathroom') }}<br> {{$row->bathroom}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($row->square)
                            <div class="col-md-auto col-6">
                                <div class="d-flex">
                                    <i class="fa fa-crop text-22 text-blue-1 mr-10"></i>
                                    <div class="text-15 lh-15">
                                        {{__("Square")}}<br> {!! size_unit_format($row->square) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($row->location->name))
                            @php $location =  $row->location->translate() @endphp
                            <div class="col-md-auto col-6">
                                <div class="d-flex">
                                    <i class="icon-location text-22 text-blue-1 mr-10"></i>
                                    <div class="text-15 lh-15">
                                        {{__("Location")}}<br> {{$location->name ?? ''}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="border-top-light mt-40 mb-40"></div>

                @if($translation->content)
                    <div>
                        <h3 class="text-22 fw-500">{{__('Description')}}</h3>
                        <div class="description">
                            {!! clean($translation->content) !!}
                        </div>
                    </div>
                @endif
                @include('Space::frontend.layouts.details.space-attributes')
                <div class="border-top-light mt-40 mb-40"></div>
                @if($translation->faqs)
                    @include('Layout::common.detail.faq',['faqs'=>$translation->faqs])
                @endif
            </div>

            <div class="col-lg-4">
                @include('Space::frontend.layouts.details.space-form-book')
            </div>
        </div>
        <div class="border-top-light mt-40 mb-40"></div>
    </div>
</section>
