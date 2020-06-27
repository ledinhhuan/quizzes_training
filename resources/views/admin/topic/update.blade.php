@extends('layouts.admin.master')

@section('title', $topic->name)

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('topics.index') }}">@lang('topic.topics')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('action.update')</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('topics.update', $topic->id) }}" method="POST" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="card-header card-header-icon" data-background-color="rose">
                                <i class="material-icons">edit</i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">@lang('topic.update_topic')</h4>
                                <div class="form-group label-floating">
                                    <label class="control-label">
                                        @lang('topic.topic_name')
                                        <small>*</small>
                                    </label>
                                    <input class="form-control" name="name" value="{{ old('name', isset($topic->name) ? $topic->name : '') }}" type="text" required aria-required="true">
                                    <span class="material-input"></span>
                                    @if ($errors->has('name'))
                                        <div class="category form-category text-danger">
                                            <small>*</small> {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">
                                        @lang('topic.title_table.description')
                                        <small>*</small>
                                    </label>
                                    <textarea class="form-control" name="description" rows="3">{{ old('description', isset($topic->description) ? $topic->description : '') }}</textarea>
                                    <span class="material-input"></span>
                                </div>
                                <div class="form-group label-floating">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ $topic->picture }}" alt="{{ $topic->name }}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">@lang('topic.select_image')</span>
                                                <span class="fileinput-exists">@lang('topic.change')</span>
                                                <input type="file" name="picture" />
                                            </span>
                                            <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i>@lang('topic.remove')</a>
                                        </div>
                                        @if ($errors->has('picture'))
                                            <div class="category form-category text-danger">
                                                <small>*</small> {{ $errors->first('picture') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-footer text-left">
                                    <button type="submit" class="btn btn-rose btn-fill">@lang('action.update')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/validation-form.js') }}"></script>
@endsection
