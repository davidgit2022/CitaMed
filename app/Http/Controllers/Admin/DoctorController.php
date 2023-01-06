<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specialty;

class DoctorController extends Controller
{
    /* public function index()
    {
        $doctors = User::doctors()->paginate(15);
        return view('doctors.index', compact('doctors'));
    } */
    public function index()
    {
        $doctors = User::doctors()->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create',compact('specialties'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|digits:10',
            'address' => 'nullable|min:6',
            'address' => 'required',
        ];

        $messages = [
            'name.required' => ' El nombre del doctor es obligatorio.',
            'name.min' => ' El nombre del doctor debe tener mas de 3 caracteres.',
            'email.required' => ' El correo electrónico es obligatorio.',
            'email.email' => ' Ingresa una dirección de correo electrónico válido.',
            'cedula.required' => ' La cédula es obligatorio.',
            'address.required' => ' La dirección debe tener al menos 6 caracteres',
            'phone.required' => ' El número de teléfono es obligatorio.',
        ];

        $this->validate($request, $rules, $messages);

        $user = User::create(
            $request->only('name', 'email', 'cedula', 'address', 'phone')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $user->specialties()->attach($request->input('specialties'));

        $notification = 'El médico se ha creado correctamente.';

        return redirect('/medicos')->with(compact('notification'));
    }

    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        $specialties = Specialty::all();
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor','specialties','specialty_ids'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|digits:10',
            'address' => 'nullable|min:6',
            'address' => 'required',
        ];

        $messages = [
            'name.required' => ' El nombre del doctor es obligatorio.',
            'name.min' => ' El nombre del doctor debe tener mas de 3 caracteres.',
            'email.required' => ' El correo electrónico es obligatorio.',
            'email.email' => ' Ingresa una dirección de correo electrónico válido.',
            'cedula.required' => ' La cédula es obligatorio.',
            'address.required' => ' La dirección debe tener al menos 6 caracteres',
            'phone.required' => ' El número de teléfono es obligatorio.',
        ];

        $this->validate($request, $rules, $messages);

        $user = User::doctors()->findOrFail($id);

        $data = $request->only('name', 'email', 'cedula', 'address', 'phone');

        $password = $request->input('password');

        if ($password) {
            $data ['password'] = bcrypt($password);
        }

        $user->fill($data);

        $user->save();

        $user->specialties()->sync($request->input('specialties'));
        $notification = 'La información del médico se actualizo correctamente.';

        return redirect('/medicos')->with(compact('notification'));

    }

    public function destroy($id)
    {
        $user = User::doctors()->findOrFail($id);
        $doctorName = $user->name;
        $user->delete();

        $notification = 'El médico' . ' ' . $doctorName . 'se elimino correctamente.';

        return redirect('/medicos')->with(compact('notification'));
    }
}
