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
                        <h1>Módulo Log</h1>
                      </div>
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="menu.principal.view.php">Inicio</a></li>
                          <li class="breadcrumb-item active">Módulo Log</li>
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
                            <h2 class="card-title text-info text-bold"> <ion-icon name="exit-outline"></ion-icon> Inicios de sesión</h2>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          
                            <div class="card-body">
                             
                              <div class="form-group">
                               <div id="listadoLog_inicioseseion"></div>
                                
                              </div>
                              
                            </div>
                            
                        </div>
                        <!-- /.card -->
                            </div>
                        </div>
                        <div class="row">
                          <!-- left column -->
                          <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-default">
                              <div class="card-header">
                                <h2 class="card-title text-info text-bold"><ion-icon name="person-outline"></ion-icon> Usuario</h2>
                              </div>
                              <!-- /.card-header -->
                              <!-- form start -->
                              
                                <div class="card-body">
                                 
                                  <div class="form-group">
                                   <div id="listadoLog_usuario"></div>
                                    
                                  </div>
                                  <div class="row">
                                    <div class="col-4">
                                      <div class="box-footer no-padding">
                                      <ul class="nav nav-pills nav-stacked">
                                        <li class="">
                                            <a><h5>Usuarios que registrarón movimientos
                                              <span class="pull-right text-default text-bold" style="background-color: #25c3ff;">
                                                <i class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> 
                                                    
                                                </span></h5>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a><h5>Usuarios que fueron creados
                                              <span class="pull-right text-default text-bold" style="background-color: #7df2ae;">
                                                <i class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> 
                                                    
                                                </span></h5>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a><h5>Credenciales que fuerón creados
                                              <span class="pull-right text-default text-bold" style="background-color: #86fff6;">
                                                <i class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> 
                                                    
                                                </span></h5>
                                            </a>
                                        </li>
                                      </ul>
                                    </div>
                                    </div>
                                </div><br/><br/>
                                </div>
                             
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>
                        <div class="row">
                          <!-- left column -->
                          <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-default">
                              <div class="card-header">
                                <h2 class="card-title text-info text-bold"><ion-icon name="medkit-outline"></ion-icon> Especialidad</h2>
                              </div>
                              <!-- /.card-header -->
                              <!-- form start -->
                              
                                <div class="card-body">
                                 
                                  <div class="form-group">
                                   <div id="listadoLog_doctor"></div>
                                    
                                  </div>
                                </div>
                             
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>
                        
                        <div class="row">
                          <!-- left column -->
                          <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-default">
                              <div class="card-header">
                                <h2 class="card-title text-info text-bold"><ion-icon name="reader-outline"></ion-icon> Tratamiento</h2>
                              </div>
                              <!-- /.card-header -->
                              <!-- form start -->
                              
                                <div class="card-body">
                                 
                                  <div class="form-group">
                                   <div id="listadoLog_tratamiento"></div>
                                    
                                  </div>
                                </div>
                             
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>
                        <div class="row">
                          <!-- left column -->
                          <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-default">
                              <div class="card-header">
                                <h2 class="card-title text-info text-bold"><ion-icon name="reader-outline"></ion-icon> Tratamiento</h2>
                              </div>
                              <!-- /.card-header -->
                              <!-- form start -->
                              
                                <div class="card-body">
                                 
                                  <div class="form-group">
                                   <div id="listadoLog_paciente"></div>
                                    
                                  </div>
                                </div>
                             
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>
                    </div>

              </section>
             
              
            <!--<?php include_once 'pie.view.php'; ?>-->

            <!-- Control Sidebar -->
            <?php // include_once 'opciones-derecha.view.php'; ?>
            <!-- /.control-sidebar -->
            <div class="control-sidebar-bg"></div>
         
        <!-- ./wrapper -->
        <?php include_once 'scripts.view.php'; ?>
        <!--<script src="js/gestionarTratamiento.js" type="text/javascript"></script>-->
        <script src="js/log.js" type="text/javascript"></script>
        
    <!--
        <script src="js/convocatoriaVigente.js" type="text/javascript"></script>
        <script src="js/convocatoriaConcluida.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoCurriculo.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoPruebas.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoFinal.js" type="text/javascript"></script>
    -->

    </body>
</html>