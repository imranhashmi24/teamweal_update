@if($events)
@foreach ($events as $event)
<div class="my-2 col-12 col-md-6 col-lg-6">
    <div class="p-4 event-card-2 d-flex justify-content-between">
        <div class="img">
            <img src="{{ getImage(getFilePath('events') . '/' . $event->image, getFileSize('events')) }}" alt="">
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
