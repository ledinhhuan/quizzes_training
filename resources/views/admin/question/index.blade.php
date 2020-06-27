@extends('layouts.admin.master')

@section('title', __('question.list_question'))

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('question.questions')</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">@lang('question.list_question')</h4>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('questions.create') }}" class="btn btn-info btn-round">
                                        <i class="material-icons">add</i> @lang('question.add_question')
                                    </a>
                                </div>
                            </div>
                            <div class="navbar-form navbar-left" style="margin-bottom: 10px;padding-left: 14em">
                                <div class="form-group form-search is-empty">
                                    <input type="text" id="search" class="form-control" placeholder=" Search Question" style="width: 23em;">
                                </div>
                            </div>
                            <div class="col-md-5" style="padding-top: 14px;">
                                <div class="box">
                                    <select id="level" onchange="levelChanged()">
                                        <option value="0">All</option>
                                        <option value="1">Easy</option>
                                        <option value="2">Medium</option>
                                        <option value="3">Hard</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row" id="table-question">
                                    @include('admin.widgets.questions')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script language="javascript">
        function levelChanged() {
            var level = document.getElementById("level").value;
            
            if(level == 1) {
                $('.Easy').parent().show();
                $('.Medium').parent().hide();
                $('.Hard').parent().hide();
            } else if(level == 2) {
                $('.Easy').parent().hide();
                $('.Medium').parent().show();
                $('.Hard').parent().hide();
            } else if(level == 3) {
                $('.Easy').parent().hide();
                $('.Medium').parent().hide();
                $('.Hard').parent().show();
            } else {
                $('.Easy').parent().show();
                $('.Medium').parent().show();
                $('.Hard').parent().show();
            }
        }
    </script>
    <script src="{{ asset('assets/js/question-search.js') }}"></script>
@endsection
