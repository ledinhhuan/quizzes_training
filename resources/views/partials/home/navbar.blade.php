<nav class="navbar navbar-transparent bg-primary navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100"
     id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img id="quiz-logo" src="{{ asset('assets/img/quiz-logo.png') }}" >
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="sr-only"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <form method="GET" action="{{ route('search.index') }}" class="form-inline form-search">
                    <div class="form-group has-white">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-white btn-raised btn-fab btn-round">
                        <i class="material-icons">search</i>
                    </button>
                </form>
                <li class="nav-item">
                    <a href="{{ route('topics.home.index') }}" class="{{ request()->segment(1) == 'topics' ? 'btn btn-rose btn-round' : 'nav-link' }}">
                        <i class="material-icons">cloud_download</i> @lang('topic.topics')
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login.show') }}" class="{{ request()->segment(1) == 'login' ? 'btn btn-rose btn-round' : 'nav-link' }}">
                            <i class="fa fa-sign-in-alt"></i> @lang('Login')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register.show') }}" class="{{ request()->segment(1) == 'register' ? 'btn btn-rose btn-round' : 'nav-link' }}">
                            <i class="material-icons">how_to_reg</i> @lang('Register')
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                @else
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">account_circle</i>
                            {{ \Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            @if (\Auth::user()->isAdmin())
                                <a class="dropdown-item" href="{{ route('admin.index') }}">
                                    <i class="material-icons mr-1">dashboard</i>
                                    @lang('admin.dashboard')
                                </a>
                            @endif
                            <a href="{{ route('result.history_result') }}" class="dropdown-item">
                                <i class="material-icons mr-1">history</i>
                                @lang('result.result')
                            </a>
                            <a href="#" class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="material-icons mr-1">chevron_right</i>
                                @lang('Logout')
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
