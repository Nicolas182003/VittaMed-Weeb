@extends('layouts.panel')

@section('content')

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">
                            <i class="fas fa-calendar-times text-danger mr-2"></i>
                            Cancelar cita
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
                @if(session('notification'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('notification') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Información de la cita -->
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-3">
                            <i class="fas fa-info-circle text-info mr-2"></i>
                            Información de la cita
                        </h4>
                        
                        @if($role == 'paciente')
                            <div class="mb-3">
                                <p class="mb-2">
                                    <i class="fas fa-user-md text-primary mr-2"></i>
                                    <strong>Médico:</strong> 
                                    <span class="text-dark">{{ $appointment->doctor->name }}</span>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-stethoscope text-success mr-2"></i>
                                    <strong>Especialidad:</strong> 
                                    <span class="badge badge-primary">{{ $appointment->specialty->name }}</span>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-calendar-alt text-info mr-2"></i>
                                    <strong>Fecha:</strong> 
                                    <span class="text-dark">{{ $appointment->scheduled_date }}</span>
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-clock text-warning mr-2"></i>
                                    <strong>Hora:</strong> 
                                    <span class="text-dark">{{ $appointment->scheduled_time_12 }}</span>
                                </p>
                            </div>
                        @elseif($role == 'doctor')
                            <div class="mb-3">
                                <p class="mb-2">
                                    <i class="fas fa-user text-primary mr-2"></i>
                                    <strong>Paciente:</strong> 
                                    <span class="text-dark">{{ $appointment->patient->name }}</span>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-stethoscope text-success mr-2"></i>
                                    <strong>Especialidad:</strong> 
                                    <span class="badge badge-primary">{{ $appointment->specialty->name }}</span>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-calendar-alt text-info mr-2"></i>
                                    <strong>Fecha:</strong> 
                                    <span class="text-dark">{{ $appointment->scheduled_date }}</span>
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-clock text-warning mr-2"></i>
                                    <strong>Hora:</strong> 
                                    <span class="text-dark">{{ $appointment->scheduled_time_12 }}</span>
                                </p>
                            </div>
                        @else
                            <div class="mb-3">
                                <p class="mb-2">
                                    <i class="fas fa-user text-primary mr-2"></i>
                                    <strong>Paciente:</strong> 
                                    <span class="text-dark">{{ $appointment->patient->name }}</span>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-user-md text-success mr-2"></i>
                                    <strong>Doctor:</strong> 
                                    <span class="text-dark">{{ $appointment->doctor->name }}</span>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-stethoscope text-info mr-2"></i>
                                    <strong>Especialidad:</strong> 
                                    <span class="badge badge-primary">{{ $appointment->specialty->name }}</span>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-calendar-alt text-warning mr-2"></i>
                                    <strong>Fecha:</strong> 
                                    <span class="text-dark">{{ $appointment->scheduled_date }}</span>
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-clock text-danger mr-2"></i>
                                    <strong>Hora:</strong> 
                                    <span class="text-dark">{{ $appointment->scheduled_time_12 }}</span>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Formulario de cancelación -->
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>¡Atención!</strong> Esta acción no se puede deshacer.
                </div>

                <form action="{{ url('/miscitas/'.$appointment->id.'/cancel') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="justification" class="font-weight-bold">
                            <i class="fas fa-comment-alt mr-2"></i>
                            Motivo de la cancelación:
                        </label>
                        <textarea 
                            name="justification" 
                            id="justification" 
                            rows="4" 
                            class="form-control" 
                            placeholder="Describa el motivo por el cual cancela esta cita..."
                            required></textarea>
                        <small class="form-text text-muted">Por favor, proporcione un motivo claro para la cancelación.</small>
                    </div>

                    <div class="text-right">
                        <a href="{{ url('/miscitas') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            No cancelar
                        </a>
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-ban mr-2"></i>
                            Confirmar cancelación
                        </button>
                    </div>
                </form>

            </div>

        </div>
    
@endsection