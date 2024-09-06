@extends('layouts.admin')
@section('title')
    <title>Roles - ISUS</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Roles del sistema</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Roles del sistema</li>
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
                <div class="col-sm-9 col-md-9 col-lg-9">

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
                            <h5 class="m-0">Roles del sistema <a href="{{ route('roles.create') }}"
                                    class="btn btn-sm btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear roles para el sistema</a></h5>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table no-margin" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>

                                            <th width="70px">Ver</th>
                                            <th width="70px">Editar</th>
                                            <th width="70px">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td></td>
                                                <td>{{ $role->name }}</td>


                                                <td>
                                                    <a class="btn btn-info btn-block btn-sm"
                                                        href="{{ route('roles.show',$role->id) }}"><i class="fa fa-eye"
                                                        aria-hidden="true"></i> Ver</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-block btn-sm"
                                                        href="{{ route('roles.edit', $role->id) }}"><i
                                                        class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                                </td>
                                                <td>
                                                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'DELETE']) !!}
                                                    <button class="btn btn-danger btn-block btn-sm" type="submit"
                                                        id="deleteButton"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>
                                                    {!! Form::close() !!}
                                                </td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>

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

