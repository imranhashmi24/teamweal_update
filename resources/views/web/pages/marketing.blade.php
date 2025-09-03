@extends('web.layouts.frontend', ['title' => @$title])
@section('content')
    <section class="py-5"
        style="background-image: url('{{ asset('assets/web/img/marketing.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-white text-center fw-bold">{{ __('Marketing') }}</h2>
                </div>
            </div>
        </div>
    </section>


    {{-- @include('sections.marketing') --}}
    @include('sections.digital_marketing_for_financial_services')
    @include('sections.traditional_marketing')

@endsection
