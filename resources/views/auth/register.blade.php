@extends('layouts.auth')

@section('title', __('Register'))
@section('content')
    <div class="page-header header-filter purple-filter"
         style="background-image: url('{{ asset('assets/img/bg7.jpg') }}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 ml-auto mr-auto">
                    <div class="card card-register">
                        <form action="{{ route('register.store') }}" class="form-register" method="POST">
                            @csrf
                            <h2 class="card-title text-center">@lang('Register')</h2>
                            <div class="card-body">
                                <div class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="material-icons">face</i>
                                        </span>
                                        </div>
                                        <input class="form-control" name="name" value="{{ old('name') }}" placeholder="Name..." type="text" />
                                    </div>
                                    @error('name')
                                        <span class="text-danger form-text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="material-icons">mail</i>
                                            </span>
                                        </div>
                                        <input class="form-control" name="email" value="{{ old('email') }}" placeholder="Email..." type="email" />
                                    </div>
                                    @error('email')
                                    <span class="text-danger form-text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                        </div>
                                        <input class="form-control" name="password" value="{{ old('password') }}" placeholder="Password..." type="password" />
                                    </div>
                                    @error('password')
                                    <span class="text-danger form-text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                        </div>
                                        <input class="form-control" name="password_confirmation"  placeholder="Password..." type="password" />
                                    </div>
                                </div>
                                <div class="bmd-form-group">
                                    <div class="text-center mb-3">
                                        <button type="submit" class="btn btn-primary" href="#">@lang('Register')</button>
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
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            if (localStorage.minutes != null && localStorage.seconds != null) {
                localStorage.removeItem('minutes');
                localStorage.removeItem('seconds');
                localStorage.removeItem('selected');
            }
        });
    </script>
@endpush
