@php 
    $galleries = $row->getGallery();
    if (empty($galleries)) {
        $galleries = [['large' => $row->getBannerImageUrlWithStandard() ?? '']];
    }
    $display_images = $galleries;
    while(count($display_images) < 5) {
        $display_images = array_merge($display_images, $galleries);
    }
@endphp

<section class="pt-40 g-gallery" style="background: transparent !important; margin-top: 30px;">
    <div class="container">
        <div class="gallery-custom-wrapper">
            {{-- العمود الأيمن --}}
            <div class="gallery-side-column">
                <div class="gallery-target-box side-img-box">
                    <img src="{{$display_images[1]['large']}}" class="rounded-15 object-cover w-1/1 h-full shadow-1" style="display: block !important; opacity: 1 !important;">
                </div>
                <div class="gallery-target-box side-img-box">
                    <img src="{{$display_images[2]['large']}}" class="rounded-15 object-cover w-1/1 h-full shadow-1" style="display: block !important; opacity: 1 !important;">
                </div>
                <div class="mt-auto">
                    <a href="{{$display_images[0]['large']}}" class="button -dark-1 py-15 text-white fw-600 rounded-10 js-gallery shadow-2" data-gallery="gallery2" style="background-color: #1A2B48 !important; width: 100%; display: flex; justify-content: center; font-size: 16px; opacity: 1 !important;">
                        {{ __('عرض كل الصور') }}
                    </a>
                    @foreach($galleries as $key => $item)
                        @if($key > 0) <a href="{{$item['large']}}" class="js-gallery" data-gallery="gallery2"></a> @endif
                    @endforeach
                </div>
            </div>

            {{-- العمود الأوسط (المقاسات المطلوبة 712x605) --}}
            <div class="gallery-center-column">
                <div class="relative h-full overflow-hidden rounded-15 js-section-slider js-gallery-main-slider swiper-container shadow-1" data-gap="0" data-slider-cols="base-1" data-pagination="js-gallery-pag" style="background: transparent !important;">
                    <div class="swiper-wrapper h-full">
                        @foreach($galleries as $item)
                            <div class="swiper-slide h-full" style="opacity: 1 !important; visibility: visible !important;">
                                <img src="{{$item['large']}}" alt="Gallery" class="object-cover w-1/1 h-full shadow-1-hover" style="display: block !important; opacity: 1 !important;">
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination -dots absolute bottom-20 left-1/2 -translate-x-1/2 z-2 js-gallery-pag style-custom-dots"></div>
                </div>
            </div>

            {{-- العمود الأيسر --}}
            <div class="gallery-side-column">
                <div class="gallery-target-box side-img-box">
                    <img src="{{$display_images[3]['large']}}" class="rounded-15 object-cover w-1/1 h-full shadow-1" style="display: block !important; opacity: 1 !important;">
                </div>
                <div class="gallery-target-box side-img-box">
                    <img src="{{$display_images[4]['large']}}" class="rounded-15 object-cover w-1/1 h-full shadow-1" style="display: block !important; opacity: 1 !important;">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .gallery-custom-wrapper {
        display: flex;
        justify-content: center;
        gap: 20px;
        height: 605px;
        width: 100%;
        max-width: 1300px;
        margin: 0 auto;
    }
    .gallery-side-column {
        width: 224px;
        flex: 0 0 224px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start; /* البداية من الأعلى لضمان التساوي */
        gap: 20px;
        padding-top: 40px; /* إزاحة لضبط الصور في منتصف ارتفاع السلايدر الكبير */
    }
    .side-img-box {
        width: 224px;
        height: 230px;
        flex: 0 0 230px;
    }
    .gallery-btn-box {
        margin-top: 15px; /* مسافة ثابتة تحت الصورة الثانية للزر */
    }
    .gallery-center-column {
        width: 712px;
        flex: 0 0 712px;
        height: 605px;
        position: relative;
    }
    .gallery-target-box { position: relative; overflow: hidden; border-radius: 15px; background: transparent !important; }
    .rounded-15 { border-radius: 15px !important; }
    .object-cover { object-fit: cover !important; }
    
    /* تنسيق النقط (Dots) - نسخة طبق الأصل من الصورة المرفقة */
    .style-custom-dots {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        bottom: 30px !important; /* مكانها فوق السجاد تماماً */
        left: 50% !important;
        transform: translateX(-50%) !important; /* إجبار التوسيد في المنتصف تماماً */
        width: auto !important;
        position: absolute !important;
        z-index: 10 !important;
    }
    
    .style-custom-dots .swiper-pagination-bullet, 
    .style-custom-dots .pagination__item { 
        background: #FFFFFF !important; 
        opacity: 1 !important; 
        width: 10px !important; 
        height: 10px !important; 
        margin: 0 6px !important; 
        border-radius: 50% !important;
        border: none !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2) !important; /* ظل خفيف لتبرز فوق السجاد */
        cursor: pointer;
        display: inline-block !important;
        transition: all 0.3s ease;
    }
    
    .style-custom-dots .swiper-pagination-bullet-active,
    .style-custom-dots .pagination__item.is-active { 
        background: #1A2B48 !important; /* اللون الكحلي الداكن للنقطة النشطة */
        width: 11px !important; 
        height: 11px !important;
    }

    /* إجبار إظهار 4 نقط فقط مهما كان عدد الصور */
    .style-custom-dots .swiper-pagination-bullet:nth-child(n+5),
    .style-custom-dots .pagination__item:nth-child(n+5) {
        display: none !important;
    }

    @media (max-width: 1200px) {
        .gallery-center-column { width: 100%; flex: 1; }
        .gallery-custom-wrapper { height: auto; flex-wrap: wrap; }
    }
    @media (max-width: 768px) {
        .gallery-side-column { display: none !important; }
    }
</style>

<script>
    window.addEventListener('load', function() {
        // ننتظر قليلاً للتأكد من أن السلايدر تم تعريفه من قبل ملف main.js
        setTimeout(function() {
            var sliderEl = document.querySelector('.js-gallery-main-slider');
            if (sliderEl && sliderEl.swiper) {
                sliderEl.swiper.params.autoplay = {
                    delay: 3000,
                    disableOnInteraction: false,
                };
                sliderEl.swiper.autoplay.start();
            }
        }, 1000);
    });
</script>
