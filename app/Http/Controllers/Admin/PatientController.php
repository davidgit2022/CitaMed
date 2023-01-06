<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /* public function index()
    {
        $patients = User::patients()->paginate(15);
        return view('patients.index', compact('patients'));
    } */
    public function index()
    {
        $patients = User::patients()->get();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
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
            'name.required' => 'El nombre del paciente es obligatorio.',
            'name.min' => 'El nombre del paciente debe tener mas de 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa una dirección de correo electrónico válido.',
            'cedula.required' => 'La cédula es obligatorio.',
            'address.required' => 'La dirección debe tener al menos 6 caracteres',
            'phone.required' => 'El número de teléfono es obligatorio.',
        ];

        $this->validate($request, $rules, $messages);

        User::create(
            $request->only('name', 'email', 'cedula', 'address', 'phone')
            + [
                'role' => 'paciente',
                'password' => bcrypt($request->input('password'))
            ]
        );


        $notification = 'El paciente se ha creado correctamente.';

        return redirect('/pacientes')->with(compact('notification'));
    }

    public function edit($id)
    {
        $patient = User::patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
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
            'name.required' => 'El nombre del paciente es obligatorio.',
            'name.min' => 'El nombre del paciente debe tener mas de 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa una dirección de correo electrónico válido.',
            'cedula.required' => 'La cédula es obligatorio.',
            'address.required' => 'La dirección debe tener al menos 6 caracteres',
            'phone.required' => 'El número de teléfono es obligatorio.',
        ];

        $this->validate($request, $rules, $messages);

        $user = User::patients()->findOrFail($id);

        $data = $request->only('name', 'email', 'cedula', 'address', 'phone');

        $password = $request->input('password');

        if ($password) {
            $data ['password'] = bcrypt($password);
        }

        $user->fill($data);

        $user->save();

        $notification = 'La información del médico se actualizo correctamente.';

        return redirect('/pacientes')->with(compact('notification'));

    }

    public function destroy($id)
    {
        $patient = User::patients()->findOrFail($id);
        $patientName = $patient->name;
        $patient->delete();

        $notification = 'El paciente' . ' ' . $patientName . 'se elimino correctamente.';

        return redirect('/pacientes')->with(compact('notification'));
    }
}
