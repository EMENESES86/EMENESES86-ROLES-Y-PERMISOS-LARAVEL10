@extends('layouts.admin')
@section('title')
    <title>Usuarios del Sistema - ISUS</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Usuarios del Sistema</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Usuarios del Sistema</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="justify-content: center;">
                <div class="container-fluid">

                    @if (session('success'))
                    <div class="alerta alert alert-info">{{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session('error'))
                        <div class="alerta alert alert-danger">{{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card card-primary card-outline">

                        <div class="card-header">
                            <h5 class="m-0">Usuarios del sistema <a href="{{ route('users.create') }}"
                                    class="btn btn-sm btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear usuario</a></h5>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table no-margin" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="20px">No</th>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th width="100px">Ver</th>
                                            <th width="100px">Editar</th>
                                            <th width="100px">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td></td>
                                                <td>{{ $user->cedula }}</td>
                                                <td>{{ $user->name1 }} {{ $user->name2 }} {{ $user->lastname1 }} {{ $user->lastname2 }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if (!empty($user->getRoleNames()))
                                                        @foreach ($user->getRoleNames() as $v)
                                                            <label class="badge badge-success">{{ $v }}</label>
                                                        @endforeach
                                                    @endif
                                                </td>

                                                <td>
                                                    <a class="btn btn-info btn-block btn-sm"
                                                        href="{{ route('users.show', $user->id) }}"><i class="fa fa-eye"
                                                        aria-hidden="true"></i> Ver</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-block btn-sm"
                                                        href="{{ route('users.edit', $user->id) }}"><i
                                                        class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                                </td>
                                                <td>
                                                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                                                    <button class="btn btn-danger btn-block btn-sm" type="submit"
                                                        id="deleteButton"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>
                                                    {!! Form::close() !!}
                                                </td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th width="20px">No</th>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Ver</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.table-responsive -->




                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" defer></script>

    <!-- <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script> -->

    <script>
        $(document).ready(function() {
            var t = $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0

                }],
                "order": [
                    [1, 'asc']
                ]

            });

            t.on('order.dt search.dt', function() {
                t.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>

<script>
    $('button#deleteButton').on('click', function(e) {
        // var name = document.getElementById("name");
        e.preventDefault();
        swal({
                title: "Cuidado",
                text: "Quiere eliminar?",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: "Cerrar",
                    confirm: "Confirmar",
                },
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).closest("form").submit();
                }
            });
    });
</script>
@endsection
