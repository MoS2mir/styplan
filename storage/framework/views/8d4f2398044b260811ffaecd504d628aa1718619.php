

<?php $__env->startPush('css'); ?>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Tajawal:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        .custom-profile-wrapper {
            font-family: 'Tajawal', 'Cairo', sans-serif;
            padding: 40px 15px;
        }

        .profile-input-card {
            border: 1px solid #777;
            border-radius: 14px;
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            max-width: 650px;
            margin: 0 auto 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            direction: rtl;
        }

        .profile-input-card .icon-pencil-container {
            color: #111;
            font-size: 22px;
        }

        .profile-input-card .input-info {
            flex-grow: 1;
            margin-right: 20px;
        }

        .profile-input-card label {
            font-size: 15px;
            color: #333;
            margin-bottom: 4px;
            display: block;
            text-align: right;
            font-family: 'Tajawal', 'Cairo', sans-serif;
        }

        .profile-input-card input {
            font-family: 'Tajawal', 'Cairo', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #000;
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            padding: 0;
            text-align: right;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="custom-profile-wrapper" dir="rtl">
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <!-- Title -->
        <h3 class="text-center"
            style="font-size: 24px; font-weight: 700; margin-bottom: 40px; color: #000; font-family: 'Tajawal', 'Cairo', sans-serif;">
            معلومات الملف الشخصي</h3>

        <!-- Inputs Form -->
        <form action="<?php echo e(route('user.profile.update')); ?>" method="post">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="last_name" value="<?php echo e(old('last_name', $dataUser->last_name)); ?>">
            <input type="hidden" name="user_name" value="<?php echo e(old('user_name', $dataUser->user_name)); ?>">
            <input type="hidden" name="avatar_id" value="<?php echo e(old('avatar_id', $dataUser->avatar_id)); ?>">

            <div class="profile-input-card">
                <div class="icon-pencil-container">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                </div>
                <div class="input-info">
                    <label>الاسم</label>
                    <input type="text" name="first_name" value="<?php echo e(old('first_name', $dataUser->first_name)); ?>" required>
                </div>
            </div>

            <div class="profile-input-card">
                <div class="icon-pencil-container">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                </div>
                <div class="input-info">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $dataUser->email)); ?>" required>
                </div>
            </div>

            <div class="profile-input-card">
                <div class="icon-pencil-container">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                </div>
                <div class="input-info">
                    <label>رقم الجوال</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone', $dataUser->phone)); ?>">
                </div>
            </div>

            <div class="text-center mt-40">
                <button type="submit"
                    style="background-color: #1f2937; color: #fff; padding: 15px 50px; border-radius: 12px; font-family: 'Tajawal', 'Cairo', sans-serif; font-weight: 700; font-size: 18px; border: none; cursor: pointer; transition: background-color 0.3s ease;">
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/GoTrip/User/Views/frontend/profile.blade.php ENDPATH**/ ?>