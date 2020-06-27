@extends('layouts.admin.master')

@section('title', __('topic.list_topic'))

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">@lang('topic.list_topic')</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('topics.create') }}" class="btn btn-info btn-round">
                                        <i class="material-icons">add</i> @lang('topic.add_topic')
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <div class="box" style="top:50%; left:-29%">
                                        <select id="status" onchange="statusChanged()">
                                            <option value="0">All</option>
                                            <option value="1">Enable</option>
                                            <option value="2" >Disable</option>
                                        </select>
                                    </div>
                                    <div class="navbar-form navbar-right">
                                        <div class="form-group form-search is-empty">
                                            <input type="text" id="search" class="form-control" placeholder=" Search ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="table-topic">
                                @include('admin.widgets.topics')
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
        function statusChanged() {
            var status = document.getElementById("status").value;
            if(status == 1) {
                $('.Enable').parent().show();
                $('.Disable').parent().hide();
            } 
            else if(status == 2) {
                $('.Enable').parent().hide();
                $('.Disable').parent().show();
            } else {
                $('.Enable').parent().show();
                $('.Disable').parent().show();
            }
        }
    </script>
    <script src="{{ asset('assets/js/topic-search.js') }}" type="text/javascript"></script>
@endsection
