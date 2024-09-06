@extends('layouts.admin')
@section('title')
    <title>Administración del sistema</title>
    <meta name="robots" content="noindex">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Administración del sistema</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../">Home</a></li>
                        <li class="breadcrumb-item active">Administración del sistema</li>
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
                <div class="col-sm-12 col-md-12 col-lg-8">

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
                            <h5 class="m-0">Administración del sistema</h5>
                        </div>
                        <div class="card-body" style="background-color: rgba(0, 0, 0, 0.711)">
                            <div class="row">
                                <div class="col-sm-12 col-md-8 col-lg-8">
                                    <label for="" style="color: white"><b>Nombre del sistema:
                                        </b>{{ $admin->name }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-8 col-lg-8">
                                    <label for="" style="color: white"><b>Nombre corto del sistema:
                                        </b>{{ $admin->short_name }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-8 col-lg-8">
                                    <label for="" style="color: white">Logo:</label>
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img class="" style="width: 100%;" src="<?php echo asset("/storage/$admin->logo"); ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <label for="" style="color: white">Favicon:</label>
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="row">
                                            <div id="preview" class="col-sm-12">
                                                <img class="" style="width: 40%;" src="<?php echo asset("/storage/$admin->favicon"); ?>">
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>


                            <hr>
                            <div class="row">



                                <div class="col-sm-6">

                                    <a class="btn btn-success btn-block"
                                        href="{{ route('administracion.edit', $admin->id) }}"><i
                                            class="fa-solid fa-pen-to-square" aria-hidden="true"></i> |
                                        Modificar</a>
                                </div>
                                <div class="col-sm-6">
                                    <i class="btn btn-info btn-block" aria-hidden="true" onclick="history.back ();"><i
                                            class="fas fa-undo"></i> |
                                        Regresar</i>
                                </div>

                            </div>


                        </div>
                        <div class="card-footer text-muted">
                            <strong>Creado por <img src="{{ asset('dist/img/ECU_EMENESES.png') }}" alt="ECUADOR"
                                    style="width: 25px"> <i class="far fa-registered"></i> <a
                                    href="mailto:emeneses@emenesesdevelopers.com" style="color: grey"> E/MENESES
                                    Developers </a><i class="far fa-copyright"> </i>
                                Todos los derechos reservados {{ date('Y') }}
                            </strong>
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
@endsection
