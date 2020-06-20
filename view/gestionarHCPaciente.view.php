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
        <title> Sistema Dental | Inicio</title>
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
                        <h1>Historia Clínica</h1>
                      </div>
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="menu.principal.view.php">Inicio</a></li>
                          <li class="breadcrumb-item active">Historia Clínica</li>
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
                            <h3 class="card-title">Paciente</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          
                            <div class="card-body">
                              
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
              
              <form id="frmgrabarDatosAdicionales" class="form-horizontal">
                <div class="modal fade" id="myModalPaciente">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-info">
                        <h4 class="modal-title" id="titulomodal">Paciente Registrado</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                          
                          <div class="row">
                            <div class="col-6">
                                <p>
                                    <input type="hidden" 
                                                  name="txtcod_paciente" 
                                                  id="txtcod_paciente" 
                                                  class="form-control input-sm">
                                    Domicilio<input type="text" 
                                                  name="txtDomicilio" 
                                                  id="txtDomicilio" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                            <div class="col-6">
                                <p>
                                    
                                    Procedencia<input type="text" 
                                                  name="txtProcedencia" 
                                                  id="txtProcedencia" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-4">
                                <p>
                                    
                                    Instrucción<input type="text" 
                                                  name="txtInstruccion" 
                                                  id="txtInstruccion" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                          
                            <div class="col-2">
                                <p>
                                    Raza <input type="text" 
                                                  name="txtRaza" 
                                                  id="txtRaza" 
                                                  class="form-control input-sm">
                                                                       
                                </p>
                            </div>
                            <div class="col-3">
                                <p>
                                    Religión<input type="text" 
                                                  name="txtReligion" 
                                                  id="txtReligion" 
                                                  class="form-control input-sm">                                     
                                </p>
                            </div>
                            <div class="col-3">
                                <p>
                                    
                                    Telefono<input type="text" 
                                                  name="txtTelefonoPacHistClinica" 
                                                  id="txtTelefonoPacHistClinica" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-4">
                                <p>
                                    fecha_ingreso<input type="text" 
                                                  name="txtFechaIngresoPaciente" 
                                                  id="txtFechaIngresoPaciente" 
                                                  class="form-control input-sm">                                    
                                </p>
                            </div>
                            <div class="col-2">
                                <p>
                                    
                                    hora<input type="text" 
                                                  name="txtHoraHistClinica" 
                                                  id="txtHoraHistClinica" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                            <div class="col-3">
                                <p>
                                    
                                    Modo de Ingreso<input type="text" 
                                                  name="txtModoIngreso" 
                                                  id="txtModoIngreso" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                            <div class="col-3">
                                <p>
                                    Fecha de Historia Clinica<input type="text" 
                                                  name="txtFechaHistClinica" 
                                                  id="txtFechaHistClinica" 
                                                  class="form-control input-sm">                                    
                                </p>
                            </div>
                          </div>



                          <div class="row">
                            
                            <div class="col-12">
                                <p>
                                    
                                    Descripcion Clínica<textarea type="text"
                                                  name="editor1"
                                                  id="editor1"
                                                  placeholder="Ejemplo: Síntomas principales, tipo de enfermedad, forma de inicio, relato cronológico" 
                                                  class = "ckeditor" cols="20"></textarea>
                                </p>
                            </div>

                          </div>
                        <div class="row">
                            <div class="modal-header col-12 text-center">
                                <h5 class="modal-title"><b>Persona Responsable del Paciente</b></h5>
                            </div>
                          </div><br/>
                        <div class="row">
                          <div class="col-8">
                                <p>
                                    
                                    Nombre Completo<input type="text" 
                                                  name="txtPersonaResponsable_paciente1" 
                                                  id="txtPersonaResponsable_paciente1" 
                                                  class="form-control input-sm">
                                </p>
                          </div>
                          <div class="col-4">
                                <p>
                                    
                                    Teléfono<input type="text" 
                                                  name="txtTelefono_paciente2" 
                                                  id="txtTelefono_paciente2" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                        </div>
                       <!--<div class="row">
                          <div class="col-12">
                              <p>
                                  
                                  Mensaje <textarea type="text" 
                                                name="txtDescripcion" 
                                                id="txtDescripcion" 
                                                class="form-control input-sm" rows="2"></textarea>
                              </p>
                          </div>
                      </div>-->
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar">Close</button>
                      <?php

                              if($_SESSION["tipo"] !== "C")
                              {
                            ?>
                        <button type="submit" class="btn btn-outline-info"><ion-icon name="save-outline"></ion-icon>  Registrar</button>
                      <?php
                              }
                            ?>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </form>







              <form id="frmgrabar" class="form-horizontal">
                <div class="modal fade" id="myModalHTratamiento">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-info">
                        <h4 class="modal-title" id="titulomodal">Historial de Tratamiento</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                          
                          <div class="row">
                            <div class="col-2">
                                <p>
                                    
                                    DNI <input type="text" 
                                                  name="txtDoc_id_paciente1" 
                                                  id="txtDoc_id_paciente1" 
                                                  class="form-control input-sm" readonly="true">
                                </p>
                            </div>
                          </div>
                          
                        <div class="row">
                          <div class="col-12">
                                <div id="listadoHistPaciente" class="table table-responsive"></div>
                          </div>
                        </div>
                       <!--<div class="row">
                          <div class="col-12">
                              <p>
                                  
                                  Mensaje <textarea type="text" 
                                                name="txtDescripcion" 
                                                id="txtDescripcion" 
                                                class="form-control input-sm" rows="2"></textarea>
                              </p>
                          </div>
                      </div>-->
                      </div>
                <!--<div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar">Close</button>
                      </div> -->
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </form>
            </div> 
            <?php include_once 'pie.view.php'; ?>

            <!-- Control Sidebar -->
            <?php // include_once 'opciones-derecha.view.php'; ?>
            <!-- /.control-sidebar -->
            <div class="control-sidebar-bg"></div>
         
        <!-- ./wrapper -->
        <?php include_once 'scripts.view.php'; ?>
        <script src="js/gestionarHCPaciente.js" type="text/javascript"></script>
        <script src="js/cbCodigo.js" type="text/javascript"></script>
    <!--
        <script src="js/convocatoriaVigente.js" type="text/javascript"></script>
        <script src="js/convocatoriaConcluida.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoCurriculo.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoPruebas.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoFinal.js" type="text/javascript"></script>
    -->

    </body>
</html>