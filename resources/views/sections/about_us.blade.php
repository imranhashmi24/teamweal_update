@php
    $aboutUsContent = getContent('about_us.content', true);
@endphp

<section class="welcome-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Content -->
            <div class="col-12 col-md-6">
                <div class="welcome-text">
                    <h1 class="display-5 fw-bold mb-3">{{ $aboutUsContent?->lang('heading') }}</h1>
                    <p class="lead text-muted">  {!! @$aboutUsContent?->lang('description') !!}</p>
                </div>
            </div>

            <!-- Right Image -->
            <div class="col-12 col-md-6 text-center">
                <div class="welcome-image">
                    <img src="{{ getImage('assets/images/frontend/about_us/' . @$aboutUsContent?->data_values?->image) }}"
                        alt="Welcome to the Export"
                        class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Section Background */
.welcome-section {
    background: linear-gradient(135deg, #f9fafc, #eef2f7);
    overflow: hidden;
}

/* Text Styling */
.welcome-text h1 {
    color: #1a2b49;
    animation: fadeInUp 1s ease-in-out;
}

.welcome-text h2 {
    color: #265073;
    font-weight: 600;
    animation: fadeInUp 1.2s ease-in-out;
}

.welcome-text p {
    font-size: 1.1rem;
    line-height: 1.7;
    animation: fadeInUp 1.4s ease-in-out;
}

/* Image Animation */
.welcome-image img {
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    animation: fadeInRight 1.5s ease-in-out;
}

.welcome-image img:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Animations */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
}
</style>
