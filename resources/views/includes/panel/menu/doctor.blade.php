<li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
    <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="/home">
        <i class="fas fa-chart-bar"></i> Dashboard
    </a>
</li>
<li class="nav-item {{ request()->is('horario*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->is('horario*') ? 'active' : '' }}" href="/horario">
        <i class="fas fa-calendar-alt"></i> Mi Horario
    </a>
</li>
<li class="nav-item {{ request()->is('miscitas*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->is('miscitas*') ? 'active' : '' }}" href="/miscitas">
        <i class="fas fa-notes-medical"></i> Mis Citas
    </a>
</li>