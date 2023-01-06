<?php

namespace App\Http\Controllers\Admin\DateTableDoctor;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataTableDoctorController extends Controller
{
    public function doctor()
    {
        $doctors = User::doctors()->select('name','email','cedula')->get();

        return datatables()->collection($doctors)->toJson();
    }
}
