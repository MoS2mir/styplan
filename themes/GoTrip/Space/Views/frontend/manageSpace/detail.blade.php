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
        
        /* Hide wizard steps by default */
        .wizard-step { display: none; }
        .wizard-step.active { display: block; }
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
                                // Try to find the attribute for Property Type
                                $categoryAttr = \Modules\Core\Models\Attributes::where('service', 'space')
                                    ->where(function($q){
                                        $q->where('name', 'LIKE', '%نوع العقار%')
                                          ->orWhere('name', 'LIKE', '%نوع المساحة%')
                                          ->orWhere('slug', 'property-type')
                                          ->orWhere('slug', 'space-type');
                                    })->with('terms')->first();
                                
                                $terms = $categoryAttr ? $categoryAttr->terms : [];
                                
                                // Mapping icons based on keywords in term name
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
                                    $img = 'cat_apartment.png'; // Default
                                    foreach($iconMap as $key => $icon) {
                                        if(str_contains($term->name, $key)) {
                                            $img = $icon;
                                            break;
                                        }
                                    }
                                @endphp
                                <label class="stayplan-cat-card" onclick="selectCategory(this)">
                                    <input type="radio" name="terms[]" value="{{ $term->id }}" class="d-none">
                                    <div class="stayplan-cat-img-wrapper">
                                        <img src="{{ asset('stayplan/'.$img) }}" class="stayplan-cat-img" alt="{{ $term->name }}">
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

                {{-- STEP 2: The rest of the original form (Hidden initially) --}}
                <div class="wizard-step" id="step-2">
                    <div class="panel">
                        <div class="panel-title"><strong>{{__("Extra Information")}}</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('Space::admin/space/content')
                                </div>
                                <div class="col-md-12">
                                    @include('Space::admin/space/location',["is_smart_search"=>"1"])
                                </div>
                                <div class="col-md-12">
                                    @include('Space::admin/space/pricing')
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
                        <button type="button" class="stayplan-btn stayplan-btn-prev" onclick="nextStep(1)">السابق</button>
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
            if(step === 2) {
                const title = document.querySelector('input[name="title"]').value;
                if(!title) {
                    alert('يرجى إدخال اسم العقار أولاً');
                    return;
                }
                const cat = document.querySelector('input[name="terms[]"]:checked');
                if(!cat) {
                    alert('يرجى اختيار تصنيف العقار');
                    return;
                }
            }
            document.querySelectorAll('.wizard-step').forEach(s => s.classList.remove('active'));
            document.getElementById('step-' + step).classList.add('active');
            window.scrollTo(0, 0);
        }
    </script>
    <script type="text/javascript" src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/condition.js?_ver='.config('app.asset_version')) }}"></script>
    <script type="text/javascript" src="{{url('module/core/js/map-engine.js?_ver='.config('app.asset_version'))}}"></script>
    {!! App\Helpers\MapEngine::scripts() !!}
@endpush

