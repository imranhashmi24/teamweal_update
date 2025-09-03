@php
    $socialMediaElements = getContent('social_media.element', null, false, true);
    $footerContents = getContent('footer.content', true);
    $pages = App\Models\Page::where('is_default', Status::NO)->get();
    $policyPages = getContent('policy_pages.element', false, null, true);
@endphp
<footer class="py-5 footer-part">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="footer-left">
                    <div class="footer-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ siteLogo('dark') }}" alt="logo">
                        </a>
                    </div>
                    <p class="pt-4 text-white small-text">
                        {{ @$footerContents->lang('address') }}
                    </p>
                    <p> <i class="mx-2 fa fa-phone"></i>
                        <a class="text-white"
                            href="tel:{{ @$footerContents->data_values->mobile }}">{{ @$footerContents->data_values->mobile }}</a>
                    </p>
                    <p> <i class="mx-2 fa fa-envelope"></i>
                        <a
                             class="text-white"
                            href="mailto:{{ @$footerContents->data_values->email }}">
                            {{ @$footerContents->data_values->email }}
                        </a>
                    </p>
                    <div class="mb-3 social-media-link">
                        <div class="my-3 footer-title">
                            <h6 class="pb-2 text-white"> @lang('Social Connect')</h6>
                        </div>
                        <ul class="d-flex" style="list-style: none;">
                            @foreach ($socialMediaElements as $socialMediaElement)
                                <li class="mx-2">
                                    <a href="{{ @$socialMediaElement->data_values->link }}" class="text-white" target="_blank" >
                                        @php echo @$socialMediaElement->data_values->icon @endphp
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="footer-title">
                    <h5 class="pb-3 text-white ml-4"> @lang('Useful Links') </h5>
                </div>
                <div class="footer-link">
                    <ul style="list-style: none;">
                        <li>
                        <a href="{{ route('web.pages.sectors') }}"> {{ __('Sectors') }} </a>
                        </li>

                        <li>
                            <a href="{{ route('web.pages.embedded-finance') }}"> {{ __('Embeded Finance') }} </a>
                        </li>

                        <li>
                            <a href="{{ route('web.pages.smart-collection') }}"> {{ __('Smart Collection') }} </a>
                        </li>

                        <li>
                            <a href="{{ route('web.pages.open-banking') }}"> {{ __('Open Banking') }} </a>
                        </li>

                        <li>
                            <a href="{{ route('events') }}"> {{ __('Events') }} </a>
                        </li>

                        <li>
                            <a href="{{ route('web.pages.marketing') }}"> {{ __('Marketing') }} </a>
                        </li>



                        <!--<li>-->
                        <!--    <a href="{{ route('blogs') }}"> @lang('Blogs')</a>-->
                        <!--</li>-->
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="footer-title">
                    <h5 class="pb-3 text-white"> @lang('Important Link') </h5>
                </div>
                <div class="footer-link">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}"> @lang('Homepage')</a>
                        </li>
                        

                        @foreach ($policyPages as $policyPage)
                            <li>
                                <a
                                    href="{{ route('policy.pages', [slug($policyPage->data_values->title), $policyPage->id]) }}">
                                    {{ @$policyPage->lang('title')  }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="my-3 footer-title">
                    <h6 class="pb-2 text-white"> @lang('Subscribe')</h6>
                </div>
                <form action="" class="subscribe-form" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="email" class="form-control email-input"
                            placeholder="@lang('Enter your email')">
                        <button class="input-group-text" type="submit"> <i class="fa fa-paper-plane"></i> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>

<section class="py-3 copyright-part">
    <div class="container">
        <div class="text-center">
            <p>@lang('Copyright') &copy; {{ date('Y') }}. @lang('All Rights Reserved')
            </p>
        </div>
    </div>
</section>


@push('script')
    <script>
        $(document).on('submit', '.subscribe-form', function(e) {
            e.preventDefault();
            var email = $('.email-input').val();
            if (!email) {
                notify('error', 'Email field is required');
            } else {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ route('subscribe') }}",
                    method: "POST",
                    data: {
                        email: email
                    },
                    success: function(response) {
                        if (response.success) {
                            $('input[name="email"]').val('');
                            notify('success', response.message);
                        } else {
                            notify('error', response.error);
                        }

                    }
                });
            }
        });
    </script>
@endpush
