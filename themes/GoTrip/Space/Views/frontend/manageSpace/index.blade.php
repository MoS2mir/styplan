@extends('layouts.user')
@section('content')
    <style>
        .property-container {
            background: #fff;
            border: 1px solid #1f2937;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 20px;
            direction: rtl;
            font-family: 'Tajawal', 'Cairo', sans-serif;
        }
        .property-table {
            width: 100%;
            border-collapse: collapse;
        }
        .property-table thead th {
            padding: 25px 20px;
            font-size: 26px;
            font-weight: 800;
            color: #000;
            text-align: center;
            border-bottom: 1px solid #000;
        }
        .property-table tbody td {
            padding: 25px 20px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #e5e7eb;
        }
        .property-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .property-name {
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
        }
        .view-link::after {
            content: ' ›';
            margin-right: 5px;
        }
        
        .status-badge {
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 18px;
            display: inline-block;
            min-width: 120px;
        }
        .status-publish { background-color: #dcfce7; color: #166534; }
        .status-draft { background-color: #fee2e2; color: #991b1b; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        
        .action-btn {
            background-color: #1f2937;
            color: #fff !important;
            padding: 10px 22px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 700;
            text-decoration: underline !important;
            margin: 0 5px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 90px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.2s;
        }
        .action-btn:hover {
            background-color: #374151;
            transform: translateY(-1px);
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
            
            @if($rows->total() > 0)
                <div class="property-container shadow-sm">
                    <table class="property-table">
                        <thead>
                            <tr>
                                <th style="width: 35%; text-align: right;">العقار</th>
                                <th style="width: 25%;">الحالة</th>
                                <th style="width: 40%;">الأجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td style="text-align: right;">
                                        <span class="property-name">{{$row->title}}</span>
                                        <a href="{{$row->getDetailUrl()}}" target="_blank" class="view-link">انقر هنا للعرض</a>
                                    </td>
                                    <td>
                                        @if($row->status == 'publish')
                                            <span class="status-badge status-publish">نشط</span>
                                        @elseif($row->status == 'draft')
                                            <span class="status-badge status-draft">غير نشط</span>
                                        @else
                                            <span class="status-badge status-pending">قيد المراجعة</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center flex-wrap" style="gap: 10px;">
                                            @if(Auth::user()->hasPermission('space_update'))
                                                <a href="{{ route("space.vendor.edit",[$row->id]) }}" class="action-btn">تعديل</a>
                                            @endif
                                            
                                            @if(Auth::user()->hasPermission('space_delete'))
                                                <a href="{{ route("space.vendor.delete",[$row->id]) }}" class="action-btn" data-confirm="{{__("هل تريد الحذف؟")}}">حذف</a>
                                            @endif

                                            @if($row->status == 'publish')
                                                <a href="{{ route("space.vendor.bulk_edit",[$row->id,'action' => "make-hide"]) }}" class="action-btn">تعطيل</a>
                                            @elseif($row->status == 'draft')
                                                <a href="{{ route("space.vendor.bulk_edit",[$row->id,'action' => "make-publish"]) }}" class="action-btn">تفعيل</a>
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
                    <h3 class="fw-700">{{__("لم يتم العثور على عقارات")}}</h3>
                    <p class="text-light-1 mt-10">{{__("ابدأ بإضافة عقارك الأول الآن")}}</p>
                    <a href="{{ route("space.vendor.create") }}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white mt-20 mx-auto">
                        {{__("Add Space")}}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

