<section class="layout-pt-xl layout-pb-md">
    <div class="container">
        <div class="row y-gap-20 justify-start">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title" style="font-family: 'Inter', sans-serif; font-weight: 600; font-size: 40px; line-height: 100%; color: #000000;"><?php echo $title ?? ''; ?></h2>
                    <p class=" sectionTitle__text mt-5 sm:mt-0"><?php echo e($desc ?? ''); ?></p>
                </div>
            </div>
        </div>

        <div class="row y-gap-30 pt-40">
            <?php if($rows): ?>
                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $translation = $row->translate() ?>
                    <div class="w-1/5 lg:w-1/3 sm:w-1/2">
                        <a href="<?php echo e($row->getDetailUrl()); ?>">
                            <div class="citiesCard -type-2 ">
                                <div class="citiesCard__image" style="width: 100%; height: 304px; border-radius: 10px; overflow: hidden; position: relative;">
                                    <img class="js-lazy" style="width: 100%; height: 100%; object-fit: cover;" data-src="<?php echo e(get_file_url($row->image_id)); ?>" src="#" alt="<?php echo e($translation->name ?? ''); ?>">
                                    
                                    <div class="citiesCard__content d-flex flex-column justify-content-end" style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; padding: 20px; background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 60%); text-align: right; align-items: flex-start; pointer-events: none;">
                                        <h4 class="text-white" style="font-family: 'Inter', sans-serif; font-weight: 500; font-size: 24px; line-height: 100%;"><?php echo e($translation->name ?? ''); ?></h4>
                                        <div class="text-white">
                                            <?php
                                                $count_all = 0;
                                                $types = [];
                                                if(!empty($service_type)){
                                                    $types = is_array($service_type) ? $service_type : [$service_type];
                                                } else {
                                                    $allServices = get_bookable_services();
                                                    if(!empty($allServices)){
                                                        $types = array_keys($allServices);
                                                    }
                                                }

                                                foreach($types as $type){
                                                     // Fallback: Direct count ignoring nested sets if model result is 0
                                                     $modelClass = '\Modules\\' . ucfirst($type) . '\Models\\' . ucfirst($type);
                                                     if(class_exists($modelClass)){
                                                         $model = new $modelClass();
                                                         $table = $model->getTable();
                                                         try {
                                                             $count = \Illuminate\Support\Facades\DB::table($table)
                                                                ->where('location_id', $row->id)
                                                                ->where('status', 'publish')
                                                                ->count();
                                                             $count_all += $count;
                                                         } catch (\Exception $e) {
                                                              // Silent fail if table not exist or error
                                                         }
                                                     }
                                                }
                                            ?>
                                            
                                            
                                            
                                            

                                            <span style="font-family: 'Inter', sans-serif; font-weight: 400; font-size: 14px; line-height: 100%;"><?php echo e($count_all); ?> مكان</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Location/Views/frontend/blocks/list-locations/style_7.blade.php ENDPATH**/ ?>