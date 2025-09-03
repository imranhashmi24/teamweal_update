@extends('web.layouts.frontend', ['title' => @$title])
@section('content')
    <section class="py-5"
        style="background-image: url('{{ asset('assets/web/img/Common-banner.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-white text-center fw-bold">{{ __('Jobs') }}</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bg-primary py-5">
                        <h2 class="text-white text-center fw-bold">{{ __('Coming Soon') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
