<li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
    <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="/home">
        <i class="fas fa-chart-line"></i> Dashboard
    </a>
</li>
<li class="nav-item {{ request()->is('especialidades*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->is('especialidades*') ? 'active' : '' }}" href="{{ url('/especialidades') }}">
        <i class="fas fa-clipboard-list"></i> Especialidades
    </a>
</li>
<li class="nav-item {{ request()->is('medicos*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->is('medicos*') ? 'active' : '' }}" href="/medicos">
        <i class="fas fa-user-md"></i> Médicos
    </a>
</li>