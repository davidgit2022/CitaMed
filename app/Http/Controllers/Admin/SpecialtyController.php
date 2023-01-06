<?php

namespace App\Http\Controllers\Admin;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{

    public function index()
    {
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialties.create');
    }

    public function sendData(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
        ];

        $messages = [
            'name.required' => 'El nombre de la especialidad es obligatorio.',
            'name.min' => 'El nombre de la especialidad debe tener mas de 3 caracteres.',
        ];

        $this->validate($request, $rules, $messages);

        $specialty = new Specialty();

        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');

        $specialty->save();

        $notification = 'La especialidad se ha creado correctamente.';

        return redirect('/especialidades')->with(compact('notification'));
    }

    public function edit(Specialty $specialty)
    {
        return view('specialties.edit', compact('specialty'));
    }

    public function updated(Request $request, Specialty $specialty)
    {
        $rules = [
            'name' => 'required|min:3',
        ];

        $messages = [
            'name.required' => 'El nombre de la especialidad es obligatorio.',
            'name.min' => 'El nombre de la especialidad debe tener mas de 3 caracteres.',
        ];

        $this->validate($request, $rules, $messages);

        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');

        $specialty->save();

        $notification = 'La especialidad se ha actualizado correctamente.';

        return redirect('/especialidades')->with(compact('notification'));
    }

    public function destroy(Specialty $specialty)
    {
        $deleteName = $specialty->name;
        $specialty->delete();

        $notification = 'La especialidad' .' ' . $deleteName . 'se ha eliminado correctamente.';

        return redirect('/especialidades')->with(compact('notification'));
    }
}
