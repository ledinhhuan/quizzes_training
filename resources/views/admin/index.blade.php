@extends('layouts.admin.master')

@section('title', __('admin.dashboard'))

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="rose">
                            <i class="fa fa-book"></i>
                        </div>
                        <div class="card-content">
                            <p class="category">@lang('topic.topics')</p>
                            <h3 class="card-title">{{ $topicsNumber }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="fa fa-question-circle"></i>
                        </div>
                        <div class="card-content">
                            <p class="category">@lang('admin.questions')</p>
                            <h3 class="card-title">{{ $questionsNumber }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="blue">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="card-content">
                            <p class="category">@lang('admin.users')</p>
                            <h3 class="card-title">{{ $usersNumber }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
