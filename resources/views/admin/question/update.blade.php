@extends('layouts.admin.master')

@section('title',$question->content)

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">@lang('admin.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                    href="{{ route('questions.index') }}">@lang('question.questions')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('action.update')</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">@lang('question.update_question')</h4>
                        </div>
                        <form action="{{ route('questions.update', $question->id) }}" method="POST"
                              class="form-horizontal" id="handle-question">
                            @csrf
                            @method('PATCH')
                            <div class="card-content">
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.topic')</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating">
                                            <select name="topic_id" class="form-control">
                                                <option value="">@lang('topic.choice_topic')</option>
                                                @if (isset($topics))
                                                    @foreach ($topics as $topic)
                                                        @if ($topic->id == $question->topic->id)
                                                            <option value="{{ $topic->id }}"
                                                                    selected>{{ $topic->name }}</option>
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
                                                @for ($i = 1; $i <= count($question->getLevels()); $i++)
                                                    @if ($question->level == $i)
                                                        <option value="{{ $i }}"
                                                                selected="selected">{{ $question->getLevels()[$i]['name'] }}</option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $question->getLevels()[$i]['name'] }}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                            @include('shared.error', ['value' => 'level'])
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.question')</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating">
                                            <textarea class="form-control" id="content"
                                                      placeholder="Content of question"
                                                      rows="6"
                                                      name="content">{{ isset($question->content) ? $question->content : '' }}</textarea>
                                        </div>
                                        @include('shared.error', ['value' => 'content'])
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.answer')</label>
                                    <div class="col-sm-10 answer-field">
                                        @foreach ($question->answers as $key => $answer)
                                            <div class="row">
                                                @if ($answer->is_correct)
                                                    <div class="col-sm-1">
                                                        <div class="form-group radio" style="margin-top: 17px;">
                                                            <label>
                                                                <input type="radio" checked="checked" name="is_correct"
                                                                       value="{{ ($key + 1) }}" class="check-radio">
                                                                <span
                                                                        class="circle"></span><span
                                                                        class="check"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-sm-1">
                                                        <div class="form-group radio" style="margin-top: 17px;">
                                                            <label>
                                                                <input type="radio" name="is_correct"
                                                                       value="{{ ($key + 1) }}" class="check-radio">
                                                                <span class="circle"></span><span
                                                                        class="check"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-sm-9">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"></label>
                                                        <input type="hidden" value="{{ $answer->id }}" name="id[]"/>
                                                        <input class="form-control check-answer" type="text" value="{{ $answer->answer }}" name="answer[]" required/>
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                @if ($loop->first)
                                                    <div class="col-sm-2">
                                                        <button class="btn btn-info btn-round btn-fab btn-fab-mini" id="add-field">
                                                            <i class="material-icons">add</i>
                                                        </button>
                                                    </div>
                                                @endif
                                                @if ($key >= 2)
                                                    <div class="col-sm-2">
                                                        <button class="btn btn-danger btn-round btn-fab btn-fab-mini remove_field">
                                                            <i class="material-icons">remove</i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
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
                                            <textarea class="form-control" rows="6"
                                                      name="plain_text">{{ isset($question->plain_text) ? $question->plain_text : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="submit" id="submit"
                                                class="btn btn-success">@lang('action.update')</button>
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
