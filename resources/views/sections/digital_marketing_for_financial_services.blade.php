@php
    $digitalMarketingForFinancialServicesElements = getContent('digital_marketing_for_financial_services.element', null, false, true);
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="sectore_category pb-3">
                    <h3 class="fw-bold" style="color: #0069CA">{{ __('Digital marketing for financial services and institutions') }}</h3>
                </div>
                <div class="row justify-content-center">
                    @foreach ($digitalMarketingForFinancialServicesElements as $digitalMarketingForFinancialServicesElement)
                        <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <div class="card h-100 p-3 bg-white">
                              <img src="{{ getImage('assets/images/frontend/digital_marketing_for_financial_services/' . @$digitalMarketingForFinancialServicesElement->data_values->image) }}"
                              alt="Smart Settlement" class="img-fluid rounded-4 shadow-lg">
                                <div class="card-body p-0">
                                    <h6 class="card-title fw-bold text-center pt-3">{{ @$digitalMarketingForFinancialServicesElement->lang('title') }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</section>
