<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>StemaClinico | Inicio</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include_once 'estilos.view.php'; ?>
</head>
<style>
/*
         #myModal{
            padding: 0 0 0 750px; 
            width: 61% !important;
            position: absolute;
            
        }
        */
        .modal-lg {
                      max-width: 394px;
                  }

    </style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php //include_once './menu-arriba.admin.view.php'; ?>

  <!-- =============================================== -->
  <!-- Left side column. contains the sidebar -->
  <?php //include_once 'menu-izquierda.admin.view.php'; ?>

  <!-- =============================================== -->

  

  <!-- Content Wrapper. Contains page content -->
  <div class="main-header">
    <!-- Content Header (Page header) -->
    <!--<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-center text-info">DataMedic</h1>
          </div>
        </div>
      </div>
    </div>-->
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="">
        <!-- Small boxes (Stat box) -->
        <div class="row col-lg-12">
          <div class="col-lg-11 text-right"><br/>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" id="btnagregar">Iniciar sesión</button>
            
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1">
            <!-- small box -->
            <div class="">
              <div class="inner">
                <img src="../images/datamedic.png" class="img img-responsive center-block" width="150">
              </div>
            </div>
          </div>
            <!-- ./col -->
            <div class="col-md-3">
              <!-- small box -->
                <div class="card-header">
                    <h3 class="text-bold text-primary">
                      Estetica Dental Alcedo
                    </h3>
                </div>
                <div><br/>
                  <div class="col-md-12 col-sm-4">
                    <h6>
                      <ion-icon name="location-outline"></ion-icon>
                      Av las Nazarenas 186, Santiago de Surco
                    </h6>
                  </div>
                </div>
                  <div class="col-md-12 col-sm-4">
                    <h6>
                      <ion-icon name="phone-portrait-outline"></ion-icon>
                       924869860
                    </h6>
                  </div>
            </div>
          <!-- ./col -->

        </div>
        <!-- /.row -->
        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-5">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header text-center bg-info">
                <h3>
                  <!--<ion-icon name="calendar-outline"></ion-icon>-->
                  Agenda tu cita
                </h3>
              </div><!-- /.card-header -->
              <div class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Especialidad:</label>
                    <div class="row">
                      <div class="col-lg-12">
                      <!-- select -->
                          <div class="form-group">
                              <select class="form-control" name="especialidad" id="especialidad" 
                                      onchange="cargarCbCodigoDoctor('#doctor',this.value,'seleccione')">
                              </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Doctor:</label>
                    <div class="row">
                      <div class="col-sm-12">
                      <!-- select -->
                          <div class="form-group">
                            <select class="form-control" name="doctor" id="doctor" 
                                    onchange="ListarHorarioDisponible(this.value)">
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              
              <div class="card-body">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Fecha y hora:</label>
                <div id="listado" class="table table-responsive"></div>
              </div>

              </div>

            </div>
            <!-- /.card -->
          </section>
          <section class="col-lg-6">
            <div class="col-lg-12">
            <!-- small box -->
              <div class="card-header small-box col-lg-12">
                  <h5 class="text-bold text-primary">
                    Más información
                  </h5>
              </div>
              <br/>
                <div class="col-md-12 col-sm-4">
                  <h6>
                    <ion-icon name="earth-outline"></ion-icon>
                    <b>Web: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> http://alfirk.org.pe
                  </h6>
                </div>
                <div class="col-md-12 col-sm-4">
                  <h6>
                    <ion-icon name="time-outline"></ion-icon>
                     <b>Atención: &nbsp;</b> Lunes-Viernes
                  </h6>
                </div>
            </div><br/>
            <div class="col-lg-12">
            <!-- small box -->
              <div class="card-header small-box col-lg-12">
                  <h5 class="text-bold text-primary">
                    Especialidades
                  </h5>
              </div>
              <br/>
                <div class="col-md-12 col-sm-4">
                  <h6>
                    <ion-icon name="checkmark-outline"></ion-icon>
                    Endodoncia
                  </h6>
                </div>
                <div class="col-md-12 col-sm-4">
                  <h6>
                    <ion-icon name="checkmark-outline"></ion-icon>
                     Estética Dental & Diseño de Sonrisa
                  </h6>
                </div>
                <div class="col-md-12 col-sm-4">
                  <h6>
                    <ion-icon name="checkmark-outline"></ion-icon>
                    Implantología
                  </h6>
                </div>
                <div class="col-md-12 col-sm-4">
                  <h6>
                    <ion-icon name="checkmark-outline"></ion-icon>
                     Ortodoncia, cirugía, rehabilitación oral
                  </h6>
                </div>
            </div>
            <br/>
            <div class="col-lg-12">
            <!-- small box -->
              <div class="card-header small-box col-lg-12">
                  <h5 class="text-bold text-primary">
                    Staff médico
                  </h5>
              </div>
              <br/>
              <div class="row">
                <div class="col-lg-4">
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="../images/doctora2.png"
                             alt="User profile picture">
                      </div>
                      <h3 class="profile-username text-center">
                        Maritza Alcedo
                      </h3>
                      <p class="text-muted text-center">
                        Estética Dental</p>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-lg-4">
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="../images/userdoctor2.jpg" alt="User profile picture">
                      </div>
                      <h3 class="profile-username text-center">
                        Mario Andretti
                      </h3>
                      <p class="text-muted text-center">
                        Endodoncia</p>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-lg-4">
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="../images/userdoctora2.jpg"
                             alt="User profile picture">
                      </div>
                      <h3 class="profile-username text-center">
                        Alejandra Díaz
                      </h3>
                      <p class="text-muted text-center">
                        Implantología</p>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div><br/>
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
                <div class="login-box">
                  <div class="login-logo">
                    <img src="../images/datamedic.png" class="img img-responsive center-block" width="200">
                
                  </div>
                  <!-- /.login-logo -->
                  <div class="card" style="display:block;" id = "iniciarSesion">
                    <div class="card-body login-card-body">
                      <div class="login-logo">
                        <img src="../images/user.png" class="img img-responsive center-block" width="80">
                    
                      </div>

                      <form id="frmgrabar" class="form-horizontal">
                        <div class="input-group mb-3">
                          <input type="email" class="form-control" id = "txtEmail" name = "txtEmail" placeholder="Email" required="true">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="password" class="form-control" id = "txtClave" name = "txtClave"  placeholder="Password" required="true">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-10">
                            <div class="icheck-primary">
                              <input type="checkbox" id="remember">
                              <label for="remember">
                                Mantener la sesión iniciada
                              </label>
                            </div>
                          </div>
                          <!-- /.col -->
                        </div>
                        <div class="row">
                          <div class="col-10">
                              <small>
                                ¿No tiene una cuenta?<a href="#" onclick="mostrarR()" class="text-primary"> Cree una</a>

                                <!--<button type="button" class="btn btn-default col-lg-2" class="btn btn-default" onclick="mostrarR()" >
                                  Cree una
                                </button>-->
                              </small>
                          </div>
                          <!-- /.col -->
                        </div><br/>
                        <div class="row">
                          <!-- /.col -->
                          <div class="col-12">
                            <button type="submit" class="btn btn-info btn-block btn-info">Iniciar sesión</button>
                          </div>
                          <!-- /.col -->
                        </div>
                      </form>
                      <!--
                      <div class="social-auth-links text-center mb-3">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-block btn-primary">
                          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                        </a>
                      </div>-->
                      <!-- /.social-auth-links -->

                    </div>
                    <!-- /.login-card-body -->
                  </div>





                  <div class="card" style="display:none;" id = "registrarCuenta">
                    <div class="card-body register-card-body">
                      <p class="login-box-msg">Registrar nueva cuenta</p>

                      <form id="frmgrabarUsuario">
                        <div class="input-group mb-3">
                          <input type="text" name="textDNI" id="textDNI" class="form-control" placeholder="DNI">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" name="textNombreCompleto" id="textNombreCompleto" class="form-control" placeholder="Nombre completo">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="email" name="textEmail" id="textEmail" class="form-control" placeholder="Email">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="password" name="textPassword" id="textPassword" class="form-control" placeholder="Password">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <!-- /.col -->
                          <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                          </div>
                          <!-- /.col -->
                        </div>
                      </form><br/>
                      <div class="row">
                        <div class="col-12 text-center">
                          <button type="button" class="btn btn-default col-lg-6" onclick="mostrarI()" ><ion-icon name="arrow-back-outline" size="small"></ion-icon></button> 
                        </div>
                      </div>
                    </div>
                    <!-- /.form-box -->
                  </div><!-- /.card -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once 'pie.view.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include_once './scripts.view.php'; ?>
<script src="js/sesionValidar.js" type="text/javascript"></script>
<script src="js/registrate.usuario.js" type="text/javascript"></script>
<script src="js/index.js" type="text/javascript"></script>
<script src="js/cbCodigo.js" type="text/javascript"></script>
</body>
</html>
