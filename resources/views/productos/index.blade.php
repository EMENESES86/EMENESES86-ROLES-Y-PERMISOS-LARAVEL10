@extends('layouts.admin')
@section('title')
    <title>Productos - ISUS</title>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <style type="text/css">
        .#preview {
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 2px;
            background: #fff;
            max-width: 200px;

        }

        #preview img {
            object-fit: cover;
            width: 100%;
            height: auto;
            border-radius: 25px;
            border: 6px solid rgb(28, 52, 60);
        }

    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Productos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Productos</li>
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







                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Productos
                                @can('producto-create')
                                    <a href="{{ route('productos.create') }}" class="btn btn-sm btn-primary"><i
                                            class="fa fa-plus-circle" aria-hidden="true"></i>
                                        Crear producto</a>
                                @endcan
                            </h5>
                        </div>
                        <div class="card-body">

                            {{-- cards --}}
                            <div class="row" style="justify-content: center;">
                                @foreach ($pro as $pr)
                                    <div class="col-sm-8 col-md-6 col-lg-5 col-xl-4">
                                        <!-- small box -->
                                        <div class="small-box"
                                            style="background: url({{ asset('dist/img/fondo.jpg') }})">
                                            <div class="card-header {{ $pr->categoria->cat_color }}">
                                                <h5 class="m-0"><b>{{ $pr->pro_name }}</b></h5>
                                            </div>
                                            <div class="row my-2">
                                                <div class="d-none d-sm-none d-md-block col-sm-12 col-md-5 col-lg-5">
                                                    <div id="preview" class="col-sm-12" align="center">
                                                        @if ($pr->pro_avatar == '')
                                                            <img class="img-circle"
                                                                src="{{ asset('dist/img/logo_sucre.png') }}"
                                                                alt="User Avatar">
                                                        @else
                                                            <img class="img-circle" src="<?php echo asset("storage/productos/$pr->pro_avatar"); ?>"
                                                                alt="User Avatar">
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-md-7 col-lg-7">
                                                    <p><b>Categoría:</b>{{ $pr->categoria->cat_name }}</p>
                                                    <p>{{ $pr->pro_descripcion }}</p>
                                                    <div class="row col-12" style="justify-content: center;">

                                                        <a href="{{ $pr->pro_link }}" target="blank"
                                                            class="btn btn-primary btn-block btn-sm"><i
                                                                class="fa fa-external-link-square" aria-hidden="true"></i>
                                                            Ir al
                                                            {{ $pr->pro_name }}</a>
                                                    </div>
                                                </div>

                                            </div>
                                            @can('producto-edit')
                                                <a class="btn btn-primary btn-block btn-sm"
                                                    href="{{ route('productos.edit', $pr->id) }}"><i
                                                        class="fa fa-pencil-square" aria-hidden="true"></i> Editar</a>
                                            @endcan

                                            @can('producto-delete')
                                                {!! Form::open(['route' => ['productos.destroy', $pr->id], 'method' => 'DELETE']) !!}
                                                <button class="btn btn-danger btn-block btn-sm" type="submit"
                                                    id="deleteButton"><i class="fa fa-trash" aria-hidden="true"></i>
                                                    Eliminar</button>
                                                {!! Form::close() !!}
                                            @endcan

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- endcards --}}



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
