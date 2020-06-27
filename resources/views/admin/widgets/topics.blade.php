<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered table-striped datatable">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">@lang('topic.title_table.topic')</th>
                <th class="text-center">@lang('topic.title_table.status')</th>
                <th class="text-center">@lang('topic.title_table.description')</th>
                <th class="text-center">@lang('topic.title_table.image')</th>
                <th class="text-center">@lang('topic.title_table.option')</th>
            </tr>
            </thead>
            <tbody>
            <input type="hidden" id="page-hidden" value="1">
            @forelse ($topics as $topic)
                <tr>
                    <td class="text-center">{{ $topic->id }}</td>
                    <td style="width: 20%;" class="text-center">{{ $topic->name }}</td>
                    <td class="text-center {{ $topic->getStatus($topic->topic_status)['name']}}" >
                        <a href="{{ route('admin.get.active.topic', $topic->id) }}">
                            <button class="btn btn-round btn-{{ $topic->topic_status ? 'success' : 'danger' }}">
                                <span class="btn-label">
                                    <i class="material-icons">{{ $topic->topic_status ? 'check' : 'close' }}</i>
                                </span>
                                {{ $topic->getStatus($topic->topic_status)['name']}}
                            </button>
                        </a>
                    </td>
                    <td style="width: 25%;" class="text-center">{{ $topic->description }}</td>
                    <td style="text-align: center">
                        <div class="img-container" style="display: block; margin-left: auto; margin-right: auto;">
                            <img src="{{ $topic->picture }}" alt="{{ $topic->name }}">
                        </div>
                    </td>
                    <td class="td-actions">
                        <a href="{{ route('topics.edit', $topic->id) }}"
                           class="btn btn-success">
                            <i class="material-icons">edit</i>
                        </a>
                        <form action="{{ route('topics.destroy', $topic->id) }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('All related questions would be deleted too. @lang('action.delete_confirm') ')">
                                <i class="material-icons">close</i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="6">@lang('messages.no_record')</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-5 text-left">
        <h5 class="show-entries">Show {{ $topics->firstItem() }}
            to {{ $topics->lastItem() }} of {{ $topics->total() }} entries</h5>
    </div>
    <div class="col-md-7 text-right" id="pagination">
        {{ $topics->onEachSide(1)->links() }}
    </div>
</div>
