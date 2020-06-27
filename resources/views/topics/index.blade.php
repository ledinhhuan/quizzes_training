@extends('layouts.home')

@section('title', __('topic.topics'))

@section('content')
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <h2 class="title text-center">@lang('topic.latest_topic')</h2>
                            </div>
                            <div class="col-md-12 ml-auto mr-auto" id="topics-data">
                                @include('widgets.topics')
                            </div>
                            <div class="col-md-12 ml-auto text-center">
                                @if (count($topics) and $topics->hasMorePages())
                                    <button class="btn btn-info" id="load-more" data-page="{{ $topics->currentPage() }}">@lang('messages.more') <i class="material-icons">arrow_right_alt</i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/load-more.js') }}" type="text/javascript"></script>
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
