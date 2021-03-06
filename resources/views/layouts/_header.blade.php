<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;<li><a href="{{ route('front.news.index') }}">{{ trans('newsItems.news') }}</a></li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">{{ trans('auth.general.login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ trans('auth.general.register') }}</a></li>
                @else
                    <li><a href="{{ route('admin.news-categories.index') }}">{{ trans('news-categories.news_categories') }}</a></li>
                    <li><a href="{{ route('admin.news-items.index') }}">{{ trans('newsItems.news_items') }}</a></li>
                    <li><a href="{{ route('admin.tags.index') }}">{{ trans('tags.tags') }}</a></li>
                    <li><a href="{{ route('admin.users.index') }}">{{ trans('users.users') }}</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{!! route('admin.users.edit', [Auth::user()->id]) !!}">{{ trans('auth.general.update_profile') }} </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ trans('auth.general.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>