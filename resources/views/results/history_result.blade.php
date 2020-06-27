@extends('layouts.home')

@section('title', __('result.history_results'))

@section('content')
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="section cd-section section-notifications" id="notifications">
                    <div class="title text-center">
                        <h2>@lang('result.history_results')</h2>
                    </div>
                    <div>
                        @forelse ($testResults as $date => $results)
                            <div class="title">
                                <h3>
                                    <i class="material-icons text-info">alarm</i><a class="text-info" href="">{{ $date }}</a>
                                </h3>
                            </div>
                            @if ($loop->first)
                                <div class="row">
                                    <div class="col-md-2"><h4 class="text-info">#</h4></div>
                                    <div class="col-md-4 text-center">
                                        <h4 class="text-info">@lang('topic.topic_name')</h4></div>
                                    <div class="col-md-2 text-center">
                                        <h4 class="text-info">@lang('question.title_table.level')</h4></div>
                                    <div class="col-md-2 text-center"><h4 class="text-info">@lang('result.result')</h4>
                                    </div>
                                </div>
                            @endif
                            @foreach ($results as $key => $result)
                                <div class="row">
                                    <div class="col-sm-2 col-xs-12">
                                        <a href="{{ route('result.show', $result->id) }}">{{ ($key + 1) }}</a></div>
                                    <div class="col-sm-4 col-xs-12">
                                        <a href="{{ route('quizz.show', ['slug' => $result->topic->slug, 'level' => $result->getOriginal('level')]) }}">{{ $result->topic->name }}</a>
                                    </div>
                                    <div class="col-sm-2 col-xs-12 text-center">{{ $result->level }}</div>
                                    <div class="col-sm-2 col-xs-12 text-center">
                                        {{ $result->result }} point
                                    </div>
                                    <div class="col-sm-2 col-xs-12 text-center">
                                        <button type="button" class="delete-user btn btn-sm btn-danger btn-round" data-id="{{ $result->id }}">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </div>

                                </div>
                                <hr>
                            @endforeach
                        @empty
                            <div class="text-center"><h3>@lang('messages.no_record')</h3></div>
                        @endforelse
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.delete-user').on('click', function (e) {
                e.preventDefault();
                let deleteConfirm = confirm('Do you want to delete ?');
                if (deleteConfirm) {
                    let click = $(this);
                    let testResultId = click.data('id');
                    $.ajax({
                        url: '/results/' + testResultId,
                        type: 'DELETE',
                        data: {
                            'id': testResultId,
                        }
                    }).done(function () {
                        click.closest('.row').next('hr').remove();
                        click.closest('.row').remove();

                    }).fail(function () {
                        alert('Server not responding...');
                    });
                }
            });
        });
    </script>
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