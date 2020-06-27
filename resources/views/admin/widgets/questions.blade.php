<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="text-align:center;">
            <thead>
                <tr style="text-align:center;">
                    <th style="text-align:center;" width="5%">@lang('question.title_table.id')</th>
                    <th style="text-align:center;" width="10%">@lang('question.title_table.topic')</th>
                    <th style="text-align:center;">@lang('question.title_table.question')</th>
                    <th style="text-align:center;" width="10%">@lang('question.title_table.level')</th>
                    <th style="text-align:center;" width="30%">@lang('question.title_table.option')</th>
                </tr>
            </thead>
            <tbody>
                <input type="hidden" id="page-hidden" value="1">
                @forelse ($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ isset($question->topic->name) ? $question->topic->name : '[N\A]' }}</td>
                    <td>{{ $question->content }}</td>
                    <td class="{{ $question->getLevel($question->level)['name'] }}">{{ $question->getLevel($question->level)['name'] }}</td>
                    <td class="td-actions">
                        
                        <a href="{{ route('questions.show', $question->id) }}"
                           class="btn btn-info">
                            <i class="material-icons">info</i>
                        </a>
                        <a href="{{ route('questions.edit', $question->id) }}"
                           class="btn btn-success">
                            <i class="material-icons">edit</i>
                        </a>
                        <form action="{{ route('questions.destroy', $question->id) }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('@lang('action.delete_confirm')')">
                                <i class="material-icons">close</i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    <td colspan="5">@lang('messages.no_record')</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-5 text-left">
        <h5 class="show-entries">Show {{ $questions->firstItem() }}
            to {{ $questions->lastItem() }} of {{ $questions->total() }} entries</h5>
    </div>
    <div class="col-md-7 text-right" id="pagination">
        {{ $questions->links() }}
    </div>
</div>
