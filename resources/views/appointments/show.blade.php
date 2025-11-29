@extends('layouts.panel')

@section('content')

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">
                            <i class="fas fa-file-medical text-primary mr-2"></i>
                            Cita #{{ $appointment->id }}
                        </h3>
                    </div>

                    <div class="col text-right">
                        <a href="{{ url('/miscitas') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-chevron-left"></i>
                            Regresar</a>
                    </div>
                    
                </div>
            </div>
            <div class="card-body">
                
                <!-- Información principal de la cita -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-primary shadow h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar-check text-primary fa-2x mr-3"></i>
                                    <div>
                                        <h6 class="text-uppercase text-muted mb-0">Fecha programada</h6>
                                        <h4 class="mb-0">{{ $appointment->scheduled_date }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-warning shadow h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-warning fa-2x mr-3"></i>
                                    <div>
                                        <h6 class="text-uppercase text-muted mb-0">Hora de atención</h6>
                                        <h4 class="mb-0">{{ $appointment->scheduled_time_12 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información de personas involucradas -->
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-users text-info mr-2"></i>
                            Información del Servicio
                        </h5>
                        <div class="row">
                            @if($role == 'paciente' || $role == 'admin')
                            <div class="col-md-6 mb-2">
                                <p class="mb-1">
                                    <i class="fas fa-user-md text-primary mr-2"></i>
                                    <strong>Doctor:</strong>
                                </p>
                                <p class="ml-4 text-dark">{{ $appointment->doctor->name }}</p>
                            </div>
                            @endif
                            
                            @if($role == 'doctor' || $role == 'admin')
                            <div class="col-md-6 mb-2">
                                <p class="mb-1">
                                    <i class="fas fa-user text-success mr-2"></i>
                                    <strong>Paciente:</strong>
                                </p>
                                <p class="ml-4 text-dark">{{ $appointment->patient->name }}</p>
                            </div>
                            @endif
                            
                            <div class="col-md-6 mb-2">
                                <p class="mb-1">
                                    <i class="fas fa-stethoscope text-info mr-2"></i>
                                    <strong>Especialidad:</strong>
                                </p>
                                <p class="ml-4">
                                    <span class="badge badge-primary badge-lg">{{ $appointment->specialty->name }}</span>
                                </p>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <p class="mb-1">
                                    <i class="fas fa-notes-medical text-warning mr-2"></i>
                                    <strong>Tipo de consulta:</strong>
                                </p>
                                <p class="ml-4">
                                    <span class="badge badge-info badge-lg">{{ $appointment->type }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estado y síntomas -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <p class="mb-2">
                                    <i class="fas fa-flag text-muted"></i>
                                    <strong class="d-block mt-2">Estado:</strong>
                                </p>
                                @if($appointment->status == 'Cancelada')
                                    <span class="badge badge-danger badge-pill" style="font-size: 1rem; padding: 0.5rem 1rem;">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Cancelada
                                    </span>
                                @else
                                    <span class="badge badge-primary badge-pill" style="font-size: 1rem; padding: 0.5rem 1rem;">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        {{ $appointment->status }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <p class="mb-2">
                                    <i class="fas fa-heartbeat text-danger mr-2"></i>
                                    <strong>Síntomas / Descripción:</strong>
                                </p>
                                <p class="text-muted ml-4 mb-0">{{ $appointment->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detalles de la cancelación -->
                @if($appointment->status == 'Cancelada')
                    <div class="alert alert-danger border-left-danger shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-ban fa-2x text-danger mr-3"></i>
                            <h4 class="mb-0 text-danger">Detalles de la Cancelación</h4>
                        </div>
                        
                        @if($appointment->cancellation)
                        <div class="bg-white p-3 rounded">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <p class="mb-1">
                                        <i class="fas fa-calendar-times text-danger mr-2"></i>
                                        <strong>Fecha de cancelación:</strong>
                                    </p>
                                    <p class="ml-4 mb-0">{{ $appointment->cancellation->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                
                                <div class="col-md-4 mb-2">
                                    <p class="mb-1">
                                        <i class="fas fa-user-times text-danger mr-2"></i>
                                        <strong>Cancelada por:</strong>
                                    </p>
                                    <p class="ml-4 mb-0">{{ $appointment->cancellation->cancelled_by->name }}</p>
                                </div>
                                
                                <div class="col-md-12 mt-3">
                                    <p class="mb-1">
                                        <i class="fas fa-comment-dots text-danger mr-2"></i>
                                        <strong>Motivo de la cancelación:</strong>
                                    </p>
                                    <div class="alert alert-light ml-4 mb-0">
                                        <p class="mb-0">{{ $appointment->cancellation->justification }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="bg-white p-3 rounded">
                            <p class="mb-0">
                                <i class="fas fa-info-circle text-info mr-2"></i>
                                La cita fue cancelada antes de su confirmación.
                            </p>
                        </div>
                        @endif
                    </div>
                @endif

            </div>

        </div>
    
@endsection