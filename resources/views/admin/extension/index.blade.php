@extends('admin.layouts.app', ['title' => 'Extension'])

@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>@lang('Extension')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($extensions as $extension)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb"><img
                                                        src="{{ getImage(getFilePath('extensions') . '/' . $extension->image, getFileSize('extensions')) }}"
                                                        alt="{{ __($extension->name) }}" class="plugin_bg"></div>
                                                <span class="name">{{ __($extension->name) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                echo $extension->statusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button type="button" class="editBtn"
                                                            data-name="{{ __($extension->name) }}"
                                                            data-shortcode="{{ json_encode($extension->shortcode) }}"
                                                            data-action="{{ route('admin.extensions.update', $extension->id) }}">
                                                            <i class="la la-cogs"></i> @lang('Configure')
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="helpBtn"
                                                            data-description="{{ __($extension->description) }}"
                                                            data-support="{{ __($extension->support) }}">
                                                            <i class="la la-question"></i> @lang('Help')
                                                        </button>
                                                    </li>
                                                    @if ($extension->status == Status::DISABLE)
                                                        <li>
                                                            <button type="button" class="confirmationBtn"
                                                                data-action="{{ route('admin.extensions.status', $extension->id) }}"
                                                                data-question="@lang('Are you sure to enable this extension?')">
                                                                <i class="la la-eye"></i> @lang('Enable')
                                                            </button>
                                                        </li>
                                                    @else
                                                        <button type="button" class="confirmationBtn"
                                                            data-action="{{ route('admin.extensions.status', $extension->id) }}"
                                                            data-question="@lang('Are you sure to disable this extension?')">
                                                            <i class="la la-eye-slash"></i> @lang('Disable')
                                                        </button>
                                                    @endif

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- EDIT METHOD MODAL --}}
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Extension'): <span class="extension-name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Script')</label>
                            <div class="col-md-12">
                                <textarea name="script" class="form-control" required rows="8" placeholder="@lang('Paste your script with proper key')">{{ old('script') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100" id="editBtn">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- HELP METHOD MODAL --}}
    <div id="helpModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Need Help')?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection


@push('breadcrumb-plugins')
    <x-search-form placeholder="@lang('Search')" />
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";

            $(document).on('click', '.editBtn', function() {
                var modal = $('#editModal');
                var shortcode = $(this).data('shortcode');

                modal.find('.extension-name').text($(this).data('name'));
                modal.find('form').attr('action', $(this).data('action'));

                var html = '';
                $.each(shortcode, function(key, item) {
                    html += `<div class="form-group">
                        <label class="col-md-12 control-label fw-bold">${item.title}</label>
                        <div class="mb-3 col-md-12">
                            <input name="${key}" class="form-control" placeholder="--" value="${item.value}" required>
                        </div>
                    </div>`;
                })
                modal.find('.modal-body').html(html);

                modal.modal('show');
            });

            $(document).on('click', '.helpBtn', function() {
                var modal = $('#helpModal');
                var path = "{{ asset(getFilePath('extensions')) }}";
                modal.find('.modal-body').html(`<div class="mb-2">${$(this).data('description')}</div>`);
                if ($(this).data('support') != 'na') {
                    modal.find('.modal-body').append(`<img src="${path}/${$(this).data('support')}">`);
                }
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush
