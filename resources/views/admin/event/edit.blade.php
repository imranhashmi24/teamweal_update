@extends('admin.layouts.app', ['title' => 'Edit Event'])
@section('panel')
<form action="{{ route('admin.events.update', @$event->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-12 col-md-6 col-lg-12">
                    <div class="form-group">
                        <label class="form-label">@lang('Event Title') <span class="text-danger fs-6">*</span></label>
                        <input type="text" name="title" value="{{ old('title', @$event->title) }}" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">@lang('Event Title') (@lang('Arabic')) <span class="text-danger fs-6">*</span></label>
                        <input type="text" name="title_ar" value="{{ old('title_ar', @$event->title_ar) }}" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">@lang('Event Slug') <span class="text-danger fs-6">*</span></label>
                        <input type="text" name="slug" value="{{ old('slug', @$event->slug) }}" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3 col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">@lang('Category') <span class="text-danger fs-6">*</span></label>
                        <div class="input-group">
                            <select class="form-control" name="category_id">
                                <option value="0">@lang('Select one')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', @$event->category_id) == $category->id ? 'selected' : '' }}>
                                        @if(app()->getLocale() == 'en')
                                        {{ $category->title }}
                                        @else
                                        {{ $category->title_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3 col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">@lang('Type') <span class="text-danger fs-6">*</span></label>
                        <div class="input-group">
                            <select class="form-control" name="type">
                                <option value="0">@lang('Select one')</option>
                                @foreach ($eventTypeElements as $type)
                                    <option value="{{ $type->data_values->title }}" {{ old('type', @$event->type) == $type->data_values->title ? 'selected' : '' }}>
                                        @if(app()->getLocale() == 'en')
                                        {{ $type->data_values->title }}
                                        @else
                                        {{ $type->data_values->title_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3 col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">@lang('Audience Type') <span class="text-danger fs-6">*</span></label>
                        <div class="input-group">
                            <select class="form-control" name="audience_type">
                                <option value="0">@lang('Select one')</option>
                                @foreach ($audienceTypeElements as $audienceType)
                                    <option value="{{ $audienceType->data_values->title }}"
                                        {{ old('audience_type', @$event->audience_type) == $audienceType->data_values->title ? 'selected' : '' }}
                                    >
                                        @if(app()->getLocale() == 'en')
                                        {{ $audienceType->data_values->title }}
                                        @else
                                        {{ $audienceType->data_values->title_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3 col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">@lang('Sector') <span class="text-danger fs-6">*</span></label>
                        <div class="input-group">
                            <select class="form-control" name="sector">
                                <option value="0">@lang('Select one')</option>
                                @foreach ($eventSectorElements as $eventSector)
                                    <option value="{{ $eventSector->data_values->title }}"
                                        {{ old('sector', @$event->sector) == $eventSector->data_values->title ? 'selected' : '' }}
                                    >
                                        @if(app()->getLocale() == 'en')
                                        {{ $eventSector->data_values->title }}
                                        @else
                                        {{ $eventSector->data_values->title_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="my-3 col-12 col-md-12 col-lg-12">
                    <div class="form-group d-flex justify-content-start">
                        <label class="w-25 form-label">@lang('Event start & end same time')</label>
                        <div class="input-group">
                            <input type="checkbox" name="same_time" value="{{ $event->same_time }}" {{ $event->same_time == 1 ? 'checked' : '' }}
                            class="custom-checkbox" id="sameTimeCheckbox">
                        </div>
                    </div>
                </div>


                <div class="mb-3 col-12 col-md-12 col-lg-12" id="startEndFields">
                   <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Start Date & Time') <span class="text-danger fs-6">*</span></label>
                                <div class="input-group">
                                    <input type="datetime-local" name="start_time" value="{{ $event->start_time }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('End Date & Time') <span class="text-danger fs-6">*</span></label>
                                <div class="input-group">
                                    <input type="datetime-local" name="end_time" value="{{ $event->end_time }}" class="form-control">
                                </div>
                            </div>
                        </div>
                   </div>

                </div>

                <div class="mb-3 col-12 col-md-6 col-lg-6" id="eventDateField" style="display: none;">
                    <div class="form-group">
                        <label class="form-label">@lang('Event Date & Time') <span class="text-danger fs-6">*</span></label>
                        <div class="input-group">
                            <input type="datetime-local" name="same_time_date" value="{{ $event->start_time }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-3 product-card">
        <div class="product-card-header">
            <h6 class="m-0 text-light">@lang('Location Information')</h6>
        </div>
        <div class="product-card-body">
            <div class="row">
                <div class="mb-3 col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">@lang('Country') <span class="text-danger fs-6">*</span></label>
                        <select name="country_id" class="form-control" required>
                            <option value="">@lang('Select One')</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" data-cities="{{ $country->city }}"
                             {{ old('country_id', @$event->country_id) == $country->id ? 'selected' : '' }}
                            >
                                @if(app()->getLocale() == 'en')
                                {{ $country->name }}
                                @else
                                {{ $country->name_ar }}
                                @endif
                            </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="mb-3 col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">@lang('City') <span class="text-danger fs-6">*</span></label>
                        <select name="city_id" class="form-control">
                            <option value="{{ $event->city_id }}" data-lat="{{ $event->latitude }}"
                                data-lng="{{ $event->longitude }}" selected>
                                {{ !empty($event->city->name) }}</option>
                        </select>
                    </div>
                </div>


                <div class="mb-3 col-12 col-md-12 col-lg-12">
                    <div id="address-map-container" style="width:100%;height:400px; margin-top:10px">
                        <div style="width: 100%; height: 100%" id="address-map"></div>
                    </div>
                </div>

                <div class="mb-3 col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="address_address">@lang('Location')</label>
                        <input type="text" id="address-input" name="address" class="form-control map-input" value="{{ @$event->address }}">
                        <input type="hidden" name="latitude" id="address-latitude" value="{{ @$event->latitude }}" />
                        <input type="hidden" name="longitude" id="address-longitude" value="{{ @$event->longitude }}" />
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="my-3 product-card">
        <div class="product-card-header">
            <h6 class="m-0 text-light">@lang('Images')</h6>
        </div>
        <div class="product-card-body">
            <div class="row">
                <div class="mb-3 col-12 col-md-4">
                    <div class="form-group">
                        <label class="form-label">@lang('Image') <span class="text-danger fs-6">*</span></label>
                        <x-image-uploader class="w-100" name="image" type="events"
                            imagePath="{{ getImage(getFilePath('events') . '/' . @$event->image, getFileSize('events')) }}"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-12 col-md-12">
            <div class="form-group">
                <label class="form-label">@lang('Description') <span class="text-danger fs-6">*</span></label>
                <textarea name="description" class="form-control nicEdit" rows="10">{{ old('description', @$event->description) }}</textarea>
            </div>
        </div>
        <div class="mb-3 col-12 col-md-12">
            <div class="form-group">
                <label class="form-label">@lang('Description') (@lang('Arabic')) <span class="text-danger fs-6">*</span></label>
                <textarea name="description_ar" class="form-control nicEdit" rows="10">{{ old('description_ar', @$event->description_ar) }}</textarea>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3 col-12 col-md-12">
                <button type="submit" class="btn btn-primary w-100">@lang('Submit')</button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('script-lib')
<script src="{{ asset('assets/global/js/image-uploader.min.js') }}"></script>
@endpush

@push('style-lib')
<link href="{{ asset('assets/global/css/image-uploader.min.css') }}" rel="stylesheet">
@endpush


@push('breadcrumb-plugins')
<a href="{{ route('admin.events.index') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i>
    @lang('Back')</a>
@endpush

@push('script')

<script>


    $('[name=country_id]').on('change', function() {
        var cities = $(this).find('option:selected').data('cities');

        var option = '<option value="">@lang('Select one')</option>';
        $.each(cities, function(index, value) {

            var name = "{{ app()->getLocale() }}" == 'en' ? value.name : value.name_ar;

            option += "<option value='" + value.id + "' " + (value.id == "{{ $event->city_id  }}" ? "selected" : "") + "data-lat='" + value.lat + "' data-lng='" + value.lng + "'>" +
                name + "</option>";
        });

        $('select[name=city_id]').html(option);
    }).change();


    $("input[name=title]").on('	keypress', function() {
        var title = $(this).val();
        var generateSlug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        $("input[name=slug]").val(generateSlug);
    })


    // image uploder
    @if(isset($images))
    let preloaded = @json($images);
    @else
    let preloaded = [];
    @endif

    $('.input-images').imageUploader({
        preloaded: preloaded
        , imagesInputName: 'images'
        , preloadedInputName: 'old'
        , maxSize: 3 * 1024 * 1024
        , maxFiles: 10
    , });


    $('[name=city_id]').on('change', function() {
        var lat = $(this).find('option:selected').data('lat');
        var lng = $(this).find('option:selected').data('lng');

        if (lat != undefined && lng != undefined) {
            $("#address-latitude").val(lat);
            $("#address-longitude").val(lng);

            initialize();
        }

    }).change();


    document.addEventListener("DOMContentLoaded", function() {
        const sameTimeCheckbox = document.getElementById("sameTimeCheckbox");
        const startEndFields = document.getElementById("startEndFields");
        const eventDateField = document.getElementById("eventDateField");

        if (sameTimeCheckbox.checked) {
            startEndFields.style.display = "none";
            eventDateField.style.display = "block";
        }

        sameTimeCheckbox.addEventListener("change", function() {
            if (this.checked) {
                startEndFields.style.display = "none";
                eventDateField.style.display = "block";
            } else {
                startEndFields.style.display = "block";
                eventDateField.style.display = "none";
            }
        });
    });

</script>
@endpush


@push('script-lib')
<script src="{{ asset('assets/global/js/map.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer>
</script>
@endpush


@push('style')
<style>
    .product-card {
        border: 1px solid #1a2232;
        border-radius: 5px;
    }

    .product-card-body {
        padding: 15px;
    }

    .product-card-header {
        background: #1a2232;
        padding: 10px;
    }

    .image-uploader {
        min-height: 278px !important;
    }

</style>
@endpush

