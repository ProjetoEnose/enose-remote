<div class="menu-sidebar">
    <i class="fa-solid fa-circle-chevron-left" id="btn-alter-menu"></i>

    <nav>
        <a href="{{ route('home.show') }}">
            <div class="icon">
                <i class="fa-solid fa-house"></i>
            </div>
            <div class="description">
                home
            </div>
        </a>

        <a href="{{ route('dashboard.show') }}">
            <div class="icon">
                <i class="fa-solid fa-chart-simple"></i>
            </div>
            <div class="description">
                dashboard
            </div>
        </a>
        <a href="{{ route('sensors.show') }}">
            <div class="icon">
                <i class="fa-solid fa-tower-broadcast"></i>
            </div>
            <div class="description">
                sensores
            </div>
        </a>
        <a href="{{ route('temperature.show') }}">
            <div class="icon">
                <i class="fa-solid fa-temperature-arrow-up"></i>
            </div>
            <div class="description">
                temperatura
            </div>
        </a>
        <nav>
            <a href="{{ route('logout') }}">
                <div class="icon">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <div class="description">
                    sair
                </div>
            </a>
        </nav>

    </nav>
</div>
