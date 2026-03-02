<section data-anim-wrap class="masthead -type-2 js-mouse-move-container" style="height: 732px !important; min-height: 732px !important; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px; overflow: hidden; position: relative;">
    <div class="masthead__bg bg-dark-3" style="height: 100%; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px; overflow: hidden;">
        <img src="<?php echo e($bg_image_url); ?>" alt="image" data-src="<?php echo e($bg_image_url); ?>" class="js-lazy" style="height: 100%; width: 100%; object-fit: cover; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px;">
    </div>
    <div class="container">


        <div class="masthead__content">
            <div class="row y-gap-40 items-center">
                
                <div class="col-xl-6">
                    <div class="masthead__images" style="position: relative; height: 100%; min-height: 600px; width: 100%;">
                        <?php $__currentLoopData = $list_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $img = get_file_url($item['bg_image'],'full');
                                $img_style = "width: 192px; height: 199px; border-radius: 20px; object-fit: cover; box-shadow: 0 15px 35px rgba(0,0,0,0.25);";
                                $container_style = "position: absolute;";
                                
                                switch($loop->index) {
                                    case 0: $container_style .= " top: 0px; right: 10%; z-index: 1;"; break;
                                    case 1: $container_style .= " top: 100px; right: 45%; z-index: 2;"; break;
                                    case 2: $container_style .= " top: 220px; right: 0%; z-index: 3;"; break;
                                    case 3: $container_style .= " top: 320px; right: 35%; z-index: 4;"; break;
                                    default: $container_style .= " position: relative; margin: 10px; display: inline-block;"; break;
                                }
                            ?>
                            <div data-anim-child="slide-up delay-6" style="<?php echo e($container_style); ?>">
                                <img src="<?php echo e($img); ?>" alt="image" class="js-mouse-move" data-move="30" style="<?php echo e($img_style); ?>">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <div class="col-xl-6 d-flex flex-column justify-center items-end text-right">
                    <div class="w-100 pl-20 lg:pl-0">
                        <h1 data-anim-child="slide-up delay-2" class="z-2 text-60 lg:text-40 md:text-30 text-white xl:pt-0" style="text-align: right;">
                            <span class="text-yellow-1"><?php echo e($title ?? ''); ?></span>
                        </h1>
                        <p data-anim-child="slide-up delay-3" class="z-2 text-white mt-20" style="text-align: right;"><?php echo e($sub_title ?? ''); ?></p>
                        <?php if(empty($hide_form_search)): ?>
                            <div data-anim-child="slide-up delay-4" class="mainSearch z-2 bg-white pr-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-4 shadow-1 mt-40" style="max-width: 550px; margin-right: 0; margin-left: auto;">
                                <div class="tabs__content js-tabs-content">
                                    <?php $allServices = get_bookable_services(); $number = 0; ?>
                                    <?php $__currentLoopData = $service_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(empty($allServices[$service_type])) continue; ?>
                                        <div class="tabs__pane -tab-item-<?php echo e($service_type); ?> <?php if($number == 0): ?> is-tab-el-active <?php endif; ?>">
                                            <?php if ($__env->exists(ucfirst($service_type).'::frontend.layouts.search.form-search', ['style' => $style])) echo $__env->make(ucfirst($service_type).'::frontend.layouts.search.form-search', ['style' => $style], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                        <?php $number++; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Template/Views/frontend/blocks/form-search-all-service/carousel_v2.blade.php ENDPATH**/ ?>