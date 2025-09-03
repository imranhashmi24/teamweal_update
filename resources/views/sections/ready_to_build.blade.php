@php
    $readyToBuildContent = getContent('ready_to_build.content', true);
@endphp

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ready_to_build py-5 align-items-center">
                    <div class="build-content text-center">
                        <h2 class="fw-bold">
                            {{ @$readyToBuildContent->lang('title') }}
                        </h2>
                        <p class="text-muted py-2">
                            {{ @$readyToBuildContent->lang('sub_title') }}
                        </p>

                        @php
                            $open_banking = \App\Models\OpenBankingForm::first();
                        @endphp

                        @if($open_banking)
                            <div class="invest-button text-center">
                                <a href="{{ route('open-banking-request.index', ['id' => base64urlEncode($open_banking->id)]) }}" class="btn btn-primary mb-3">@lang('Request Service Now')</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
