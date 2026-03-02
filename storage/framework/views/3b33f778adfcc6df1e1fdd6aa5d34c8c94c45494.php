<?php $key_time = time(); ?>
<section class="layout-pt-md layout-pb-lg">
    <div data-anim-wrap class="container">
        <div class="tabs -pills-2 js-tabs">
            <div data-anim-child="slide-up delay-1" class="row y-gap-20 items-center">
                <div class="col-auto">
                    <div class="d-flex items-center x-gap-30">
                        <div class="sectionTitle -md">
                            <h2 class="sectionTitle__title" style="font-family: 'Inter', sans-serif; font-weight: 600; font-size: 40px; color: #000000;"><?php echo e($title ?? ''); ?></h2>
                            <p class=" sectionTitle__text mt-5 sm:mt-0"><?php echo e($sub_title ?? ''); ?></p>
                        </div>

                        <div class="d-flex x-gap-20 items-center pt-5">
                            <div class="col-auto">
                                <button class="d-flex items-center js-common-next">
                                    <i class="icon icon-chevron-right" style="width: 16.5px; height: 31.5px; color: #000000CC; display: flex; align-items: center; justify-content: center; font-size: 24px;"></i>
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="d-flex items-center js-common-prev">
                                    <i class="icon icon-chevron-left" style="width: 16.5px; height: 31.5px; color: #000000CC; display: flex; align-items: center; justify-content: center; font-size: 24px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tabs__content pt-40 js-tabs-content">
                <?php if(!empty($service_types)): ?>
                    <?php $number = 0; ?>
                    <?php $__currentLoopData = $service_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $allServices = get_bookable_services();
                            if(empty($allServices[$service_type]) OR empty($rows[$service_type])) continue;
                        ?>
                        <div class="tabs__pane -tab-item-<?php echo e($service_type); ?> <?php if($number == 0): ?> is-tab-el-active <?php endif; ?>">
                            <?php 
                                $service_rows = $rows[$service_type];
                                if($service_type == 'hotel' && count($service_rows) > 0 && count($service_rows) < 10){
                                    $temp_rows = collect($service_rows);
                                    while(count($temp_rows) < 10){
                                        $temp_rows = $temp_rows->concat($service_rows);
                                    }
                                    $service_rows = $temp_rows->take(10);
                                }
                            ?>

                            <?php if($service_type == 'hotel'): ?>
                                <div class="relative overflow-hidden js-section-slider" data-gap="30" data-slider-cols="xl-5 lg-5 md-4 sm-2 base-1" data-nav-prev="js-common-prev" data-nav-next="js-common-next">
                                    <div class="swiper-wrapper">
                                        <?php $__currentLoopData = $service_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="swiper-slide">
                                                <?php echo $__env->make(ucfirst($service_type).'::frontend.layouts.search.loop-grid', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row y-gap-30">
                                    <?php $__currentLoopData = $service_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div data-anim-child="slide-left delay-<?php echo e($number+4); ?>" class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                                            <?php echo $__env->make(ucfirst($service_type).'::frontend.layouts.search.loop-grid', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php $number++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Template/Views/frontend/blocks/list-all-service/style_1.blade.php ENDPATH**/ ?>