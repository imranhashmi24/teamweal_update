@php
    $valuesElemets = getContent('values.element', false, null, true);
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <!-- Section Title -->
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">@lang('Our Values')</h2>
            <p class="text-muted fs-6">@lang('Our values guide our actions and decisions.')</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($valuesElemets as $value)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 offer-card text-center p-4">
                        <!-- Icon -->
                        <div class="icon mx-auto mb-3">
                            <img src="{{ getImage('assets/images/frontend/values/' . @$value?->data_values?->image, '460x390') }}"
                                 class="img-fluid" alt="{{ @$value?->lang('title') }}">
                        </div>
                        <!-- Heading & Description -->
                        <h5 class="fw-bold mb-2">{{ @$value->lang('heading') }}</h5>
                        <p class="text-muted small">{{ @$value->lang('title') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Custom CSS -->
<style>
/* Card hover effect */
.offer-card {
    border-radius: 20px;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    background-color: #ffffff;
}

.offer-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

/* Icon styling */
.icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #f1f5f9;
    transition: all 0.3s ease;
}

.icon img {
    width: 50%;
    height: auto;
}

.offer-card:hover .icon {
    background: #e0f2fe; /* subtle color on hover */
    transform: scale(1.1);
}

/* Responsive text */
h5 {
    font-size: 1.1rem;
}

p {
    font-size: 0.875rem;
}
</style>
