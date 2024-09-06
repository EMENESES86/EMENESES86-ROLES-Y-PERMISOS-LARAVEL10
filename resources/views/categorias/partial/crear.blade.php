<div class="box box-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header" style="background: url('<?php echo asset('dist/img/ISUS-fondo.png'); ?>')">
        <div class="row">

            <div id="preview" class="col-sm-12" align="center">
                <img class="img-circle" src="{{ asset('dist/img/logo_sucre.png') }}" alt="User Avatar">
            </div>
        </div>

    </div>
</div>
<br><br><br>
<hr>


<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <label>Cambiar el avatar:</label>
        <input class="form-control-file" type="file" name="cat_avatar" id="avatar">
        @if ($errors->has('cat_avatar'))
            <p style="color: red">{{ $errors->first('cat_avatar') }}</p>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-8">
        <label>Nombre de categoría</label>
        <input class="form-control" type="text" name="cat_name" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
        @if ($errors->has('cat_name'))
            <p style="color: red">{{ $errors->first('cat_name') }}</p>
        @endif
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4">
        <label>Color</label>
        <select class="form-control" aria-label="Default select example" name="cat_color" required>
            <option selected>Open this select menu</option>
            <option value="bg-primary" class="bg-primary">Azul</option>
            <option value="bg-secondary" class="bg-secondary">Gris</option>
            <option value="bg-success" class="bg-success">Verde</option>
            <option value="bg-danger" class="bg-danger">Rojo</option>
            <option value="bg-warning" class="bg-warning">Amarillo</option>
            <option value="bg-info" class="bg-info">Azul bajo</option>
            <option value="bg-light" class="bg-light">Blanco</option>
            <option value="bg-dark" class="bg-dark">Negro</option>

        </select>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <label>Descripción de categoría</label>
        <textarea class="form-control" name="cat_descripcion" id="" rows="5" onkeyup="countChars(this);" maxlength="150" required></textarea>
        <p id="charNum">0 characters</p>
        @if ($errors->has('cat_descripcion'))
            <p style="color: red">{{ $errors->first('cat_descripcion') }}</p>
        @endif
    </div>
</div>


<hr>
<div class="row">
    <div class="col-sm-6">
        <button type="submit" class="btn btn-primary btn-block" id="guardar"><i class="fas fa-save"></i> |
            Guardar</button>
    </div>
    <div class="col-sm-6">
        <i class="btn btn-info btn-block" aria-hidden="true" onclick="history.back ();"><i class="fas fa-undo"></i> |
            Regresar</i>
    </div>
</div>

<script>
    function countChars(obj) {
        var maxLength = 150;
        var strLength = obj.value.length;

        if (strLength > maxLength) {
            document.getElementById("charNum").innerHTML = '<span style="color: red;">' + strLength + ' out of ' +
                maxLength + ' characters</span>';
        } else {
            document.getElementById("charNum").innerHTML = strLength + ' out of ' + maxLength + ' characters';
        }
    }
</script>
