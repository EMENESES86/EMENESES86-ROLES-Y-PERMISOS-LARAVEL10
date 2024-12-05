<div class="box box-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header" style="background: url('<?php echo asset('dist/img/ISUS-fondo.png'); ?>')">
        <div class="row">

            <div id="preview" class="col-sm-12" align="center">
                <img class="img-circle" src="{{ asset("/storage/administration/$admin->favicon") }}?{{ time() }}"
                    alt="User Avatar">
            </div>
        </div>

    </div>
</div>
<br><br><br>
<hr>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <label>Cambiar el avatar:</label>
        <input class="form-control-file @error('avatar') is-invalid @enderror" type="file" name="avatar" id="avatar">
        @error('avatar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Nombres</label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
            value="{{ old('name') }}" required>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Apellidos</label>
        <input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname"
            value="{{ old('lastname') }}" required>
        @error('lastname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Email</label>
        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
            value="{{ old('email') }}" required>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3">
        <label>Cédula</label>
        <input class="form-control @error('cedula') is-invalid @enderror" type="text" name="cedula"
            value="{{ old('cedula') }}" required>
        @error('cedula')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3">
        <label>Teléfono</label>
        <input class="form-control @error('telefono') is-invalid @enderror" type="text" name="telefono"
            value="{{ old('telefono') }}" required>
        @error('telefono')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Password</label>
        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <label>Confirmar password</label>
        <input class="form-control @error('confirm-password') is-invalid @enderror" type="password"
            name="confirm-password" required>
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
                        {{ Form::checkbox('roles[]', $role->id, in_array($role->id, old('roles', [])) ? true : false) }}
                        {{ $role->name }}
                        <em>({{ $role->description ?: 'N/A' }})</em>
                    </label>
                </li>
            @endforeach
        </ul>
        @error('roles')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<hr>
<hr>
<div class="row">
    <div class="col-6">
        <button type="submit" class="btn btn-primary btn-block" id="guardar"><i class="fas fa-save"></i> |
            Guardar</button>
    </div>
    <div class="col-6">
        <i class="btn btn-info btn-block" aria-hidden="true" onclick="history.back ();"><i class="fas fa-undo"></i> |
            Regresar</i>
    </div>
</div>
