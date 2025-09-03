@extends('web.layouts.frontend', ['title' => @$title])
@section('content')
    <section class="py-5"
        style="background-image: url('{{ asset('assets/web/img/about.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-white text-center fw-bold">{{ __('About Us') }}</h2>
                </div>
            </div>
        </div>
    </section>

    @include('sections.about_us')
    @include('sections.mission_vision')
    @include('sections.values')
    @include('sections.what_we_offer')

    <section class="py-5  text-white">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-10">
                  <div class="text-center p-4 p-md-5 rounded-3 shadow-lg bg-primary">
                      <div class="fs-1 mb-3">
                          <i class="bi bi-envelope-paper-heart"></i>
                      </div>
                      <p class="fs-5 fw-light mb-0 ">
                          @lang('Through Temweal Hub, we shorten the distance between idea and funding, and between project and investor becoming your smart partner in shaping a better financial and investment future.')
                      </p>
                  </div>
              </div>
          </div>
      </div>
  </section>
@endsection
