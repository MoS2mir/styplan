<section class="pt-40 g-header">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-12">
                <div class="row justify-between items-end">
                    <div class="col-auto">
                        <h1 class="text-26 fw-600"><?php echo e($translation->title); ?></h1>

                        <div class="row x-gap-20 y-gap-20 items-center pt-10">
                            <div class="col-auto">
                                <div class="row x-gap-10 items-center">
                                    <div class="col-auto">
                                        <div class="d-flex x-gap-5 items-center">
                                            <i class="icon-location-2 text-16 text-light-1"></i>
                                            <div class="text-15 text-light-1"><?php echo e($translation->address); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="row x-gap-10 y-gap-10">
                            <div class="col-auto">
                                <div class="dropdown">
                                    <button class="button px-15 py-10 -blue-1 dropdown-toggle" type="button" id="dropdownMenuShare" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-share mr-10"></i>
                                        <?php echo e(__('Share')); ?>

                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuShare">
                                        <a class="dropdown-item facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" rel="noopener" original-title="<?php echo e(__("Facebook")); ?>">
                                            <i class="fa fa-facebook"></i> <?php echo e(__('Facebook')); ?>

                                        </a>
                                        <a class="dropdown-item twitter" href="https://twitter.com/share?url=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" rel="noopener" original-title="<?php echo e(__("Twitter")); ?>">
                                            <i class="fa fa-twitter"></i> <?php echo e(__('Twitter')); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <div class="service-wishlist <?php echo e($row->isWishList()); ?>" data-id="<?php echo e($row->id); ?>" data-type="<?php echo e($row->type); ?>">
                                    <button class="button px-15 py-10 -blue-1 bg-light-2">
                                        <i class="icon-heart mr-10"></i>
                                        <?php echo e(__('Save')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if($row->getGallery()): ?>
    <?php echo $__env->make('Layout::common.detail.gallery2',['galleries' => $row->getGallery()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<section class="pt-40">
    <div class="container js-pin-container">
        <div class="row y-gap-30">
            <div class="col-lg-8">
                <div>
                    <h3 class="text-22 fw-500"><?php echo e(__('Property highlights')); ?></h3>

                    <div class="row y-gap-30 justify-between pt-20">
                        <?php if(!empty($row->bed)): ?>
                            <div class="col-md-auto col-6">
                                <div class="d-flex">
                                    <i class="icon-bed text-22 text-blue-1 mr-10"></i>
                                    <div class="text-15 lh-15">
                                        <?php echo e(__('Bedrooms')); ?><br> <?php echo e($row->bed); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($row->bathroom): ?>
                            <div class="col-md-auto col-6">
                                <div class="d-flex">
                                    <i class="icon-bathtub text-22 text-blue-1 mr-10"></i>
                                    <div class="text-15 lh-15">
                                        <?php echo e(__('Bathroom')); ?><br> <?php echo e($row->bathroom); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($row->square): ?>
                            <div class="col-md-auto col-6">
                                <div class="d-flex">
                                    <i class="fa fa-crop text-22 text-blue-1 mr-10"></i>
                                    <div class="text-15 lh-15">
                                        <?php echo e(__("Square")); ?><br> <?php echo size_unit_format($row->square); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($row->location->name)): ?>
                            <?php $location =  $row->location->translate() ?>
                            <div class="col-md-auto col-6">
                                <div class="d-flex">
                                    <i class="icon-location text-22 text-blue-1 mr-10"></i>
                                    <div class="text-15 lh-15">
                                        <?php echo e(__("Location")); ?><br> <?php echo e($location->name ?? ''); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="border-top-light mt-40 mb-40"></div>

                <?php if($translation->content): ?>
                    <div>
                        <h3 class="text-22 fw-500"><?php echo e(__('Description')); ?></h3>
                        <div class="description">
                            <?php echo clean($translation->content); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php echo $__env->make('Space::frontend.layouts.details.space-attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="border-top-light mt-40 mb-40"></div>
                <?php if($translation->faqs): ?>
                    <?php echo $__env->make('Layout::common.detail.faq',['faqs'=>$translation->faqs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <?php echo $__env->make('Space::frontend.layouts.details.space-form-book', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="border-top-light mt-40 mb-40"></div>
    </div>
</section>
<?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Space/Views/frontend/layouts/details/space-detail.blade.php ENDPATH**/ ?>