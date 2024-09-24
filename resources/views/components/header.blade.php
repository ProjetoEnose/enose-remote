<header>
    <div class="logo-contain">
        <img src="{{ asset('images/logo.png') }}" alt="logo">
        <span class="separator">
            /
        </span>
        <span id="user">
            Olá, {{ $userName }}
        </span>
    </div>
    <div class="services-contain">
        <div class="notification">
            <a href="/notifications">
                <i class="fa-solid fa-bell"></i>
            </a>
        </div>
        <div class="about">
            <a href="">
                <i class="fa-solid fa-circle-info"></i>
            </a>
        </div>
        <div class="user">
            <a href="{{ route('user.show', ['user' => $userID]) }}">
                <img src="{{ asset($pathToProfileImage) }}" alt="user">
            </a>
        </div>
    </div>

    <i class="fa-solid fa-bars" id="btn-menu-mobile"></i>
</header>
