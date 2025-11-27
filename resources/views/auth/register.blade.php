@extends('layouts.form')

@section('title', 'Regístrate')

@section('content')
<div class="container mt--8 pb-5 auth-split-container">
      <!-- Table -->
      <div class="row justify-content-center">
        <!-- Left Side - Illustration (Hidden on mobile) -->
        <div class="col-lg-5 d-none d-lg-flex auth-illustration-side">
          <div class="auth-illustration">
            <!-- Medical Illustration SVG -->
            <svg width="380" height="380" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
              <!-- Clipboard/Form -->
              <rect x="120" y="80" width="160" height="220" rx="12" fill="white" opacity="0.95"/>
              <rect x="140" y="100" width="120" height="8" rx="4" fill="#667eea" opacity="0.3"/>
              <rect x="140" y="120" width="100" height="8" rx="4" fill="#764ba2" opacity="0.3"/>
              <rect x="140" y="140" width="80" height="8" rx="4" fill="#667eea" opacity="0.3"/>
              
              <!-- Checkmarks -->
              <circle cx="145" cy="170" r="8" fill="#667eea" opacity="0.3"/>
              <path d="M142 170 L144 172 L148 168" stroke="white" stroke-width="2" stroke-linecap="round" fill="none"/>
              <circle cx="145" cy="200" r="8" fill="#764ba2" opacity="0.3"/>
              <path d="M142 200 L144 202 L148 198" stroke="white" stroke-width="2" stroke-linecap="round" fill="none"/>
              <circle cx="145" cy="230" r="8" fill="#667eea" opacity="0.3"/>
              <path d="M142 230 L144 232 L148 228" stroke="white" stroke-width="2" stroke-linecap="round" fill="none"/>
              
              <!-- Pen/Pencil -->
              <rect x="240" y="260" width="8" height="40" rx="4" fill="#764ba2" transform="rotate(-45 244 280)"/>
              <path d="M250 270 L255 265" stroke="#667eea" stroke-width="3" stroke-linecap="round"/>
              
              <!-- Person Icon -->
              <circle cx="200" cy="180" r="25" fill="rgba(102, 126, 234, 0.2)"/>
              <circle cx="200" cy="170" r="12" fill="#667eea"/>
              <path d="M185 195 Q200 185 215 195" stroke="#667eea" stroke-width="6" stroke-linecap="round" fill="none"/>
              
              <!-- Decorative -->
              <circle cx="100" cy="150" r="6" fill="white" opacity="0.6"/>
              <circle cx="300" cy="140" r="8" fill="white" opacity="0.6"/>
              <circle cx="95" cy="250" r="5" fill="white" opacity="0.6"/>
              <circle cx="305" cy="230" r="7" fill="white" opacity="0.6"/>
              
              <!-- Medical Cross Small -->
              <path d="M280 100 L280 120 M270 110 L290 110" stroke="white" stroke-width="4" stroke-linecap="round" opacity="0.6"/>
            </svg>
          </div>
          
          <!-- Brand Section -->
          <div class="auth-brand">
            <div class="auth-brand-logo">
              <i class="fas fa-user-plus"></i>
            </div>
            <h2>VittaMed</h2>
            <p>Únete a nuestro sistema médico</p>
          </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="col-lg-6 col-md-8">
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
                        <small>Completa tus datos para crear una cuenta</small>
                    </div>
                @endif

              <form role="form" method="POST" action="{{ route('register') }}" >
                  @csrf 
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="Nombre completo" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Correo Electrónico" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Contraseña" type="password" name="password" required autocomplete="new-password">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Confirmar Contraseña" type="password" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">Crear Cuenta</button>
                </div>
              </form>
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-12 text-center">
              <a href="{{ route('login') }}" class="text-light"><small>¿Ya tienes cuenta? Inicia sesión aquí</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
