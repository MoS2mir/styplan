
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('themes/gotrip/dist/frontend/module/tour/css/tour.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>"/>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_detail_tour bravo_detail">
        <?php echo $__env->make('Layout::parts.bc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="bravo_content">
            <?php $review_score = $row->review_data ?>
            <?php echo $__env->make('Tour::frontend.layouts.details.tour-detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <section>
                <div class="container">
                    <?php echo $__env->make('Layout::common.detail.review', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </section>

            <div class="container">
                <div class="mt-50 border-top-light"></div>
            </div>

            <?php echo $__env->make('Tour::frontend.layouts.details.tour-related', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <?php echo App\Helpers\MapEngine::scripts(); ?>

    <script>
        jQuery(function ($) {
            <?php if($row->map_lat && $row->map_lng): ?>
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [<?php echo e($row->map_lat); ?>, <?php echo e($row->map_lng); ?>],
                zoom:<?php echo e($row->map_zoom ?? "8"); ?>,
                ready: function (engineMap) {
                    engineMap.addMarker([<?php echo e($row->map_lat); ?>, <?php echo e($row->map_lng); ?>], {
                        icon_options: {
                            iconUrl:"<?php echo e(get_file_url(setting_item("tour_icon_marker_map"),'full') ?? url('images/icons/png/pin.png')); ?>"
                        }
                    });
                }
            });
            <?php endif; ?>
        })
    </script>
    <script>
        var bravo_booking_data = <?php echo json_encode($booking_data); ?>

        var bravo_booking_i18n = {
                no_date_select:'<?php echo e(__('Please select Start and End date')); ?>',
                no_guest_select:'<?php echo e(__('Please select at least one guest')); ?>',
                load_dates_url:'<?php echo e(route('tour.vendor.availability.loadDates')); ?>',
                name_required:'<?php echo e(__("Name is Required")); ?>',
                email_required:'<?php echo e(__("Email is Required")); ?>',
            };
    </script>
    <script type="text/javascript" src="<?php echo e(asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('module/tour/js/single-tour.js?_ver='.config('app.asset_version'))); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('themes/gotrip/module/tour/js/single-tour.js?_ver='.config('app.asset_version'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Tour/Views/frontend/detail.blade.php ENDPATH**/ ?>