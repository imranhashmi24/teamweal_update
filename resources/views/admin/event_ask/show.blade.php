@extends('admin.layouts.app', ['title' => 'Event Request Details'])
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border shadow-none card">
                                <div class="p-0 card-body">
                                    <div class="card-list">
                                        <span>@lang('Request Name')</span>
                                        <b>{{ $event_ask->name }}</b>
                                    </div>
                                     <div class="card-list">
                                        <span>@lang('Email')</span>
                                        <b>{{ @$event_ask->email }}</b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('Mobile Number')</span>
                                        <b>{{ @$event_ask->phone }}</b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('City')</span>
                                        <b>
                                            {{ @$event_ask->city }}
                                        </b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('Events')</span>
                                        <b>
                                            @if (app()->getLocale() == 'en')
                                            {{ @$event_ask->event->title }}
                                            @else
                                            {{ @$event_ask->event->title_ar }}
                                            @endif
                                        </b>
                                    </div>
                                    <div class="card-list">
                                        <span>@lang('Message')</span>
                                        <b>{{ @$event_ask->message }}</b>
                                    </div>
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
        <a href="{{ route('admin.event_ask.index') }}" class="btn btn-primary"><i
                class="bi bi-arrow-clockwise pe-1"></i>@lang('Back')</a>
    </div>
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
