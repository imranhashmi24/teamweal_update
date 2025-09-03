@extends('admin.layouts.app', ['title' => 'Event Ask'])
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive--md table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('City')</th>
                                    <th>@lang('Events')</th>
                                    <th>@lang('Request Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($event_asks as $eventAsk)
                                <tr>
                                    <td>
                                        {{@$eventAsk->name}}
                                    </td>
                                    <td>
                                        {{@$eventAsk->city}}
                                    </td>
                                    <td>
                                        @if(app()->getLocale() == 'en')
                                            {{@$eventAsk->event?->title}}
                                        @else
                                           {{@$eventAsk->event?->title_ar}}
                                        @endif
                                    </td>

                                    <td>
                                        <small>{{ showDateTime($eventAsk->created_at,'d M Y') }}</small>
                                        <br>
                                        <small>{{ showDateTime($eventAsk->created_at,'H:i A') }}</small>
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            <button data-bs-toggle="dropdown">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ route('admin.event_ask.show', $eventAsk->id) }}">
                                                        <i class="bi bi-eye"></i>@lang('Details')
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-muted" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($event_asks->hasPages())
                    <div class="card-footer pagination-card-footer">
                        {{ paginateLinks($event_asks) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="flex-wrap gap-3 d-flex">
        <x-search-form placeholder="Search" />
    </div>
@endpush
