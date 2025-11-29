<?php
    use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0 text-white"><i class="ni ni-calendar-grid-58 mr-2"></i>Reservar nueva cita</h3>
                        <p class="text-sm mb-0 mt-1 opacity-8">Complete el formulario para agendar su cita médica</p>
                    </div>
                    <div class="col text-right">
                        <a href="{{ url('/pacientes') }}" class="btn btn-sm btn-white">
                            <i class="fas fa-chevron-left mr-1"></i>Regresar
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body px-lg-5 py-lg-4">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
                        <span class="alert-text">
                            <strong>¡Atención!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </span>
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ url('/reservarcitas') }}" method="POST">
                    @csrf

                    <!-- Sección: Datos del Médico -->
                    <div class="mb-4">
                        <h4 class="text-primary mb-3"><i class="ni ni-badge mr-2"></i>Información del médico</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="specialty">
                                        <i class="fas fa-stethoscope mr-1"></i>Especialidad
                                    </label>
                                    <select name="specialty_id" id="specialty" class="form-control form-control-alternative">
                                        <option value="">Seleccionar especialidad</option>
                                        @foreach ($specialties as $especialidad)
                                            <option value="{{ $especialidad->id }}"
                                                @if(old('specialty_id') == $especialidad->id) selected @endif>
                                                {{ $especialidad->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="doctor">
                                        <i class="fas fa-user-md mr-1"></i>Médico
                                    </label>
                                    <select name="doctor_id" id="doctor" class="form-control form-control-alternative" required>
                                        @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}"
                                            @if(old('doctor_id') == $doctor->id) selected @endif>
                                            {{ $doctor->name }}
                                        </option>
                                        @endforeach  
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Sección: Fecha -->
                    <div class="mb-4">
                        <h4 class="text-primary mb-3"><i class="ni ni-calendar-grid-58 mr-2"></i>Fecha de la cita</h4>
                        <div class="form-group">
                            <label class="form-control-label" for="date">Seleccione la fecha</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker"
                                id="date" name="scheduled_date"
                                placeholder="Seleccionar fecha" 
                                type="date" value="{{ old('scheduled_date'), date('Y-m-d') }}" 
                                data-date-format="yyyy-mm-dd"
                                data-date-start-date="{{ date('Y-m-d') }}" 
                                data-date-end-date="+30d">
                            </div>
                        </div>
                    </div>
                    <!-- Sección: Horarios -->
                    <div class="mb-4">
                        <h4 class="text-primary mb-3"><i class="ni ni-time-alarm mr-2"></i>Hora de atención</h4>
                        @if($intervals)
                            <div class="row">
                                <div class="col-md-6">
                                    @if(count($intervals['morning']) > 0)
                                        <div class="card border-0 mb-3" style="background: linear-gradient(135deg, #4F46E5 0%, #6366F1 100%);">
                                            <div class="card-body p-3">
                                                <h5 class="text-white mb-3">
                                                    <i class="fas fa-sun mr-2"></i>Horario Matutino
                                                </h5>
                                                <div id="hoursMorning">
                                                    @foreach ($intervals['morning'] as $key => $interval)
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="intervalMorning{{ $key }}" name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input">
                                                            <label class="custom-control-label text-white" for="intervalMorning{{ $key }}">
                                                                <i class="far fa-clock mr-1"></i>{{ $interval['start'] }} - {{ $interval['end'] }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div id="hoursMorning"></div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if(count($intervals['afternoon']) > 0)
                                        <div class="card border-0 mb-3" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                                            <div class="card-body p-3">
                                                <h5 class="text-white mb-3">
                                                    <i class="fas fa-moon mr-2"></i>Horario Vespertino
                                                </h5>
                                                <div id="hoursAfternoon">
                                                    @foreach ($intervals['afternoon'] as $key => $interval)
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="intervalAfternoon{{ $key }}" name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input">
                                                            <label class="custom-control-label text-white" for="intervalAfternoon{{ $key }}">
                                                                <i class="far fa-clock mr-1"></i>{{ $interval['start'] }} - {{ $interval['end'] }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div id="hoursAfternoon"></div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>Información:</strong> Selecciona un médico y una fecha para ver los horarios disponibles.
                            </div>
                            <div class="row">
                                <div class="col-md-6"><div id="hoursMorning"></div></div>
                                <div class="col-md-6"><div id="hoursAfternoon"></div></div>
                            </div>
                        @endif
                    </div>
                    <!-- Sección: Tipo de Consulta -->
                    <div class="mb-4">
                        <h4 class="text-primary mb-3"><i class="ni ni-folder-17 mr-2"></i>Tipo de consulta</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="type1" name="type" class="custom-control-input" 
                                    @if(old('type') == 'Consulta') checked @endif value="Consulta">
                                    <label class="custom-control-label" for="type1">
                                        <i class="fas fa-notes-medical mr-2 text-success"></i>Consulta
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="type2" name="type" class="custom-control-input"
                                    @if(old('type') == 'Examen') checked @endif value="Examen">
                                    <label class="custom-control-label" for="type2">
                                        <i class="fas fa-microscope mr-2 text-warning"></i>Examen
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="type3" name="type" class="custom-control-input" 
                                    @if(old('type') == 'Operación') checked @endif value="Operación">
                                    <label class="custom-control-label" for="type3">
                                        <i class="fas fa-procedures mr-2 text-danger"></i>Operación
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Síntomas -->
                    <div class="mb-4">
                        <h4 class="text-primary mb-3"><i class="ni ni-paper-diploma mr-2"></i>Descripción</h4>
                        <div class="form-group">
                            <label class="form-control-label" for="description">Síntomas o motivo de la consulta</label>
                            <textarea name="description" id="description" class="form-control form-control-alternative"
                            rows="5" placeholder="Describa brevemente sus síntomas o el motivo de su consulta..." required>{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save mr-2"></i>Reservar cita
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}} "></script>

<script src="{{ asset('/js/appointments/create.js') }}" >
</script>

@endsection