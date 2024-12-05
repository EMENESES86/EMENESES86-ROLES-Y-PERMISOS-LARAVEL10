@extends('layouts.admin')
@section('title')
    <title>Ver Usuario</title>
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

        .name {
            font-size: clamp(10pt, 2vw, 16pt);
            display: flex;
            justify-content: center;
            font-weight: bold;
            padding-bottom: 0%
        }

        .cedula {
            font-size: clamp(15pt, 2vw, 12pt);
            padding-top: 0%;
            display: flex;
            font-weight: bold;
            justify-content: center;
        }

        .email {
            padding-top: 0%;
            display: flex;
            justify-content: center;
        }

        .qr-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 200px;
            height: 200px;
            margin: 20px auto;
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ver Usuario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Ver Usuario</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    @if (session('message'))
                        <div class="alert alert-info">{{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('message1'))
                        <div class="alert alert-danger">{{ session('message1') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- card --}}
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Usuario: {{ $user->name }} {{ $user->lastname }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="box box-widget widget-user">
                                <div class="widget-user-header"
                                    style="background: url('{{ asset('dist/img/ISUS-fondo.png') }}')">
                                    <div class="row">
                                        <div id="preview" class="col-sm-12" align="center">
                                            <img class="img-circle"
                                                src="{{ asset("/storage/usuarios/$user->avatar") }}?{{ time() }}"
                                                alt="User Avatar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <hr>

                            <div class="name">
                                {{ $user->name }} {{ $user->lastname }}
                            </div>

                            <div class="cedula">
                                {{ $user->cedula }}
                            </div>

                            <div class="email">
                                {{ $user->email }}
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="qr-container">
                                        {{-- QR mostrando la cédula del usuario --}}
                                        {!! QrCode::size(200)->generate($user->cedula) !!}
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <i class="btn btn-info btn-block" aria-hidden="true" onclick="history.back();"><i
                                            class="fas fa-undo"></i> | Regresar</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- endcard --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
