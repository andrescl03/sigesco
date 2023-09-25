<h4 class="mt-4"><b><i class="far fa-object-ungroup fa-sm"></i> Perfil de Usuarios </b></h4>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
    <li class="breadcrumb-item active"> Perfil de Usuarios</li>
</ol>
<div class="card mb-4">
    <div class="card-body">
        <div class="row">        
            <div class="col-lg-6">                            
                <div class="form-group row">
                    <label for="txt_dni" class="col-sm-3 col-form-label"><b>DNI:</b></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" id="txt_dni" name="txt_dni" minlength="8" maxlength="8" onkeypress="return soloNumeros(event)"  onblur="limpiaNumeros(this)" value="<?php echo $usu_dni; ?>" readonly> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_nombre" class="col-sm-3 col-form-label"><b>Nombre:</b></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="txt_nombre" name="txt_nombre" onkeypress="return soloLetras(event)" onblur="limpiaLetras(this)" onkeyup="mayus(this)" value="<?php echo $usu_nombre; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_apellidos" class="col-sm-3 col-form-label"><b>Apellidos:</b></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="txt_apellidos" name="txt_apellidos" onkeypress="return soloLetras(event)" onblur="limpiaLetras(this)" onkeyup="mayus(this)" value="<?php echo $usu_apellidos; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_tipo" class="col-sm-3 col-form-label"><b>Grupo Asignado:</b></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="txt_tipo" name="txt_tipo" value="<?php echo $usu_tipo; ?>" readonly>
                    </div>
                </div>
                <!-- Resto de tu código HTML -->
            </div>            
        </div>
    </div>
</div>
