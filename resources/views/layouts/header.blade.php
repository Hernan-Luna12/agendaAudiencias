<nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-shadow navbar-light fixed-top">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="#">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <h2 class="mb-0 fw-bolder" id="section-title"></h2>
            </div>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            {{-- <li class="nav-item d-sm-block d-md-block d-lg-block">
                <a class="nav-link nav-link-style" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cambiar tema">
                    <i class="ficon" data-feather="moon"></i>
                </a>
            </li> --}}
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{ Auth()->user()->name }}</span>
                        {{--  <span class="user-status">{{ Auth()->user()->role->name }}</span>  --}}
                        {{-- <span class="user-status">Role</span> --}}
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{ asset('public/img/avatar/no_avatar.svg') }}" alt="avatar" height="37" width="37">
                    </span>
                    {{-- @switch ( Auth()->user()->persona->datospersonales->idgenero )
                        @case(1)
                            <span class="avatar">
                                <img class="round" src="{{ asset('public/img/avatar/undraw_male_avatar.svg') }}" alt="avatar" height="40" width="40">
                            </span>
                            @break
                        @case(2)
                            <span class="avatar">
                                <img class="round" src="{{ asset('public/img/avatar/undraw_female_avatar.svg') }}" alt="avatar" height="40" width="40">
                            </span>
                            @break
                        @case(3)
                            <span class="avatar">
                                <img class="round" src="{{ asset('public/img/avatar/no_avatar.svg') }}" alt="avatar" height="40" width="40">
                            </span>
                            @break
                        @default
                            <span class="avatar">
                                <img class="round" src="{{ asset('public/img/avatar/no_avatar.svg') }}" alt="avatar" height="40" width="40">
                            </span>
                    @endswitch --}}
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                        <i class="me-50" data-feather="user"></i> Perfil
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="me-50" data-feather="log-out"></i> {{ __('Logout') }}
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>