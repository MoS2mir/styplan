@extends('layouts.user')

@push('css')
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Tajawal:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        .dashboard__main {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .custom-profile-wrapper {
            font-family: 'Tajawal', 'Cairo', sans-serif;
            padding: 40px 15px;
        }

        .btn-action {
            background-color: #1f2937;
            color: #fff;
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

        .btn-action:hover {
            background-color: #374151;
            color: #fff;
        }

        .btn-action i,
        .btn-action svg {
            margin-left: 10px;
        }

        .profile-input-card {
            border: 1px solid #777;
            border-radius: 14px;
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            max-width: 650px;
            margin: 0 auto 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            direction: rtl;
        }

        .profile-input-card .icon-pencil-container {
            color: #111;
            font-size: 22px;
        }

        .profile-input-card .input-info {
            flex-grow: 1;
            margin-right: 20px;
        }

        .profile-input-card label {
            font-size: 15px;
            color: #333;
            margin-bottom: 4px;
            display: block;
            text-align: right;
            font-family: 'Tajawal', 'Cairo', sans-serif;
        }

        .profile-input-card input {
            font-family: 'Tajawal', 'Cairo', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #000;
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            padding: 0;
            text-align: right;
        }

        .top-profile-card {
            border: 1px solid #ddd;
            border-radius: 14px;
            padding: 30px;
            background: #fff;
            max-width: 800px;
            margin: 0 auto 40px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        }
    </style>
@endpush

@section('content')
    <div class="custom-profile-wrapper" dir="rtl">
        @include('admin.message')

        <!-- Top Card -->
        <div class="top-profile-card text-center">
            <h2
                style="font-size: 28px; font-weight: 700; margin-bottom: 12px; color: #000; font-family: 'Tajawal', 'Cairo', sans-serif;">
                {{ old('first_name', $dataUser->first_name ?: $dataUser->user_name) }}
            </h2>
            <div style="font-size: 18px; font-weight: 600; color: #111; font-family: 'Tajawal', 'Cairo', sans-serif;">
                {{ old('email', $dataUser->email) }}
            </div>
        </div>

        <!-- Actions Row -->
        <div class="d-flex justify-content-center flex-wrap" style="gap: 15px; margin-bottom: 60px;">
            <a href="{{ route('user.profile.index') }}" class="btn-action">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                الملف الشخصي
            </a>
            <a href="{{ route('user.booking_history') }}" class="btn-action">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                حجوزاتي
            </a>
            <a href="{{ route('user.wishList.index') }}" class="btn-action">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                    <path
                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                    </path>
                </svg>
                مفضلتي
            </a>
            <a href="{{ url('/contact') }}" class="btn-action">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                    </path>
                </svg>
                تواصل معنا
            </a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();"
                class="btn-action">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                تسجيل خروج
            </a>
            <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>

        <!-- Title -->
        <h3 class="text-center"
            style="font-size: 24px; font-weight: 700; margin-bottom: 40px; color: #000; font-family: 'Tajawal', 'Cairo', sans-serif;">
            معلومات الملف الشخصي</h3>

        <!-- Inputs Form -->
        <form action="{{route('user.profile.update')}}" method="post">
            @csrf

            <input type="hidden" name="last_name" value="{{ old('last_name', $dataUser->last_name) }}">
            <input type="hidden" name="user_name" value="{{ old('user_name', $dataUser->user_name) }}">
            <input type="hidden" name="avatar_id" value="{{ old('avatar_id', $dataUser->avatar_id) }}">

            <div class="profile-input-card">
                <div class="icon-pencil-container">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                </div>
                <div class="input-info">
                    <label>الاسم</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $dataUser->first_name) }}" required>
                </div>
            </div>

            <div class="profile-input-card">
                <div class="icon-pencil-container">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                </div>
                <div class="input-info">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email', $dataUser->email) }}" required>
                </div>
            </div>

            <div class="profile-input-card">
                <div class="icon-pencil-container">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                </div>
                <div class="input-info">
                    <label>رقم الجوال</label>
                    <input type="text" name="phone" value="{{ old('phone', $dataUser->phone) }}">
                </div>
            </div>

            <div class="text-center mt-40">
                <button type="submit"
                    style="background-color: #1f2937; color: #fff; padding: 15px 50px; border-radius: 12px; font-family: 'Tajawal', 'Cairo', sans-serif; font-weight: 700; font-size: 18px; border: none; cursor: pointer; transition: background-color 0.3s ease;">
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
@endsection