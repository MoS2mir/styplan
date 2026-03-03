@extends('layouts.user')

@section('content')
    <div class="row pt-20">
        <div class="col-12 mb-40 text-center">
            <h2 class="text-30 fw-700" style="color: #000; font-family: 'Tajawal', 'Cairo', sans-serif;">
                {{ __('تواصل معنا') }}</h2>
        </div>

        <div class="col-12 col-md-10 mx-auto">
            <div class="mb-3">
                <h3 class="fw-700 mb-0 pb-2"
                    style="font-size: 18px; color: #111; font-family: 'Tajawal', 'Cairo', sans-serif; border-bottom: 3px solid #007bff; display: inline-block;">
                    {{ __('نموذج المراسلة') }}
                </h3>
            </div>

            <div class="bg-white" style="border: 1px solid #707070; border-radius: 8px; overflow: hidden;">
                <form method="post" action="{{ route("contact.store") }}" class="bravo-contact-block-form m-0">
                    {{csrf_field()}}
                    <div style="display: none;">
                        <input type="hidden" name="g-recaptcha-response" value="">
                        <!-- Hidden inputs for required fields to pass validation -->
                        <input type="hidden" name="name" value="{{ Auth::user()->display_name }}">
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                        <input type="hidden" name="phone" value="{{ Auth::user()->phone ?? '000000' }}">
                    </div>

                    <div class="row m-0">
                        <div class="col-12 p-3 p-md-4" style="border-bottom: 1px solid #707070;">
                            <label class="d-block w-100 mb-2"
                                style="color: #4B5563; font-size: 16px; font-weight: 500; font-family: 'Tajawal', 'Cairo', sans-serif;">{{ __('الموضوع') }}</label>
                            <input type="text" name="subject" class="w-100 border-0 outline-none p-0 fw-700"
                                placeholder="{{ __('ادخل الموضوع هنا') }}"
                                style="color: #1F2937; font-size: 18px; font-family: 'Tajawal', 'Cairo', sans-serif; background: transparent;">
                        </div>
                    </div>

                    <div class="row m-0">
                        <div class="col-12 p-3 p-md-4">
                            <label class="d-block w-100 mb-2"
                                style="color: #4B5563; font-size: 16px; font-weight: 500; font-family: 'Tajawal', 'Cairo', sans-serif;">{{ __('نص الرسالة') }}</label>
                            <textarea name="message" rows="8" class="w-100 border-0 outline-none p-0 fw-700"
                                placeholder="{{ __('ابدأ بالكتابة هنا ...') }}"
                                style="color: #1F2937; font-size: 18px; font-family: 'Tajawal', 'Cairo', sans-serif; background: transparent; resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="form-mess mt-2 px-4 pb-2 text-center text-16"></div>
                </form>
            </div>

            <div class="text-center mt-30 mb-50">
                <button type="button" onclick="submitContactForm(this)" class="px-50 py-3 rounded-8 text-white fw-700"
                    style="background-color: #1a2235; border: none; min-width: 150px; font-size: 18px; font-family: 'Tajawal', 'Cairo', sans-serif; cursor: pointer; transition: background 0.3s ease;">
                    {{ __('إرسال') }}
                    <i class="fa fa-spinner fa-pulse fa-fw d-none mr-2"></i>
                </button>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function submitContactForm(btn) {
            var $btn = $(btn);
            var $form = $('.bravo-contact-block-form');
            var $message = $form.find('.form-mess');

            // Append subject to message so it is recorded in the contact store 
            var subj = $form.find('input[name="subject"]').val();
            var msg = $form.find('textarea[name="message"]').val();

            if (!msg.trim()) {
                $message.html('<div class="text-danger">{{ __("يرجى إدخال نص الرسالة") }}</div>');
                return;
            }

            var old_message = msg;
            if (subj.trim()) {
                $form.find('textarea[name="message"]').val('الموضوع: ' + subj + '\n\n' + msg);
            }

            $btn.find('.fa-spinner').removeClass('d-none');
            $btn.prop('disabled', true);

            $.ajax({
                url: $form.attr('action'),
                data: $form.serialize(),
                type: 'POST',
                success: function (res) {
                    $btn.find('.fa-spinner').addClass('d-none');
                    $btn.prop('disabled', false);
                    $form.find('textarea[name="message"]').val(old_message); // restore original
                    if (res.status) {
                        $form.find('input[name="subject"], textarea[name="message"]').val(''); // clear
                        $message.html('<div class="text-success">' + res.message + '</div>');
                    } else {
                        $message.html('<div class="text-danger">' + res.message + '</div>');
                    }
                },
                error: function (e) {
                    $btn.find('.fa-spinner').addClass('d-none');
                    $btn.prop('disabled', false);
                    $form.find('textarea[name="message"]').val(old_message); // restore original
                    var errors = e.responseJSON && e.responseJSON.errors ? e.responseJSON.errors : {};
                    var errStr = '';
                    for (var k in errors) {
                        errStr += errors[k][0] + '<br>';
                    }
                    if (!errStr) errStr = 'حدث خطأ، يرجى المحاولة لاحقاً.';
                    $message.html('<div class="text-danger">' + errStr + '</div>');
                }
            });
        }
    </script>
@endpush