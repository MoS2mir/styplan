@if(Auth::user()->hasPermission('dashboard_vendor_access'))
    <style>
        .vendor-nav-pill {
            background-color: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
            margin: 0 auto 40px auto;
            direction: rtl;
        }

        .vendor-nav-pill a {
            padding: 15px 30px;
            color: #111;
            font-family: 'Tajawal', 'Cairo', sans-serif;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none !important;
            border-left: 1px solid #e5e7eb;
            position: relative;
            transition: all 0.3s ease;
        }

        .vendor-nav-pill a:last-child {
            border-left: none;
        }

        .vendor-nav-pill a:hover {
            background-color: #f9fafb;
        }

        .vendor-nav-pill a.active {
            color: #111;
        }

        .vendor-nav-pill a.active::after {
            content: '';
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 3px;
            background-color: #1f2937;
            border-radius: 2px;
        }

        .dashboard__sidebar {
            display: none !important;
        }

        .dashboard__main {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: auto !important;
            margin-right: auto !important;
            max-width: 1200px;
        }

        .dashboard__content {
            background-color: #f5f7f9 !important;
        }
    </style>

    <div class="text-center">
        <div class="vendor-nav-pill">
            <a href="{{ route('vendor.dashboard') }}"
                class="{{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">الصفحة الرئيسية</a>
            <a href="{{ route('space.vendor.index') }}"
                class="{{ request()->routeIs('space.vendor.index') ? 'active' : '' }}">إدارة العقارات</a>
            <a href="{{ route('space.vendor.create') }}"
                class="{{ request()->routeIs('space.vendor.create') ? 'active' : '' }}">إضافة عقار آخر</a>
            <a href="{{ route('vendor.bookingReport') }}"
                class="{{ request()->routeIs('vendor.bookingReport') ? 'active' : '' }}">الحجوزات</a>
            <a href="{{ route('vendor.reviewReport') }}" class="{{ request()->routeIs('vendor.reviewReport') ? 'active' : '' }}">التقييمات</a>
        </div>

        @if(request()->routeIs('vendor.dashboard') || request()->routeIs('space.vendor.create') || request()->routeIs('user.booking_history') || request()->routeIs('vendor.reviewReport') || request()->is('user/reviews'))
            <div class="d-flex justify-content-center flex-wrap" style="gap: 30px; margin-bottom: 40px; margin-top: -10px;">
                <!-- Card 3: Notifications -->
                <div class="bg-white text-center d-flex flex-column justify-content-center align-items-center"
                    style="width: 160px; height: 130px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.06); border: 1px solid #f3f4f6;">
                    <span class="mb-3"
                        style="font-size: 24px; font-weight: 800; color: #111;">{{ Auth::user()->unreadNotifications ? Auth::user()->unreadNotifications->count() : 0 }}</span>
                    <span
                        style="font-size: 15px; font-weight: 700; color: #000; font-family: 'Tajawal', 'Cairo', sans-serif;">الإشعارات</span>
                </div>

                <!-- Card 2: Spaces -->
                <div class="bg-white text-center d-flex flex-column justify-content-center align-items-center"
                    style="width: 160px; height: 130px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.06); border: 1px solid #f3f4f6;">
                    <span class="mb-3"
                        style="font-size: 24px; font-weight: 800; color: #111;">{{ \Modules\Space\Models\Space::where('status', 'publish')->where("create_user", Auth::id())->count('id') }}</span>
                    <span
                        style="font-size: 15px; font-weight: 700; color: #000; font-family: 'Tajawal', 'Cairo', sans-serif;">عدد
                        العقارات</span>
                </div>

                <!-- Card 1: Books -->
                <div class="bg-white text-center d-flex flex-column justify-content-center align-items-center"
                    style="width: 160px; height: 130px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.06); border: 1px solid #f3f4f6;">
                    <span class="mb-3"
                        style="font-size: 24px; font-weight: 800; color: #111;">{{ \Modules\Booking\Models\Booking::whereNotIn('status', \Modules\Booking\Models\Booking::$notAcceptedStatus)->where("vendor_id", Auth::id())->count('id') }}</span>
                    <span
                        style="font-size: 15px; font-weight: 700; color: #000; font-family: 'Tajawal', 'Cairo', sans-serif;">عدد
                        الحجوزات</span>
                </div>
            </div>
        @endif
    </div>
@else
    <div class="top-profile-card text-center">
        <h2
            style="font-size: 28px; font-weight: 700; margin-bottom: 12px; color: #000; font-family: 'Tajawal', 'Cairo', sans-serif;">
            {{ Auth::user()->display_name }}
        </h2>
        <div style="font-size: 18px; font-weight: 600; color: #111; font-family: 'Tajawal', 'Cairo', sans-serif;">
            {{ Auth::user()->email }}
        </div>
    </div>

    <div class="d-flex justify-content-center flex-wrap" style="gap: 15px; margin-bottom: 60px;">
        @php
            $currentUrl = url()->current();
            $menus = [
                [
                    'url' => route('user.profile.index'),
                    'title' => __("الملف الشخصي"),
                    'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>'
                ],
                [
                    'url' => route('user.booking_history'),
                    'title' => __("حجوزاتي"),
                    'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>'
                ],
                [
                    'url' => route('user.wishList.index'),
                    'title' => __("مفضلتي"),
                    'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>'
                ],
                [
                    'url' => route('user.contact'),
                    'title' => __("تواصل معنا"),
                    'icon_svg' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>'
                ],
            ];
        @endphp

        @foreach($menus as $menu)
            <a href="{{ $menu['url'] }}" class="btn-action {{ $currentUrl == $menu['url'] ? 'active' : '' }}">
                {!! $menu['icon_svg'] !!}
                {{ $menu['title'] }}
            </a>
        @endforeach

        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();"
            class="btn-action">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            {{ __("تسجيل خروج") }}
        </a>
        <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>

    <style>
        .top-profile-card {
            border: 1px solid #ddd;
            border-radius: 14px;
            padding: 30px;
            background: #fff;
            max-width: 800px;
            margin: 0 auto 40px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        }

        .btn-action {
            background-color: #1f2937;
            color: #fff !important;
            padding: 12px 24px;
            border-radius: 10px;
            font-family: 'Tajawal', 'Cairo', sans-serif;
            font-weight: 600;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            text-decoration: none !important;
            transition: all 0.3s ease;
        }

        .btn-action:hover,
        .btn-action.active {
            background-color: #374151;
            transform: translateY(-2px);
        }

        .btn-action svg {
            margin-left: 10px;
        }

        /* Global layout adjustments */
        .dashboard__sidebar {
            display: none !important;
        }

        .dashboard__main {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: auto !important;
            margin-right: auto !important;
            max-width: 1200px;
        }

        .dashboard__content {
            background-color: #f5f7f9 !important;
        }
    </style>
@endif