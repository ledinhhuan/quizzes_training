<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered table-striped datatable">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">@lang('user.title_table.name')</th>
                <th class="text-center">@lang('user.title_table.email')</th>
                <th class="text-center">@lang('user.title_table.role')</th>
                <th class="text-center">@lang('user.title_table.status')</th>
                <th class="text-center" style="width: 25%">@lang('user.title_table.option')</th>
            </tr>
            </thead>
            <tbody>
            <input type="hidden" id="page-hidden" value="1">
            @forelse ($users as $user)
                <tr>
                    <td class="text-center">{{ $user->id }}</td>
                    <td class="text-center" style="width: 25%;">{{ $user->name }}</td>
                    <td style="width: 30%;" class="text-center">{{ $user->email }}</td>
                    <td style="width: 10%;" class="text-center">{{ $user->getLevelUser($user->role)['role'] }}</td>
                    <td class="text-center {{ $user->getStatus($user->user_status)['name']}}" style="width: 15%;">
                        <a href="{{ route('admin.get.active.user', $user->id) }}" style="color: #fff;">
                               <button class="{{ $user->getStatus($user->user_status)['name'] == 'Active' ? 'btn btn-info' : 'btn btn-danger' }}">
                                {{ $user->getStatus($user->user_status)['name']}}
                            </button>
                        </a>
                    </td>
                    <td class="td-actions text-center">
                        <a href="{{ route('users.edit', $user->id) }}"
                           rel="tooltip" class="btn btn-success"
                           data-original-title="Edit" title="{{ __('action.edit') }}">
                            <i class="material-icons">edit</i>
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display:inline">
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
                    <td colspan="6">@lang('messages.no_record')</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-5 text-left">
        <h5 class="show-entries">Show {{ $users->firstItem() }}
            to {{ $users->lastItem() }} of {{ $users->total() }} entries</h5>
    </div>
    <div class="col-md-7 text-right" id="pagination">
        {{ $users->onEachSide(1)->links() }}
    </div>
</div>
