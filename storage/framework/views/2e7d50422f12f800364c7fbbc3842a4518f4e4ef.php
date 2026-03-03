<?php echo $__env->make('Layout::parts.footer-style.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Layout::parts.login-register-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Popup::frontend.popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(Auth::id()): ?>
    <?php echo $__env->make('Media::browser', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!-- Custom script for all pages -->
<script src="<?php echo e(asset('libs/lodash.min.js')); ?>"></script>
<script src="<?php echo e(asset('libs/jquery-3.6.3.min.js')); ?>"></script>
<script src="<?php echo e(asset('libs/vue/vue' . (!env('APP_DEBUG') ? '.min' : '') . '.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('themes/gotrip/libs/bs/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('libs/bootbox/bootbox.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('themes/gotrip/js/vendors.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('themes/gotrip/js/main.js?_ver=' . config('app.asset_version'))); ?>"></script>

<?php echo App\Helpers\MapEngine::scripts(); ?>

<?php if(Auth::id()): ?>
    <script src="<?php echo e(asset('module/media/js/browser.js?_ver=' . config('app.version'))); ?>"></script>
<?php endif; ?>
<script src="<?php echo e(asset('libs/carousel-2/owl.carousel.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset("libs/daterange/moment.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset("libs/daterange/daterangepicker.min.js")); ?>"></script>
<script src="<?php echo e(asset('libs/select2/js/select2.min.js')); ?>"></script>



<script src="<?php echo e(asset('themes/gotrip/dist/frontend/js/gotrip.js?_ver=' . config('app.asset_version'))); ?>"></script>

<?php \App\Helpers\ReCaptchaEngine::scripts() ?>
<?php echo $__env->yieldPushContent('js'); ?><?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Layout/parts/footer.blade.php ENDPATH**/ ?>