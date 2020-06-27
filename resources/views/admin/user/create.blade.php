@extends('layouts.admin.master')

@section('title', __('user.create_user'))

@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <br/><br/><br/>
            <ul class="breadcrumb" style="background:#EDEDED">
                <li><a href="{{ route('admin.index') }}">@lang('admin.dashboard')</a></li>
                <li><a href="{{ route('users.index') }}">@lang('user.users')</a></li>
                <li>@lang('action.create')</li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('users.store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card-content">
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('user.title_table.name')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control" type="text" value="{{ old('name', isset($user->name) ? $user->name : '') }}" name="name" required="true" placeholder="Username" />
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('user.title_table.email')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control" type="email" placeholder="Email" value="{{ old('email', isset($user->email) ? $user->email : '') }}" required="true" name="email" />
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">
                                            {{ $errors->first('email') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('user.title_table.password')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control" type="password" placeholder="Password" value="{{ old('password', isset($user->password) ? $user->password : '') }}" required="true" name="password" />
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">
                                            {{ $errors->first('password') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('user.title_table.password')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control" type="password" placeholder="Password Confirmation" required="true" name="password_confirmation" />
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">
                                            {{ $errors->first('password_confirmation') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('user.title_table.role')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <select name="role" class="form-control">
                                                <option value="">--Choose position of user--</option>
                                                <option value="0">Admin</option>
                                                <option value="1">User</option>
                                            </select>
                                        </div>
                                        @if($errors->has('role'))
                                            <span class="text-danger">
                                                {{ $errors->first('role') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-success">@lang('action.create')</button>
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
