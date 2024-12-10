<div class="menu-mobile">
    <nav>
        <a class="user" href="{{ route('user.show', ['user' => $user->id]) }}">
            <img src="{{ asset($pathToProfileImage) }}" alt="user" width="500">
        </a>
        <a href="{{ route('dashboard.index') }}">
            <div class="icon">
                <i class="fa-solid fa-chart-simple"></i>
            </div>
            <div class="description">
                dashboard
            </div>
        </a>
        <a href="/sensors">
            <div class="icon">
                <i class="fa-solid fa-tower-broadcast"></i>
            </div>
            <div class="description">
                sensores
            </div>
        </a>
        <a href="">
            <div class="icon">
                <i class="fa-solid fa-temperature-arrow-up"></i>
            </div>
            <div class="description">
                temperatura
            </div>
        </a>
        @if ($user->isAdmin())
            <a href="{{ route('user.create') }}">
                <div class="icon">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                <div class="description">
                    gerir usuários
                </div>
            </a>
        @endif

        <a href="{{ route('logout') }}">
            <div class="icon">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
            <div class="description">
                sair
            </div>
        </a>

    </nav>
</div>
