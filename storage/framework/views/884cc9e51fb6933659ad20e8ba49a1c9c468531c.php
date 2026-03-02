<style>
    /* Custom Top Bar & Filter Styles */
    .custom-main-filter-container {
        font-family: 'Tajawal', 'Cairo', sans-serif;
        /* Arabic fonts fallback */
        margin-bottom: 40px;
    }

    .custom-top-search-bar {
        background-color: #dfdfdf;
        border-radius: 8px;
        border: 1px solid #d0d0d0;
        overflow: hidden;
        display: inline-flex;
    }

    .custom-search-field {
        display: flex;
        align-items: center;
        padding: 12px 25px;
        border-left: 2px solid #5a5a5a;
        /* Dark distinct separator */
        cursor: pointer;
        transition: background 0.2s;
        color: #6a6a6a;
    }

    .custom-search-field:last-child {
        border-left: none;
        /* remove for last item */
    }

    .custom-search-field:hover {
        background-color: #d4d4d4;
    }

    .custom-search-field span {
        font-size: 14px;
        margin-left: 8px;
        /* space between text and icon (RTL) */
        color: #444;
    }

    .custom-search-btn {
        background-color: #1b263b;
        /* Dark navy blue from image */
        color: white;
        border: none;
        padding: 0 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .custom-search-btn:hover {
        background-color: #0f1623;
    }

    .custom-search-btn svg {
        width: 18px;
        height: 18px;
        fill: white;
    }

    /* Filter Box Style */
    .custom-filter-box {
        width: 100%;
        max-width: 480px;
        border: 1px solid #ccc;
        border-radius: 12px;
        background-color: #fff;
        margin-top: 25px;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .custom-filter-header {
        text-align: center;
        padding: 15px 0;
        position: relative;
    }

    .custom-filter-header::after {
        content: "";
        display: block;
        width: 40%;
        height: 1px;
        background-color: #e0e0e0;
        margin: 10px auto 0 auto;
    }

    .custom-filter-header h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #111;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-filter-header h4 svg {
        margin-right: 8px;
        width: 16px;
        fill: #111;
    }

    .custom-filter-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .custom-filter-item {
        padding: 15px 20px;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: background 0.2s;
    }

    .custom-filter-item:hover {
        background-color: #fafafa;
    }

    .custom-filter-item:nth-child(odd) {
        border-left: 1px solid #ccc;
        /* Right side in RTL */
    }

    /* Remove bottom border for last row */
    .custom-filter-item:nth-last-child(1),
    .custom-filter-item:nth-last-child(2) {
        border-bottom: none;
    }

    .custom-filter-item span {
        font-size: 14px;
        color: #222;
        font-weight: 500;
    }

    .custom-filter-item svg {
        width: 12px;
        fill: #666;
    }
</style>

<div class="custom-main-filter-container d-flex flex-column align-items-center w-100" dir="rtl">

    <!-- Top Search Bar -->
    <div class="custom-top-search-bar flex-row-reverse">

        <div class="custom-search-field">
            <span>عدد الاشخاص</span>
            <svg viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z" />
            </svg>
        </div>

        <div class="custom-search-field">
            <span>التصنيف</span>
            <svg viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z" />
            </svg>
        </div>

        <div class="custom-search-field">
            <span>تاريخ المغادرة</span>
            <svg viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z" />
            </svg>
        </div>

        <div class="custom-search-field" style="border-left: none;">
            <span>تاريخ الوصول</span>
            <svg viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z" />
            </svg>
        </div>

        <button class="custom-search-btn border-right border-dark">
            <svg viewBox="0 0 24 24">
                <path
                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
            </svg>
        </button>

    </div>

    <!-- Filter Box -->
    <div class="custom-filter-box">
        <div class="custom-filter-header">
            <h4>
                <svg viewBox="0 0 24 24">
                    <path
                        d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z" />
                </svg>
                فلتر البحث
            </h4>
        </div>
        <div class="custom-filter-grid">

            <!-- Row 1 -->
            <div class="custom-filter-item">
                <span>عدد الغرف</span>
                <svg viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" />
                </svg>
            </div>
            <div class="custom-filter-item">
                <span>السعر</span>
                <svg viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" />
                </svg>
            </div>

            <!-- Row 2 -->
            <div class="custom-filter-item">
                <span>التصنيف</span>
                <svg viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" />
                </svg>
            </div>
            <div class="custom-filter-item">
                <span>التقييم</span>
                <svg viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" />
                </svg>
            </div>

            <!-- Row 3 -->
            <div class="custom-filter-item">
                <span>نوع السرير</span>
                <svg viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" />
                </svg>
            </div>
            <div class="custom-filter-item">
                <span>مرافق العقار</span>
                <svg viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" />
                </svg>
            </div>

            <!-- Row 4 -->
            <div class="custom-filter-item">
                <span>المدينة</span>
                <svg viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" />
                </svg>
            </div>
            <div class="custom-filter-item">
                <span>وسائل الراحة</span>
                <svg viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" />
                </svg>
            </div>

        </div>
    </div>

</div><?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Hotel/Views/frontend/layouts/search/custom-filter-box.blade.php ENDPATH**/ ?>