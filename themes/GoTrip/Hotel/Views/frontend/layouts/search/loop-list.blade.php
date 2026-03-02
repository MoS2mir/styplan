@php
    $translation = $row->translate();
    $lat = $row->map_lat ?? '23.885942';
    $lng = $row->map_lng ?? '45.079201';
    $static_map_url = "https://static-maps.yandex.ru/1.x/?ll=" . $lng . "," . $lat . "&z=12&l=map&size=200,200";
@endphp

<style>
    .custom-hotel-card {
        display: flex;
        flex-direction: row-reverse;
        background: #fff;
        border: 1px solid #dcdcdc;
        border-radius: 12px;
        overflow: hidden;
        height: 180px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
        transition: box-shadow 0.3s;
        margin-bottom: 20px;
        font-family: 'Tajawal', 'Cairo', sans-serif;
    }

    .custom-hotel-card:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
    }

    .chc-image {
        width: 280px;
        position: relative;
        background-size: cover;
        background-position: center;
    }

    .chc-wishlist {
        position: absolute;
        top: 15px;
        right: 15px;
        background: transparent;
        border: none;
        z-index: 2;
        cursor: pointer;
    }

    .chc-wishlist i.icon-heart {
        color: #fff;
        font-size: 22px;
        -webkit-text-stroke: 1.5px #111;
    }

    .chc-content {
        flex: 1;
        padding: 15px 25px;
        display: flex;
        flex-direction: column;
        text-align: right;
        direction: rtl;
        justify-content: space-between;
    }

    .chc-title-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        gap: 15px;
    }

    .chc-title {
        font-size: 18px;
        font-weight: 700;
        color: #111;
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .chc-location {
        font-size: 14px;
        color: #111;
        font-weight: 600;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chc-amenities {
        font-size: 13px;
        color: #111;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .chc-amenity-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chc-price-stars {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-top: auto;
    }

    .chc-price {
        font-size: 14px;
        font-weight: 700;
        color: #111;
    }

    .chc-price span {
        font-size: 16px;
    }

    .chc-stars {
        color: #ffd700;
        font-size: 14px;
        margin-top: 5px;
        letter-spacing: 2px;
    }

    .chc-map {
        width: 200px;
        border-right: 1px solid #dcdcdc;
        position: relative;
        background-size: cover;
        background-position: center;
        background-color: #f1f8fc;
        display: flex;
        align-items: flex-start;
        padding: 20px 15px;
    }

    .chc-map-link-inline {
        color: #2b70fa;
        background: transparent;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        .custom-hotel-card {
            flex-direction: column;
            height: auto;
        }

        .chc-image {
            width: 100%;
            height: 200px;
        }

        .chc-map {
            width: 100%;
            height: 120px;
            border-right: none;
            border-top: 1px solid #dcdcdc;
        }
    }
</style>

<div class="custom-hotel-card {{$wrap_class ?? ''}}">
    <!-- Right side: Map -->
    <div class="chc-map" style="background-image: url('{{ $static_map_url }}');">
        <a href="{{ $row->getDetailUrl() }}?_layout=map" style="position: absolute; inset: 0; z-index: 1;"></a>
    </div>

    <!-- Middle: Content -->
    <div class="chc-content">
        <div>
            <div class="chc-title-wrapper">
                <h3 class="chc-title">
                    <a href="{{ $row->getDetailUrl() }}" style="color: inherit;">{{ $translation->title }}</a>
                </h3>
                <a href="{{ $row->getDetailUrl() }}?_layout=map" class="chc-map-link-inline">
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 1L1 5L5 9" stroke="#2b70fa" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    عرض على الخريطة
                </a>
            </div>

            <div class="chc-location">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
                {{ !empty($row->location) ? $row->location->translate()->name : 'مكان غير محدد' }}
            </div>

            <div class="chc-amenities">
                <div class="chc-amenity-item">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                    <span>{{ $row->room_count ?? '1' }} غرفة</span>
                </div>

                <div class="chc-amenity-item">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>{{ $row->max_guests ?? '1' }} اشخاص</span>
                </div>
            </div>
        </div>

        <div class="chc-price-stars">
            <div class="chc-price">
                <span>{{ $row->display_price }}</span> - ليلة
            </div>
            <div class="chc-stars">
                @if($row->star_rate)
                    @for ($star = 1; $star <= $row->star_rate; $star++)
                        ★
                    @endfor
                @else
                    ★ ★ ★ ★ ☆
                @endif
            </div>
        </div>
    </div>

    <!-- Left side: Map -->



    <div class="chc-image" style="background-image: url('{{ $row->image_url ?? asset('images/default-hotel.jpg') }}');">
        <div class="service-wishlist {{$row->isWishList()}}" data-id="{{ $row->id }}" data-type="{{ $row->type }}">
            <div class="chc-wishlist">
                <i class="icon-heart"></i>
            </div>
        </div>
        <a href="{{ $row->getDetailUrl() }}" style="position: absolute; inset: 0; z-index: 1;"></a>
    </div>



</div>