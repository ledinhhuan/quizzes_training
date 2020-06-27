@extends('layouts.home')

@section('title', __('quizz.title_quizz'))

@section('styles')
    <style>
        .timer_countdown {
            font-weight: 500;
            float: right;
            position: relative;
            color: #e91e63;
            font-size: 20px;
        }

        span#time {
            position: fixed;
        }
    </style>
@endsection

@section('content')
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="section">
                    <div class="container">
                        <form action="{{ route('quizz.store') }}" method="POST" id="quizz_submit">
                            @csrf
                            <input type="hidden" name="key" value="{{ $cacheKey }}">
                            <div class="row">
                                <div class="col-md-12 ml-auto mr-auto">
                                    <h2 class="title text-center">@lang('quizz.make_quizz')</h2>
                                    <h5 class="title text-center">{{ $topic->name }}</h5>
                                    <input type="hidden" name="topic-id" value="{{ $topic->id }}">
                                    <br>
                                    <div class="timer_countdown">
                                        <span id="time"></span>
                                    </div>
                                    <div class="row">
                                        @forelse ($questions as $key => $question)
                                            <input type="hidden" name="questions[{{ $question->id }}]" value="{{ $question->id }}">
                                            <input type="hidden" name="level" value="{{ $question->level }}">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="title">
                                                    <h3 id="question-{{ $key }}">{{ ($key + 1) }}. {!! $question->content !!}</h3>
                                                </div>
                                                @forelse ($question->answers as $answer)
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="{{ $answer->id }}" value="{{ $answer->id }}">
                                                            {!! $answer->answer !!}
                                                            <span class="circle">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                @empty
                                                    <label class="form-check-label">@lang('messages.no_record')</label>
                                                @endforelse
                                                <hr>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <div class="text-center"><h2>@lang('messages.no_record')</h2></div>
                                            </div>
                                        @endforelse
                                    </div>

                                    @if (count($questions))
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <button type="submit" id="submitQuiz" class="btn btn-rose btn-upgrade btn-lg">
                                                    <i class="material-icons">unarchive</i> @lang('quizz.submit_quizz')
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/prism.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/submit-quizz.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/countdown.js') }}" type="text/javascript"></script>
@endsection
