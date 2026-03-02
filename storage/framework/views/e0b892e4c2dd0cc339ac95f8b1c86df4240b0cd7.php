<section class="pt-40 g-header">
    <div class="container">
        <div class="row y-gap-20 justify-between items-end">
            <div class="col-auto">
                <h1 class="text-30 sm:text-25 fw-600"><?php echo e($translation->title); ?></h1>

                <div class="row x-gap-20 y-gap-20 items-center pt-10">
                    <div class="col-auto">
                        <div class="d-flex items-center text-15 text-light-1">
                            <svg width="18" height="18" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px;">
                                <path d="M6.3462 12.0531L20.4354 5.34444C22.4895 4.36569 24.6331 6.51049 23.6556 8.56586L16.9469 22.6538C16.0298 24.5787 13.2506 24.4603 12.5015 22.4629L11.2617 19.1533C11.1406 18.8304 10.9517 18.5372 10.7079 18.2933C10.464 18.0495 10.1708 17.8607 9.84795 17.7395L6.53712 16.4986C4.54095 15.7494 4.42133 12.9702 6.3462 12.0531Z" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?php echo e($translation->address); ?>

                        </div>
                    </div>
                </div>

                <?php
                    $reviewData = $row->getScoreReview();
                    $score_total = $reviewData['score_total'];
                    if ($score_total > 5) {
                        $score_total = $score_total / 2;
                    }
                ?>
                <?php if($score_total > 0): ?>
                    <div class="row x-gap-10 items-center pt-5">
                        <div class="col-auto">
                            <div class="d-flex x-gap-5 items-center">
                                
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?php $rev_i = 6 - $i; ?>
                                    <?php if($rev_i <= floor($score_total)): ?>
                                        <i class="fa fa-star" style="font-size: 18px; color: #FFC700;"></i>
                                    <?php elseif($rev_i - $score_total <= 0.5): ?>
                                        
                                        <i class="fa fa-star-half-o" style="font-size: 18px; color: #FFC700;"></i>
                                    <?php else: ?>
                                        <i class="fa fa-star-o" style="font-size: 18px; color: #FFC700;"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-auto">
                <div class="row x-gap-15 y-gap-15 items-center">
                    <div class="col-auto">
                        <div class="text-14">
                            <?php echo e(__('From')); ?>

                            <div class="d-inline-flex justify-content-end align-baseline mt-5">
                                <div class="text-16 text-red-1 line-through mr-5"><?php echo e($row->display_sale_price); ?></div>
                                <div class="text-22 lh-12 fw-600"><?php echo e($row->display_price); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <a href="#hotel-rooms-form" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                            <?php echo e(__('حجز الآن')); ?> <div class="icon-arrow-top-right ml-15"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if($row->getGallery()): ?>
    <?php echo $__env->make('Layout::common.detail.gallery2',['galleries' => $row->getGallery()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<section class="pt-30" id="hotel-rooms">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-xl-12">
                <div class="row y-gap-40">
                    <?php if($translation->content): ?>
                        <div id="overview" class="col-12 gotrip-overview">
                            <h3 class="text-22 fw-500 pt-20"><?php echo e(__('Overview')); ?></h3>
                            <div class="description text-dark-1 text-15 mt-20">
                                <?php echo clean($translation->content); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-12">
                        <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php if($translation->faqs): ?>
                        <?php echo $__env->make('Layout::common.detail.faq',['faqs'=>$translation->faqs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-rooms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</section>
<?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Hotel/Views/frontend/layouts/details/hotel-detail.blade.php ENDPATH**/ ?>