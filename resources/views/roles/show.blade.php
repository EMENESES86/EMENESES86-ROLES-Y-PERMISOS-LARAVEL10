@extends('layouts.admin')
@section('title')
    <title>Ver rol {{ $role->name }} - ISUS</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
@endsection


@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ver rol {{ $role->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles del sistema</a>
                        </li>
                        <li class="breadcrumb-item active">Rol {{ $role->name }}</li>
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

                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Rol:</label>
                                    <span>{{ $role->name }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Permisos:</label>
                                    <span>
                                        @if (!empty($rolePermissions))
                                            @foreach ($rolePermissions as $v)
                                                {{ $v->name }},
                                            @endforeach
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <a class="btn btn-primary btn-block" href="{{ route('roles.index') }}"> Back</a>



                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection
