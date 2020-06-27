@extends('layouts.auth')

@section('title', __('Login'))

@section('content')
    <div class="page-header header-filter"
         style="background-image: url('{{ asset('assets/img/bg7.jpg') }}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                    <div class="card card-login">
                        <form action="{{ route('login.store') }}" class="form" method="POST">
                            @csrf
                            <div class="card-header card-header-primary text-center">
                                <h4 class="card-title">@lang('Login')</h4>
                            </div>
                            <p class="description text-center">Or Be Classical</p>
                            <div class="card-body">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">mail</i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="Email..." />
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Password..." />
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-primary" href="#">@lang('Login')</button>
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
