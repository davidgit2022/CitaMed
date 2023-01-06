<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\admin\DoctorController;
use App\Http\Controllers\admin\PatientController;
use App\Http\Controllers\Api\ApiHorarioController;
use App\Http\Controllers\Doctor\HorarioController;
use App\Http\Controllers\admin\SpecialtyController;
use App\Http\Controllers\Api\ApiSpecialtyController;
use App\Http\Controllers\Admin\DateTableDoctor\DataTableDoctorController;
use App\Http\Controllers\Admin\DateTablePatient\DataTablePatientController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/* Route::get('/', function () {

})->middleware(['first', 'second']); */

Route::middleware(['auth', 'admin'])->group(function () {

    //Profile
    Route::get('/profile', [ProfileController::class, 'index']);


    //Rutas Especialidades

    Route::get('/especialidades', [SpecialtyController::class, 'index']);

    Route::get('/especialidades/create', [SpecialtyController::class, 'create']);
    Route::get('/especialidades/{specialty}/edit', [SpecialtyController::class, 'edit']);
    Route::post('/especialidades', [SpecialtyController::class, 'sendData']);

    Route::put('/especialidades/{specialty}', [SpecialtyController::class, 'updated']);
    Route::delete('/especialidades/{specialty}', [SpecialtyController::class, 'destroy']);

    //Rutas Médicos
    Route::resource('/medicos', DoctorController::class);
    Route::get('/datatable/medicos', [DataTableDoctorController::class, 'doctor'])->name('datatable.medicos');

    //Rutas Paciente
    Route::resource('/pacientes', PatientController::class);
    Route::get('/datatable/pacientes', [DataTablePatientController::class, 'patient'])->name('datatable.pacientes');

    //Rutas Reportes
    Route::get('/reportes/citas/line', [ChartController::class, 'appointments']);
    Route::get('/reportes/doctors/column', [ChartController::class, 'doctors']);

    Route::get('/reportes/doctors/column/data', [ChartController::class, 'doctorsJson']);

});

//Horarios
Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/horario', [HorarioController::class, 'edit']);
    Route::post('/horario', [HorarioController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    //Reservar citas
    Route::get('/reservarcitas/create', [AppointmentController::class, 'create']);
    Route::post('/reservarcitas', [AppointmentController::class, 'store']);
    Route::get('/miscitas', [AppointmentController::class, 'index']);
    Route::get('/miscitas/{appointment}', [AppointmentController::class, 'show']);
    Route::post('/miscitas/{appointment}/cancel', [AppointmentController::class, 'cancel']);
    Route::post('/miscitas/{appointment}/confirm', [AppointmentController::class, 'confirm']);
    Route::get('/miscitas/{appointment}/cancel', [AppointmentController::class, 'formCancel']);
    //JSON
    Route::get('/especialidades/{specialty}/medicos', [ApiSpecialtyController::class, 'doctors']);
    Route::get('/horario/horas', [ApiHorarioController::class, 'hours']);
});
