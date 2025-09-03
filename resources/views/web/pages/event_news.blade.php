@extends('web.layouts.frontend', ['title' => 'Events'])

@section('content')
<section class="py-3">
    <div class="container">
        <div class="row">
            @foreach ($event_news as $news)
            <div class="my-3 col-md-3 col-12 col-lg-3">
                <div class="news-card">
                    <div class="news-img">
                        <img src="{{ getImage(getFilePath('event_news') . '/' . $news->image, getFileSize('event_news')) }}" alt="" />
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
        @if($event_news->hasPages())
        <div class="row">
            <div class="my-3 col-md-12">
                {{ $event_news->links() }}
            </div>
        </div>
        @endif
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
    $('.flan-view').each(function() {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });

    $(".clickType").click(function() {
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
            success: function(res) {
                $("#showResult").html(res);
            }
        });
    });

</script>
@endpush
