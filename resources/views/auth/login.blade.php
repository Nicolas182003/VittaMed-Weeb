@extends('layouts.form')

@section('title', 'Iniciar sesión')

@section('content')
<!-- Page content -->
<div class="container mt--8 pb-5 auth-split-container">
      <div class="row justify-content-center">
        <!-- Left Side - Illustration (Hidden on mobile) -->
        <div class="col-lg-6 d-none d-lg-flex auth-illustration-side">
          <div class="auth-illustration">
            <!-- Medical Illustration SVG -->
            <svg width="400" height="400" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
              <!-- Hospital Building -->
              <rect x="100" y="150" width="200" height="180" rx="10" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>
              <rect x="120" y="170" width="60" height="80" rx="8" fill="rgba(255,255,255,0.2)"/>
              <rect x="220" y="170" width="60" height="80" rx="8" fill="rgba(255,255,255,0.2)"/>
              <circle cx="200" cy="120" r="40" fill="white" opacity="0.9"/>
              <path d="M200 100 L200 140 M180 120 L220 120" stroke="#667eea" stroke-width="8" stroke-linecap="round"/>
              
              <!-- Doctor Figure -->
              <circle cx="160" cy="250" r="20" fill="white"/>
              <rect x="145" y="270" width="30" height="50" rx="5" fill="#667eea"/>
              <rect x="140" y="275" width="10" height="40" rx="3" fill="#764ba2"/>
              <rect x="170" y="275" width="10" height="40" rx="3" fill="#764ba2"/>
              
              <!-- Nurse Figure -->
              <circle cx="240" cy="250" r="20" fill="white"/>
              <rect x="225" y="270" width="30" height="50" rx="5" fill="#764ba2"/>
              <rect x="220" y="275" width="10" height="40" rx="3" fill="#667eea"/>
              <rect x="250" y="275" width="10" height="40" rx="3" fill="#667eea"/>
              
              <!-- Decorative Elements -->
              <circle cx="80" cy="200" r="5" fill="white" opacity="0.6"/>
              <circle cx="320" cy="180" r="7" fill="white" opacity="0.6"/>
              <circle cx="90" cy="280" r="4" fill="white" opacity="0.6"/>
              <circle cx="310" cy="260" r="6" fill="white" opacity="0.6"/>
              
              <!-- Plant -->
              <ellipse cx="70" cy="310" rx="15" ry="8" fill="rgba(255,255,255,0.2)"/>
              <path d="M70 310 Q60 290 55 270 Q60 280 70 285 Q80 280 85 270 Q80 290 70 310" fill="#667eea" opacity="0.6"/>
            </svg>
          </div>
          
          <!-- Brand Section -->
          <div class="auth-brand">
            <div class="auth-brand-logo">
              <i class="fas fa-heartbeat"></i>
            </div>
            <h2>VittaMed</h2>
            <p>Sistema de Gestión de Citas Médicas</p>
          </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            
            <div class="card-body px-lg-5 py-lg-5">
                @if ($errors->any())
                    <div class="text-center text-muted mb-2">
                        <h4>Se encontró el siguiente error</h4>
                    </div>

                    <div class="alert alert-danger mb-4" role="alert">
                        {{ $errors->first() }}
                    </div>
                @else
                    <div class="text-center text-muted mb-4">
                        <small>Ingresa tus credenciales para acceder al sistema</small>
                    </div>
                @endif

              
              <form role="form" method="POST" action="{{ route('login') }}">
                  @csrf 
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Correo Electrónico" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Contraseña" type="password" name="password" required autocomplete="current-password">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input name="remember" class="custom-control-input" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for="remember">
                    <span class="text-muted">Recordar sesión</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Iniciar Sesión</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{ route('password.request') }}" class="text-light"><small>¿Olvidaste tu contraseña?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="{{ route('register') }}" class="text-light"><small>Crear cuenta nueva</small></a>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
