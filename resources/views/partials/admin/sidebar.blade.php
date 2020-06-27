<div class="sidebar" data-active-color="rose" data-background-color="black"
     data-image="{{ asset('assets/img/sidebar-2.jpg') }}">
    <div class="logo">
        <a href="{{ route('admin.index') }}" class="simple-text logo-normal">
            @lang('admin.dashboard')
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ \request()->segment(2) == 'topics' ? 'active' : '' }}">
                <a href="{{ route('topics.index') }}">
                    <i class="material-icons">library_books</i>
                    <p> @lang('topic.topics') </p>
                </a>
            </li>
            <li class="{{ \request()->segment(2) == 'questions' ? 'active' : '' }}">
                <a href="{{ route('questions.index') }}">
                    <i class="material-icons">question_answer</i>
                    <p> @lang('admin.questions') </p>
                </a>
            </li>
            <li class="{{ \Request::segment(2) == 'users' ? 'active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <i class="material-icons">people</i>
                    <p> @lang('admin.users') </p>
                </a>
            </li>
            <li class="{{ \Request::segment(2) == 'results' ? 'active' : '' }}" style="visibility:hidden">
                <a href="{{ route('results.index') }}">
                    <i class="material-icons">date_range</i>
                    <p> @lang('admin.results') </p>
                </a>
            </li>
        </ul>
    </div>
</div>
