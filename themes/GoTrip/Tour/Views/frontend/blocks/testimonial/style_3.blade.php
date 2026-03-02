@if(!empty($list_item))
<section class="layout-pt-lg layout-pb-lg">
    <div data-anim-wrap class="container">
        <div data-anim-child="slide-up delay-1" class="row justify-center text-center">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title" style="font-family: 'Inter', sans-serif; font-weight: 600; font-size: 40px; color: #000000;">{{ $title ?? 'تقييمات الزبائن' }}</h2>
                </div>
            </div>
        </div>

        <div class="relative mt-60 md:mt-40 js-section-slider" data-gap="30" data-slider-cols="xl-3 lg-3 md-2 sm-1 base-1">
            <div class="swiper-wrapper">
                @php $i = 2 @endphp
                @foreach($list_item as $item)
                    <div data-anim-child="slide-up delay-{{$i}}" class="swiper-slide h-auto">
                        <div class="testimonials -type-custom text-center d-flex flex-column items-center h-100 px-20 y-gap-30">
                            {{-- Avatar Circle --}}
                            <div class="">
                                <div class="size-120 flex-center bg-light-2 rounded-full overflow-hidden" style="background-color: #e5e7eb !important;">
                                    @if(!empty($item['avatar']))
                                        <img class="size-full object-cover" src="{{get_file_url($item['avatar'])}}" alt="{{$item['name']}}">
                                    @else
                                        <i class="icon-user text-40 text-dark-1"></i>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Name --}}
                            <h4 class="" style="font-family: 'Inter', sans-serif; font-weight: 500; font-size: 35px; color: #000000; margin: 0;">{{$item['name']}}</h4>
                            
                            {{-- Review Text --}}
                            <p class="testimonials__text lh-16" style="font-family: 'Inter', sans-serif; font-weight: 500; font-size: 22px; color: #000000B2; max-width: 350px; margin: 0;">"{!! clean($item['desc']) !!}"</p>
                        </div>
                    </div>
                    @php $i++; @endphp
                @endforeach
            </div>

            {{-- Custom Arrows --}}
            <button class="section-slider-nav -prev flex-center js-prev" style="position: absolute; top: 50%; left: -80px; transform: translateY(-50%); background: none; border: none; width: 58.23px; height: 110.93px; padding: 0;">
                <svg width="58" height="111" viewBox="0 0 58 111" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M55 3L3 55.5L55 108" stroke="black" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <button class="section-slider-nav -next flex-center js-next" style="position: absolute; top: 50%; right: -80px; transform: translateY(-50%); background: none; border: none; width: 58.23px; height: 110.93px; padding: 0;">
                <svg width="58" height="111" viewBox="0 0 58 111" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 3L55 55.5L3 108" stroke="black" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        {{-- Bottom Line --}}
        <div class="row justify-center pt-80">
            <div class="col-xl-10">
                <div class="border-top-light" style="border-top: 1px solid #e5e7eb !important;"></div>
            </div>
        </div>
    </div>
</section>
@endif
