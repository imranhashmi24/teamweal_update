@extends('web.layouts.frontend', ['title' => @$title])
@section('content')

    <section class="py-5"
        style="background-image: url('{{ asset('assets/web/img/event.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-white text-center fw-bold">{{ __('Events') }}</h2>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5 property property-bg-color">
        <div class="container">
            <div class="row">
                @foreach($currents as $key => $current_event)
                <div class="my-3 col-12 col-md-4 col-lg-4">
                    <div class="event-card">
                        <div class="card-img">
                            <img src="{{ getImage(getFilePath('events') . '/' . $current_event->image, getFileSize('events')) }}"
                                alt="">
                        </div>
                        <div class="px-3 pt-4">
                            <div class="event-content">
                                <h3>
                                    <a href="{{ route('event.details', $current_event->slug) }}">
                                        {{ app()->getLocale() == 'en' ? $current_event->title : $current_event->title_ar }}
                                    </a>
                                </h3>
                                <p>
                                    {{ app()->getLocale() == 'en' ? $current_event->city?->name :
                                    $current_event->city?->name_ar }},
                                    {{ app()->getLocale() == 'en' ? $current_event->country?->name :
                                    $current_event->country?->name_ar }}
                                </p>
                            </div>
                            <div class="event-footer d-flex justify-content-between">
                                <p> {{ showDateTime($current_event->end_time, 'F j, Y') }}</p>
                                <p class="fvt" data-item="{{ $current_event->id }}" data-type="event-news"><i class="fa fa-star {{ findMyFvt('event-news', $current_event->id) ? 'text-danger' : '' }}"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-3 property property-bg-color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>@lang('Find Your Desire')</h3>
                </div>
            </div>

            <form id="filterForm">
                <div class="py-3 row">
                    <div class="my-3 col-6 col-md-3 col-lg-3">
                        <div class="form-group">
                            <select name="category" id="category" class="custom-control">
                                <option value="0">@lang('Category')</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->title }}">{{ app()->getLocale() == 'en' ? $category->title :
                                    $category->title_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="my-3 col-6 col-md-3 col-lg-3">
                        <div class="form-group">
                            <select name="type" id="type" class="custom-control">
                                <option value="0">@lang('Type')</option>
                                @foreach ($eventTypeElements as $eventTypeElement)
                                <option value="{{ $eventTypeElement->data_values->title }}">{{ app()->getLocale() == 'en' ?
                                    $eventTypeElement->data_values->title : $eventTypeElement->data_values->title_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="my-3 col-6 col-md-3 col-lg-3">
                        <div class="form-group">
                            <select name="audience_type" id="audience_type" class="custom-control">
                                <option value="0">@lang('Audience Type')</option>
                                @foreach ($audienceTypeElements as $eventTypeElement)
                                <option value="{{ $eventTypeElement->data_values->title }}">{{ app()->getLocale() == 'en' ?
                                    $eventTypeElement->data_values->title : $eventTypeElement->data_values->title_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="my-3 col-6 col-md-3 col-lg-3">
                        <div class="form-group">
                            <select name="sector" id="sector" class="custom-control">
                                <option value="0">@lang('Sector')</option>
                                @foreach ($eventSectorElements as $eventTypeElement)
                                <option value="{{ $eventTypeElement->data_values->title }}">{{ app()->getLocale() == 'en' ?
                                    $eventTypeElement->data_values->title : $eventTypeElement->data_values->title_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <section class="py-5 property property-bg-color">
        <div class="container">
            <div class="row" id="showResult">
                @if($events)
                    @foreach ($events->skip(3) as $event)
                    <div class="my-2 col-12 col-md-6 col-lg-6">
                        <div class="p-4 event-card-2 d-flex justify-content-between">
                            <div class="img">
                                <img src="{{ getImage(getFilePath('events') . '/' . $event->image, getFileSize('events')) }}"
                                    alt="">
                            </div>
                            <div class="px-4 event-card-2-content">
                                <h3> <a href="{{ route('event.details', $current_event->slug) }}">
                                    {{ app()->getLocale() == 'en' ? $event->title : $event->title_ar }}
                                </a></h3>
                                <p>@lang('SD') {{ showDateTime($event->start_time, 'd-m-Y') }} - @lang('ED') {{
                                    showDateTime($event->end_time, 'd-m-Y') }}</p>

                                <div class="event-time" id="countdown_{{ $event->id }}">
                                    <div class="overly-content">
                                        <p class="day">00</p>
                                        <p>@lang('Days')</p>
                                    </div>
                                    <div class="overly-content">
                                        <p class="hour">00</p>
                                        <p>@lang('Hours')</p>
                                    </div>
                                    <div class="overly-content">
                                        <p class="minutes">00</p>
                                        <p>@lang('Minutes')</p>
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
                    </div>
                
                    @endforeach
                @endif
            </div>
            @if($events->hasPages())
            <div class="row">
                <div class="my-3 col-md-12">
                    {{ $events->links() }}
                </div>
            </div>
            @endif
        </div>
    </section>


    <section class="py-3 property property-bg-color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <h3>@lang('Event News')</h3>
                        <a href="{{ route('eventNews') }}">@lang('See more')</a>
                    </div>
                    <hr>
                </div>
            </div>
            
            <div class="py-3 row">
                @foreach ($event_news as $news)
                <div class="my-3 col-md-3">
                    <div class="news-card">
                        <div class="news-img">
                            <img src="{{ getImage(getFilePath('event_news') . '/' . $news->image, getFileSize('event_news')) }}" alt="">
                        </div>
                        <div class="py-4 news-content">
                            <h3>{{ app()->getLocale() == 'en' ? $news->title : $news->title_ar }}</h3>
                            <p>
                                @if(app()->getLocale() == 'en')
                                {!! Str::limit($news->description, 100, '...') !!}
                                @else
                                {!! Str::limit($news->description_ar, 100, '...') !!}
                                @endif
                            </p>

                            <a href="{{ route('event.news.details', $news->slug) }}">@lang('READ MORE')</a>
                        </div>
                    </div>
                </div>
                @if(app()->getLocale() == 'ar')
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>

    @if ($sections != null)
        @foreach (json_decode($sections) as $sec)
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
    
    .news-img img{
       border-radius: 10px; 
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
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });

        $(".clickType").click(function(){
            var type = $(this).val();
            $("#typeValue").val(type);
        });


    $('select').on('change', function(e) {
        e.preventDefault();

        const queryParams = new URLSearchParams();
        $('select').each(function() {
            queryParams.set($(this).attr('name'), $(this).val());
        });

        const url = '{{ route("eventFilter") }}?' + queryParams.toString();

        $.ajax({
            type: 'GET',
            url: url,
            success: function(res){
                $("#showResult").html(res);
            }
        });
    });

</script>
@endpush


@push('script')
<script>
    $(document).ready(function(){
        $(".fvt").click(function(){
            var $this  = $(this);
            var likeId = $(this).attr('data-item');
            var type   =   $(this).attr('data-type');
            var url    = "{{ route('fvtStore') }}";
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    type: type,
                    property_id: likeId
                },
                success: function(res) {
                    if (res.status === true) {
                        notify('success', res.message);
                        $this.find('i.fa').addClass('text-danger');
                    }
                    if (res.status === false) {
                        notify('success', res.message);
                        $this.find('i.fa').removeClass('text-danger');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    window.location.href = "{{ route('user.login') }}";
                }
            });
        })
    })
</script>
@endpush

