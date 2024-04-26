<nav class="navbar fixed-top flex-md-nowrap p-0 shadow">
    <a class="app-title navbar-brand col-sm-3 col-md-2 mr-0 px-3 text-white" href="{{route('home')}}">{{$appName}}</a>
    <search-field></search-field>
<span class="nav-link col-sm-2 mr-0 text-center" style="color: #FFF">{{$user->name}}</span>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
                <a class="nav-link text-white" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
             </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
        </li>
    </ul>
</nav>