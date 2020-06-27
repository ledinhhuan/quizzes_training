@extends('layouts.admin.master')

@section('title', __('user.list_user'))

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
                            <h4 class="card-title">@lang('user.list_user')</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('users.create') }}" class="btn btn-info btn-round">
                                        <i class="material-icons"></i> @lang('user.add_user')
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <div class="box" style="top: 50%; left: 46%">
                                        <select id="status" onchange="statusChanged()">
                                            <option value="0">All</option>
                                            <option value="1">Active</option>
                                            <option value="2" >Non-active</option>
                                        </select>
                                    </div>
                                    <div class="navbar-form navbar-right">
                                        <div class="form-group form-search is-empty">
                                            <input type="text" name="search" id="search" class="form-control" placeholder=" Search ">
                                            <span class="material-input"></span>
                                            <span class="material-input"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="table-user">
                                @include('admin.widgets.users')
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
                $('.Active').parent().show();
                $('.Non-active').parent().hide();
            } 
            else if(status == 2) {
                $('.Active').parent().hide();
                $('.Non-active').parent().show();
            } else {
                $('.Active').parent().show();
                $('.Non-active').parent().show();
            }
        }
    </script>
    <script src="{{ asset('assets/js/user-search.js') }}"></script>
@endsection
