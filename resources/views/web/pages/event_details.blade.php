@extends('web.layouts.frontend', ['title' => 'Events'])

@section('content')
<section class="py-5 pages-banner">
    <div class="container">
        <div class="py-3 row">
            <div class="col-md-6">
                <div class="text-dark">
                    <h3>
                        {{ app()->getLocale() == 'en' ? $event->title : $event->title_ar }}
                    </h3>
                    <p>@lang('SD') {{ showDateTime($event->start_time, 'd-m-Y') }} - @lang('ED') {{
                        showDateTime($event->end_time, 'd-m-Y') }}</p>

                </div>
            </div>
            <div class="col-md-6">
                <div class="text-white event-time" style="background-color: rgba(255, 111, 5, 1)" id="countdown_{{ $event->id }}">
                    <div class="overly-content">
                        <p class="text-white day">00</p>
                        <p class="text-white">@lang('Days')</p>
                    </div>
                    <div class="overly-content">
                        <p class="text-white hour">00</p>
                        <p class="text-white">@lang('Hours')</p>
                    </div>
                    <div class="overly-content">
                        <p class="text-white minutes">00</p>
                        <p class="!text-white">@lang('Minutes')</p>
                    </div>
                </div>

                <script>
                    var countDownDate_{{ $event->id }} = new Date("{{ $event->end_time }}").getTime();
                    var x_{{ $event->id }} = setInterval(function() {
                        var now = new Date().getTime();
                        var distance = countDownDate_{{ $event->id }} - now;
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        document.getElementById("countdown_{{ $event->id }}").innerHTML =
                            "<div class='overly-content'><p class='day'>" + days + "</p><p>@lang('Days')</p></div>" +
                            "<div class='overly-content'><p class='hour'>" + hours + "</p><p>@lang('Hours')</p></div>" +
                            "<div class='overly-content'><p class='minutes'>" + minutes + "</p><p>@lang('Minutes')</p></div>";

                        if (distance < 0) {
                            clearInterval(x_{{ $event->id }});
                            document.getElementById("countdown_{{ $event->id }}").innerHTML = '<p class="expired">{{ __("EXPIRED") }}</p>';
                        }
                    }, 1000);
                </script>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="py-3 event-detail-card">
                    <img src="{{ getImage(getFilePath('events') . '/' . $event->image, getFileSize('events')) }}" alt="">
                </div>
            </div>
        </div>

        <div class="py-3 row">
            <div class="col-12 col-md-12 col-lg-12">
                <h3 class="text-dark">@lang('Event details')</h3>
            </div>

            <div class="py-3 col-12 col-md-12 col-lg-12">
              <div style="color:black">
                @if(app()->getLocale() == 'en')
                    <p class="text-dark">{!! $event->description !!}</p>
                @else
                    <p  class="text-dark">{!! $event->description_ar !!}</p>
                @endif
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <h3 class="text-dark">@lang('Event Information')</h3>
            </div>
            <div class="my-5 col-12 col-md-12 col-lg-12">
                <div class="info-card">
                    <div class="row">
                        <div class="col-3 col-md-4 col-lg-4">
                            <b>@lang('Event Type')</b>
                        </div>
                        <div class="col-9 col-md-8 col-lg-8">
                            <p>{{ __($event->type) }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-md-4 col-lg-4">
                            <b>@lang('Time')</b>
                        </div>
                        <div class="col-9 col-md-8 col-lg-8">
                            <p>@lang('SD') {{ showDateTime($event->start_time, 'd-m-Y') }} - @lang('ED') {{
                                showDateTime($event->end_time, 'd-m-Y') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-md-4 col-lg-4">
                            <b>@lang('Audience Type')</b>
                        </div>
                        <div class="col-9 col-md-8 col-lg-8">
                            <p>{{ __($event->audience_type) }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-md-4 col-lg-4">
                            <b>@lang('Sector')</b>
                        </div>
                        <div class="col-9 col-md-8 col-lg-8">
                            <p>{{ __($event->sector) }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-md-4 col-lg-4">
                            <b>@lang('Location')</b>
                        </div>
                        <div class="col-9 col-md-8 col-lg-8">
                            <p>{{ $event->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-2">
    <div class="container">
        <div class="mb-5 row">
            <div class="col-12 col-md-12">
                <h3 class="mb-5 text-center">@lang('Have any ask?')</h3>
            </div>
            <div class="col-md-12">
                <div class="any-ask-card">
                    <form action="{{ route('event.ask.form_submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <div class="my-3 row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <label for="" class="form-label">@lang('Name') <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control c-form-control" placeholder="@lang('Type name')">
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <label for="" class="form-label">@lang('Phone') <span class="text-danger">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control c-form-control" placeholder="@lang('Type phone')">
                            </div>
                        </div>
                        <div class="my-3 row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <label for="" class="form-label">@lang('Email') <span class="text-danger">*</span></label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control c-form-control" placeholder="@lang('Type email')">
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <label for="" class="form-label">@lang('City') <span class="text-danger">*</span></label>
                                <input type="text" name="city" value="{{ old('city') }}" class="form-control c-form-control" placeholder="@lang('Type city')">
                            </div>
                        </div>
                        <div class="my-3 row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <label for="" class="form-label">@lang('Type your asking') <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control c-form-control" placeholder="@lang('Type message')">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <div class="my-3 row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" class="view-btn">
                                    @lang('Get Started')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




@if(@$sections->secs != null)
@foreach (json_decode($sections->secs) as $sec)
@include('sections.' . $sec)
@endforeach
@endif

@endsection

@push('style-lib')
<link rel="stylesheet" href="{{ asset('assets/global/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('assets/web/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/web/css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/web/css/custom.css') }}">
@endpush

@push('style')
<style>
    .property-image img {
        height: 200px !important;
    }

    .body-content {
        margin-bottom: 7px !important;
        height: 150px !important;
        overflow: hidden;
    }
</style>
@endpush


@push('script-lib')
<script src="{{ asset('assets/global/js/magnific-popup.js') }}"></script>
<script src="{{ asset('assets/web/js/slick.min.js') }}"></script>
@endpush

@push('script')
<script>
    $('.flan-view').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                  delegate: 'a', // the selector for gallery item
                  type: 'image'
                  , gallery: {
                        enabled: true
                  }
            });
      });

      $(".clickType").click(function() {
            var type = $(this).val();
            $("#typeValue").val(type);
      });

</script>
@endpush
