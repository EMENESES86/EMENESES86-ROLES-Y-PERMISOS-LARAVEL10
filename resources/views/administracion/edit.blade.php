@extends('layouts.admin')
@section('title')
    <title>Administración del sistema | {{ $admin->name }}</title>
    <meta name="robots" content="noindex">
    <style type="text/css">
        #preview_logo, #preview_favicon {
            background-color: #c4c2c2;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #preview_logo img, #preview_favicon img {
            object-fit: cover;
            max-width: 100%;
            height: auto;
        }
    </style>
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

                    {!! Form::model($admin, ['method' => 'PATCH', 'route' => ['administracion.update', $admin->id], 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
                    @csrf
                    <div class="card card-primary card-outline">

                        <div class="card-header">
                            <h5 class="m-0">Administración del sistema</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="">Nombre del sistema:</label>
                                    <input type="text" class="form-control" name="name" value="{{ $admin->name }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="">Nombre corto del sistema:</label>
                                    <input type="text" class="form-control" name="short_name" value="{{ $admin->short_name }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <label for="formFile" class="form-label">Logo:</label>
                                    <div id="preview_logo" class="col-sm-12">
                                        <img class="img-fluid" src="{{ asset("/storage/administration/$admin->logo") }}" alt="Logo del sistema">
                                    </div>
                                    <input class="form-control" type="file" id="logo" name="logo" value="{{ $admin->logo }}">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <label for="formFile" class="form-label">Favicon:</label>
                                    <div id="preview_favicon" class="col-sm-12">
                                        <img class="img-fluid" src="{{ asset("/storage/administration/$admin->favicon") }}" alt="Favicon del sistema">
                                    </div>
                                    <input class="form-control" type="file" id="favicon" name="favicon" value="{{ $admin->favicon }}">
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary btn-block" id="guardar">
                                        <i class="fas fa-save"></i> | Guardar
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-info btn-block" onclick="history.back();">
                                        <i class="fas fa-undo"></i> | Regresar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('script')
    <script>
        document.getElementById("logo").onchange = function(e) {
            let reader = new FileReader();

            reader.onload = function() {
                let preview = document.getElementById('preview_logo'),
                    image = document.createElement('img');

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };

            reader.readAsDataURL(e.target.files[0]);
        }
    </script>

    <script>
        document.getElementById("favicon").onchange = function(e) {
            let reader = new FileReader();

            reader.onload = function() {
                let preview = document.getElementById('preview_favicon'),
                    image = document.createElement('img');

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };

            reader.readAsDataURL(e.target.files[0]);
        }
    </script>
@endsection
