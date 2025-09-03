@extends('admin.layouts.app', ['title' => 'Event Details'])
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="border shadow-none card">
                                <div class="p-0 card-body">

                                    <div class="card-list">
                                        <span>@lang('Title')</span>
                                        <b>{{ $event->title }}</b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('Title ar')</span>
                                        <b>{{ $event->title_ar }}</b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('Category')</span>
                                        <b>{{ app()->getLocale() == 'en' ? $event->category?->title : $event->category?->title_ar }}</b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('Type')</span>
                                        <b>{{ @$event->type }}</b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('Audience type')</span>
                                        <b>{{ @$event->audience_type }}</b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('Sector')</span>
                                        <b>{{ @$event->sector }}</b>
                                    </div>

                                    <div class="card-list">
                                        <span>@lang('Same date & time')</span>
                                        <b>{{ @$event->same_time == 1 ? __('Yes') : __('No') }}</b>
                                    </div>

                                    @if($event->same_time == 1)
                                    <div class="card-list">
                                        <span>@lang('Date and Time')</span>
                                        <b> <small>{{ showDateTime($event->start_time, 'd M Y') }}</small>
                                            <br>
                                            <small>{{ showDateTime($event->start_time, 'H:i A') }}</small>
                                        </b>
                                    </div>
                                    @else
                                    <div class="card-list">
                                        <span>@lang('Start Time')</span>
                                        <b> <small>{{ showDateTime($event->start_time, 'd M Y') }}</small>
                                            <br>
                                            <small>{{ showDateTime($event->start_time, 'H:i A') }}</small>
                                        </b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('End Time')</span>
                                        <b> <small>{{ showDateTime($event->end_time, 'd M Y') }}</small>
                                            <br>
                                            <small>{{ showDateTime($event->end_time, 'H:i A') }}</small>
                                        </b>
                                    </div>
                                    @endif
                                    <div class="card-list">
                                        <span>@lang('Status')</span>
                                        <b>@php echo $event->statusBadge; @endphp</b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('Created At')</span>
                                        <b> <small>{{ showDateTime($event->created_at, 'd M Y') }}</small>
                                            <br>
                                            <small>{{ showDateTime($event->created_at, 'H:i A') }}</small>
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border shadow-none card">
                            <div class="card-header">
                                    <h5>@lang('Images')</h5>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <h6 class="pb-2">@lang('Image') :</h6>
                                        <div class="property-image">
                                            <a
                                                href="{{ getImage(getFilePath('events') . '/' . $event->image, getFileSize('events')) }}">
                                                <img src="{{ getImage(getFilePath('events') . '/' . $event->image, getFileSize('events')) }}"
                                                    alt="@lang('Image')">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 border shadow-none card">
                                <div class="card-header">
                                    <h5>@lang('Locations')</h5>
                                </div>
                                <div class="card-body">
                                    <div class="card-list">
                                        <span>@lang('Country')</span>
                                        <b>
                                            @if (app()->getLocale() == 'en')
                                                {{ optional($event->country)->name }}
                                            @else
                                                {{ optional($event->country)->name_ar }}
                                            @endif

                                        </b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('City')</span>
                                        <b>
                                            @if (app()->getLocale() == 'en')
                                                {{ optional($event->city)->name }}
                                            @else
                                                {{ optional($event->city)->name_ar }}
                                            @endif
                                        </b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('Location')</span>
                                        <b>
                                            {{ $event->address }}
                                        </b>
                                    </div>
                                    <div>
                                        @include('admin.event.map')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="border shadow-none card">
                                <div class="card-header">
                                    <h6>@lang('Description')</h6>
                                </div>
                                <div class="card-body">
                                    @php echo $event->description @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border shadow-none card">
                                <div class="card-header">
                                    <h6>@lang('Description') @lang('Arabic')</h6>
                                </div>
                                <div class="card-body">
                                    @php echo $event->description_ar @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <div class="flex-wrap gap-2 d-flex">
        <a href="{{ route('admin.events.index') }}" class="btn btn-primary"><i
                class="bi bi-arrow-clockwise pe-1"></i>@lang('Back')</a>

        <a href="{{ route('admin.events.status', [$event->id, Status::INACTIVE]) }}" class="btn btn-warning"><i
                class="bi bi-x pe-1"></i>@lang('Inactive')</a>
        <a href="{{ route('admin.events.status', [$event->id, Status::ACTIVE]) }}" class="btn btn-success"><i
                    class="bi bi-check2 pe-1"></i>@lang('Active')</a>

    </div>
@endpush


@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/magnific-popup.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/magnific-popup.js') }}"></script>
@endpush


@push('script')
    <script>
        $('.property-image').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    </script>
@endpush



@push('style')
    <style>
        .card-body .card-list {
            display: flex;
            padding: 8px;
            flex-wrap: nowrap;
            border-bottom: 1px solid #cccccc;
            justify-content: space-between;

        }

        .card-body .card-list:last-child {
            border-bottom: none;
        }

        .property-image {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .property-image>a {
            width: 170px;
            display: flex;
            border: 1px solid #cccccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .property-image img {
            width: 100%;
        }
    </style>
@endpush
