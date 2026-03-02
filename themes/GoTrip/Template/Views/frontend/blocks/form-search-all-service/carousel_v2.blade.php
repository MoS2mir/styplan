<section data-anim-wrap class="masthead -type-2 js-mouse-move-container" style="height: 732px !important; min-height: 732px !important; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px; overflow: hidden; position: relative;">
    <div class="masthead__bg bg-dark-3" style="height: 100%; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px; overflow: hidden;">
        <img src="{{ $bg_image_url }}" alt="image" data-src="{{ $bg_image_url }}" class="js-lazy" style="height: 100%; width: 100%; object-fit: cover; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px;">
    </div>
    <div class="container">


        <div class="masthead__content">
            <div class="row y-gap-40 items-center">
                {{-- Column 1 (Right in RTL): Images --}}
                <div class="col-xl-6">
                    <div class="masthead__images" style="position: relative; height: 100%; min-height: 600px; width: 100%;">
                        @foreach($list_slider as $item)
                            @php
                                $img = get_file_url($item['bg_image'],'full');
                                $img_style = "width: 192px; height: 199px; border-radius: 20px; object-fit: cover; box-shadow: 0 15px 35px rgba(0,0,0,0.25);";
                                $container_style = "position: absolute;";
                                
                                switch($loop->index) {
                                    case 0: $container_style .= " top: 0px; right: 10%; z-index: 1;"; break;
                                    case 1: $container_style .= " top: 100px; right: 45%; z-index: 2;"; break;
                                    case 2: $container_style .= " top: 220px; right: 0%; z-index: 3;"; break;
                                    case 3: $container_style .= " top: 320px; right: 35%; z-index: 4;"; break;
                                    default: $container_style .= " position: relative; margin: 10px; display: inline-block;"; break;
                                }
                            @endphp
                            <div data-anim-child="slide-up delay-6" style="{{ $container_style }}">
                                <img src="{{ $img }}" alt="image" class="js-mouse-move" data-move="30" style="{{ $img_style }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Column 2 (Left in RTL): Title and Search Form --}}
                <div class="col-xl-6 d-flex flex-column justify-center items-end text-right">
                    <div class="w-100 pl-20 lg:pl-0">
                        <h1 data-anim-child="slide-up delay-2" class="z-2 text-60 lg:text-40 md:text-30 text-white xl:pt-0" style="text-align: right;">
                            <span class="text-yellow-1">{{$title ?? ''}}</span>
                        </h1>
                        <p data-anim-child="slide-up delay-3" class="z-2 text-white mt-20" style="text-align: right;">{{$sub_title ?? ''}}</p>
                        @if(empty($hide_form_search))
                            <div data-anim-child="slide-up delay-4" class="mainSearch z-2 bg-white pr-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-4 shadow-1 mt-40" style="max-width: 550px; margin-right: 0; margin-left: auto;">
                                <div class="tabs__content js-tabs-content">
                                    @php $allServices = get_bookable_services(); $number = 0; @endphp
                                    @foreach($service_types as $service_type)
                                        @php if(empty($allServices[$service_type])) continue; @endphp
                                        <div class="tabs__pane -tab-item-{{$service_type}} @if($number == 0) is-tab-el-active @endif">
                                            @includeIf(ucfirst($service_type).'::frontend.layouts.search.form-search', ['style' => $style])
                                        </div>
                                        @php $number++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
