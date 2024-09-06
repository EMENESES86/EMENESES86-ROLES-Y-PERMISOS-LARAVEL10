<div class="box box-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header" style="background: url('<?php echo asset('dist/img/ISUS-fondo.png'); ?>')">
        <div class="row">

            <div id="preview" class="col-sm-12" align="center">
                @if ($pro->pro_avatar == '')
                    <img class="img-circle" src="{{ asset('dist/img/logo_sucre.png') }}" alt="User Avatar">
                @else
                    <img class="img-circle" src="<?php echo asset("storage/productos/$pro->pro_avatar"); ?>" alt="User Avatar">
                @endif
            </div>
        </div>

    </div>
</div>
<br><br><br>
<hr>


<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
        <label>Cambiar el avatar:</label>
        <input class="form-control-file" type="file" name="pro_avatar" id="avatar">
        @if ($errors->has('pro_avatar'))
            <p style="color: red">{{ $errors->first('pro_avatar') }}</p>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-7 col-lg-7">
        <label>Nombre de categoría</label>
        <input class="form-control" type="text" name="pro_name" value="{{ $pro->pro_name }}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
        @if ($errors->has('pro_name'))
            <p style="color: red">{{ $errors->first('pro_name') }}</p>
        @endif
    </div>
    <div class="col-sm-12 col-md-5 col-lg-5">
        <label>Categoría</label>
        <select class="form-control" name="id_cat" id="">
            <option value="{{ $pro->categoria->id }}" selected>{{ $pro->categoria->cat_name }}</option>
            @foreach ($cat as $c)
                <option value="{{ $c->id }}" class="bg-primary">{{ $c->cat_name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <label>Link del producto</label>
        <input class="form-control" type="text" name="pro_link" value="{{ $pro->pro_link }}" required>
        @if ($errors->has('pro_link'))
            <p style="color: red">{{ $errors->first('pro_link') }}</p>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <label>Descripción de categoría</label>
        <textarea class="form-control" name="pro_descripcion" id=""rows="5" onkeyup="countChars(this);" maxlength="150" required>{{ $pro->pro_descripcion }}</textarea>
        <p id="charNum">0 characters</p>
        @if ($errors->has('pro_descipcion'))
            <p style="color: red">{{ $errors->first('pro_descipcion') }}</p>
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
