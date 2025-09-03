@extends('admin.layouts.app', ['title' => 'Create Event News'])
@section('panel')
<form action="{{ route('admin.event_news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-12 col-md-6 col-lg-12">
                    <div class="form-group">
                        <label class="form-label">@lang('Title') <span class="text-danger fs-6">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">@lang('Title') (@lang('Arabic')) <span class="text-danger fs-6">*</span></label>
                        <input type="text" name="title_ar" value="{{ old('title_ar') }}" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">@lang('Event Slug') <span class="text-danger fs-6">*</span></label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" required>
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
                        <x-image-uploader class="w-100" name="image" type="event_news" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-12 col-md-12">
            <div class="form-group">
                <label class="form-label">@lang('Description') <span class="text-danger fs-6">*</span></label>
                <textarea name="description" class="form-control nicEdit" rows="10">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="mb-3 col-12 col-md-12">
            <div class="form-group">
                <label class="form-label">@lang('Description') (@lang('Arabic')) <span class="text-danger fs-6">*</span></label>
                <textarea name="description_ar" class="form-control nicEdit" rows="10">{{ old('description_ar') }}</textarea>
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
<a href="{{ route('admin.event_news.index') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i>
    @lang('Back')</a>
@endpush


@push('script')
<script>

    $("input[name=title]").on('	keypress', function() {
        var title = $(this).val();
        var generateSlug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        $("input[name=slug]").val(generateSlug);
    })
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

