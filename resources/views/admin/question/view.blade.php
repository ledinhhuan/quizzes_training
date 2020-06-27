@extends('layouts.admin.master')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <br/><br/><br/>
            <ul class="breadcrumb" style="background:#EDEDED">
                <li><a href="{{ route('admin.index') }}">@lang('admin.dashboard')</a></li>
                <li><a href="{{ route('questions.index') }}">@lang('question.questions')</a></li>
                <li>{{ isset($question->id) ? $question->id : '' }}</li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.topic')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <input disabled="disabled" class="form-control" type="text" value="@if(isset($question->topic->name)) {{ $question->topic->name }} @endif" name="name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.level')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <select name="level" class="form-control" disabled="disabled">
                                                <option value="">--Choose level of question--</option>
                                                @for($i = 1; $i <= count($question->getLevels()); $i++)
                                                    @if($question->level == $i)
                                                        <option selected="selected">{{ $question->getLevels()[$i]['name'] }}</option>
                                                    @else
                                                        <option>{{ $question->getLevels()[$i]['name'] }}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.question')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <textarea class="form-control" disabled="disabled">{{ isset($question->content) ? $question->content : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.answer')</label>
                                    <div class="col-sm-7">
                                        @for($i = 0; $i < count($question->answers); $i++)
                                            @if($question->answers[$i]->is_correct == 1)
                                                <input disabled="disabled" checked = checked class="answer-radio" type="radio" name="is-correct" value="">
                                            @else
                                                <input disabled="disabled" class="answer-radio" type="radio" name="is-correct" value="">
                                            @endif
                                            <input disabled="disabled" type="" id="name" value="{{ $question->answers[$i]->answer }}" name="name">
                                            <br>
                                        @endfor
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('question.title_table.plain_text')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <textarea class="form-control" disabled="disabled">{{ isset($question->plain_text) ? $question->plain_text : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-success">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-danger delete">
                                        <i class="material-icons">close</i>
                                    </a>
                                    <form  id="submit-delete" action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
@section('scripts')
@endsection