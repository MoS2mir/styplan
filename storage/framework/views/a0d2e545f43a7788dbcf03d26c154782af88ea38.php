<footer class="footer -type-custom py-60" style="background-color: #151F30; color: white;">
    <div class="container">
        <div class="row y-gap-40 justify-between items-start">
            
            <div class="col-xl-7 col-lg-8" style="width: 37.33333%;">
                <div class="row y-gap-30 text-center" style="text-align: center;">
                    <div class="col-sm-6">
                        <ul class="y-gap-15">
                            <li><a href="/ شروط الأستخدام" style="color: white; font-size: 18px; font-weight: 400;">شروط الأستخدام</a></li>
                            <li><a href="/ الاسئلة المتكررة" style="color: white; font-size: 18px; font-weight: 400;">الاسئلة المتكررة</a></li>
                            <li><a href="/ تواصل معنا" style="color: white; font-size: 18px; font-weight: 400;">تواصل معنا</a></li>
                            <li class="mt-15">
                                <a href="/login?register=1" class="button px-30 py-15 rounded-8 text-black" style="background-color: #555555; color: white; min-width: 140px; display: inline-flex; justify-content: center;">
                                    اضف عقارك
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="y-gap-15">
                            <li><a href="#" style="color: white; font-size: 18px; font-weight: 400;">شقق و بيوت</a></li>
                            <li><a href="#" style="color: white; font-size: 18px; font-weight: 400;">استراحات و شاليهات</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            
            <div class="col-auto text-left">
                <div class="footer-logo">
                    <?php
                        $logo = setting_item('logo_id');
                    ?>
                    <?php if($logo): ?>
                        <img src="<?php echo e(get_file_url($logo,'full')); ?>" alt="<?php echo e(setting_item("site_title")); ?>" style="max-height: 60px;">
                    <?php else: ?>
                        <h2 class="text-white fw-700">STAYPLAN</h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="pt-60 mt-60">
            <div class="row justify-between items-center y-gap-20">
                <div class="col-auto">
                    <div class="text-white-50 text-15 fw-400">
                        جميع الحقوق محفوظة <?php echo e(date('Y')); ?> <?php echo e(setting_item('site_title')); ?>

                    </div>
                </div>
                <div class="col-auto">
                    <div class="social-capsule d-flex x-gap-25 items-center bg-white px-25 py-10 rounded-20">
                        <a href="#" class="text-black text-22"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="text-black text-22"><i class="fa fa-instagram"></i></a>
                        <a href="#" class="text-black text-22"><i class="fa fa-youtube-play"></i></a>
                        <a href="#" class="text-black text-22"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .social-capsule a:hover {
        color: #0084FF !important;
    }
    .footer a:hover {
        opacity: 0.8;
    }
</style>
<?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/Layout/parts/footer-style/index.blade.php ENDPATH**/ ?>