@extends('layouts.admin.master')

@section('title', __('question.create_question'))
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">@lang('question.questions')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('action.create')</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">@lang('question.create_question')</h4>
                        </div>
                        <form action="{{ route('questions.store') }}" method="POST" id="handle-question"
                              class="form-horizontal">
                            @csrf
                            <div class="card-content">
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.topic')</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating">
                                            <select name="topic_id" class="form-control">
                                                <option value="">@lang('topic.choice_topic')</option>
                                                @if (isset($topics))
                                                    @foreach ($topics as $topic)
                                                        @if (old('topic_id') == $topic->id)
                                                            <option value="{{ $topic->id }}" selected>{{ $topic->name }}</option>
                                                        @else
                                                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @include('shared.error', ['value' => 'topic_id'])
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.level')</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating">
                                            <select name="level" class="form-control">
                                                <option value="">Choose level</option>
                                                <option value="1" {{ old('level') == 1 ? 'selected' : '' }}>@lang('question.easy')
                                                </option>
                                                <option value="2" {{ old('level') == 2 ? 'selected' : '' }}>@lang('question.medium')
                                                </option>
                                                <option value="3" {{ old('level') == 3 ? 'selected' : '' }}>@lang('question.hard')
                                                </option>
                                            </select>
                                            @include('shared.error', ['value' => 'level'])
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.question')</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating">
                                            <textarea class="form-control" rows="6" placeholder="Content of question" name="content">{{ old('content') }}</textarea>
                                        </div>
                                        @include('shared.error', ['value' => 'content'])
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.answer')</label>
                                    <div class="col-sm-10 answer-field">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div class="radio" style="margin-top: 17px;">
                                                    <label>
                                                        <input type="radio" name="is_correct" value="1"><span class="circle"></span><span class="check"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="answer[]" required/>
                                                    <span class="material-input"></span></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div class="radio" style="margin-top: 17px;">
                                                    <label>
                                                        <input type="radio" name="is_correct" value="2"><span class="circle"></span><span class="check"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="answer[]" required/>
                                                    <span class="material-input"></span></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button class="btn btn-info btn-round btn-fab btn-fab-mini"
                                                        id="add-field">
                                                    <i class="material-icons">add</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <div id="error"></div>
                                        @if (count($errors))
                                            @foreach ($errors->get('answer.*') as $message)
                                                <li class="text-danger">{{ $message[0] }}</li>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.plain_text')</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating">
                                            <textarea class="form-control" rows="6" name="plain_text">{{ old('plain_text') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-success">@lang('action.create')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/create-question.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/lodash.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/validate-question.js') }}" type="text/javascript"></script>
@endsection
