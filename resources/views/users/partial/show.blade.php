<div class="box box-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header" style="background: url('<?php echo asset('dist/img/ISUS-fondo.png'); ?>')">
        <div class="row">

            <div id="preview" class="col-sm-12" align="center">
                <img class="img-circle" src="<?php echo asset("/storage/usuarios/$user->avatar"); ?>" alt="User Avatar">
            </div>
        </div>

    </div>
</div>
<br><br><br>
<hr>



<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Nombres y Apellidos:</label>
        <p>{{ $user->name1 }} {{ $user->name2 }} {{ $user->lastname1 }} {{ $user->lastname2 }}</p>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Cédula:</label>
        <p>{{ $user->cedula }}</p>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Email:</label>
        <p>{{ $user->email }}</p>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Teléfono:</label>
        <p>{{ $user->telefono }}</p>
    </div>
</div>



<hr>

<div class="row">
    <div class="col-sm-12">
        <i class="btn btn-info btn-block" aria-hidden="true" onclick="history.back ();"><i class="fas fa-undo"></i> | Regresar</i>
    </div>
</div>


