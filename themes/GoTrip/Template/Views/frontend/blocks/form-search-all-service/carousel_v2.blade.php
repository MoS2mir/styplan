<section data-anim-wrap class="masthead -type-2" style="height: 732px !important; min-height: 732px !important; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px; overflow: visible !important; position: relative;">
    <div class="masthead__bg bg-dark-3" style="height: 100%; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px; overflow: hidden;">
        <img src="{{ $bg_image_url }}" alt="image" data-src="{{ $bg_image_url }}" class="js-lazy" style="height: 100%; width: 100%; object-fit: cover; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px;">
    </div>
    <div class="container">


        <style>
            .search-pill-container {
                position: relative;
                z-index: 100 !important;
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
                flex: 2.2 !important; /* Increase space for the two dates */
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
                padding: 0 10px; /* Reduced padding to save horizontal space */
                border-left: 1px solid #E5E7EB;
                cursor: pointer;
                position: relative;
            }
            .searchMenu-loc {
                flex: 0.8 !important; /* Shrink Category as requested */
            }
            .searchMenu-guests {
                flex: 0.8 !important; /* Shrink Guests as requested */
            }
            .pill-item:last-child {
                border-left: none;
            }
            .pill-item h4 {
                font-family: 'Inter', sans-serif !important;
                font-weight: 500 !important;
                font-size: 16px !important;
                line-height: 100% !important;
                letter-spacing: 0% !important;
                text-align: center !important;
                color: #00000080 !important;
                margin: 0 !important;
                display: flex;
                align-items: center;
                gap: 15px;
                justify-content: center;
            }
            /* Styling for the dropdown icons in the header */
            .pill-item h4 i {
                font-size: 18px;
                color: #5E6D77;
                opacity: 0.7;
                font-weight: 900 !important;
            }
            .pill-item .val {
                display: none !important;
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

            /* Custom StayPlan Search Dropdown */
            .stayplan-search-dropdown {
                position: absolute !important;
                top: 100% !important;
                right: 0 !important;
                background: white !important;
                border-radius: 35px !important;
                padding: 0 !important;
                overflow: hidden !important;
                width: 320px !important;
                border: 1px solid #eee !important;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
                z-index: 9999 !important;
                display: none;
            }
            .stayplan-search-dropdown.-is-active {
                display: block !important;
            }
            .stayplan-search-header {
                padding: 25px 20px 15px 20px;
                text-align: center;
            }
            .stayplan-search-header h5 {
                font-size: 22px !important;
                font-weight: 900 !important;
                color: #1a2332 !important;
                margin-bottom: 15px !important;
            }
            .stayplan-search-separator {
                height: 1px;
                background: #eee;
                width: 70%;
                margin: 0 auto;
            }
            .stayplan-search-list {
                display: flex;
                flex-direction: column;
            }
            .stayplan-search-item {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                padding: 20px 30px !important;
                border-bottom: 1px solid #f0f0f0 !important;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none !important;
            }
            .stayplan-search-item:last-child {
                border-bottom: none !important;
            }
            .stayplan-search-item:hover {
                background: #f8fafc !important;
            }
            .stayplan-search-item .item-text {
                font-size: 18px !important;
                font-weight: 700 !important;
                color: #1a2332 !important;
                flex: 1;
                text-align: right;
            }
            .stayplan-search-item .item-icon {
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: transparent;
                margin-left: 0;
                margin-right: 15px;
            }
            .stayplan-search-item .item-icon i {
                font-size: 28px;
                color: #1a2332;
            }
            
            /* Custom StayPlan Guests Dropdown Styling */
            .stayplan-guests-dropdown {
                position: absolute;
                top: 100%;
                left: 0;
                width: 280px;
                background: white;
                border-radius: 30px;
                box-shadow: 0 15px 40px rgba(0,0,0,0.15);
                z-index: 1000;
                padding: 25px 0 10px 0;
                display: none;
                margin-top: 15px;
                overflow: hidden;
            }
            .stayplan-guests-dropdown.-is-active {
                display: block !important;
            }
            .stayplan-guests-header {
                padding: 0 25px 15px 25px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 15px;
            }
            .stayplan-guests-header h5 {
                font-size: 18px;
                font-weight: 800;
                color: #1a2332;
                margin: 0;
            }
            .stayplan-guests-header i {
                font-size: 22px;
                color: #1a2332;
            }
            .stayplan-guests-separator {
                height: 1px;
                background: #eee;
                margin: 0 25px 10px 25px;
            }
            .stayplan-guests-item {
                padding: 15px 25px;
                text-align: center;
                font-size: 18px;
                font-weight: 700;
                color: #1a2332;
                cursor: pointer;
                transition: all 0.2s ease;
                border-top: 1px solid #f0f0f0;
            }
            .stayplan-guests-item:first-child {
                border-top: none;
            }
            .stayplan-guests-item:hover {
                background: #f8fafc;
            }
            .stayplan-guests-item.active {
                background: #f1f5f9;
            }
            
            /* Hide default shadow if active */
            .searchMenu-loc__field.shadow-2 {
                box-shadow: none !important;
            }

            /* Custom StayPlan Daterangepicker Styling - Final Fixes */
            .daterangepicker {
                border-radius: 30px !important;
                border: 1px solid #f0f0f0 !important;
                box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important;
                padding: 30px !important;
                font-family: 'Tajawal', sans-serif !important;
                width: 467px !important;
                height: 413px !important;
                direction: rtl !important;
                margin-top: 15px !important;
                background: #fff !important;
                display: none;
            }
            .daterangepicker:before, .daterangepicker:after {
                display: none !important;
            }

            /* Force SINGLE calendar layout and hide second month */
            .daterangepicker .drp-calendar.right {
                display: none !important;
            }
            .daterangepicker .drp-calendar.left {
                width: 100% !important;
                max-width: none !important;
                padding: 0 !important;
                margin: 0 !important;
                float: none !important;
                display: block !important;
            }
            .daterangepicker .calendar-table {
                background: transparent !important;
                border: none !important;
                padding: 0 !important;
            }
            .daterangepicker .calendar-table table {
                width: 100% !important;
                table-layout: fixed !important; /* Forces 7 columns to be equal and visible */
                border-spacing: 0 !important;
                border-collapse: collapse !important;
            }
            .daterangepicker .calendar-table th, .daterangepicker .calendar-table td {
                font-family: 'Tajawal', sans-serif !important;
                font-weight: 600 !important;
                font-size: 15px !important;
                color: #1a2332 !important;
                border: none !important;
                height: 45px !important;
                line-height: 45px !important;
                text-align: center !important;
                vertical-align: middle !important;
                padding: 0 !important;
            }

            /* Month and Year Header */
            .daterangepicker th.month {
                font-size: 20px !important;
                font-weight: 800 !important;
                color: #1a2332 !important;
                padding: 0 0 20px 0 !important;
                width: 100% !important;
            }

            /* Arrows Design */
            .daterangepicker .calendar-table .prev, 
            .daterangepicker .calendar-table .next {
                background: #ffffff !important;
                background-image: none !important; /* Hide library default background */
                border: 1px solid #f0f0f0 !important;
                box-shadow: 0 4px 10px rgba(0,0,0,0.05) !important;
                width: 40px !important;
                height: 40px !important;
                border-radius: 50% !important;
                cursor: pointer !important;
                position: relative !important;
            }
            .daterangepicker .calendar-table .prev:after, 
            .daterangepicker .calendar-table .next:after,
            .daterangepicker .calendar-table .prev:before,
            .daterangepicker .calendar-table .next:before {
                display: none !important;
                content: none !important;
            }
            .daterangepicker .calendar-table .prev span, 
            .daterangepicker .calendar-table .next span {
                border-color: #1a2332 !important;
                border-width: 0 2.5px 2.5px 0 !important;
                padding: 4px !important;
                display: block !important;
                position: absolute !important;
                top: 50% !important;
                left: 50% !important;
                background: none !important;
                color: transparent !important;
            }
            .daterangepicker .calendar-table .prev span {
                transform: translate(-70%, -50%) rotate(-45deg) !important;
            }
            .daterangepicker .calendar-table .next span {
                transform: translate(-30%, -50%) rotate(135deg) !important;
            }

            /* Days Headers */
            .daterangepicker thead tr:last-child {
                border-top: 1px solid #eee !important;
            }
            .daterangepicker thead tr:last-child th {
                padding: 15px 0 !important;
                color: #1a2332 !important;
                font-weight: 700 !important;
                font-size: 14px !important;
            }

            /* Day Cells Interaction */
            .daterangepicker td.available:hover {
                background-color: #f8fafc !important;
                border-radius: 50% !important;
            }
            .daterangepicker td.active, .daterangepicker td.active:hover {
                background-color: #1a2332 !important;
                color: #fff !important;
                border-radius: 50% !important;
            }
            .daterangepicker td.off {
                color: #cbd5e0 !important;
                opacity: 0.5;
            }
            .daterangepicker td.in-range {
                background-color: #f1f5f9 !important;
                border-radius: 0 !important;
            }

            @media (max-width: 767px) {
                .daterangepicker {
                    width: 320px !important;
                    min-width: 320px !important;
                    height: auto !important;
                    padding: 20px !important;
                    flex-direction: column !important;
                }
                .daterangepicker .drp-calendar {
                    width: 100% !important;
                }
                .daterangepicker .calendar-table th, .daterangepicker .calendar-table td {
                    width: 38px !important;
                    height: 38px !important;
                    line-height: 38px !important;
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
                                <img src="{{ $img }}" alt="image" style="{{ $img_style }}">
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
                                <form action="{{ route('space.search') }}" method="get" class="w-100">
                                    <div class="search-pill-inner">
                                        {{-- Search Button (Rightmost in RTL) --}}
                                        <button class="pill-submit-btn" type="submit">
                                            <i class="icon-search"></i>
                                        </button>

                                            <div class="pill-items-row">
                                                {{-- تاريخ الوصول (Arrival) --}}
                                                <div class="pill-item searchMenu-date form-date-search is_single_picker">
                                                    <div class="date-wrapper" data-x-dd-click="searchMenu-date">
                                                        <h4>
                                                            <i class="fa fa-angle-down"></i>
                                                            تاريخ الوصول
                                                        </h4>
                                                        <div class="val js-first-date render check-in-render" style="display:none !important;">{{Request::query('start',display_date(strtotime("today")))}}</div>
                                                    </div>
                                                    <input type="hidden" class="check-in-input" value="" name="start">
                                                    <input type="text" class="check-in-out absolute invisible" name="date_start" value="">
                                                </div>

                                                {{-- تاريخ المغادرة (Departure) --}}
                                                <div class="pill-item searchMenu-date form-date-search is_single_picker">
                                                    <div class="date-wrapper" data-x-dd-click="searchMenu-date">
                                                        <h4>
                                                            <i class="fa fa-angle-down"></i>
                                                            تاريخ المغادرة
                                                        </h4>
                                                        <div class="val js-last-date render check-out-render" style="display:none !important;">{{Request::query('end',display_date(strtotime("+1 day")))}}</div>
                                                    </div>
                                                    <input type="hidden" class="check-out-input" value="" name="end">
                                                    <input type="text" class="check-in-out absolute invisible" name="date_end" value="">
                                                </div>
                                            </div>

                                            {{-- التصنيف (Category/Location) --}}
                                            <div class="pill-item searchMenu-loc js-form-dd js-liverSearch">
                                                <div data-x-dd-click="searchMenu-loc">
                                                    <h4>
                                                        <i class="fa fa-angle-down"></i>
                                                        التصنيف
                                                    </h4>
                                                    <div class="val" style="display:none !important;">
                                                        <input type="hidden" name="terms[]" class="js-search-get-id" value="">
                                                        <input type="text" autocomplete="off" readonly class="parent_text js-search js-dd-focus" style="border:none; padding:0; background:transparent; font-size:14px; color:#5E6D77; width:100%;" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="searchMenu-loc__field shadow-2 js-liverSearch-drop-down stayplan-search-dropdown" data-x-dd="searchMenu-loc" data-x-dd-toggle="-is-active">
                                                    <div class="stayplan-search-header">
                                                        <h5>التصنيفات</h5>
                                                        <div class="stayplan-search-separator"></div>
                                                    </div>
                                                    <div class="stayplan-search-list js-results">
                                                        @php
                                                            $categoryAttr = \Modules\Core\Models\Attributes::with('terms')->find(3);
                                                            $terms = $categoryAttr ? $categoryAttr->terms : [];
                                                            
                                                            $iconMap = [
                                                                'شقق' => 'fa-house-user',
                                                                'بيوت' => 'fa-house-user',
                                                                'مخيم' => 'fa-campground',
                                                                'مزارع' => 'fa-tractor',
                                                                'مزرعة' => 'fa-tractor',
                                                                'استراحات' => 'fa-swimming-pool',
                                                                'شاليه' => 'fa-swimming-pool'
                                                            ];
                                                        @endphp
                                                        @foreach($terms as $term)
                                                            @php
                                                                $icon = 'fa-home'; // Default
                                                                foreach($iconMap as $key => $val) {
                                                                    if(strpos($term->name, $key) !== false) {
                                                                        $icon = $val;
                                                                        break;
                                                                    }
                                                                }
                                                            @endphp
                                                            <div class="stayplan-search-item" onclick="document.querySelector('input[name=\'terms[]\']').value = '{{$term->id}}'; document.querySelector('.parent_text').value = '{{$term->name}}';">
                                                                <div class="item-text">{{$term->name}}</div>
                                                                <div class="item-icon">
                                                                    <i class="fa {{$icon}}"></i>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- عدد الاشخاص (Guests) --}}
                                            <div class="pill-item searchMenu-guests js-form-dd">
                                                <div data-x-dd-click="searchMenu-guests">
                                                    <h4>
                                                        <i class="fa fa-angle-down"></i>
                                                        عدد الاشخاص
                                                    </h4>
                                                    <div class="val" style="display:none !important;">
                                                        @php
                                                            $adults = request()->query('adults',1);
                                                        @endphp
                                                        <input type="text" readonly class="js-search-adults-render" style="border:none; padding:0; background:transparent; font-size:14px; color:#5E6D77; width:100%; cursor:pointer;" value="">
                                                        <input type="hidden" name="adults" value="{{ $adults }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="stayplan-guests-dropdown js-guests-drop-down" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                                                    <div class="stayplan-guests-header">
                                                        <i class="fa fa-user"></i>
                                                        <h5>عدد الاشخاص</h5>
                                                    </div>
                                                    <div class="stayplan-guests-separator"></div>
                                                    <div class="stayplan-guests-list">
                                                        <div class="stayplan-guests-item" onclick="updateGuests(1, '1 بالغ')">1</div>
                                                        <div class="stayplan-guests-item" onclick="updateGuests(2, '2 بالغين')">2</div>
                                                        <div class="stayplan-guests-item" onclick="updateGuests(3, '3 بالغين')">3</div>
                                                        <div class="stayplan-guests-item" onclick="updateGuests(4, 'أكثر من 3')">أكثر من 3</div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Arabic Locale Configuration
        const arabicLocale = {
            "format": "YYYY-MM-DD",
            "applyLabel": "تطبيق",
            "cancelLabel": "إلغاء",
            "fromLabel": "من",
            "toLabel": "إلى",
            "customRangeLabel": "مخصص",
            "weekLabel": "أسبوع",
            "daysOfWeek": [
                "أحد",
                "إثنين",
                "ثلاثاء",
                "أربعاء",
                "خميس",
                "جمعة",
                "سبت"
            ],
            "monthNames": [
                "يناير",
                "فبراير",
                "مارس",
                "أبريل",
                "مايو",
                "يونيو",
                "يوليو",
                "أغسطس",
                "سبتمبر",
                "أكتوبر",
                "نوفمبر",
                "ديسمبر"
            ],
            "firstDay": 0
        };

        jQuery(function($) {
            // Re-initialize or Update existing pickers with Arabic locale
            $('.check-in-out').each(function() {
                const $el = $(this);
                if ($el.data('daterangepicker')) {
                    const picker = $el.data('daterangepicker');
                    picker.locale = $.extend(true, picker.locale, arabicLocale);
                    
                    // Set default date to today if value matches today
                    const todayStr = moment().format('YYYY-MM-DD');
                    const valStr = $el.val();
                    if(valStr === todayStr || !valStr) {
                        picker.setStartDate(moment());
                        picker.setEndDate(moment());
                    }
                    
                    picker.updateMonthsInView();
                }
            });

            $('.check-in-out').on('show.daterangepicker', function(ev, picker) {
                // Close any other open daterangepickers
                $('.check-in-out').not(this).each(function() {
                    const otherPicker = $(this).data('daterangepicker');
                    if (otherPicker && otherPicker.isShowing) {
                        otherPicker.hide();
                    }
                });
                
                // Also close the category dropdown if open
                $('.stayplan-search-dropdown').removeClass('-is-active');
                $('.js-form-dd').removeClass('-is-dd-wrap-active');
            });
            
            // Also close date pickers when category is clicked
            $('[data-x-dd-click="searchMenu-loc"]').on('click', function() {
                $('.check-in-out').each(function() {
                    if($(this).data('daterangepicker')) {
                        $(this).data('daterangepicker').hide();
                    }
                });
            });

            // Guests selection function
            window.updateGuests = function(count, text) {
                $('input[name="adults"]').val(count);
                $('.js-search-adults-render').val(text);
                $('.js-guests-drop-down').removeClass('-is-active');
            };
        });
    });
</script>
