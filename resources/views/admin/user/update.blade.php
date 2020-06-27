@extends('layouts.admin.master')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <br/><br/><br/>
            <ul class="breadcrumb" style="background:#EDEDED">
                <li><a href="{{ route('admin.index') }}">@lang('admin.dashboard')</a></li>
                <li><a href="{{ route('users.index') }}">@lang('user.users')</a></li>
                <li>@lang('action.edit')</li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('users.update', $user->id) }}" method="post" class="form-horizontal">
                            @csrf
                            @method('PATCH')
                            <div class="card-content">
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">@lang('user.title_table.name')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input disabled class="form-control" type="text" value="{{ old('name', isset($user->name) ? $user->name : '') }}" required="true" placeholder="Username" />
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
                                            <input disabled class="form-control" type="email" placeholder="Email" value="{{ old('email', isset($user->email) ? $user->email : '') }}" required="true" name="email" />
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">
                                            {{ $errors->first('email') }}
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
                                                @for($i = 0; $i < count($user->getLevels()); $i++)
                                                    @if($user->role == $i)
                                                        <option value="{{ $i }}" selected="selected">{{ $user->getLevels()[$i]['role'] }}</option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $user->getLevels()[$i]['role'] }}</option>
                                                    @endif
                                                @endfor
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
                                    <button type="submit" class="btn btn-success">@lang('action.edit')</button>
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
