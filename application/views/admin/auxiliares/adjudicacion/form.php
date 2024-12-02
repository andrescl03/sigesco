<style>
    .modal-body {
        font-family: Arial, sans-serif;
        /*display: flex;*/
        justify-content: center;
        align-items: center;
        /*height: 100vh;*/
        margin: 0;
    }

    .dual-listbox-container {
        display: flex;
        align-items: center;
    }

    .listbox {
        list-style: none;
        border: 1px solid #ccc;
        /*width: 300px;*/
        height: 500px;
        overflow-y: auto;
        margin-bottom: 15px;
    }

    .listbox li {
        cursor: pointer;
        margin: 7px 0;
        padding: 5px 15px;
        font-size: 13px;
    }

    .controls {
        margin: 100px 20px;
    }
    .dataTables_info {
        float: left;
    }
    .paging_simple_numbers {
        float: right;
    }
    .min-width-table-postulant {
        min-width: 100px;
    }
</style>
<?php $edit = isset($data['adjudicacion']) ? true : false ?>
<div id="AppFormAdjudicacionAdmin" data-id="<?php echo $edit ? $data['adjudicacion']->id : 0 ?>"
    data-now="<?php echo date('Y-m-d H:i'); ?>">
    <h4 class="mt-3"><b><i class="far fa-object-ungroup fa-sm"></i> <?php echo $edit ? "Editar" : "Crear" ?>
            Adjudicación</b></h4>
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"> Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/auxiliares/adjudicaciones"> Adjudicaciones</a></li>
        <li class="breadcrumb-item active"><?php echo $edit ? "Editar" : "Crear" ?></li>
    </ol>
    <div class="app-row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="card border-secondary">
                        <div class="card-body text-dark">
                            <div class="text-right mb-2">

                                <div class="row <?= $edit ? 'd-none' : '' ?>">
                                    <div class="col-md-12 mb-3">
                                        <div class="card border border-primary">
                                            <div class="card-header bg-dark text-white">
                                                <div class="d-flex">
                                                    <h5 class="col"><span
                                                            class="badge rounded-pill bg-light text-primary me-1 fs-7">+</span>Asignación
                                                        de busqueda</h5>
                                                    <?php if (!$edit) { ?>
                                                        <div class="col text-end">
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-light btn-filtro-busqueda">
                                                                <i class="fa-solid fa-file-signature fa-lg me-1"></i> Buscar
                                                                Modalidad/Nivel/Especialidad
                                                            </button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-md-12 list-modalidades">
                                                    No hay registro para mostrar
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="card border border-primary">
                                                    <div class="card-header bg-primary text-white">
                                                        <div class="d-flex">
                                                            <h5 class="col"><span
                                                                    class="badge rounded-pill bg-light text-primary me-1 fs-7">1</span>
                                                                Auxiliar</h5>
                                                            <?php if (!$edit) { ?>
                                                               <!--    <div class="col text-end">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-light btn-docente">
                                                                        <i
                                                                            class="fa-solid fa-file-signature fa-lg me-1"></i>
                                                                        Buscar Auxiliar
                                                                    </button>
                                                                </div>-->
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                    <div class="row mb-3 <?= $edit ? 'd-none' : '' ?>">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm shadow-none"
                                                                        placeholder="Escribe aquí..." id="txtBuscador1">
                                                                    <button type="button"
                                                                        class="input-group-text btn btn-sm btn-primary shadow-none btn-search-1">Filtrar</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="">
                                                                    <table
                                                                        class="table table-bordered results table-postulaciones mb-0"
                                                                        id="tablePostulantes" style="width:100%;">
                                                                        <thead>
                                                                            <tr class="cabecera_tabla_2 bg-primary">
                                                                                <th>Convocatoría</th>
                                                                                <th>Tipo</th>
                                                                                <th>Nombre del Docente</th>
                                                                                <th>N° de Documento</th>
                                                                                <th>Modalidad</th>
                                                                                <th>Nivel</th>
                                                                                <th>Especialidad</th>
                                                                                <th>Puntaje</th>
                                                                                <th>Prelación</th>
                                                                                <th>Fecha de Registro</th>
                                                                                <th class="text-center">Estado</th>
                                                                                <th class="text-center">Nro de intentos</th>
                                                                                <th>Acciones</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                           <!--  <div class="col-md-3 mt-4 offset-9">
                                                                <button type="button"
                                                                    class="btn w-100 btn-primary btn-docente-add">Agregar</button>
                                                            </div> -->

                                                        </div>

                                                         <div class="col-md-12 list-docente">
                                                            No hay registro para mostrar
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="card border-success">
                                                    <div class="card-header bg-success text-white">
                                                        <div class="d-flex">
                                                            <h5 class="col"><span
                                                                    class="badge rounded-pill bg-light text-success me-1 fs-7">2</span>
                                                                Plaza</h5>
                                                            <?php if (!$edit) { ?>
                                                             <!--   <div class="col text-end">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-light btn-plaza">
                                                                        <i
                                                                            class="fa-solid fa-file-signature fa-lg me-1"></i>
                                                                        Buscar Plaza
                                                                    </button>
                                                                </div>-->
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                    <div class="row mb-3 <?= $edit ? 'd-none' : '' ?>">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm shadow-none"
                                                                        placeholder="Escribe aquí..." id="txtBuscador">
                                                                    <button type="button"
                                                                        class="input-group-text btn btn-sm btn-success shadow-none btn-search">Filtrar</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <table class="table table-bordered table-plazas mb-0"
                                                                    id="tablePlazas" width="100%">
                                                                    <thead>
                                                                        <tr class="cabecera_tabla_2 bg-success">
                                                                            <th>#</th>
                                                                            <th>Código Plaza</th>
                                                                            <th>Insitución Educativa</th>
                                                                            <th>Especialidad</th>
                                                                            <th>Jordana</th>
                                                                            <th>Tipo vacante</th>
                                                                            <th>Motivo vacante</th>
                                                                            <th>Tipo de convocatoria</th>
                                                                            <th>Opciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                          <!--  <div class="col-md-3 mt-4 offset-9">
                                                                    <button type="button" class="btn w-100 btn btn-success btn-plaza-add">Agregar</button>
                                                            </div>   -->
                                                            
                                                        </div>
                                                         <div class="col-md-12 list-plaza">
                                                            No hay registro para mostrar
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="card border-warning">
                                                    <div class="card-header bg-warning text-white">
                                                        <h5><span
                                                                class="badge rounded-pill bg-light text-warning me-1 fs-7">3</span>
                                                            Adjudicación</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="formAdjudicacion">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="" class="form-label">Fecha y hora de
                                                                        Registro</label>
                                                                    <input type="datetime-local" name="fecha_registro"
                                                                        class="form-control" placeholder="" required />
                                                                </div>
                                                                <button type="button"
                                                                    class="mb-4 btn btn-sm btn-warning text-white btn-obtener-fecha-actual">
                                                                    Obtener fecha y hora actual
                                                                </button>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="" class="form-label">Inicio
                                                                        Contrato</label>
                                                                    <input type="date" name="fecha_inicio"
                                                                        class="form-control" placeholder="" required />
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="" class="form-label">Término
                                                                        Contrato</label>
                                                                    <input type="date" name="fecha_final"
                                                                        class="form-control shadow-none bg-white" placeholder="" readonly />
                                                                </div>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-warning text-white btn-obtener-fecha-inicio-fin">
                                                                    Obtener fecha inicio y fin de contrato por defecto
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                  
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                    <div class="row">
                                    <div class="col-md-12 mb-3">
                                                <div class="card border-info">
                                                    <div class="card-header bg-info text-white">
                                                        <div class="d-flex">
                                                            <h5 class="col"><span
                                                                    class="badge rounded-pill bg-light text-info me-1 fs-7">4</span>
                                                                Firmas en el acta</h5>
                                                            <div class="col text-end">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-light mb-2 btn-usuario-firma">
                                                                    <i class="fa-solid fa-edit fa-lg me-1"></i>
                                                                    Gestionar
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-light mb-2 btn-firma">
                                                                    <i
                                                                        class="fa-solid fa-file-signature fa-lg me-1"></i>
                                                                    Buscar Firma
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="col-md-12 list-firmas">
                                                            No hay registro para mostrar
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3 text-end">
                                        <a href="<?php echo base_url(); ?>adjudicaciones" type="button"
                                            class="btn btn-secondary">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary" form="formAdjudicacion">
                                            Adjudicar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDocentes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listado de auxiliares</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <!-- <div class="col-md-4">
                            <div class="mb-3">
                                <select class="form-select select-tipo-docente" name="">
                                    <option value="" selected>[TODOS]</option>
                                    <option value="1">PUN</option>
                                    <option value="2">EVALUACIÓN DE EXPEDIENTE</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="form-group pull-right mb-2">
                                <input type="text" class="search search-postulaciones form-control" placeholder="Buscar">
                            </div>
                        </div> -->
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm shadow-none"
                                    placeholder="Escribe aquí..." id="txtBuscador1">
                                <button type="button"
                                    class="input-group-text btn btn-sm btn-primary shadow-none btn-search-1">Busqueda</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered results table-postulaciones mb-0"
                                    id="tablePostulantes">
                                    <thead>
                                        <tr class="cabecera_tabla_2">
                                            <th>#</th>
                                            <th>Docente</th>
                                            <th>Número de Documento</th>
                                            <th>Modalidad</th>
                                            <th>Nivel</th>
                                            <th>Especialidad</th>
                                            <th>Puntaje</th>
                                            <th>Fecha de Registro</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Nro de intentos</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-docente-add">Agregar</button>
                </div>
            </div>
        </div>
    </div>

 
    <div class="modal fade" id="modalFiltroBusqueda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asignación de busqueda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Modalidad</label>
                            <select class="form-control select-modalidades shadow-none" name="modalidad" required>
                                <option value="" selected>[SELECCIONE]</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Nivel</label>
                            <select class="form-control select-niveles shadow-none" name="nivel" required>
                                <option value="" selected>[SELECCIONE]</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Especialidad</label>
                            <select class="form-control select-especialidades shadow-none" name="especialidad" required>
                                <option value="" selected>[SELECCIONE]</option>
                            </select>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="search" class="form-control shadow-none input-search-2"
                                    placeholder="Escribe aquí..." id="txtBuscador2">
                                <button type="button"
                                    class="input-group-text btn btn-primary shadow-none btn-search-2">Buscar</button>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-modalidades mb-0" id="tableModalidades"
                                    width="100%">
                                    <thead>
                                        <tr class="cabecera_tabla_2">
                                            <th>#</th>
                                            <th>Modalidad</th>
                                            <th>Nivel</th>
                                            <th>Especialidad</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-modalidad-add">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Modal -->
    <div class="modal fade" id="modalPlazas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listado de Plazas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm shadow-none"
                                    placeholder="Escribe aquí..." id="txtBuscador">
                                <button type="button"
                                    class="input-group-text btn btn-sm btn-primary shadow-none btn-search">Buscar</button>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <table class="table table-bordered table-plazas mb-0" id="tablePlazas" width="100%">
                                <thead>
                                    <tr class="cabecera_tabla_2">
                                        <th>#</th>
                                        <th>Código Plaza</th>
                                        <th>Insitución Educativa</th>
                                        <th>Especialidad</th>
                                        <th>Jordana</th>
                                        <th>Tipo vacante</th>
                                        <th>Motivo vacante</th>
                                        <th>Tipo de convocatoria</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-plaza-add">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalFirmas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listado de Firmas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group pull-right mb-2">
                                <input type="text" class="search search-firmas form-control" placeholder="Buscar">
                            </div>
                        </div>
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-firmas mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Usuario</th>
                                        <th>Número Documento</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-firma-add">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUsuarioFirmas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listado de Firmas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="dual-listbox-container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="mb-2">Todos los usuarios</h5>
                                        <ul id="left-listbox" class="listbox" data-list="left" draggable="true">
                                        </ul>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="controls">
                                            <button class="btn btn-primary" id="move-right">
                                                Mover Derecha
                                                <i class="fa fa-chevron-right ms-2" aria-hidden="true"></i><i
                                                    class="fa fa-chevron-right" aria-hidden="true"></i>
                                            </button><br><br>
                                            <button class="btn btn-primary" id="move-left">
                                                <i class="fa fa-chevron-left" aria-hidden="true"></i><i
                                                    class="fa fa-chevron-left me-2" aria-hidden="true"></i>
                                                Mover Izquierda
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="mb-2">Mis usuarios</h5>
                                        <ul id="right-listbox" class="listbox" data-list="right" draggable="true">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-usuario-firma-add">Guardar</button>
                </div>
            </div>
        </div>
    </div>

</div>