
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('themes/gotrip/dist/frontend/module/hotel/css/hotel.css?_ver=' . config('app.asset_version'))); ?>"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>" />
<?php $__env->stopPush(); ?>
<?php $disable_subscribe_default = true; ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_search bravo_search_hotel">

        <section class="layout-pt-md layout-pb-lg">
            <div class="container">
                <div class="row">
                    <div class="col-12 w-100">
                        <?php echo $__env->make('Hotel::frontend.layouts.search.custom-filter-box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="col-12 w-100">
                        <?php echo $__env->make('Hotel::frontend.layouts.search.list-item', ['layout' => $layout], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/filter.js?_ver=' . config('app.asset_version'))); ?>"></script>
    <script type="text/javascript"
        src="<?php echo e(asset('module/hotel/js/hotel.js?_ver=' . config('app.asset_version'))); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Hotel/Views/frontend/search.blade.php ENDPATH**/ ?>