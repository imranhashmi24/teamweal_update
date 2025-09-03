@php
    $lang = app()->getLocale() ?? 'en';
@endphp

<div class="row">
    {{-- Default Name --}}
    <div class="col-6">
        <div class="form-group my-2">
            <label for="name" class="form-label">{{ $lang=='ar' ? 'الاسم الكامل' : 'Full Name' }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-0" id="name" name="form_data[name]" placeholder="{{ $lang=='ar' ? 'أدخل الاسم الكامل' : 'Enter your full name' }}" required>
        </div>
    </div>

    {{-- Default Email --}}
    <div class="col-6">
        <div class="form-group my-2">
            <label for="email" class="form-label">{{ $lang=='ar' ? 'البريد الالكتروني' : 'Email' }} <span class="text-danger">*</span></label>
            <input type="email" class="form-control rounded-0" id="email" name="form_data[email]" placeholder="{{ $lang=='ar' ? 'أدخل البريد الالكتروني' : 'Enter your email' }}" required>
        </div>
    </div>

    {{-- Default Phone --}}
    <div class="col-6">
        <div class="form-group my-2">
            <label for="phone" class="form-label">{{ $lang=='ar' ? 'رقم الهاتف' : 'Phone Number' }}</label>
            <input type="tel" class="form-control rounded-0" id="phone" name="form_data[phone]" placeholder="{{ $lang=='ar' ? 'رقم الهاتف' : 'Enter phone number' }}">
        </div>
    </div>

    {{-- Default City --}}
    <div class="col-6">
        <div class="form-group my-2">
            <label for="city" class="form-label">{{ $lang=='ar' ? 'المدينة' : 'City' }}</label>
            <input type="text" class="form-control rounded-0" id="city" name="form_data[city]" placeholder="{{ $lang=='ar' ? 'أدخل المدينة' : 'Enter city' }}">
        </div>
    </div>

    {{-- Default Message --}}
    <div class="col-12">
        <div class="form-group my-2">
            <label for="message" class="form-label">{{ $lang=='ar' ? 'رسالة' : 'Message' }}</label>
            <textarea class="form-control rounded-0" id="message" name="form_data[message]" placeholder="{{ $lang=='ar' ? 'اكتب رسالتك' : 'Write your message' }}"></textarea>
        </div>
    </div>
</div>