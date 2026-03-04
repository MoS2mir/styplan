@extends('layouts.user')
@section('content')
    <style>
        .review-search-container {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
        }
        .review-search-wrap {
            position: relative;
            width: 100%;
            max-width: 600px;
        }
        .review-search-wrap input {
            width: 100%;
            padding: 12px 20px 12px 50px;
            border-radius: 50px;
            border: 1px solid #e5e7eb;
            font-size: 16px;
            direction: rtl;
            font-family: 'Tajawal', 'Cairo', sans-serif;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }
        .review-search-wrap .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }

        .review-report-container {
            background: #fff;
            border: 1px solid #1f2937;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 20px;
            direction: rtl;
            font-family: 'Tajawal', 'Cairo', sans-serif;
        }
        .review-table {
            width: 100%;
            border-collapse: collapse;
        }
        .review-table thead th {
            padding: 25px 20px;
            font-size: 26px;
            font-weight: 800;
            color: #000;
            text-align: center;
            border-bottom: 1px solid #000;
        }
        .review-table tbody td {
            padding: 25px 20px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #e5e7eb;
        }
        .review-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .property-info {
            text-align: right;
        }
        .property-title {
            font-size: 20px;
            font-weight: 800;
            color: #000;
            margin-bottom: 5px;
            display: block;
        }
        .view-link {
            font-size: 15px;
            color: #3b82f6;
            text-decoration: none !important;
            font-weight: 600;
            display: inline-block;
        }
        .view-link::after {
            content: ' ›';
            margin-right: 5px;
        }
        
        .customer-name {
            font-size: 18px;
            font-weight: 700;
            color: #000;
            line-height: 1.4;
        }
        
        .stars-wrap {
            color: #FFC107;
            font-size: 20px;
            display: flex;
            justify-content: center;
            gap: 2px;
        }
        .star-off {
            color: #E0E0E0;
        }

        .bravo-pagination {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            margin-bottom: 40px;
        }
    </style>

    <div class="row">
        <div class="col-12">
            @include('admin.message')

            <!-- Search Bar -->
            <form action="" method="get" class="review-search-container">
                <div class="review-search-wrap">
                    <input type="text" name="s" value="{{ request('s') }}" placeholder="البحث">
                    <i class="fa fa-search search-icon"></i>
                </div>
            </form>
            
            @if($rows->total() > 0)
                <div class="review-report-container shadow-sm">
                    <table class="review-table">
                        <thead>
                            <tr>
                                <th style="width: 30%;">العميل</th>
                                <th style="width: 30%;">التقييم</th>
                                <th style="width: 40%; text-align: right;">العقار</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $row)
                                @php 
                                    $service = $row->getService;
                                    $author = $row->author;
                                    $customer_name = $author->display_name ?? ($row->first_name . ' ' . $row->last_name);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="customer-name">
                                            {{ $customer_name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="stars-wrap">
                                            @for( $i = 0 ; $i < 5 ; $i++ )
                                                @if($i < $row->rate_number)
                                                    <i class="fa fa-star"></i>
                                                @else
                                                    <i class="fa fa-star star-off"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </td>
                                    <td>
                                        <div class="property-info">
                                            <span class="property-title">
                                                @if($service)
                                                    {{ $service->title }}
                                                @else
                                                    {{ __("[Deleted]") }}
                                                @endif
                                            </span>
                                            @if($service)
                                                <a href="{{ $service->getDetailUrl() }}" target="_blank" class="view-link">انقر هنا للعرض</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="bravo-pagination">
                    {{$rows->appends(request()->query())->links()}}
                </div>
            @else
                <div class="text-center py-50 bg-white rounded-4 shadow-3 mt-20" style="border: 1px solid #1f2937; border-radius: 20px;">
                    <h3 class="fw-700">{{__("لا يوجد تقييمات بعد")}}</h3>
                </div>
            @endif
        </div>
    </div>
@endsection
