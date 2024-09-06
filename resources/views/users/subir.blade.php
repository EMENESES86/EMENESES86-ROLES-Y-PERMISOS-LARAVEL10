@extends('layouts.admin')
@section('title')
    <title>Subir usuarios</title>
    <meta name="robots" content="noindex">
@endsection


@section('content')


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="justify-content: center;">
                <div class="col-sm-12 col-md-9 col-lg-9">

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
                            <h5 class="m-0">Subir usuarios al sistema</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label class="form-label">Descargar archivo de ejemplo: <a
                                            href="{{ asset('/storage/archivos/usuarios.csv') }}">Descargar CSV</a></label>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label for="formFile" class="form-label">Subir CSV:</label>
                                        <input class="form-control" type="file" name="users_file" id="users_file">
                                        <hr>
                                        <button class="btn btn-success">
                                            <i class="fa-solid fa-cloud-arrow-up"></i> Importar usuarios
                                        </button>
                                        <a class="btn btn-info" href="{{ route('users.index') }}"><i class="fa-sharp fa-solid fa-rotate-left"></i> Regresar a usuarios</a>
                                    </div>
                                </div>
                            </form>
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
