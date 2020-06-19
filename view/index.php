<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Medic</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include_once 'estilos.view.php'; ?>
</head>

<body class="hold-transition register-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="">
      <div class="login-logo">
          <img src="../images/datamedic.png" class="img img-responsive center-block" width="200"><br/>
          <img src="../images/user3.jpg" class="img img-responsive center-block" width="150">
      </div>
        <div class="card-body login-card-body" style="display:block;" id = "iniciarSesion">
          <div class="card-body login-card-body">

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
                  <div class="icheck-info">
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
                      ¿No tiene una cuenta?<a href="#" onclick="mostrarR()" class="text-primary"> Regístrate</a>

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
          </div>
        </div>
        <div class="" style="display:none;" id = "registrarCuenta">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Registrar nueva cuenta</p>

          <form id="frmgrabarUsuario">
            <div class="input-group mb-3">
              <input type="text" name="textDNI" id="textDNI" class="form-control" placeholder="DNI" required="" maxlength="8"
                     onkeypress="ValidaSoloNumeros();">
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
              <input type="password" name="textPassword" id="textPassword" class="form-control" placeholder="Contraseña">
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
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  

<!-- ./wrapper -->
<?php include_once 'scripts.view.php'; ?>
<script src="js/sesionValidar.js" type="text/javascript"></script>
<script src="js/registrate.usuario.js" type="text/javascript"></script>
<script src="js/index.js" type="text/javascript"></script>
<script src="js/cbCodigo.js" type="text/javascript"></script>
</body>
</html>
