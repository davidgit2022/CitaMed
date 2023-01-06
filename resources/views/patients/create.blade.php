<?php
    use Illuminate\Support\Str;
?>
@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevo paciente</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/pacientes')}}" class="btn btn-sm btn-success">Regresar</a>
                    <i class="fas fa-chevron-left"></i>
                </div>
            </div>
        </div>
        <div class="card-body">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Por favor!</strong>&nbsp; {{$error}}
                </div>
                @endforeach
            @endif
            <form action="{{url('/pacientes')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del paciente:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nombre del paciente" value="{{ old('name')}}" required>
                </div>
                <div class="form-group">
                    <label for="description">Correo electrónico:</label>
                    <input type="email" name="email" class="form-control" placeholder="Correo electrónico" value="{{ old('email')}}">
                </div>
                <div class="form-group">
                    <label for="cedula">Cédula:</label>
                    <input type="number" name="cedula" class="form-control" placeholder="Cédula" value="{{ old('cedula')}}">
                </div>
                <div class="form-group">
                    <label for="address">Dirección:</label>
                    <input type="text" name="address" class="form-control" placeholder="Dirección" value="{{ old('address')}}">
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono / Móvil:</label>
                    <input type="number" name="phone" class="form-control" placeholder="Teléfono / Móvil" value="{{ old('phone')}}">
                </div>
                <div class="form-group">
                    <label for="phone">Contraseña:</label>
                    <input type="number" name="password" class="form-control" placeholder="Contraseña" value="{{ old('password', Str::random(8))}}">
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Crear paciente</button>
            </form>
        </div>
    </div>
@endsection
