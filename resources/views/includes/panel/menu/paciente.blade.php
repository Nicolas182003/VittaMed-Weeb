<li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
    <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="/home">
        <i class="fas fa-home"></i> Inicio
    </a>
</li>
<li class="nav-item {{ request()->is('reservarcitas*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->is('reservarcitas*') ? 'active' : '' }}" href="/reservarcitas/create">
        <i class="fas fa-calendar-plus"></i> Reservar Cita
    </a>
</li>
<li class="nav-item {{ request()->is('miscitas*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->is('miscitas*') ? 'active' : '' }}" href="/miscitas">
        <i class="fas fa-file-medical"></i> Mis Citas
    </a>
</li>