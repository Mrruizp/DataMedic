<?php
require_once 'validar.datos.sesion.view.php';
$_POST["s_usuario"] = $dniSesion;


require_once '../controller/perfil.usuario.leer.datos.controller.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/datamedic.png">
        <title> Data Medic | Inicio</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include_once 'estilos.view.php'; ?>
    </head>

    <body class="hold-transition skin-purple-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php include_once './menu-arriba.admin.view.php'; ?>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <?php include_once 'menu-izquierda.admin.view.php'; ?>

            <!-- =============================================== -->

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1>Módulo Tratamiento</h1>
                      </div>
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="menu.principal.view.php">Inicio</a></li>
                          <li class="breadcrumb-item active">Módulo de Tratamiento</li>
                        </ol>
                      </div>
                    </div>
                  </div><!-- /.container-fluid -->
                </section>
                <!-- Main content -->
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <!-- left column -->
                      <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-default">
                          <div class="card-header">
                            <h3 class="card-title">Tratamiento</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          
                            <div class="card-body">
                              <div class="form-group">
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><ion-icon name="calendar-outline"></ion-icon> Agregar Tratamiento</button>
                              </div>
                              <div class="form-group">
                               <div id="listado" class="table table-responsive"></div>
                                
                              </div>
                            </div>
                         
                        </div>
                        <!-- /.card -->
                            </div>
                        </div>
                    </div>

              </section>
              <form id="frmgrabar" class="form-horizontal">
                <div class="modal fade" id="myModal">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-info">
                        <h4 class="modal-title" id = "titulomodalTratamiento">Registrar Tratamiento</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-2">
                                <p>
                                    <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                    Código <input type="text" 
                                                  name="txtCodigo" 
                                                  id="txtCodigo" 
                                                  class="form-control input-sm" 
                                                  readonly="true">
                                </p>
                            </div>
                            <div class="col-8">
                                <p>
                                    
                                    Nombre del Tratamiento<input type="text" 
                                                  name="txtTratamiento" 
                                                  id="txtTratamiento" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar">Close</button>
                        <button type="submit" class="btn btn-outline-info"><ion-icon name="save-outline"></ion-icon>  Registrar</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </form>
              
            <!--<?php include_once 'pie.view.php'; ?>-->

            <!-- Control Sidebar -->
            <?php // include_once 'opciones-derecha.view.php'; ?>
            <!-- /.control-sidebar -->
            <div class="control-sidebar-bg"></div>
         
        <!-- ./wrapper -->
        <?php include_once 'scripts.view.php'; ?>
        <script src="js/gestionarTratamiento.js" type="text/javascript"></script>
        
    <!--
        <script src="js/convocatoriaVigente.js" type="text/javascript"></script>
        <script src="js/convocatoriaConcluida.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoCurriculo.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoPruebas.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoFinal.js" type="text/javascript"></script>
    -->

    </body>
</html>