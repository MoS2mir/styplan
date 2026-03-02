<?php $lang_local = app()->getLocale() ?>
<div class="booking-review">
	<div style="display: flex; align-items: center; justify-content: flex-start; margin-bottom: 25px;">
		<div style="display: flex; align-items: center; justify-content: center; margin-right: -15px;">
			<svg width="86" height="83" viewBox="0 0 86 83" fill="none" xmlns="http://www.w3.org/2000/svg"
				style="flex-shrink: 0;">
				<g filter="url(#filter0_d_65_101)">
					<rect x="20" y="16" width="45.6061" height="43" rx="15" fill="white" />
				</g>
				<path fill-rule="evenodd" clip-rule="evenodd"
					d="M48.7846 39.2756L41.3881 46.6215L39.552 44.7727L46.024 38.3448L39.5962 31.8727L41.445 30.0366L48.7909 37.4331C49.0344 37.6783 49.1705 38.0101 49.1693 38.3556C49.1681 38.7011 49.0297 39.032 48.7846 39.2756Z"
					fill="#1B263B" />
				<defs>
					<filter id="filter0_d_65_101" x="0" y="0" width="85.606" height="83" filterUnits="userSpaceOnUse"
						color-interpolation-filters="sRGB">
						<feFlood flood-opacity="0" result="BackgroundImageFix" />
						<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
							result="hardAlpha" />
						<feOffset dy="4" />
						<feGaussianBlur stdDeviation="10" />
						<feComposite in2="hardAlpha" operator="out" />
						<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0" />
						<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_65_101" />
						<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_65_101" result="shape" />
					</filter>
				</defs>
			</svg>
		</div>
		<h2 style="font-size: 24px; font-weight: 700; color: #111; margin: 0; padding-left: 5px;"><?php echo e(__("Your Booking")); ?>

		</h2>
	</div>
	<div class="booking-review-content mt-20" style="border: none !important; padding: 0 !important;">
		<div class="row y-gap-30">
			<!-- Right Column (Text info and Policy) -->
			<div class="col-lg-8 pr-lg-30">
				<?php
					$service_translation = $service->translate($lang_local);
				?>
				<h3 class="text-24 fw-700 mb-20" style="font-family: 'Tajawal', 'Cairo', sans-serif;"><a
						href="<?php echo e($service->getDetailUrl()); ?>"
						class="text-dark-1"><?php echo clean($service_translation->title); ?></a></h3>

				<div class="d-flex items-center mb-10">
					<!-- Icon Location -->
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="ml-10"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M12 22C12 22 20 16 20 10C20 5.58172 16.4183 2 12 2C7.58172 2 4 5.58172 4 10C4 16 12 22 12 22Z"
							stroke="#111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						<path
							d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
							stroke="#111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					<span
						class="text-15 fw-500"><?php echo e(!empty($service->location) ? $service->location->translate()->name : ($service_translation->address ?? 'مكان غير محدد')); ?></span>
				</div>

				<div class="d-flex items-center mb-10">
					<!-- Icon Door/Room -->
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="ml-10"
						xmlns="http://www.w3.org/2000/svg">
						<path d="M3 21H21" stroke="#111" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
						<path
							d="M6 21V5C6 4.46957 6.21071 3.96086 6.58579 3.58579C6.96086 3.21071 7.46957 3 8 3H16C16.5304 3 17.0391 3.21071 17.4142 3.58579C17.7893 3.96086 18 4.46957 18 5V21"
							stroke="#111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M14 13V13.01" stroke="#111" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
					<span class="text-15 fw-500">3 غرفة</span>
				</div>

				<div class="d-flex items-center mb-10">
					<!-- Icon User -->
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="ml-10"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
							stroke="#111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						<path
							d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
							stroke="#111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					<span class="text-15 fw-500"><?php echo e($booking->total_guests > 0 ? $booking->total_guests : 3); ?>

						أشخاص</span>
				</div>

				<div class="d-flex items-center mb-10">
					<span class="text-16 fw-500" style="color: #111;"><?php echo e(format_money($service->price)); ?> <span
							class="text-14 pr-5" style="color: #666;">- ليلة</span></span>
				</div>

				<?php if($service->star_rate): ?>
					<div class="d-flex items-center mb-30" style="gap: 5px;">
						<?php for($star = 1; $star <= $service->star_rate; $star++): ?>
							<svg width="14" height="14" viewBox="0 0 14 14" fill="#FFC107" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M7 0L9.16086 4.37699L14 5.08154L10.5 8.4905L11.3262 13.3185L7 11.0425L2.67376 13.3185L3.5 8.4905L0 5.08154L4.83914 4.37699L7 0Z" />
							</svg>
						<?php endfor; ?>
					</div>
				<?php endif; ?>

				<div class="mt-30 mb-30" style="border-top: 1px solid #E5E5E5;"></div>

				<h4 class="text-22 fw-700 mb-20" style="font-family: 'Tajawal', 'Cairo', sans-serif;">سياسة وشروط الدفع
				</h4>
				<h5 class="text-18 fw-700 mb-15" style="font-family: 'Tajawal', 'Cairo', sans-serif;">شروط الحجز</h5>
				<ul class="text-15 fw-500 mb-20" style="color: #111; list-style-type: disc; padding-right: 20px;">
					<li class="mb-15" style="line-height: 1.8;">يوجد تأمين بمبلغ 500 يدفع عند الوصول ويسترجع عند
						المغادرة في حال تم التأكد من سلامة ممتلكات والالتزام بالخروج في الوقت المحدد وأيضا الالتزام بأي
						شروط أخرى مذكورة.</li>
					<li class="mb-15" style="line-height: 1.8;">بإمكانك إلغاء او تأجيل الحجز مجاناً قبل 3 ايام من الحجز
					</li>
				</ul>


			</div>

			<!-- Left Column (Media Card) -->
			<div class="col-lg-4 text-center mt-30 mt-lg-0 pb-30">
				<div
					style="border: 1px solid #E5E5E5; border-radius: 12px; overflow: hidden; max-width: 350px; margin: 0 auto; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
					<!-- Hotel Image -->
					<div style="height: 180px; position: relative;">
						<?php if($image_url = $service->image_url): ?>
							<img src="<?php echo e($service->image_url); ?>" style="width: 100%; height: 100%; object-fit: cover;"
								alt="<?php echo clean($service_translation->title); ?>">
						<?php endif; ?>
						<!-- Pagination dots mock -->
						<div
							style="position: absolute; bottom: 10px; left: 0; right: 0; display: flex; justify-content: center; gap: 6px;">
							<div style="width: 8px; height: 8px; border-radius: 50%; background: #fff;"></div>
							<div
								style="width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.5);">
							</div>
							<div
								style="width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.5);">
							</div>
							<div
								style="width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.5);">
							</div>
						</div>
					</div>

					<!-- Map Image -->
					<?php
						$lat = $service->map_lat;
						$lng = $service->map_lng;
						if (empty($lat) || empty($lng)) {
							$lat = '24.7136'; // Default Saudi Arabia
							$lng = '46.6753';
						}
						$static_map = "https://static-maps.yandex.ru/1.x/?ll={$lng},{$lat}&z=12&l=map&size=350,150";
					?>
					<div
						style="height: 150px; background-image: url('<?php echo e($static_map); ?>'); background-size: cover; background-position: center; border-bottom: 1px solid #E5E5E5;">
					</div>

					<!-- View Map Link -->
					<div style="padding: 15px; text-align: center;">
						<a href="<?php echo e($service->getDetailUrl()); ?>?_layout=map"
							style="color: #0d6efd; font-size: 16px; font-weight: 600; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
							<svg width="6" height="10" viewBox="0 0 6 10" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path d="M5 1L1 5L5 9" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round" />
							</svg>
							عرض على الخريطة
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-30">
			<div class="col-12">
				<!-- Dark Theme Final Booking Card -->
				<div
					style="background-color: #1B263B; border-radius: 12px; padding: 30px; color: #fff; font-family: 'Tajawal', 'Cairo', sans-serif; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
					<!-- Top Title -->
					<div class="text-center mb-30">
						<h4 class="text-18 fw-700 m-0"
							style="color: #fff; border-bottom: 2px solid rgba(255,255,255,0.2); padding-bottom: 15px; display: inline-block; min-width: 150px;">
							الحجز النهائي</h4>
					</div>

					<!-- Dates -->
					<div
						style="border: 1px solid rgba(255,255,255,0.3); border-radius: 12px; display: flex; text-align: center; margin-bottom: 30px; overflow: hidden;">
						<div class="py-15" style="flex: 1; border-left: 1px solid rgba(255,255,255,0.3);">
							<div class="text-16 fw-700 d-flex justify-content-center align-items-center"
								style="color: #fff; gap: 8px;">
								تاريخ المغادرة
								<svg width="10" height="6" viewBox="0 0 10 6" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path d="M1 1L5 5L9 1" stroke="white" stroke-width="1.2" stroke-linecap="round"
										stroke-linejoin="round" />
								</svg>
							</div>
							<?php if($booking->end_date): ?>
								<div class="text-14 fw-500 mt-5" style="color: rgba(255,255,255,0.8);">
									<?php echo e(display_date($booking->end_date)); ?>

								</div>
							<?php endif; ?>
						</div>
						<div class="py-15" style="flex: 1;">
							<div class="text-16 fw-700 d-flex justify-content-center align-items-center"
								style="color: #fff; gap: 8px;">
								تاريخ الوصول
								<svg width="10" height="6" viewBox="0 0 10 6" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path d="M1 1L5 5L9 1" stroke="white" stroke-width="1.2" stroke-linecap="round"
										stroke-linejoin="round" />
								</svg>
							</div>
							<?php if($booking->start_date): ?>
								<div class="text-14 fw-500 mt-5" style="color: rgba(255,255,255,0.8);">
									<?php echo e(display_date($booking->start_date)); ?>

								</div>
							<?php endif; ?>
						</div>
					</div>

					<!-- Price Equation Row -->
					<div class="d-flex justify-content-between align-items-center mb-10 position-relative">
						<div class="text-16 fw-700" style="color: #fff;">الإجمالي
							<?php echo e(format_money($booking->total_before_fees)); ?>

						</div>

						<!-- Center Arrow and small text -->
						<div class="d-flex flex-column align-items-center"
							style="position: absolute; left: 50%; transform: translateX(-50%); top: -5px;">
							<svg width="50" height="16" viewBox="0 0 50 16" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path d="M50 8H1M1 8L8 1M1 8L8 15" stroke="white" stroke-width="1.2"
									stroke-linecap="round" stroke-linejoin="round" />
							</svg>
							<span class="text-12 mt-5" style="color: rgba(255,255,255,0.7); white-space: nowrap;">(
								<?php echo e($booking->duration_nights); ?> ليالي ×
								<?php echo e(format_money($booking->total_before_fees / ($booking->duration_nights > 0 ? $booking->duration_nights : 1))); ?>

								)</span>
						</div>

						<div class="text-16 fw-700" style="color: #fff;"><?php echo e($booking->duration_nights); ?> ليالي
							<?php echo e(format_money($booking->total_before_fees)); ?>

						</div>
					</div>

					<!-- Dynamically loop over extra prices / fees if needed -->
					<?php $extra_price = $booking->getJsonMeta('extra_price') ?>
					<?php if(!empty($extra_price)): ?>
						<?php $__currentLoopData = $extra_price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="d-flex justify-content-between align-items-center mb-10 mt-15">
								<div class="text-16 fw-500" style="color: #fff;"><?php echo e(format_money($type['total'] ?? 0)); ?></div>
								<div class="text-16 fw-500" style="color: rgba(255,255,255,0.9);">
									<?php echo e($type['name_' . $lang_local] ?? $type['name']); ?>

								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>

					<?php
						$list_all_fee = [];
						if (!empty($booking->buyer_fees)) {
							$buyer_fees = json_decode($booking->buyer_fees, true);
							$list_all_fee = $buyer_fees;
						}
						if (!empty($vendor_service_fee = $booking->vendor_service_fee)) {
							$list_all_fee = array_merge($list_all_fee, $vendor_service_fee);
						}
					?>
					<?php if(!empty($list_all_fee)): ?>
						<?php $__currentLoopData = $list_all_fee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$fee_price = $item['price'];
								if (!empty($item['unit']) and $item['unit'] == "percent") {
									$fee_price = ($booking->total_before_fees / 100) * $item['price'];
								}
								$total_fee = (!empty($item['per_person']) and $item['per_person'] == "on") ? $fee_price * $booking->total_guests : $fee_price;
							?>
							<div class="d-flex justify-content-between align-items-center mb-10 mt-15">
								<div class="text-16 fw-500" style="color: #fff;"><?php echo e(format_money($total_fee)); ?></div>
								<div class="text-16 fw-500" style="color: rgba(255,255,255,0.9);">
									<?php echo e($item['name_' . $lang_local] ?? $item['name']); ?>

									<i class="icofont-info-circle ml-5" style="color: rgba(255,255,255,0.5)"
										data-toggle="tooltip" data-placement="top"
										title="<?php echo e($item['desc_' . $lang_local] ?? $item['desc']); ?>"></i>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>

					<!-- Extra Spacer for small text -->
					<div style="height: 25px;"></div>

					<!-- Final Total -->
					<div class="text-center text-16 fw-700 mt-20"
						style="color: #fff; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.1);">
						= سوف تدفع المجموع النهائي <?php echo e(format_money($booking->total)); ?>

					</div>
				</div>

				<div class="review-section total-review mt-30 px-0 border-0">
					<ul class="review-list mt-0">
						<?php if ($__env->exists('Coupon::frontend/booking/checkout-coupon')) echo $__env->make('Coupon::frontend/booking/checkout-coupon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php echo $__env->make('Booking::frontend/booking/checkout-deposit-amount', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$dateDetail = $service->detailBookingEachDate($booking);
;?>
<div class="modal fade" id="detailBookingDate<?php echo e($booking->code); ?>" tabindex="-1" role="dialog"
	aria-labelledby="modelTitleId" aria-hidden="true" style="background-color: #00000060">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center"><?php echo e(__('Detail')); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php if(!empty($rooms)): ?>
					<ul class="review-list list-unstyled">
						<?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li class="mb-3 pb-1 border-bottom">
								<h6 class="label text-center font-weight-bold mb-1"><?php echo e($room->room->title); ?> *
									<?php echo e($room->number); ?>

								</h6>
								<?php if(!empty($dateDetail[$room->room_id])): ?>
									<div>
										<?php if ($__env->exists("Hotel::frontend.booking.detail-room", ['roomDate' => $dateDetail[$room->room_id]])) echo $__env->make("Hotel::frontend.booking.detail-room", ['roomDate' => $dateDetail[$room->room_id]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									</div>
								<?php endif; ?>
								<div class="d-flex justify-content-between font-weight-bold px-2">
									<span><?php echo e(__("Total:")); ?></span>
									<span><?php echo e(format_money($room->price * $room->number)); ?></span>
								</div>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div><?php /**PATH C:\Users\MoSamir\Downloads\public_html\public_html\themes/Base/Hotel/Views/frontend/booking/detail.blade.php ENDPATH**/ ?>