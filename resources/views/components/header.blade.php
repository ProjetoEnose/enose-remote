<header>
    <div class="logo-contain">
        <img src="{{ asset('images/logo.png') }}" alt="logo">
        <span class="separator">
            /
        </span>
        <span id="user">
            Olá, {{ $user->name }}
        </span>
    </div>
    <a class="user" href="{{ route('user.show', ['user' => $user->id]) }}">
        <img src="{{ asset('storage/' . $pathToProfileImage) }}" alt="user">
    </a>

    <i class="fa-solid fa-bars" id="btn-menu-mobile"></i>
</header>
