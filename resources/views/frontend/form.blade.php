@php
    $lang = app()->getLocale() ?? 'en';
    $conditional_on = [];
    $count = 1;
    $type = '';
    $conditional_values = [];

@endphp


<div class="row">
    @foreach($forms as $form)
       

        {{-- Collect conditional_on values --}}
        @php
            if(isset($form->conditional_on)){
                $conditional_on[] = $form->conditional_on;

                // keep only unique values
                $conditional_on = array_unique($conditional_on);

                $type = $form->conditional_on;
            }

            if(isset($form->conditional_value)){
                $conditional_values = $form->conditional_value;
            }
        @endphp


        {{-- TITLE --}}
        @if($form->type == 'title')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2 border-bottom pb-2">
                    <h5> {{ $count }} . {{ $lang == 'ar' ? $form->name_ar : $form->name }}</h5>
                </div>
            </div>
            @php
                $count++;
            @endphp
        @endif

        {{-- TEXT --}}
        @if($form->type == 'text')
            <div class="col-{{ $form->col }} visible" data-condition="{{ isset($form->conditional_on) ? $form->conditional_on : '' }}" data-values="{{ isset($form->conditional_value) ? $form->conditional_value : '' }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input
                        type="text"
                        class="form-control rounded-0"
                        id="{{ Str::slug($form->name, '_') }}"
                        name="form_data[{{ Str::slug($form->name, '_') }}]"
                        value="{{ old('form_data.'.Str::slug($form->name, '_')) }}"
                        placeholder="{{ $form->placeholder ? ($lang=='ar' ? $form->placeholder_ar : $form->placeholder) : ($lang=='ar' ? $form->name_ar : $form->name) }}"
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>

        {{-- EMAIL --}}
        @elseif($form->type == 'email')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input
                        type="email"
                        class="form-control rounded-0"
                        id="{{ Str::slug($form->name, '_') }}"
                        name="form_data[{{ Str::slug($form->name, '_') }}]"
                        value="{{ old('form_data.'.Str::slug($form->name, '_')) }}"
                        placeholder="{{ $form->placeholder ? ($lang=='ar' ? $form->placeholder_ar : $form->placeholder) : ($lang=='ar' ? $form->name_ar : $form->name) }}"
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>

        {{-- NUMBER --}}
        @elseif($form->type == 'number')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input
                        type="number"
                        class="form-control rounded-0"
                        id="{{ Str::slug($form->name, '_') }}"
                        name="form_data[{{ Str::slug($form->name, '_') }}]"
                        value="{{ old('form_data.'.Str::slug($form->name, '_')) }}"
                        placeholder="{{ $form->placeholder ? ($lang=='ar' ? $form->placeholder_ar : $form->placeholder) : ($lang=='ar' ? $form->name_ar : $form->name) }}"
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>

        {{-- TEL --}}
        @elseif($form->type == 'tel')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input
                        type="tel"
                        class="form-control rounded-0"
                        id="{{ Str::slug($form->name, '_') }}"
                        name="form_data[{{ Str::slug($form->name, '_') }}]"
                        value="{{ old('form_data.'.Str::slug($form->name, '_')) }}"
                        placeholder="{{ $form->placeholder ? ($lang=='ar' ? $form->placeholder_ar : $form->placeholder) : ($lang=='ar' ? $form->name_ar : $form->name) }}"
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>

        {{-- SELECT --}}
        @elseif($form->type == 'select')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <select
                        class="form-select rounded-0"
                        id="{{ Str::slug($form->name, '_') }}"
                        name="form_data[{{ Str::slug($form->name, '_') }}]"
                        @if($form->required == 'yes') required @endif
                    >
                        <option value="">{{ $lang == 'ar' ? $form->name_ar : $form->name }}</option>

                        @if($lang == 'ar')
                            @foreach ($form->options_ar as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        @else
                            @foreach ($form->options as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

        {{-- TEXTAREA --}}
        @elseif($form->type == 'textarea')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <textarea
                        class="form-control rounded-0"
                        id="{{ Str::slug($form->name, '_') }}"
                        name="form_data[{{ Str::slug($form->name, '_') }}]"
                        @if($form->required == 'yes') required @endif
                    >{{ old('form_data.'.Str::slug($form->name, '_')) }}</textarea>
                </div>
            </div>

        {{-- FILE --}}
        @elseif($form->type == 'file')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input type="file"
                        class="form-control rounded-0"
                        id="{{ Str::slug($form->name, '_') }}"
                        name="form_file[{{ Str::slug($form->name, '_') }}][]"
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>

        {{-- CHECKBOX --}}
        @elseif($form->type == 'checkbox')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    @php
                        $display = isset($form->display) ? $form->display : '';
                    @endphp

                    <div class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </div>


                    @if ($display == 'form-check-inline')
                        <br />
                    @endif


                    @foreach($lang=='ar' ? $form->options_ar : $form->options as $option)
                        <div class="form-check {{ $display }}">
                            <input type="checkbox"
                                class="form-check-input rounded-0"
                                id="{{ Str::slug($form->name, '_').$option }}"
                                name="form_checkbox[{{ Str::slug($form->name, '_') }}][]"
                                value="{{ $option }}"
                            >
                            <label for="{{ Str::slug($form->name, '_').$option }}">{{ $option }}</label>
                        </div>
                    @endforeach


                </div>
            </div>

        {{-- RADIO --}}
        @elseif($form->type == 'radio')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>

                    @php
                        $display = isset($form->display) ? $form->display : '';
                    @endphp

                    @if ($display == 'form-check-inline')
                        <br />
                    @endif

                    @foreach($lang=='ar' ? $form->options_ar : $form->options as $option)
                        <div class="form-check {{ $display }}">
                            <input type="radio"
                                class="form-check-input rounded-0"
                                id="{{ Str::slug($form->name, '_').$option }}"
                                name="form_radio[{{ Str::slug($form->name, '_') }}]"
                                value="{{ $option }}"
                            >
                            <label for="{{ Str::slug($form->name, '_').$option }}">{{ $option }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

        {{-- DATE / TIME --}}
        @elseif(in_array($form->type, ['date','datetime','time']))
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input
                        type="{{ $form->type }}"
                        class="form-control rounded-0"
                        id="{{ Str::slug($form->name, '_') }}"
                        name="form_data[{{ Str::slug($form->name, '_') }}]"
                        value="{{ old('form_data.'.Str::slug($form->name, '_')) }}"
                        placeholder="{{ $form->placeholder ? ($lang=='ar' ? $form->placeholder_ar : $form->placeholder) : ($lang=='ar' ? $form->name_ar : $form->name) }}"
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>
        @endif
    @endforeach
</div>


@push('script')
<script>
    let conditional_on = @json($conditional_on);
    const isCondition = true;

    // Utility function: get all elements for a given fieldName
    function getFormElements(fieldName) {
        let selector = `
            [name="form_data[${fieldName}]"],
            [name="form_checkbox[${fieldName}][]"],
            [name="form_radio[${fieldName}]"]
        `;
        return document.querySelectorAll(selector);
    }

    // field name change as like type or service_type

    function convertSlug(fieldName){
        if (!fieldName) return '';
    
        return fieldName
            .trim()                     // remove leading/trailing spaces
            .toLowerCase()              // convert to lowercase
            .replace(/\s+/g, '_')       // replace spaces with underscore
            .replace(/[^\w_]/g, '');   // remove all non-alphanumeric/underscore chars
    }

    // Attach event listeners
    conditional_on.forEach(fieldName => {


        let elements = getFormElements(convertSlug(fieldName));

        elements.forEach(el => {
            el.addEventListener('change', function() {
                var type = this.value;

               // console.log(type);

                let visibleElements = document.querySelectorAll('.visible');

                visibleElements.forEach(elem => {
                    let condition = elem.getAttribute('data-condition');
                    let values = elem.getAttribute("data-values");

                    try {
                        values = JSON.parse(values); // parse string into real array or string
                    } catch (e) {
                        values = values ? [values] : [];
                    }

                    // Ensure final result is always an array
                    if (!Array.isArray(values)) {
                        values = [values];
                    }

                    // this filed type to check values array to return true or false
                    if (values.includes(type)) {
                        // match found → keep visible
                        elem.classList.remove("display-none");
                    } else {
                        // no match → hide it
                        elem.classList.add("display-none");
                    }
                });
            });
        });
    });


</script>


@endpush