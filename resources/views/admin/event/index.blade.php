@extends('admin.layouts.app', ['title' => 'Events'])
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive--md table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>

                                    <th>@lang('Image') | @lang('Title')</th>
                                    <th>@lang('Title') (@lang('Arabic'))</th>
                                    <th>@lang('Category')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Created At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($events as $event)
                                    <tr>
                                        <td>
                                            <div class="gap-2 d-flex align-items-center">
                                                <div class="avatar avatar--sm">
                                                    <img src="{{ getImage(getFilePath('events') . '/' . $event->image, getFileSize('events')) }}"
                                                        alt="@lang('Image')">
                                                </div>
                                                <a
                                                    href="{{ route('admin.events.show', $event->id) }}">{{ strLimit($event->title, 15) }}</a>
                                            </div>
                                        </td>
                                        <td><a
                                                href="{{ route('admin.events.show', $event->id) }}">{{ strLimit($event->title_ar, 15) }}</a>
                                        </td>
                                        <td>
                                            @if (app()->getLocale() == 'en')
                                                {{ optional($event->category)->name }}
                                            @else
                                                {{ optional($event->category)->name_ar }}
                                            @endif
                                        </td>

                                        <td>
                                           {{ $event->type }}
                                        </td>
                                        <td>

                                            @php echo $event->statusBadge; @endphp

                                        </td>
                                        <td>
                                            <small>{{ showDateTime($event->created_at, 'd M Y') }}</small>
                                            <br>
                                            <small>{{ showDateTime($event->created_at, 'H:i A') }}</small>
                                        </td>
                                        <td>

                                            <div class="btn-group">
                                                <button data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="{{ route('admin.events.edit', $event->id) }}">
                                                            <i class="bi bi-pencil me-1"></i> @lang('Edit')
                                                        </a>
                                                    </li>
                                                    <li><a href="{{ route('admin.events.show', $event->id) }}"> <i
                                                                class="bi bi-eye me-1"></i> @lang('Details')</a></li>
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
                @if ($events->hasPages())
                    <div class="card-footer pagination-card-footer">
                        {{ paginateLinks($events) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="flex-wrap gap-3 d-flex">
        <x-search-form placeholder="@lang('Search')" />
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>@lang('Add New')</a>
    </div>
@endpush
