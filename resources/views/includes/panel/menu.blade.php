 <!-- Heading -->
 <h6 class="navbar-heading text-muted">
    @if(auth()->user()->role == 'admin')
        Gestión
    @else
        Menú
    @endif   
</h6>

 <ul class="navbar-nav">

    @include('includes.panel.menu.'.auth()->user()->role)
     
     <li class="nav-item">
         <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
             <i class="fas fa-sign-in-alt"></i> Cerrar sesión
         </a>
         <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
             @csrf
         </form>
     </li>
 </ul>

 @if(auth()->user()->role == 'admin')
    <!-- Divider -->
    <hr class="my-3">
    <!-- Heading -->
    <h6 class="navbar-heading text-muted">Reportes</h6>
    <!-- Navigation -->
    <ul class="navbar-nav mb-md-3">
        <li class="nav-item {{ request()->is('reportes/citas*') ? 'active' : '' }}">
            <a class="nav-link {{ request()->is('reportes/citas*') ? 'active' : '' }}" href="{{ url('/reportes/citas/line') }}">
                <i class="fas fa-chart-area"></i> Citas 
            </a>
        </li>
        <li class="nav-item {{ request()->is('reportes/doctors*') ? 'active' : '' }}">
            <a class="nav-link {{ request()->is('reportes/doctors*') ? 'active' : '' }}" href="{{ url('/reportes/doctors/column') }}">
                <i class="fas fa-chart-bar"></i> Desempeño Médico
            </a>
        </li>
        
    </ul>
 @endif
 