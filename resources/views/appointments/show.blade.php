@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Citas #{{ $appointment->id }} </h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/miscitas') }}" class="btn btn-sm btn-success">Regresar</a>
                    <i class="fas fa-chevron-left"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul>
                <dd>
                    <strong>Fecha:</strong>&nbsp; {{ $appointment->scheduled_date }}
                </dd>
                <dd>
                    <strong>Hora de atención:</strong>&nbsp; {{ $appointment->scheduled_time }}
                </dd>
                @if ($role == 'paciente' || $role == 'admin')
                    <dd>
                        <strong>Doctor:</strong>&nbsp; {{ $appointment->doctor->name }}
                    </dd>
                @endif
                @if ($role == 'doctor' || $role == 'admin')
                    <dd>
                        <strong>Paciente:</strong>&nbsp; {{ $appointment->patient->name }}
                    </dd>
                @endif

                <dd>
                    <strong>Especialidad:</strong>&nbsp; {{ $appointment->specialty->name }}
                </dd>
                <dd>
                    <strong>Tipo de consulta:</strong>&nbsp; {{ $appointment->type }}
                </dd>
                <dd>
                    <strong>Estado:</strong>&nbsp; {{ $appointment->status }}
                </dd>
                <dd>
                    <strong>Síntomas:</strong>&nbsp; {{ $appointment->description }}
                </dd>
            </ul>

            @if ($appointment->status == 'Cancelada')
                <div class="alert bg-light text-primary">
                    <h3>Detalles de la cancelación</h3>
                    @if ($appointment->cancellation)
                        <ul>
                            <li>
                                <strong>Fecha de cancelación:</strong>&nbsp;{{ $appointment->cancellation->created_at }}
                            </li>
                            <li>
                                <strong>La cita fue
                                    cancelada:</strong>&nbsp;{{ $appointment->cancellation->cancelled_by->name }}
                            </li>
                            <li>
                                <strong>Motivo de la
                                    cancelación:</strong>&nbsp;{{ $appointment->cancellation->justification }}
                            </li>
                        </ul>
                    @else
                        <ul>
                            <li>La cita fue cancelada antes de su confirmación.</li>
                        </ul>
                    @endif
                </div>
            @endif

        </div>
    </div>
@endsection
