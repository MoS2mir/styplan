
<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_detail bravo_detail_event">
        <?php echo $__env->make('Layout::parts.bc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('Layout::common.detail.gallery4',['galleries'=>$row->getGallery()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="bravo_content pt-40">
            <div class="container">
                <div class="row y-gap-30">
                    <div class="col-md-12 col-lg-8">
                        <?php echo $__env->make('Event::frontend.layouts.details.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <?php echo $__env->make('Event::frontend.layouts.details.form-book', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-40">
                            <?php echo $__env->make('Event::frontend.layouts.details.attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="border-top-light mt-40 mb-40"></div>
                        <?php echo $__env->make('Layout::map.detail.map',['class_container'=>'container-full'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php if($translation->faqs): ?>
                            <div class="py-40">
                                <?php echo $__env->make('Layout::common.detail.faq2',['faqs'=>$translation->faqs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="border-top-light py-40">
                <div class="container">
                    <?php echo $__env->make('Layout::common.detail.review', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <div class="container">
                <?php echo $__env->make('Event::frontend.layouts.details.related', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
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
                            iconUrl:"<?php echo e(get_file_url(setting_item("event_icon_marker_map"),'full') ?? url('images/icons/png/pin.png')); ?>"
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
            no_guest_select:'<?php echo e(__('Please select at least one number')); ?>',
            load_dates_url:'<?php echo e(route('event.vendor.availability.loadDates')); ?>'
        };
    </script>
    <script type="text/javascript" src="<?php echo e(asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset("libs/fotorama/fotorama.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset("libs/sticky/jquery.sticky.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('module/event/js/single-event.js?_ver='.config('app.asset_version'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Event/Views/frontend/detail.blade.php ENDPATH**/ ?>