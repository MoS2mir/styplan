@extends('layouts.user')
@section('content')
    <div class="bravo-user-dashboard pt-30">
        @include('admin.message')

        <style>
            .vendor-dashboard-card {
                background: #fff;
                border-radius: 16px;
                overflow: hidden;
            }

            .vendor-dashboard-card.reviews-card {
                border: 2px solid #3b82f6;
                /* Blue border */
            }

            .vendor-dashboard-card.bookings-card {
                border: 1px solid #e5e7eb;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            }

            .card-header-title {
                text-align: center;
                border-bottom: 1px solid #9ca3af;
                margin: 0 auto;
                width: 70%;
                padding-top: 25px;
                padding-bottom: 15px;
            }

            .card-header-title h3 {
                font-family: 'Tajawal', 'Cairo', sans-serif;
                font-size: 22px;
                font-weight: 800;
                color: #111;
                margin: 0;
            }

            /* Reviews list styles */
            .review-item {
                border-bottom: 1px solid #3b82f6;
                padding: 15px 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .review-item:last-child {
                border-bottom: none;
            }

            .review-prop-title {
                font-family: 'Tajawal', 'Cairo', sans-serif;
                font-weight: 700;
                font-size: 14px;
                color: #000;
                margin-bottom: 5px;
            }

            .review-stars {
                color: #fbbf24;
                font-size: 14px;
                margin-bottom: 8px;
            }

            .review-link {
                color: #3b82f6;
                font-size: 12px;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .review-meta {
                text-align: left;
            }

            .review-author {
                font-family: 'Tajawal', 'Cairo', sans-serif;
                font-weight: 700;
                font-size: 14px;
                color: #374151;
                margin-bottom: 5px;
            }

            .review-date {
                font-size: 13px;
                color: #6b7280;
            }

            /* Bookings table styles */
            .bookings-table {
                width: 100%;
                border-collapse: collapse;
            }

            .bookings-table th {
                font-family: 'Tajawal', 'Cairo', sans-serif;
                font-weight: 800;
                font-size: 16px;
                color: #111;
                text-align: center;
                padding: 20px 10px;
                border-bottom: 1px solid #9ca3af;
            }

            .bookings-table td {
                text-align: center;
                padding: 20px 10px;
                border-bottom: 1px solid #9ca3af;
                font-family: 'Tajawal', 'Cairo', sans-serif;
                font-size: 14px;
                font-weight: 700;
                color: #111;
                vertical-align: middle;
            }

            .bookings-table tr:last-child td {
                border-bottom: none;
            }

            .status-pill {
                display: inline-block;
                padding: 6px 16px;
                border-radius: 8px;
                font-weight: 700;
                font-size: 14px;
                min-width: 80px;
                text-align: center;
            }

            .status-confirmed,
            .status-paid,
            .status-completed {
                background-color: #bbf7d0;
                color: #166534;
            }

            .status-cancelled,
            .status-unpaid,
            .status-fail {
                background-color: #fecaca;
                color: #b91c1c;
            }

            .status-processing {
                background-color: #fef08a;
                color: #854d0e;
            }
        </style>

        <div class="row y-gap-30 pt-10">
            @php
                $recent_reviews = \Modules\Review\Models\Review::where('vendor_id', Auth::id())->orderBy('id', 'desc')->take(5)->get();
                $recent_bookings = \Modules\Booking\Models\Booking::where('vendor_id', Auth::id())->orderBy('id', 'desc')->take(5)->get();
            @endphp
            <!-- Reviews Card -->
            <div class="col-xl-6 col-md-6">
                <div class="vendor-dashboard-card reviews-card">
                    <div class="card-header-title">
                        <h3>التقييمات</h3>
                    </div>
                    <div class="reviews-list mt-10">
                        @forelse($recent_reviews as $review)
                            <div class="review-item" style="border-bottom: 1px solid #3b82f6;">
                                <div class="review-content">
                                    <div class="review-prop-title">{{ $review->service->title ?? '' }}</div>
                                    <div class="review-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rate_number)
                                                <i class="fa fa-star text-yellow-1"></i>
                                            @else
                                                <i class="fa fa-star text-light-2"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <a href="{{ url('/user/reviews') }}" class="review-link">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M15 18l-6-6 6-6" />
                                        </svg>
                                        انقر هنا للعرض
                                    </a>
                                </div>
                                <div class="review-meta">
                                    <div class="review-author">{{ $review->author->display_name ?? 'مستخدم' }}</div>
                                    <div class="review-date">
                                        {{ Carbon\Carbon::parse($review->created_at)->translatedFormat('j F Y') }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-40 text-light-1">لا توجد تقييمات بعد</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Bookings Card -->
            <div class="col-xl-6 col-md-6">
                <div class="vendor-dashboard-card bookings-card">
                    <div class="card-header-title">
                        <h3>الحجوزات الأخيرة</h3>
                    </div>
                    <div class="bookings-list mt-10">
                        <table class="bookings-table">
                            <thead>
                                <tr>
                                    <th>الحالة</th>
                                    <th>الوصول</th>
                                    <th>العميل</th>
                                    <th>العقار</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_bookings as $booking)
                                    @php
                                        $statusClass = 'status-processing';
                                        $statusText = booking_status_to_text($booking->status);
                                        if (in_array($booking->status, ['paid', 'completed', 'confirmed'])) {
                                            $statusClass = 'status-confirmed';
                                            $statusText = 'مؤكد';
                                        }
                                        if (in_array($booking->status, ['cancelled', 'cancel', 'fail', 'unpaid'])) {
                                            $statusClass = 'status-cancelled';
                                            $statusText = 'ملغي';
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="status-pill {{ $statusClass }}">
                                                {{ $statusText }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>{{ Carbon\Carbon::parse($booking->start_date)->translatedFormat('j F') }}</div>
                                            <div>{{ Carbon\Carbon::parse($booking->start_date)->translatedFormat('Y') }}</div>
                                        </td>
                                        <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                        <td>{{ $booking->service->title ?? '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-40 text-light-1">لا توجد حجوزات بعد</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="row pt-30 pb-60" style="margin-bottom: 60px;">
            <div class="col-12">
                <div class="vendor-dashboard-card bookings-card px-30 py-30" style="padding: 30px; height: 564px; display: flex; flex-direction: column;">
                    <div class="d-flex justify-content-end mb-20">
                        <h3 style="font-family: 'Tajawal', 'Cairo', sans-serif; font-size: 22px; font-weight: 800; color: #111; margin: 0;">إحصائيات الحجز</h3>
                    </div>
                    <div style="flex-grow: 1; position: relative;">
                        <canvas id="bookingStatsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

@php
    $chart_labels = [];
    $chart_data = [];
    for ($i = 5; $i >= 0; $i--) {
        $date = \Carbon\Carbon::now()->subMonths($i);
        $chart_labels[] = $date->translatedFormat('F');
        $count = \Modules\Booking\Models\Booking::where('vendor_id', Auth::id())
            ->whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->whereNotIn('status', \Modules\Booking\Models\Booking::$notAcceptedStatus)
            ->count();
        $chart_data[] = $count;
    }
@endphp

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset("libs/chart_js/Chart.min.js") }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('bookingStatsChart').getContext('2d');
            
            // gradient for the line
            var gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.2)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chart_labels) !!},
                    datasets: [{
                        label: 'إحصائيات الحجز',
                        data: {!! json_encode($chart_data) !!},
                        backgroundColor: gradient,
                        borderColor: '#3b82f6', // bright blue
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        fill: true,
                        // This makes the line curved
                        lineTension: 0.4 
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                fontFamily: "'Tajawal', 'Cairo', sans-serif",
                                fontColor: '#111',
                                fontSize: 15,
                                fontStyle: 'bold'
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                color: "#f3f4f6",
                                drawBorder: false,
                                zeroLineColor: "#f3f4f6"
                            },
                            ticks: {
                                display: false, // Hide y axis labels since in the image they aren't visible
                                beginAtZero: true
                            }
                        }]
                    },
                    tooltips: {
                        backgroundColor: '#1f2937',
                        titleFontFamily: "'Tajawal', 'Cairo', sans-serif",
                        bodyFontFamily: "'Tajawal', 'Cairo', sans-serif",
                        cornerRadius: 8,
                        xPadding: 15,
                        yPadding: 15
                    }
                }
            });
        });
    </script>
@endpush