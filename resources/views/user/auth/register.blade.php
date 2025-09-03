@extends('web.layouts.frontend',['title'=> __('Service providers registration')])
@section('content')
@php
    $policyPages = getContent('policy_pages.element',false,null,true);
@endphp

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card border-0">

                    <div class="card-header">
                        <h5 class="card-title text-center">@lang('Join our network of verified service providers')</h5>
                        <p class="text-center mb-0">@lang('Start offering your services to businesses and organizations seeking advanced tech solutions')</p>
                    </div>

                    <div class="card-body px-4">
                        <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <h6 class="section-title mb-3">@lang('Basic Information:')</h6>
                            <div class="row">
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Full Name') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                
            
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('National ID / Iqama Number') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="national_id_number" value="{{ old('national_id_number') }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Nationality') <span class="text-danger">*</span></label>
                                        <select name="country" class="form-select" required>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ app()->getLocale() == 'en' ? $country->name : $country->name_ar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Date of birth') <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('City/Region') <span class="text-danger">*</span></label>
                                        <input type="text" name="city" value="{{ old('city') }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <h6 class="section-title mb-3">@lang('Contact Details:')</h6>
                            <div class="row">

                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Email Address') <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control checkUser" name="email" value="{{ old('email') }}" required>
                                        <small class="text-danger emailExist"></small>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Mobile Number') <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control checkUser" required>
                                        <small class="text-danger mobileExist"></small>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Password') <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @if(gs('secure_password')) secure-password @endif" name="password" required>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Confirm Password') <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                            
                            <h6 class="section-title mb-3">@lang("Investment Preferences (optional)")</h6>
                            
                            <div class="row">
                                <div class="col-12 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Preferred investment sectors')</label>
                                        <div class="">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" value="Health" id="Health">
                                                <label class="form-check-label" for="Health">@lang('Health')</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" value="Education" id="Education">
                                                <label class="form-check-label" for="Education">@lang('Education')</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" value="Technology" id="Technology">
                                                <label class="form-check-label" for="Technology">@lang('Technology')</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" value="Agriculture" id="Agriculture">
                                                <label class="form-check-label" for="Agriculture">@lang('Agriculture')</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" value="Industry" id="Industry">
                                                <label class="form-check-label" for="Industry">@lang('Industry')</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" value="Other" id="Other">
                                                <label class="form-check-label" for="Other">@lang('Other')</label>
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="text" name="preferred_investment_sectors[]"  id="Other">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 pb-3">
                                    <div class="form-check">
                                        <label class="form-label" id="is_regular_opportunity_alert">@lang('Would you like to receive regular alerts about opportunities?')</label>
                                        <input class="form-check-input" type="checkbox" name="is_regular_opportunity_alert" value="yes" id="is_regular_opportunity_alert">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12 pb-3">
                                    <h6>@lang('Upload Supporting Documents (optional)')</h6>
                                </div>
                                <div class="col-12 pb-3">
                                    <div class="form-check">
                                        <label class="form-label" id="resume_or_investor_profile">@lang('Resume or Investor Profile')</label>
                                        <input class="form-check-input" type="radio" name="identity_proof" value="resume_or_investor_profile" id="resume_or_investor_profile">
                                    </div>
                                </div>
                                <div class="col-12 pb-3">
                                    <div class="form-check">
                                        <label class="form-label" id="identity_proof">@lang('Identity Proof')</label>
                                        <input class="form-check-input" type="radio" name="identity_proof" value="identity_proof" id="identity_proof">
                                    </div>
                                </div>
                                <div class="col-12 pb-3">
                                    <div class="form-group">
                                        <label class="form-label" id="file_upload">@lang('File Upload')</label>
                                        <input class="form-control" type="file" name="file_upload" >
                                    </div>
                                </div>
                            </div>
                        
        
                            <x-captcha />
                            
                            @if(gs()->agree)
                            <div class="col-12 pb-3">
                                <div class="form-group">
                                    <input type="checkbox" id="agree" @checked(old('agree')) name="agree" required>
                                    <label for="agree">@lang('I confirm that the provided information is accurate and I accept the platforms Terms & Conditions')</label>
                                    <span>
                                        @foreach($policyPages as $policy)
                                            <a style="font-weight: bold;" href="{{ route('policy.pages',[slug($policy->data_values->title),$policy->id]) }}" target="_blank">{{ __($policy->data_values->title) }}</a>
                                            @if(!$loop->last), @endif
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            @endif
                            
                            <div class="col-12 pb-3">
                                <div class="form-group">
                                    <button type="submit" id="recaptcha" class="btn btn-primary w-100">@lang('Submit Application')</button>
                                </div>
                                
                                <p class="mb-0 text-center pt-3">@lang('Already have an account?') <a href="{{ route('user.login') }}">@lang('Sign In')</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if(gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
        $(document).ready(function() {
            var isArabic = "{{ app()->getLocale() === 'ar' }}" === '1';
            
            $('#category_id').change(function() {
                $('#sub_category_id').html('<option value="0" selected>@lang("Select one")</option>');
                
                var selectedOption = $(this).find('option:selected');
                var childrenCategories = selectedOption.data('childrens');
                
                if (childrenCategories && childrenCategories.length > 0) {
                    $.each(childrenCategories, function(index, child) {
                        var childName = (isArabic && child.name_ar) ? child.name_ar : child.name || 'Unnamed';
                        $('#sub_category_id').append($('<option>', {
                            value: child.id,
                            text: childName
                        }));
                    });
                }
            });
        });
    </script>
    <script>
      "use strict";
        (function ($) {
            $('.checkUser').on('focusout',function(e){
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';

                if ($(this).attr('name') == 'email') {
                    var data = {email:value,_token:token}
                }
                if ($(this).attr('name') == 'username') {
                    var data = {username:value,_token:token}
                }

                if ($(this).attr('name') == 'mobile') {
                    var data = {mobile:value,_token:token}
                }

                $.post(url,data,function(response) {
                  if(response.data != false){
                    $(`.${response.type}Exist`).text(`${response.type} already exists`);
                  }else{
                    $(`.${response.type}Exist`).text('');
                  }
                });
            });
        })(jQuery);
    </script>
@endpush


@push('style')
    <style>
        .card {
            border: none;
            background: transparent;
        }

        .card:hover {
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .section-title{
            text-align: left;
            border-bottom: 1px solid #DDD;
            font-size: 18px;
            padding: 5px 0px;
        }


        .form-control,
        .form-select,
        .form-check-input {
           border-radius: 0px !important;
           border: 1px solid #ddd !important;
        }

       
    </style>
@endpush