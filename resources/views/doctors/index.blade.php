@extends('layouts.panel')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Médicos</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/medicos/create') }}" class="btn btn-sm btn-primary">Nuevo médico</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush" id="doctors">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nombres</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Cédula</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                                <tr>
                                    <th scope="row">
                                        {{ $doctor->name }}
                                    </th>
                                    <td>
                                        {{ $doctor->email }}
                                    </td>
                                    <td>
                                        {{ $doctor->cedula }}
                                    </td>
                                    <td>
                                        <form action="{{ url('/medicos/' . $doctor->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ url('/medicos/' . $doctor->id . '/edit') }}"
                                                class="btn btn-sm btn-primary">Editar</a>
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="card-body">
        {{ $doctors->links()}}
    </div> --}}

    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>
    <script>
        
        $('#doctors').DataTable({

            /* ajax: "{{ route('datatable.medicos')}}",
            columns:[
                {data:'name'},
                {data:'email'},
                {data:'cedula'},
                {data:'opctiones'= [``]},
            ] */
            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostrar " +
                    `
            <select class="custom-select custom-select-sm form-control form-control-sm">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="-1">All</option>
            </select>
            ` + " registros por pagina",
                "zeroRecords": "Nada encontrado - disculpa",
                "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    'next': 'Siguiente',
                    'previous': 'Anterior',
                }
            }
        });
    </script>
@endsection
