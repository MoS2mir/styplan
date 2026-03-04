<section data-anim-wrap class="masthead -type-2 js-mouse-move-container" style="height: 732px !important; min-height: 732px !important; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px; overflow: hidden; position: relative;">
    <div class="masthead__bg bg-dark-3" style="height: 100%; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px; overflow: hidden;">
        <img src="{{ $bg_image_url }}" alt="image" data-src="{{ $bg_image_url }}" class="js-lazy" style="height: 100%; width: 100%; object-fit: cover; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px;">
    </div>
    <div class="container">


        <style>
            .search-pill-container {
                position: relative;
                z-index: 10;
                margin-top: 40px;
                max-width: 650px;
                width: 100%;
                margin-right: 0;
                margin-left: auto;
            }
            .search-pill-inner {
                background: #FFFFFF !important;
                border-radius: 100px !important;
                padding: 10px !important;
                display: flex !important;
                align-items: center !important;
                box-shadow: 0 15px 45px rgba(0,0,0,0.1) !important;
                height: 80px !important;
                width: 100% !important;
                direction: rtl;
                position: relative;
            }
            .pill-submit-btn {
                width: 60px !important;
                height: 60px !important;
                border-radius: 50% !important;
                background: #1B283F !important;
                color: #fff !important;
                padding: 0 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                min-width: 60px !important;
                flex-shrink: 0;
                border: none;
                margin-right: 5px;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            .pill-submit-btn:hover {
                background: #F7941D !important;
            }
            .pill-submit-btn i {
                font-size: 24px;
            }
            
            .pill-items-row {
                flex: 1;
                display: flex !important;
                align-items: center;
                height: 100%;
                margin: 0 !important;
            }
            .pill-item {
                flex: 1;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 0 20px;
                border-left: 1px solid #E5E7EB;
                cursor: pointer;
                position: relative;
            }
            .pill-item:last-child {
                border-left: none;
            }
            .pill-item h4 {
                font-size: 16px !important;
                font-weight: 700 !important;
                color: #1A2B48 !important;
                margin-bottom: 2px !important;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .pill-item h4::after {
                content: "\f107";
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                font-size: 14px;
                color: #5E6D77;
            }
            .pill-item .val {
                font-size: 14px !important;
                color: #5E6D77 !important;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            @media (max-width: 991px) {
                .search-pill-inner {
                    height: auto !important;
                    flex-direction: column !important;
                    border-radius: 20px !important;
                    padding: 20px !important;
                }
                .pill-items-row {
                    flex-direction: column !important;
                    width: 100%;
                }
                .pill-item {
                    border-left: none !important;
                    border-bottom: 1px solid #eee;
                    padding: 15px 0 !important;
                    width: 100%;
                    align-items: center;
                }
                .pill-submit-btn {
                    width: 100% !important;
                    border-radius: 10px !important;
                    margin-top: 15px;
                    margin-right: 0;
                }
                .pill-submit-btn::after {
                    content: " بحث";
                    font-family: inherit;
                    font-size: 18px;
                    margin-right: 10px;
                }
            }
        </style>

        <div class="masthead__content">
            <div class="row y-gap-40 items-center">
                {{-- Column 1 (Right in RTL): Images - 50% --}}
                <div class="col-xl-6">
                    <div class="masthead__images" style="position: relative; height: 100%; min-height: 500px; width: 100%;">
                        @foreach($list_slider as $item)
                            @php
                                $img = get_file_url($item['bg_image'],'full');
                                $img_style = "width: 192px; height: 199px; border-radius: 20px; object-fit: cover; box-shadow: 0 15px 35px rgba(0,0,0,0.25);";
                                $container_style = "position: absolute;";
                                
                                    switch($loop->index) {
                                        case 0: $container_style .= " top: -33px; right: 27%; z-index: 1;"; break;
                                        case 1: $container_style .= " top: 86px; right: 8%; z-index: 2;"; break;
                                        case 2: $container_style .= " top: 233px; right: 28%; z-index: 3;"; break;
                                        case 3: $container_style .= " top: 369px; right: 11%; z-index: 4;"; break;
                                        default: $container_style .= " position: relative; margin: 10px; display: inline-block;"; break;
                                    }
                            @endphp
                            <div data-anim-child="slide-up delay-6" style="{{ $container_style }}">
                                <img src="{{ $img }}" alt="image" class="js-mouse-move" data-move="30" style="{{ $img_style }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Column 2 (Left in RTL): Title and Search Form - 50% --}}
                <div class="col-xl-6 d-flex flex-column justify-center items-end text-right">
                    <div class="w-100 pl-20 lg:pl-0">
                        <h1 data-anim-child="slide-up delay-2" class="z-2 text-60 lg:text-40 md:text-30 text-white xl:pt-0" style="text-align: right;">
                            <span class="text-yellow-1">{{$title ?? ''}}</span>
                        </h1>
                        <p data-anim-child="slide-up delay-3" class="z-2 text-white mt-20" style="text-align: right;">{{$sub_title ?? ''}}</p>
                        @if(empty($hide_form_search))
                            <div data-anim-child="slide-up delay-4" class="search-pill-container" style="direction: rtl;">
                                <form action="{{ route('hotel.search') }}" method="get" class="w-100">
                                    <div class="search-pill-inner">
                                        {{-- Search Button (Rightmost in RTL) --}}
                                        <button class="pill-submit-btn" type="submit">
                                            <i class="icon-search"></i>
                                        </button>

                                        <div class="pill-items-row">
                                            {{-- تاریخ الوصول (Arrival) --}}
                                            <div class="pill-item searchMenu-date">
                                                <div class="date-wrapper" data-x-dd-click="searchMenu-date">
                                                    <h4>تاريخ الوصول</h4>
                                                    <div class="val js-first-date render check-in-render">{{Request::query('start',display_date(strtotime("today")))}}</div>
                                                </div>
                                                <input type="hidden" class="check-in-input" value="{{Request::query('start',display_date(strtotime("today")))}}" name="start">
                                            </div>

                                            {{-- تاریخ المغادرة (Departure) --}}
                                            <div class="pill-item searchMenu-date">
                                                <div class="date-wrapper" data-x-dd-click="searchMenu-date">
                                                    <h4>تاريخ المغادرة</h4>
                                                    <div class="val js-last-date render check-out-render">{{Request::query('end',display_date(strtotime("+1 day")))}}</div>
                                                </div>
                                                <input type="hidden" class="check-out-input" value="{{Request::query('end',display_date(strtotime("+1 day")))}}" name="end">
                                                <input type="text" class="check-in-out absolute invisible" name="date" value="{{Request::query('date',date("Y-m-d")." - ".date("Y-m-d",strtotime("+1 day")))}}">
                                            </div>

                                            {{-- التصنيف (Category/Location) --}}
                                            {{-- I will use a simple dropdown format similar to location field but with 'Classification' label --}}
                                            <div class="pill-item searchMenu-loc js-form-dd js-liverSearch">
                                                <div data-x-dd-click="searchMenu-loc">
                                                    <h4>التصنيف</h4>
                                                    <div class="val">
                                                        <input type="hidden" name="location_id" class="js-search-get-id" value="">
                                                        <input type="text" autocomplete="off" readonly class="parent_text js-search js-dd-focus" style="border:none; padding:0; background:transparent; font-size:14px; color:#5E6D77; width:100%;" placeholder="اختر التصنيف">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- عدد الاشخاص (Guests) --}}
                                            <div class="pill-item searchMenu-guests form-select-guests js-form-dd">
                                                <div data-x-dd-click="searchMenu-guests">
                                                    <h4>عدد الاشخاص</h4>
                                                    <div class="val">
                                                        @php
                                                            $adults = request()->query('adults',1);
                                                            $children = request()->query('children',0);
                                                        @endphp
                                                        <div class="render">
                                                            <span class="adults">
                                                                <span class="one @if($adults >1) d-none @endif">{{__('1 Adult')}}</span>
                                                                <span class="@if($adults <= 1) d-none @endif multi" data-html="{{__(':count Adults')}}">{{__(':count Adults',['count'=>request()->query('adults',1)])}}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Standard Guests Dropdown (Hidden until click) --}}
                                                <div class="searchMenu-guests__field select-guests-dropdown shadow-2" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                                                    <div class="bg-white px-30 py-30 rounded-4">
                                                        <div class="row y-gap-10 justify-between items-center">
                                                            <div class="col-auto"><div class="text-15 fw-500">{{ __('Adults') }}</div></div>
                                                            <div class="col-auto">
                                                                <div class="d-flex items-center">
                                                                    <span class="button -outline-blue-1 text-blue-1 size-38 rounded-4 btn-minus" data-input="adults"><i class="icon-minus text-12"></i></span>
                                                                    <span class="flex-center size-20 ml-15 mr-15 count-display"><input type="number" name="adults" value="{{request()->query('adults',1)}}" min="1"></span>
                                                                    <span class="button -outline-blue-1 text-blue-1 size-38 rounded-4 btn-add" data-input="adults"><i class="icon-plus text-12"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="border-top-light mt-24 mb-24"></div>
                                                        <div class="row y-gap-10 justify-between items-center">
                                                            <div class="col-auto"><div class="text-15 fw-500">{{ __('Children') }}</div></div>
                                                            <div class="col-auto">
                                                                <div class="d-flex items-center">
                                                                    <span class="button -outline-blue-1 text-blue-1 size-38 rounded-4 btn-minus" data-input="children"><i class="icon-minus text-12"></i></span>
                                                                    <span class="flex-center size-20 ml-15 mr-15 count-display"><input type="number" name="children" value="{{request()->query('children',0)}}" min="0"></span>
                                                                    <span class="button -outline-blue-1 text-blue-1 size-38 rounded-4 btn-add" data-input="children"><i class="icon-plus text-12"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
