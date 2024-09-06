@extends('layouts.admin')
@section('title')
    <title>Editar permisos {{ $role->name }} - ISUS</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Editar permisos</h1>
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
                <div class="col-sm-6 col-md-6 col-lg-6">


                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Rol {{ $role->name }}</h5>
                        </div>
                        <div class="card-body">
                            {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}

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
                                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
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
