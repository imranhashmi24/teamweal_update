@extends('web.layouts.frontend', ['title' => 'News Details'])
@section('content')
<section class="blog-section" style="background: none;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="py-5 mt-3 blog-left">
                    <div class="mb-2">
                        <img src="{{ getImage(getFilePath('event_news') . '/' . $event->image) }}" alt="Event Photo"  style="width:100% !important; height: 400px !important; border-radius:40px !important">
                    </div>
                    <span class="blog-date"><i class="bi bi-clock pe-1"></i>
                        {{ showDateTime($event->created_at, 'd M Y') }}</span>
                    <h4 class="blog-details-head">
                        {{ $event->lang('title') }}
                    </h4>

                    <div class="py-3 blog-ditails">
                        @php echo $event->lang('description') @endphp
                    </div>

                    <div class="mt-5 social-icon social-icon-2">
                        <span>{{ __('Share') }} :</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"><i
                                class="fab fa-facebook-f"></i></a>
                        <a
                            href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ urlencode(url()->current()) }}">
                            <i class="fab fa-twitter"></i></a>
                        <a
                            href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary">
                            <i class="fab fa-linkedin-in"></i></a>

                        <a target="_blank"
                            href="https://www.instagram.com/sharer.php?u={{ urlencode(url()->current()) }}">
                            <i class="fab fa-instagram"></i>
                        </a>

                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="my-5 blog-right sticky-blog-right">
                    <div class="blog-sidbar-post">
                        <h3 class="border-bottom">{{ __('Recent event news') }}</h3>
                        @foreach ($recentPosts as $recentPos)
                        <div class="py-2 sidbar-blog-box d-flex">
                            <img src="{{ getImage(getFilePath('event_news') . '/' . $recentPos->image) }}" alt="Event Photo"  style="width:70px !important; height: 50px !important">
                            <div class="content">
                                <a href="{{ route('event.news.details', $recentPos->slug) }}">
                                    {{ strLimit($recentPos->lang('title'), 50) }}
                                </a>
                                <p>
                                    <span>{{ diffForHumans($recentPos->created_at) }}</span>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
