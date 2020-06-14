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
        <title> Sistema Dental | Horario</title>
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
                        <h1>Módulo Horario</h1>
                      </div>
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="menu.principal.view.php">Horario</a></li>
                          <li class="breadcrumb-item active">Módulo de Horario</li>
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
                            <h3 class="card-title">Horario</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          
                            <div class="card-body">
                              <div class="form-group">
                           
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><ion-icon name="calendar-outline"></ion-icon> Agregar Horario</button>
                           
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
                        <h4 class="modal-title">Registrar Horario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-3">
                                <p>
                                    <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                    Código <input type="text" 
                                                  name="txtCodigo" 
                                                  id="txtCodigo" 
                                                  class="form-control input-sm" 
                                                  readonly="true">
                                </p>
                            </div>
                          
                          </div>
                          <div class="row">
                            <div class="col-6">
                                <p>
                                   
                                    Sede <select class="form-control" name="cbSede" id="cbSede"
                                    onchange="cargarCbCodigoAreaSede('#cbArea',this.value,'seleccione')">
                                              
                                                 </select>
                     
                 
                                </p>
                            </div>
                            <div class="col-6">
                                <p>
                                   
                                    Área <select class="form-control" name="cbArea" id="cbArea"
                                         onchange="cargarCbCodigoConsultorio('#cbConsultorio',this.value,'seleccione')">
                                           </select>
                                </p>
                            </div>
                            
                          </div>
                          <div class="row">
                            <div class="col-6">
                                <p>
                                   
                                    Consultorio <select class="form-control" name="cbConsultorio" id="cbConsultorio">
                                                 </select>
                     
                 
                                </p>
                            </div>
                            <div class="col-6">
                                <p>
                                   
                                    Doctor <select class="form-control" name="cbDoctor" id="cbDoctor">
                                              
                                                 </select>
                     
                 
                                </p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-3">
                                <p>
                                    
                                    Día<select id="cbDia" name="cbDia" class="form-control" required> 
                                                    <option></option>
                                                    <option value="Lunes">Lunes</option>
                                                    <option value="Martes">Martes</option>
                                                    <option value="Miercoles">Miércoles</option>
                                                    <option value="Jueves">Jueves</option>
                                                    <option value="Viernes">Viernes</option>
                                                    <option value="Sábado">Sábado</option>
                                                    <option value="Domingo">Domingo</option>
                                                </select>
                                </p>
                            </div>
                            <div class="col-3">
                                <p>
                                    
                                    Número<select id="cbNumero" name="cbNumero" class="form-control" required> 
                                                    <option></option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                </p>
                            </div>
                            <div class="col-3">
                                <p>
                                    
                                    Mes<select id="cbMes" name="cbMes" class="form-control" required> 
                                                    <option></option>
                                                    <option value="Enero">Enero</option>
                                                    <option value="Febrero">Febrero</option>
                                                    <option value="Marzo">Marzo</option>
                                                    <option value="Abril">Abril</option>
                                                    <option value="Mayo">Mayo</option>
                                                    <option value="Junio">Junio</option>
                                                    <option value="Julio">Julio</option>
                                                    <option value="Agosto">Agosto</option>
                                                    <option value="Setiembre">Setiembre</option>
                                                    <option value="Octubre">Octubre</option>
                                                    <option value="Noviembre">Noviembre</option>
                                                    <option value="Diciembre">Diciembre</option>
                                                </select>
                                </p>
                            </div>
                            <div class="col-3">
                                <p>
                                    
                                    Año<select id="cbAno" name="cbAno" class="form-control" required> 
                                                    <option></option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                    <option value="2031">2031</option>
                                                    <option value="2032">2032</option>
                                                </select>
                                </p>
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

              









            </div> 
            
              <form id="frmgrabar" class="form-horizontal">
                <div class="modal fade" id="myModalHorarioDetalle">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-info">
                        <h4 class="modal-title" id="titulomodal">Detalle Horario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                      
                         
                                <div class="form-group">
                               <div id="listadoHorarioDetalle" class="table table-responsive"></div>
                                
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
            <!-- Control Sidebar -->
            <?php // include_once 'opciones-derecha.view.php'; ?>
            <!-- /.control-sidebar -->
            
            <div class="control-sidebar-bg"></div>
         
        <!-- ./wrapper -->
        <?php include_once 'scripts.view.php'; ?>
        <script src="js/gestionarHorario.js" type="text/javascript"></script>
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