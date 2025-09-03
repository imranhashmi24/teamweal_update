@php
    $MissionVisionElemets = getContent('mission_vision.element', false, null, true);
@endphp

<section class="py-5 mission_bg bg-white">
    <div class="container">
        <div class="row py-3 py-md-5 justify-content-center">
            @foreach ($MissionVisionElemets as $MissionVisionElemet)
                <div class="col-12 col-md-4 mb-3">
                    <div class="card mission_card h-100 bg-white">
                        <img class="mv-img m-auto"
                            src="{{ getImage('assets/images/frontend/mission_vision/' . @$MissionVisionElemet?->data_values?->image, '120x120') }}"
                            alt="{{ @$MissionVisionElemet?->lang('title') }}">
                        
                        <div class="card-body text-center">
                            <div class="pb-3">
                                <h5 class="text-center card-titlem ">
                                    {{ @$MissionVisionElemet?->lang('heading') }}
                                </h5>
                            </div>

                            <!-- DOT LINE SEPARATOR -->
                            <div class="dot-line my-3">
                                <span class="line"></span>
                                <span class="dot"></span>
                                <span class="line"></span>
                            </div>

                            <p class="card-text">{{ @$MissionVisionElemet?->lang('title') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .mission_card {
        border-radius: 12px;
    }

    .mv-img {
        height: 120px;
        width: 120px;
    }

    .card-titlem {
        color: #ffffff;
        background: #2F0052;
        display: inline-block;
        padding: 15px;
        font-size: 1.25rem;
        font-weight: 600;
        border-radius: 8px;
    }

    p.card-text {
        padding-top: 15px;
    }

    /* DOT-LINE STYLE */
    .dot-line {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .dot-line .line {
        flex: 1;
        height: 2px;
        background: #2F0052; /* Line color */
    }

    .dot-line .dot {
        width: 10px;
        height: 10px;
        background: #2F0052; /* Dot color */
        border-radius: 50%;
    }
</style>
