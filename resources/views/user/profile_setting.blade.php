@extends('web.layouts.master', ['title' => 'Profile Setting'])
@section('content')
    <form class="register" action="{{ route('user.profile.setting') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex gap-4 flex-wrap">
                    <div class="user-profile-img">
                        <div>
                            <x-image-uploader image="{{ $user->image }}" class="w-100" type="userProfile"
                                :showSizeFileType=false />
                        </div>
                    </div>
                    <div class="profile-information">
                        <p>{{ $user->name }}</p>
                        <p>{{ '@' . $user->username }}</p>
                        <p>{{ $user->email }}</p>
                        <p>{{ $user->mobile }}</p>
                        <p>{{ @$user->country->name }}</p>
                    </div>
                </div>
            </div>

            <h6 class="section-title mb-3">@lang('Basic Information')</h6>
            <div class="row">
                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Full Name') <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('National ID / Iqama Number') <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="national_id_number" 
                           value="{{ $user->val_license_number }}" required>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Nationality') <span class="text-danger">*</span></label>
                    <select name="country" class="form-select" required>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ $user->country_id == $country->id ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'en' ? $country->name : $country->name_ar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Date of birth') <span class="text-danger">*</span></label>
                    <input type="date" name="date_of_birth" value="{{ $user->date_of_birth }}" class="form-control" required>
                </div>
                
                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('City/Region') <span class="text-danger">*</span></label>
                    <input type="text" name="city" value="{{ $user->city }}" class="form-control" required>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Mobile Number') <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control" required>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Email Address') <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                </div>
            </div>

            <hr class="my-4">
            <h6 class="section-title mb-3">@lang('Investment Preferences')</h6>
            <div class="row">
                <div class="col-12 pb-3">
                    <label class="form-label">@lang('Preferred investment sectors')</label>
                    <div class="">
                        @php
                            $preferredSectors = json_decode($user->services_provided, true) ?? [];
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" 
                                   value="Health" id="Health" {{ in_array('Health', $preferredSectors) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Health">@lang('Health')</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" 
                                   value="Education" id="Education" {{ in_array('Education', $preferredSectors) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Education">@lang('Education')</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" 
                                   value="Technology" id="Technology" {{ in_array('Technology', $preferredSectors) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Technology">@lang('Technology')</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" 
                                   value="Agriculture" id="Agriculture" {{ in_array('Agriculture', $preferredSectors) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Agriculture">@lang('Agriculture')</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" 
                                   value="Industry" id="Industry" {{ in_array('Industry', $preferredSectors) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Industry">@lang('Industry')</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="preferred_investment_sectors[]" 
                                   value="Other" id="Other" {{ in_array('Other', $preferredSectors) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Other">@lang('Other')</label>
                        </div>
                        <div class="form-group mt-2">
                            <input class="form-control" type="text" name="preferred_investment_sectors_other" 
                                   value="{{ in_array('Other', $preferredSectors) ? end($preferredSectors) : '' }}"
                                   placeholder="@lang('Please specify other sectors')" id="OtherInput">
                        </div>
                    </div>
                </div>

                <div class="col-12 pb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_regular_opportunity_alert" 
                               value="yes" id="is_regular_opportunity_alert" {{ $user->is_regular_opportunity_alert ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_regular_opportunity_alert">
                            @lang('Would you like to receive regular alerts about opportunities?')
                        </label>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <h6 class="section-title mb-3">@lang('Supporting Documents')</h6>
            <div class="row">
                <div class="col-12 pb-3">
                    <label class="form-label">@lang('Identity Proof Type')</label>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="identity_proof" 
                                   value="resume_or_investor_profile" id="resume_or_investor_profile" 
                                   {{ $user->identity_proof_type == 'resume_or_investor_profile' ? 'checked' : '' }}>
                            <label class="form-check-label" for="resume_or_investor_profile">
                                @lang('Resume or Investor Profile')
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="identity_proof" 
                                   value="identity_proof" id="identity_proof" 
                                   {{ $user->identity_proof_type == 'identity_proof' ? 'checked' : '' }}>
                            <label class="form-check-label" for="identity_proof">
                                @lang('Identity Proof')
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 pb-3">
                    <div class="form-group">
                        <label class="form-label">@lang('File Upload')</label>
                        <input class="form-control" type="file" name="file_upload">
                        @if($user->identity_proof_file)
                            <div class="mt-2">
                                <a href="{{ asset('storage/'.$user->identity_proof_file) }}" target="_blank" class="text-primary">
                                    @lang('View current file')
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-base w-100">@lang('Update Profile')</button>
            </div>
        </div>
    </form>
@endsection

@push('title')
    <h5 class="card-title">@lang('Profile Setting')</h5>
@endpush

@push('script')
<script>
    $(document).ready(function() {
        // Show/hide other sectors input based on checkbox
        $('#Other').change(function() {
            if ($(this).is(':checked')) {
                $('#OtherInput').show();
            } else {
                $('#OtherInput').hide().val('');
            }
        });

        // Initial state
        if ($('#Other').is(':checked')) {
            $('#OtherInput').show();
        } else {
            $('#OtherInput').hide();
        }
    });
</script>
@endpush