@extends('layouts.home')

@section('title', __('quizz.title_quizz'))
@section('meta_tags')
    <meta name="title" content="@lang('home.title')">
    <meta name="description" content="@lang('home.description')" />
    <meta property="og:title" content="@lang('home.title')" />
    <meta property="og:description" content="@lang('home.description')" />
    <meta property="og:image" content="{{ asset('assets/img/quizizz.png') }}">
@endsection

@section('content')
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                @if (request()->is('search'))
                                    <h2 class="title text-center">@lang('topic.topics')</h2>
                                    <h3 class="title">
                                        <i class="material-icons">search</i>
                                        @lang('messages.search_result', ['attribute' => $data['topic_count']])
                                        @if (!is_null($data['key_word']))
                                            <code class="search-result">{{ $data['key_word'] }}</code>
                                        @endif
                                    </h3>
                                @else
                                    <h2 class="title text-center">@lang('topic.latest_topic')</h2>
                                @endif
                                <br>
                                <div class="col-md-12 ml-auto mr-auto" id="topics-data">
                                    @include('widgets.topics')
                                </div>
                                @if (request()->is('search'))
                                    @include('widgets.load_more')
                                @else
                                    @if (count($topics))
                                        <div class="col-md-12 ml-auto text-center">
                                            <a class="btn btn-info" href="{{ route('topics.home.index') }}">@lang('messages.more') <i class="material-icons">arrow_right_alt</i></a>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @include('partials.home.our_team')

                <div class="section section-contacts">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <h2 class="text-center title">Work with us (developing)</h2>
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
