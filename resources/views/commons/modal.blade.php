<div class="modal fade" id="showLevel-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choice Level Quizzes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 ml-auto d-flex justify-content-center">
                        <a href="{{ route('quizz.show', ['slug' => $slug, 'level' => config('setting.level.easy')]) }}" class="btn" data-level="1">Easy</a>
                        <a href="{{ route('quizz.show', ['slug' => $slug, 'level' => config('setting.level.medium')]) }}" class="btn btn-info" data-level="2">Medium</a>
                        <a href="{{ route('quizz.show', ['slug' => $slug, 'level' => config('setting.level.hard')]) }}" class="btn btn-danger" data-level="3">Hard</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-link btn-success btn-simple" data-dismiss="modal">Never mind</button>
            </div>
        </div>
    </div>
</div>