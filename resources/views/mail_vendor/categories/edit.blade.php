@extends('admin.layouts.app', ['title' => 'Edit Category'])
@section('panel')
    <div class="container-fluid">
        <div class="pb-2 mb-2 page-breadcrumb d-flex align-items-center border-bottom">

            <div class="ms-auto">
                <a href="{{ route('admin.category.index') }}" type="button" class="btn btn-primary btn-sm"> <i
                        class="bi bi-arrow-counterclockwise"></i> @lang('Back To Category List')</a>
            </div>
        </div>
        <!--breadcrumb-->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.category.update',$category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <div class="py-2 col-sm-7">
                            <div class="form-group">
                                <label for="title">@lang('Title')</label>
                                <input type="text" name="title" value="{{ $category->title }}" class="form-control">
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            </div>
                        </div>

                        <div class="py-2 col-sm-7">
                            <div class="form-group">
                                <label for="type">@lang('Type')</label>
                                <select name="type" id="type" class="form-control">
                                    <option {{  $category->type == "EMAIL" ? "selected" : "" }} value="EMAIL"> @lang('EMAIL')</option>
                                    <option {{  $category->type == "SMS" ? "selected" : "" }} value="SMS"> @lang('SMS')</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                            </div>
                        </div>

                        <div class="mt-3 col-sm-12">
                            <a href="{{ route('admin.category.index') }}" class="px-3 btn btn-warning btn-sm">@lang('Cancel')</a>
                            <button type="submit" class="px-3 btn btn-primary btn-sm">@lang('Update')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
