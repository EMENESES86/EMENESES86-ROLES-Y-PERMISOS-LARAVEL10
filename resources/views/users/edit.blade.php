@extends('layouts.admin')
@section('title')
    <title>Editar Usuario</title>
    <meta name="robots" content="noindex">
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
            width: 200px;
            height: 200px;
            border-radius: 160px;
            border: 5px solid #666;
        }
    </style>
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Editar Usuario</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Editar Usuario</li>
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

                    {{-- card --}}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Usuarios del sistema <a href="{{ route('users.create') }}"
                                    class="btn btn-sm btn-primary">Crear usuario</a></h5>
                        </div>
                        <div class="card-body">

                            {!! Form::model($user, [
                                'method' => 'PATCH',
                                'route' => ['users.update', $user->id],
                                'enctype' => 'multipart/form-data',
                                'method' => 'PUT',
                            ]) !!}
                            @csrf
                            @include('users.partial.editar')

                            {!! Form::close() !!}



                        </div>
                    </div>
                    {{-- endcard --}}

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('script')
    <script>
        document.getElementById("avatar").onchange = function(e) {
            let reader = new FileReader();

            reader.onload = function() {
                let preview = document.getElementById('preview'),
                    image = document.createElement('img');

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };

            reader.readAsDataURL(e.target.files[0]);
        }
    </script>
@endsection
