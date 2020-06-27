@extends('layouts.home')

@section('title', __('quizz.result_quizz'))

@section('content')
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <h2 class="title text-center">@lang('result.result')</h2>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 mr-auto ml-auto">
                                        <div class="card card-nav-tabs text-center">
                                            <div class="card-header card-header-info">
                                                <h3>@lang('result.score'): {{ $testResult->result }} / {{ count($results) }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="title">@lang('result.finish_time'): {{ $testResult->created_at }}</h4>
                                                <a href="{{ route('topics.home.index') }}" class="btn btn-info">@lang('quizz.take_any_quizz')</a>
                                                <a href="{{ route('home') }}" class="btn btn-primary">@lang('messages.go_back_home')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="container" data-chart="{{ $calculateChart }}" style="min-width: 310px; height: 305px; max-width: 600px; margin: 0 auto"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 ml-auto mr-auto">
                                        <br>
                                        <div class="row">
                                            @forelse ($results as $key => $result)
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="title">
                                                        <h3 id="question-{{ $key }}">{{ ($key + 1) }}. {!! $result->question->content !!}</h3>
                                                    </div>
                                                    @foreach ($result->question->answers as $answer)
                                                        <div class="form-check has-success">
                                                            @if ($result->selected_answer_id == $answer->id and $answer->is_correct)
                                                                <label class="form-check-label">
                                                                    <input disabled checked class="form-check-input" type="radio" name="answers[{{ $result->question->id }}]" id="{{ $answer->id }}" value="{{ $answer->id }}"> {!! $answer->answer !!}
                                                                    <span class="circle">
                                                                        <span class="check"></span>
                                                                    </span>
                                                                </label>
                                                                <i class="material-icons correct">done</i> <span>(@lang('result.your_answer'))</span>
                                                            @elseif ($result->selected_answer_id == $answer->id and ($answer->is_correct == 0))
                                                                <label class="form-check-label">
                                                                    <input disabled checked class="form-check-input" type="radio" name="answers[{{ $result->question->id }}]" id="{{ $answer->id }}" value="{{ $answer->id }}"> {!! $answer->answer !!}
                                                                    <span class="circle">
                                                                        <span class="check"></span>
                                                                    </span>
                                                                </label>
                                                                <i class="material-icons incorrect">clear</i> <span>(@lang('result.your_answer'))</span>
                                                            @else
                                                                <label class="form-check-label">
                                                                    <input disabled class="form-check-input" type="radio" name="answers[{{ $result->question->id }}]" id="{{ $answer->id }}" value="{{ $answer->id }}"> {!! $answer->answer !!}
                                                                    <span class="circle">
                                                                        <span class="check"></span>
                                                                    </span>
                                                                </label>
                                                                @if ($answer->is_correct)
                                                                    <i class="material-icons correct">keyboard_backspace</i> <span>(Correct)</span>
                                                                @endif
                                                            @endif

                                                        </div>
                                                    @endforeach
                                                    <hr>
                                                </div>
                                            @empty
                                                <div class="col-md-12">
                                                    <div class="text-center"><h2>@lang('messages.no_record')</h2></div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/back-history.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/highcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/chart-result.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/prism.js') }}" type="text/javascript"></script>
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
