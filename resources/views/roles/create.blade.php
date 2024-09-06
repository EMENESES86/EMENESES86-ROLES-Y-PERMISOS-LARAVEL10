@extends('layouts.admin')
@section('title')
    <title>Crear Roles y Permisos - ISUS</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
@endsection



@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Crear Roles y Permisos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles del sistema</a>
                        </li>
                        <li class="breadcrumb-item active">Crear Roles y Permisos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="justify-content: center;">
                <div class="col-sm-6 col-md-6 col-lg-6">


                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Crear Roles y Permisos</h5>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}

                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Rol name:</label>
                                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Permisos:</label>
                                    <br>
                                    <ul style="column-count: 2">
                                        @foreach ($permission as $value)
                                            <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                                {{ $value->name }}</label>
                                            <br />
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-success btn-block">Guardar</button>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-primary btn-block" href="{{ route('roles.index') }}"> Back</a>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection
