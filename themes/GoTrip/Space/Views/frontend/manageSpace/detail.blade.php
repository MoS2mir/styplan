@extends('layouts.user')
@section('content')
    <link rel="stylesheet" href="{{ asset('themes/gotrip/css/stayplan.css') }}">
    <style>
        .stayplan-add-container { max-width: 900px; margin: 0 auto; padding: 20px; font-family: 'Tajawal', sans-serif; }
        .stayplan-banner { background: #1a2332; border-radius: 20px; padding: 40px 20px; text-align: center; position: relative; overflow: hidden; margin-bottom: 30px; min-height: 180px; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .stayplan-banner .logo-text { color: white; font-size: 32px; font-weight: 800; letter-spacing: 2px; margin-bottom: 5px; display: flex; align-items: center; gap: 10px; }
        .stayplan-banner .sub-text { color: #cbd5e0; font-size: 16px; font-weight: 500; }
        .stayplan-card { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; position: relative; z-index: 1; }
        .stayplan-card-title { text-align: center; font-size: 24px; font-weight: 700; color: #1a202c; margin-bottom: 30px; }
        .stayplan-input { width: 100%; border: 1px solid #cbd5e0; border-radius: 12px; padding: 15px 20px; font-size: 16px; text-align: center; transition: all 0.3s ease; }
        .stayplan-input:focus { border-color: #1a2332; box-shadow: 0 0 0 3px rgba(26, 35, 50, 0.1); outline: none; }
        .stayplan-separator { height: 1px; background: #e2e8f0; border: none; margin: 30px auto; width: 60%; }
        .stayplan-section-title { text-align: right; font-size: 20px; font-weight: 700; color: #1a202c; margin-bottom: 25px; }
        .stayplan-categories { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-bottom: 40px; }
        .stayplan-cat-card { width: 130px; cursor: pointer; text-align: center; transition: all 0.3s ease; }
        .stayplan-cat-img-wrapper { width: 130px; height: 100px; border-radius: 12px; overflow: hidden; margin-bottom: 10px; border: 3px solid transparent; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .stayplan-cat-card.active .stayplan-cat-img-wrapper { border-color: #1a2332; transform: translateY(-5px); }
        .stayplan-cat-img { width: 100%; height: 100%; object-fit: cover; }
        .stayplan-cat-name { font-size: 15px; font-weight: 700; color: #2d3748; }
        .stayplan-pagination { display: flex; justify-content: center; gap: 8px; margin-bottom: 40px; }
        .stayplan-dot { width: 8px; height: 8px; border-radius: 50%; background: #e2e8f0; }
        .stayplan-dot.active { background: #1a2332; width: 24px; border-radius: 4px; }
        .stayplan-nav-btns { display: flex; justify-content: center; gap: 20px; }
        .stayplan-btn { padding: 12px 60px; border-radius: 10px; font-size: 17px; font-weight: 700; transition: all 0.3s ease; border: none; cursor: pointer; }
        .stayplan-btn-next { background: #1a2332; color: white; }
        .stayplan-btn-prev { background: white; color: #1a2332; border: 1.5px solid #cbd5e0; }
        .stayplan-btn-next:hover { background: #2d3748; }
        .stayplan-banner .shape { position: absolute; opacity: 0.15; }
        .stayplan-banner .shape-1 { left: 20px; top: 20px; width: 80px; }
        .stayplan-banner .shape-2 { right: 20px; bottom: 20px; width: 100px; }
        
        /* Fix: Use visibility/height instead of display:none to allow Map initialization */
        .wizard-step { 
            visibility: hidden; 
            height: 0; 
            overflow: hidden; 
            opacity: 0; 
        }
        .wizard-step.active { 
            visibility: visible; 
            height: auto; 
            opacity: 1;
            overflow: visible;
        }

        /* Map styling for wizard */
        #step-2 .panel { border: none; box-shadow: none; margin-bottom: 0; background: transparent; width: 100%; }
        #step-2 .panel-title { display: none; }
        #step-2 .panel-body { 
            padding: 0; 
            width: 100%;
            display: block; /* Change to block for better compatibility */
        }
        #step-2 .form-group { 
            margin-bottom: 25px !important; 
            width: 100%;
            max-width: 650px;
            margin-left: auto !important;
            margin-right: auto !important;
            float: none !important; /* Prevent floating issues from core CSS */
            clear: both;
        }
        #step-2 .form-group > label { font-weight: 700; color: #1a202c; margin-bottom: 12px; display: block; text-align: center; width: 100%; }
        #step-2 .smart-search-location, #step-2 #customPlaceAddress { border-radius: 12px; padding: 12px 20px; border: 1px solid #cbd5e0; height: 50px; text-align: center; width: 100%; }
        
        #step-2 .control-map-group { 
            position: relative; 
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
            align-items: center;
        }
        #step-2 .bravo_searchbox { 
            position: relative !important; 
            top: auto !important; 
            left: auto !important; 
            right: auto !important; 
            width: 100% !important; 
            border-radius: 12px;
            height: 50px;
            border: 1px solid #cbd5e0;
            margin-bottom: 15px !important;
            text-align: center;
        }
        #step-2 #map_content { 
            height: 350px !important; 
            width: 100% !important;
            border-radius: 20px; 
            border: 1px solid #e2e8f0; 
            background-color: #f8fafc;
            background-image: linear-gradient(45deg, #f1f5f9 25%, #e2e8f0 25%, #e2e8f0 50%, #f1f5f9 50%, #f1f5f9 75%, #e2e8f0 75%, #e2e8f0 100%);
            background-size: 25px 25px;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.02);
            margin: 0 auto;
        }
        #step-2 #map_content::after {
            content: 'الخريطة التفاعلية ستظهر هنا';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #94a3b8;
            font-size: 16px;
            font-weight: 600;
        }
        #step-2 .g-control { display: none !important; }

        /* Step 3 & 4 styling */
        .stayplan-detail-form-group { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 30px; width: 100%; }
        .stayplan-detail-input { width: 100px; text-align: center; border: 1px solid #cbd5e0; border-radius: 12px; height: 45px; font-weight: 700; color: #1a2332; }
        .stayplan-detail-label { font-size: 16px; font-weight: 700; color: #2d3748; white-space: nowrap; }
        .stayplan-amenities-list { 
            display: flex; 
            flex-direction: column; 
            align-items: flex-start; /* Right alignment in RTL */
            gap: 15px; 
            width: 100%; 
            max-width: 650px; 
            margin: 0 auto; 
            padding-right: 40px;
        }
        .stayplan-amenity-item { 
            display: flex; 
            flex-direction: row; 
            align-items: center; 
            gap: 15px; 
            cursor: pointer; 
            user-select: none; 
            width: fit-content;
        }
        .stayplan-amenity-item input { display: none; }
        .stayplan-amenity-circle { order: 2; width: 22px; height: 22px; border-radius: 50%; border: 2px solid #cbd5e0; transition: all 0.3s ease; position: relative; }
        .stayplan-amenity-name { order: 1; font-size: 16px; font-weight: 600; color: #2d3748; text-align: right; }
        .stayplan-amenity-item input:checked + .stayplan-amenity-circle { background-color: #1a2332; border-color: #1a2332; }
        .stayplan-amenity-item input:checked + .stayplan-amenity-circle::after { content: ''; position: absolute; width: 6px; height: 6px; background: white; border-radius: 50%; top: 50%; left: 50%; transform: translate(-50%, -50%); }

        /* Step 4 Specific styling */
        .stayplan-bedroom-row { display: flex; align-items: center; justify-content: space-between; gap: 20px; width: 100%; max-width: 450px; margin: 0 auto 25px auto; }
        .stayplan-bedroom-label { font-size: 18px; font-weight: 700; color: #1a202c; text-align: right; flex: 1; }
        .stayplan-bedroom-input-wrapper { flex: 0 0 120px; }
        .stayplan-bedroom-input { width: 100px; height: 50px; border-radius: 15px; border: 1.5px solid #cbd5e0; text-align: center; font-size: 18px; font-weight: 700; color: #1a2332; transition: all 0.3s ease; }
        .stayplan-bedroom-input:focus { border-color: #1a2332; box-shadow: 0 0 0 4px rgba(26, 35, 50, 0.1); outline: none; }
        .stayplan-bedroom-input::placeholder { color: #cbd5e0; font-size: 14px; }

        /* Step 8 Specific styling: Image Upload */
        .stayplan-upload-box { 
            width: 100%; 
            max-width: 500px; 
            height: 220px; 
            background: #e2e8f0; 
            border-radius: 25px; 
            margin: 0 auto 25px auto; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            position: relative;
            cursor: pointer;
            overflow: hidden;
        }
        .stayplan-upload-icon-wrapper { position: relative; width: 80px; height: 80px; }
        .stayplan-upload-icon-main { font-size: 70px; color: #94a3b8; opacity: 0.6; }
        .stayplan-upload-icon-plus { 
            position: absolute; 
            bottom: 5px; 
            right: 5px; 
            background: #1a202c; 
            color: white; 
            width: 35px; 
            height: 35px; 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 24px; 
            border: 3px solid #e2e8f0;
        }
        .stayplan-upload-text { text-align: center; font-size: 15px; font-weight: 700; color: #1a202c; max-width: 400px; margin: 0 auto 30px auto; line-height: 1.6; }
        .stayplan-upload-list { width: 100%; max-width: 450px; margin: 0 auto; display: flex; flex-direction: column; gap: 20px; }
        .stayplan-upload-item { display: flex; align-items: center; justify-content: flex-end; gap: 20px; }
        .stayplan-upload-item-text { font-size: 15px; font-weight: 600; color: #4a5568; text-align: right; }
        .stayplan-upload-item-text b { color: #1a202c; font-weight: 800; }
        .stayplan-upload-item-icon { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #1a2332; }
        
        /* Integration with system upload */
        #step-8 .form-group-image, #step-8 .form-group-gallery { 
            margin-top: 20px; 
            text-align: center;
        }
        #step-8 .form-group-gallery .btn-field-upload { 
            width: 100%; 
            max-width: 500px; 
            height: 220px; 
            position: absolute; 
            top: 0; 
            left: 50%; 
            transform: translateX(-50%); 
            opacity: 0; 
            z-index: 10; 
        }
    </style>

    @if(!$row->id)
        <div class="stayplan-add-container">
            <form action="{{route('space.vendor.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post" id="stayplan-wizard-form">
                @csrf
                
                {{-- STEP 1: Basic Info & Category --}}
                <div class="wizard-step active" id="step-1">
                    <div class="stayplan-banner">
                        <div class="shape shape-1" style="background: rgba(255,255,255,0.1); width: 80px; height: 80px; border-radius: 20px; transform: rotate(45deg); top: -20px; left: -20px; position: absolute;"></div>
                        <div class="shape shape-2" style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 30px; transform: rotate(15deg); bottom: -30px; right: -20px; position: absolute;"></div>
                        <div class="logo-text">
                            <span style="font-family: sans-serif;">STAYPLAN</span>
                        </div>
                        <div class="sub-text">عرض عقارك صار اسهل - سجل و ابدأ التأجير</div>
                    </div>

                    <div class="stayplan-card">
                        <h2 class="stayplan-card-title">معلومات العقار</h2>
                        
                        <div class="stayplan-form-name">
                            <input type="text" name="title" class="stayplan-input" placeholder="ادخل اسم عقارك الذي سيظهر للضيوف" required>
                        </div>

                        <hr class="stayplan-separator">

                        <h3 class="stayplan-section-title">حدد التصنيف المناسب</h3>
                        
                        <div class="stayplan-categories">
                            @php
                                // Use attribute ID 3 as requested by the user for "Property Type"
                                $categoryAttr = \Modules\Core\Models\Attributes::with('terms')->find(3);
                                
                                $terms = $categoryAttr ? $categoryAttr->terms : [];
                                
                                // Mapping icons based on keywords in term name or term ID if needed
                                $iconMap = [
                                    'شقق' => 'cat_apartment.png',
                                    'بيوت' => 'cat_apartment.png',
                                    'مخيم' => 'cat_camp.png',
                                    'مزارع' => 'cat_farm.png',
                                    'مزرعة' => 'cat_farm.png',
                                    'استراحات' => 'cat_resort.png',
                                    'شاليه' => 'cat_resort.png'
                                ];
                            @endphp

                            @foreach($terms as $term)
                                @php 
                                    $img = 'cat_apartment.png'; // Default image if no match
                                    
                                    // Try to use the image uploaded for the term if it exists
                                    if(!empty($term->image_id)) {
                                        $img_url = get_file_url($term->image_id, 'full');
                                    } else {
                                        // Fallback to keyword mapping from iconMap
                                        foreach($iconMap as $key => $icon) {
                                            if(str_contains(mb_strtolower($term->name), mb_strtolower($key))) {
                                                $img = $icon;
                                                break;
                                            }
                                        }
                                        $img_url = asset('stayplan/'.$img);
                                    }
                                @endphp
                                <label class="stayplan-cat-card" onclick="selectCategory(this)">
                                    <input type="radio" name="terms[]" value="{{ $term->id }}" class="d-none has-value">
                                    <div class="stayplan-cat-img-wrapper">
                                        <img src="{{ $img_url }}" class="stayplan-cat-img" alt="{{ $term->name }}">
                                    </div>
                                    <div class="stayplan-cat-name">{{ $term->name }}</div>
                                </label>
                            @endforeach
                        </div>

                        <div class="stayplan-pagination">
                            <div class="stayplan-dot active"></div>
                            @for($i=0; $i<8; $i++) <div class="stayplan-dot"></div> @endfor
                        </div>

                        <div class="stayplan-nav-btns">
                            <button type="button" class="stayplan-btn stayplan-btn-prev" onclick="window.history.back()">السابق</button>
                            <button type="button" class="stayplan-btn stayplan-btn-next" onclick="nextStep(2)">التالي</button>
                        </div>
                    </div>
                </div>

                {{-- STEP 2: Location --}}
                <div class="wizard-step" id="step-2">
                    <div class="stayplan-banner">
                        <div class="shape shape-1" style="background: rgba(255,255,255,0.1); width: 80px; height: 80px; border-radius: 20px; transform: rotate(45deg); top: -20px; left: -20px; position: absolute;"></div>
                        <div class="shape shape-2" style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 30px; transform: rotate(15deg); bottom: -30px; right: -20px; position: absolute;"></div>
                        <div class="logo-text">
                            <span style="font-family: sans-serif;">STAYPLAN</span>
                        </div>
                        <div class="sub-text">عرض عقارك صار اسهل - سجل و ابدأ التأجير</div>
                    </div>

                    <div class="stayplan-card">
                        <h2 class="stayplan-card-title">عنوان عقارك</h2>
                        <h3 class="stayplan-section-title" style="text-align: center; margin-bottom: 20px;">حدد الموقع على الخريطة</h3>
                        
                        <div class="stayplan-location-step-content">
                            @include('Space::admin/space/location',["is_smart_search"=>"1"])
                        </div>

                        <div class="stayplan-pagination">
                            <div class="stayplan-dot"></div>
                            <div class="stayplan-dot active"></div>
                            @for($i=0; $i<7; $i++) <div class="stayplan-dot"></div> @endfor
                        </div>

                        <div class="stayplan-nav-btns mt-4">
                            <button type="button" class="stayplan-btn stayplan-btn-prev" onclick="nextStep(1)">السابق</button>
                            <button type="button" class="stayplan-btn stayplan-btn-next" onclick="nextStep(3)">التالي</button>
                        </div>
                    </div>
                </div>

                {{-- STEP 3: Property Details & Amenities (ID 4) --}}
                <div class="wizard-step" id="step-3">
                    <div class="stayplan-banner">
                        <div class="shape shape-1" style="background: rgba(255,255,255,0.1); width: 80px; height: 80px; border-radius: 20px; transform: rotate(45deg); top: -20px; left: -20px; position: absolute;"></div>
                        <div class="shape shape-2" style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 30px; transform: rotate(15deg); bottom: -30px; right: -20px; position: absolute;"></div>
                        <div class="logo-text">
                            <span style="font-family: sans-serif;">STAYPLAN</span>
                        </div>
                        <div class="sub-text">عرض عقارك صار اسهل - سجل و ابدأ التأجير</div>
                    </div>

                    <div class="stayplan-card">
                        <h2 class="stayplan-card-title">تفاصيل المساحة</h2>
                        
                        <h3 class="stayplan-section-title" style="text-align: center; margin-bottom: 10px;">مساحة عقارك</h3>
                        <div class="stayplan-detail-form-group">
                            <input type="number" name="square" class="stayplan-detail-input" placeholder="200" value="{{$row->square}}">
                            <span class="stayplan-detail-label">متر مربع</span>
                        </div>

                        <hr class="stayplan-separator">

                        <h3 class="stayplan-section-title" style="text-align: center; margin-bottom: 25px;">مرافق عقارك الرئيسية</h3>
                        
                        <div class="stayplan-amenities-list">
                            @php
                                $amenitiesAttr = \Modules\Core\Models\Attributes::with('terms')->find(4);
                                $amenities = $amenitiesAttr ? $amenitiesAttr->terms : [];
                            @endphp
                            @foreach($amenities as $term)
                                <label class="stayplan-amenity-item">
                                    <span class="stayplan-amenity-name">{{ $term->name }}</span>
                                    <input type="checkbox" name="terms[]" value="{{ $term->id }}" @if(!empty($selected_terms) and $selected_terms->contains($term->id)) checked @endif>
                                    <span class="stayplan-amenity-circle"></span>
                                </label>
                            @endforeach
                        </div>

                        <div class="stayplan-pagination">
                            <div class="stayplan-dot"></div>
                            <div class="stayplan-dot active"></div>
                            @for($i=0; $i<8; $i++) <div class="stayplan-dot"></div> @endfor
                        </div>

                        <div class="stayplan-nav-btns mt-4">
                            <button type="button" class="stayplan-btn stayplan-btn-prev" onclick="nextStep(2)">السابق</button>
                            <button type="button" class="stayplan-btn stayplan-btn-next" onclick="nextStep(4)">التالي</button>
                        </div>
                    </div>
                </div>

                {{-- STEP 4: Bedroom Details --}}
                <div class="wizard-step" id="step-4">
                    <div class="stayplan-banner">
                        <div class="shape shape-1" style="background: rgba(255,255,255,0.1); width: 80px; height: 80px; border-radius: 20px; transform: rotate(45deg); top: -20px; left: -20px; position: absolute;"></div>
                        <div class="shape shape-2" style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 30px; transform: rotate(15deg); bottom: -30px; right: -20px; position: absolute;"></div>
                        <div class="logo-text">
                            <span style="font-family: sans-serif;">STAYPLAN</span>
                        </div>
                        <div class="sub-text">عرض عقارك صار اسهل - سجل و ابدأ التأجير</div>
                    </div>

                    <div class="stayplan-card">
                        <h2 class="stayplan-card-title">تفاصيل غرفة النوم</h2>
                        
                        <div class="stayplan-bedroom-row">
                            <div class="stayplan-bedroom-label">عدد غرف النوم</div>
                            <div class="stayplan-bedroom-input-wrapper">
                                <input type="number" name="bed" class="stayplan-bedroom-input" placeholder="3" value="{{$row->bed}}">
                            </div>
                        </div>

                        <div class="stayplan-bedroom-row">
                            <div class="stayplan-bedroom-label">عدد الاسرة المفردة</div>
                            <div class="stayplan-bedroom-input-wrapper">
                                <input type="number" name="single_bed" class="stayplan-bedroom-input" placeholder="2">
                            </div>
                        </div>

                        <div class="stayplan-bedroom-row">
                            <div class="stayplan-bedroom-label">عدد الاسرة الماستر</div>
                            <div class="stayplan-bedroom-input-wrapper">
                                <input type="text" name="master_bed" class="stayplan-bedroom-input" placeholder="لا يوجد">
                            </div>
                        </div>

                        <div class="stayplan-pagination">
                             @for($i=0; $i<3; $i++) <div class="stayplan-dot"></div> @endfor
                            <div class="stayplan-dot active"></div>
                            @for($i=0; $i<5; $i++) <div class="stayplan-dot"></div> @endfor
                        </div>

                        <div class="stayplan-nav-btns mt-4">
                            <button type="button" class="stayplan-btn stayplan-btn-prev" onclick="nextStep(3)">السابق</button>
                            <button type="button" class="stayplan-btn stayplan-btn-next" onclick="nextStep(5)">التالي</button>
                        </div>
                    </div>
                </div>

                {{-- STEP 5: Kitchen Details --}}
                <div class="wizard-step" id="step-5">
                    <div class="stayplan-banner">
                        <div class="shape shape-1" style="background: rgba(255,255,255,0.1); width: 80px; height: 80px; border-radius: 20px; transform: rotate(45deg); top: -20px; left: -20px; position: absolute;"></div>
                        <div class="shape shape-2" style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 30px; transform: rotate(15deg); bottom: -30px; right: -20px; position: absolute;"></div>
                        <div class="logo-text">
                            <span style="font-family: sans-serif;">STAYPLAN</span>
                        </div>
                        <div class="sub-text">عرض عقارك صار اسهل - سجل و ابدأ التأجير</div>
                    </div>

                    <div class="stayplan-card">
                        <h2 class="stayplan-card-title">تفاصيل المطابخ</h2>
                        
                        <div class="stayplan-counter-group">
                            <div class="stayplan-counter-label">عدد كراسي الطاولة</div>
                            <div class="stayplan-counter-controls">
                                <div class="stayplan-counter-btn" onclick="updateCounter('table_chairs', -1)">—</div>
                                <div class="stayplan-counter-value-box" id="table_chairs_display">لا يوجد</div>
                                <input type="hidden" name="table_chairs" id="table_chairs_input" value="0">
                                <div class="stayplan-counter-btn" onclick="updateCounter('table_chairs', 1)">+</div>
                            </div>
                        </div>

                        <hr class="stayplan-separator">

                        <h3 class="stayplan-section-title" style="text-align: center; margin-bottom: 25px;">مرافق المطبخ</h3>
                        
                        <div class="stayplan-amenities-list">
                            @php
                                $kitchenAttr = \Modules\Core\Models\Attributes::with('terms')->find(17);
                                $kitchenTerms = $kitchenAttr ? $kitchenAttr->terms : [];
                            @endphp
                            @foreach($kitchenTerms as $term)
                                <label class="stayplan-amenity-item">
                                    <span class="stayplan-amenity-name">{{ $term->name }}</span>
                                    <input type="checkbox" name="terms[]" value="{{ $term->id }}" @if(!empty($selected_terms) and $selected_terms->contains($term->id)) checked @endif>
                                    <span class="stayplan-amenity-circle"></span>
                                </label>
                            @endforeach
                        </div>

                        <div class="stayplan-pagination">
                             @for($i=0; $i<2; $i++) <div class="stayplan-dot"></div> @endfor
                            <div class="stayplan-dot active"></div>
                            @for($i=0; $i<6; $i++) <div class="stayplan-dot"></div> @endfor
                        </div>

                        <div class="stayplan-nav-btns mt-4">
                            <button type="button" class="stayplan-btn stayplan-btn-prev" onclick="nextStep(4)">السابق</button>
                            <button type="button" class="stayplan-btn stayplan-btn-next" onclick="nextStep(6)">التالي</button>
                        </div>
                    </div>
                </div>

                {{-- STEP 6: Bathroom Details --}}
                <div class="wizard-step" id="step-6">
                    <div class="stayplan-banner">
                        <div class="shape shape-1" style="background: rgba(255,255,255,0.1); width: 80px; height: 80px; border-radius: 20px; transform: rotate(45deg); top: -20px; left: -20px; position: absolute;"></div>
                        <div class="shape shape-2" style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 30px; transform: rotate(15deg); bottom: -30px; right: -20px; position: absolute;"></div>
                        <div class="logo-text">
                            <span style="font-family: sans-serif;">STAYPLAN</span>
                        </div>
                        <div class="sub-text">عرض عقارك صار اسهل - سجل و ابدأ التأجير</div>
                    </div>

                    <div class="stayplan-card">
                        <h2 class="stayplan-card-title">تفاصيل دورة المياه</h2>
                        
                        <div class="stayplan-counter-group">
                            <div class="stayplan-counter-label">عدد دورات المياه</div>
                            <div class="stayplan-counter-controls">
                                <div class="stayplan-counter-btn" onclick="updateCounter('bathroom', -1)">—</div>
                                <div class="stayplan-counter-value-box" id="bathroom_display">{{ $row->bathroom > 0 ? $row->bathroom : 'لا يوجد' }}</div>
                                <input type="hidden" name="bathroom" id="bathroom_input" value="{{ $row->bathroom ?? 0 }}">
                                <div class="stayplan-counter-btn" onclick="updateCounter('bathroom', 1)">+</div>
                            </div>
                        </div>

                        <hr class="stayplan-separator">

                        <h3 class="stayplan-section-title" style="text-align: center; margin-bottom: 25px;">مرافق دورة المياه</h3>
                        
                        <div class="stayplan-amenities-list">
                            @php
                                $bathroomAttr = \Modules\Core\Models\Attributes::with('terms')->find(18);
                                $bathroomTerms = $bathroomAttr ? $bathroomAttr->terms : [];
                            @endphp
                            @foreach($bathroomTerms as $term)
                                <label class="stayplan-amenity-item">
                                    <span class="stayplan-amenity-name">{{ $term->name }}</span>
                                    <input type="checkbox" name="terms[]" value="{{ $term->id }}" @if(!empty($selected_terms) and $selected_terms->contains($term->id)) checked @endif>
                                    <span class="stayplan-amenity-circle"></span>
                                </label>
                            @endforeach
                        </div>

                        <div class="stayplan-pagination">
                            @for($i=0; $i<5; $i++) <div class="stayplan-dot"></div> @endfor
                            <div class="stayplan-dot active"></div>
                            @for($i=0; $i<4; $i++) <div class="stayplan-dot"></div> @endfor
                        </div>

                        <div class="stayplan-nav-btns mt-4">
                            <button type="button" class="stayplan-btn stayplan-btn-prev" onclick="nextStep(5)">السابق</button>
                            <button type="button" class="stayplan-btn stayplan-btn-next" onclick="nextStep(7)">التالي</button>
                        </div>
                    </div>
                </div>

                {{-- STEP 7: Property Features --}}
                <div class="wizard-step" id="step-7">
                    <div class="stayplan-banner">
                        <div class="shape shape-1" style="background: rgba(255,255,255,0.1); width: 80px; height: 80px; border-radius: 20px; transform: rotate(45deg); top: -20px; left: -20px; position: absolute;"></div>
                        <div class="shape shape-2" style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 30px; transform: rotate(15deg); bottom: -30px; right: -20px; position: absolute;"></div>
                        <div class="logo-text">
                            <span style="font-family: sans-serif;">STAYPLAN</span>
                        </div>
                        <div class="sub-text">عرض عقارك صار اسهل - سجل و ابدأ التأجير</div>
                    </div>

                    <div class="stayplan-card">
                        <h2 class="stayplan-card-title">مميزات العقار</h2>
                        
                        <div class="stayplan-amenities-list">
                            @php
                                $featuresAttr = \Modules\Core\Models\Attributes::with('terms')->find(19);
                                $featuresTerms = $featuresAttr ? $featuresAttr->terms : [];
                            @endphp
                            @foreach($featuresTerms as $term)
                                <label class="stayplan-amenity-item">
                                    <span class="stayplan-amenity-name">{{ $term->name }}</span>
                                    <input type="checkbox" name="terms[]" value="{{ $term->id }}" @if(!empty($selected_terms) and $selected_terms->contains($term->id)) checked @endif>
                                    <span class="stayplan-amenity-circle"></span>
                                </label>
                            @endforeach
                        </div>

                        <div class="stayplan-pagination">
                            @for($i=0; $i<5; $i++) <div class="stayplan-dot"></div> @endfor
                            <div class="stayplan-dot active"></div>
                            @for($i=0; $i<3; $i++) <div class="stayplan-dot"></div> @endfor
                        </div>

                        <div class="stayplan-nav-btns mt-4">
                            <button type="button" class="stayplan-btn stayplan-btn-prev" onclick="nextStep(6)">السابق</button>
                            <button type="button" class="stayplan-btn stayplan-btn-next" onclick="nextStep(8)">التالي</button>
                        </div>
                    </div>
                </div>

                {{-- STEP 8: Image Upload --}}
                <div class="wizard-step" id="step-8">
                    <div class="stayplan-banner">
                        <div class="shape shape-1" style="background: rgba(255,255,255,0.1); width: 80px; height: 80px; border-radius: 20px; transform: rotate(45deg); top: -20px; left: -20px; position: absolute;"></div>
                        <div class="shape shape-2" style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 30px; transform: rotate(15deg); bottom: -30px; right: -20px; position: absolute;"></div>
                        <div class="logo-text">
                            <span style="font-family: sans-serif;">STAYPLAN</span>
                        </div>
                        <div class="sub-text">عرض عقارك صار اسهل - سجل و ابدأ التأجير</div>
                    </div>

                    <div class="stayplan-card">
                        <h2 class="stayplan-card-title">اضافة الصور</h2>
                        
                        <div class="stayplan-upload-box" onclick="document.querySelector('#step-8 .btn-field-upload').click()">
                            <div class="stayplan-upload-icon-wrapper">
                                <i class="fa fa-picture-o stayplan-upload-icon-main"></i>
                                <div class="stayplan-upload-icon-plus">+</div>
                            </div>
                            {{-- Mask system gallery upload for better UX --}}
                            <div class="form-group-gallery" style="opacity: 0; position: absolute; width: 100%; height: 100%;">
                                {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
                            </div>
                        </div>

                        <div class="stayplan-upload-text">
                            على حسب خياراتك اثناء التسجيل .. مطلوب منك رفع صورة واحدة لكل من الآتي :
                        </div>

                        <hr class="stayplan-separator" style="margin-bottom: 30px;">

                        <div class="stayplan-upload-list">
                            <div class="stayplan-upload-item">
                                <div class="stayplan-upload-item-text"><b>1 صورة</b> غرفة النوم</div>
                                <div class="stayplan-upload-item-icon"><i class="fa fa-bed"></i></div>
                            </div>
                            <div class="stayplan-upload-item">
                                <div class="stayplan-upload-item-text"><b>1 صورة</b> دورة مياه</div>
                                <div class="stayplan-upload-item-icon"><i class="fa fa-bath"></i></div>
                            </div>
                            <div class="stayplan-upload-item">
                                <div class="stayplan-upload-item-text"><b>1 صورة</b> للمطبخ</div>
                                <div class="stayplan-upload-item-icon"><i class="fa fa-cutlery"></i></div>
                            </div>
                            <div class="stayplan-upload-item">
                                <div class="stayplan-upload-item-text"><b>1 صورة</b> للمبنى</div>
                                <div class="stayplan-upload-item-icon"><i class="fa fa-building-o"></i></div>
                            </div>
                            <div class="stayplan-upload-item">
                                <div class="stayplan-upload-item-text"><b>5 صور</b> لمرافق و مميزات العقار</div>
                                <div class="stayplan-upload-item-icon"><i class="fa fa-star-o"></i></div>
                            </div>
                        </div>

                        <div class="stayplan-pagination">
                            @for($i=0; $i<6; $i++) <div class="stayplan-dot"></div> @endfor
                            <div class="stayplan-dot active"></div>
                            @for($i=0; $i<2; $i++) <div class="stayplan-dot"></div> @endfor
                        </div>

                        <div class="stayplan-nav-btns mt-4">
                            <button type="button" class="stayplan-btn stayplan-btn-prev" onclick="nextStep(7)">السابق</button>
                            <button type="button" class="stayplan-btn stayplan-btn-next" onclick="nextStep(9)">التالي</button>
                        </div>
                    </div>
                </div>

                {{-- STEP 9: Final Step - Rest of Information --}}
                <div class="wizard-step" id="step-9">
                    <div class="panel">
                        <div class="panel-title"><strong>{{__("Extra Information")}}</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('Space::admin/space/content')
                                </div>
                                <div class="col-md-12">
                                    @include('Space::admin/space/pricing')
                                </div>
                                <div class="col-md-12">
                                    {{-- Banner image can be set here if needed, gallery was in step 8 --}}
                                    <div class="form-group">
                                        <label class="control-label">{{__("Banner Image")}}</label>
                                        <div class="form-group-image">
                                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id) !!}
                                        </div>
                                    </div>
                                </div>
                                @if(is_default_lang())
                                    <div class="col-md-12">
                                        @include('Space::admin/space/attributes')
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="stayplan-nav-btns mt-4">
                        <button type="button" class="stayplan-btn stayplan-btn-prev" onclick="nextStep(8)">السابق</button>
                        <button type="submit" class="stayplan-btn stayplan-btn-next">حفظ العقار</button>
                    </div>
                </div>

            </form>
        </div>
    @else
        {{-- ORIGINAL EDIT LAYOUT --}}
        <div class="row y-gap-20 justify-between items-end pb-20 lg:pb-40 md:pb-20">
            <div class="col-auto">
                <h1 class="text-30 lh-14 fw-600">{{$row->id ? __('Edit: ').$row->title : __('Add new space')}}</h1>
            </div>
        </div>
        @include('admin.message')
        <div class="lang-content-box">
            <form action="{{route('space.vendor.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
                @csrf
                <div class="form-add-service">
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a data-bs-toggle="tab" data-bs-target="#nav-tour-content" aria-selected="true" class="active">{{__("1. Content")}}</a>
                        <a data-bs-toggle="tab" data-bs-target="#nav-tour-location" aria-selected="false">{{__("2. Locations")}}</a>
                        <a data-bs-toggle="tab" data-bs-target="#nav-tour-pricing" aria-selected="false">{{__("3. Pricing")}}</a>
                        @if(is_default_lang())
                            <a data-bs-toggle="tab" data-bs-target="#nav-attribute" aria-selected="false">{{__("4. Attributes")}}</a>
                        @endif
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-tour-content">
                            @include('Space::admin/space/content')
                        </div>
                        <div class="tab-pane fade" id="nav-tour-location">
                            @include('Space::admin/space/location',["is_smart_search"=>"1"])
                        </div>
                        <div class="tab-pane fade" id="nav-tour-pricing">
                            @include('Space::admin/space/pricing')
                        </div>
                        @if(is_default_lang())
                            <div class="tab-pane fade" id="nav-attribute">
                                @include('Space::admin/space/attributes')
                            </div>
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white" type="submit"><i class="fa fa-save mr-2"></i> {{__('Save Changes')}}</button>
                </div>
            </form>
        </div>
    @endif
@endsection

@push('js')
    <script>
        function selectCategory(el) {
            document.querySelectorAll('.stayplan-cat-card').forEach(card => card.classList.remove('active'));
            el.classList.add('active');
            el.querySelector('input').checked = true;
        }

        function nextStep(step) {
            if(step === 2 || step === 3 || step === 4 || step === 5 || step === 6 || step === 7 || step === 8 || step === 9) {
                const title = document.querySelector('input[name="title"]').value;
                if(!title) {
                    alert('يرجى إدخل اسم العقار أولاً');
                    return;
                }
                const cat = document.querySelector('input[name="terms[]"]:checked');
                if(!cat) {
                    alert('يرجى اختيار تصنيف العقار');
                    return;
                }
            }
            
            if(step === 3 || step === 4 || step === 5 || step === 6 || step === 7 || step === 8 || step === 9) {
                 const locationId = document.querySelector('input[name="location_id"]').value;
                 if(!locationId) {
                     alert('يرجى اختيار الموقع');
                     return;
                 }
            }

            document.querySelectorAll('.wizard-step').forEach(s => s.classList.remove('active'));
            document.getElementById('step-' + step).classList.add('active');
            
            // Trigger map resize when step 2 becomes active
            if(step === 2) {
                setTimeout(function(){
                    // Trigger dynamic resize for various map engines (Google, Leaflet, etc.)
                    window.dispatchEvent(new Event('resize'));
                    if(typeof engineMap !== 'undefined' && engineMap.map) {
                        google.maps.event.trigger(engineMap.map, 'resize');
                    }
                    // For OpenStreetMap/Leaflet if used
                    if(typeof map !== 'undefined' && map.invalidateSize) {
                        map.invalidateSize();
                    }
                }, 200);
            }
            
            window.scrollTo(0, 0);
        }

        function updateCounter(id, change) {
            const input = document.getElementById(id + '_input');
            const display = document.getElementById(id + '_display');
            let val = parseInt(input.value) + change;
            if(val < 0) val = 0;
            input.value = val;
            display.innerText = val === 0 ? 'لا يوجد' : val;
        }
    </script>
    <script type="text/javascript" src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/condition.js?_ver='.config('app.asset_version')) }}"></script>
    <script type="text/javascript" src="{{url('module/core/js/map-engine.js?_ver='.config('app.asset_version'))}}"></script>
    {!! App\Helpers\MapEngine::scripts() !!}
@endpush

