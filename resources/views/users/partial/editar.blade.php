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
    {{-- <label>Cambiar el avatar:</label>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <input type="file" class="custom-file-input " id="validatedInputGroupCustomFile" name="avatar">
        <label class="custom-file-label" for="validatedInputGroupCustomFile"></label>
    </div> --}}


    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <label>Cambiar el avatar:</label>
        <input class="form-control-file" type="file" name="avatar" id="avatar" value="{{ $user->avatar }}">
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Primer Nombre</label>
        <input class="form-control" type="text" name="name1" value="{{$user->name1}}" required>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Segundo Nombre</label>
        <input class="form-control" type="text" name="name2" value="{{$user->name2}}" required>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Primer Apellido</label>
        <input class="form-control" type="text" name="lastname1" value="{{$user->lastname1}}" required>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Segundo Apellido</label>
        <input class="form-control" type="text" name="lastname2" value="{{$user->lastname2}}" required>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Email</label>
        <input class="form-control" type="text" name="email" value="{{$user->email}}" required>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3">
        <label>Cédula</label>
        <input class="form-control" type="text" name="cedula" value="{{$user->cedula}}" required>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3">
        <label>Teléfono</label>
        <input class="form-control" type="text" name="telefono" value="{{$user->telefono}}" required>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <label>Si quiere cambiar su contraseña habilítelo</label>
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="changePasswordSwitch"
                onclick="togglePasswordFields()">
            <label class="custom-control-label" for="changePasswordSwitch">Habilitar cambio de contraseña</label>
        </div>
    </div>
</div>


<div class="row" id="passwordFields" style="display: none;">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Password</label>
        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Confirmar password</label>
        <input class="form-control" type="password" name="confirm-password">
        @error('confirm-password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div id="roleslist">
    <div class="form-group col-sm-12">
        <h3>Lista de roles</h3>
    </div>
    <div class="form-group col-sm-12">
        <ul class="list-unstyled">
            @foreach ($roles as $role)
                <li>
                    <label>
                        {{ Form::checkbox('roles[]', $role->id, null) }}
                        {{ $role->name }}
                        <em>({{ $role->description ?: 'N/A' }})</em>
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<hr>

<hr>
<div class="row">
    <div class="col-6">
        <button type="submit" class="btn btn-primary btn-block" id="guardar"><i class="fas fa-save"></i> | Guardar</button>
    </div>
    <div class="col-6">
        <i class="btn btn-info btn-block" aria-hidden="true" onclick="history.back ();"><i class="fas fa-undo"></i> | Regresar</i>
    </div>
</div>
<script>
    function togglePasswordFields() {
        const passwordFields = document.getElementById('passwordFields');
        passwordFields.style.display = passwordFields.style.display === 'none' ? 'block' : 'none';
    }
</script>

