<section class="layout-pt-md layout-pb-md">
    <div class="container">
        
        <div class="row justify-content-start">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title" style="font-family: 'Inter', sans-serif; font-weight: 600; font-size: 40px; line-height: 100%; letter-spacing: 0%; color: #000000; text-align: right; padding-bottom: 20px;"><?php echo $title ?? ''; ?></h2>
                </div>
            </div>
        </div>

        
        <div class="row pt-40" style="padding-top: 70px !important;">
            <?php if(!empty($services_data)): ?>
                <?php $__currentLoopData = $services_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <a href="<?php echo e($item['link']); ?>" class="d-block text-decoration-none">
                            <div class="d-flex flex-column align-items-center text-center">
                                
                                <div class="rounded-full" style="width: 186px; height: 186px; overflow: hidden; border-radius: 50%;">
                                    <img class="js-lazy" style="width: 100%; height: 100%; object-fit: cover;" data-src="<?php echo e(get_file_url($item['image_id'], 'full')); ?>" src="#" alt="<?php echo e($item['title']); ?>">
                                </div>
                                
                                
                                <div class="mt-20">
                                    <h4 style="font-family: 'Inter', sans-serif; font-weight: 500; font-size: 40px; color: #000000; margin-bottom: 5px;"><?php echo e($item['title']); ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        </div>

        <div class="row pt-40">
            <div class="col-12">
                <div style="border-bottom: 1px solid #00000080; width: 712px; max-width: 100%; margin: 0 auto;"></div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Template/Views/frontend/blocks/list-categories/index.blade.php ENDPATH**/ ?>