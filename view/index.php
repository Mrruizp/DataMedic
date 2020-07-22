<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>Login</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <?php include_once 'estilos.view.php'; ?>
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container"><span></span><span></span><span></span><span></span>
        </div>
      </div>
    </div>
    <div class="page">
      <!-- Page Header-->
      
     
      <!-- Shop-->
      <section class="section section-md bg-default">
        <div class="container">
          <div class="row row-90 justify-content-center">
            
            <div class="col-md-6 col-lg-5 col-xl-4"  style="display:block;" id = "iniciarSesion">
              <div class="box-pricing box-pricing-popular">
                <form id = "frmgrabar" class="rd-form rd-mailform"> <!-- rd-form rd-mailform: le da la ubicación de los textos -->
                <div class="box-pricing-body">
                  <div class="box-pricing-caption">
                    <h5 class="box-pricing-title">Iniciar Sesión</h5>
                    <div class="box-pricing-time">
                      <img src="../util/images/Chuspita-logo.jpg"/>
                    </div>
                    <h8>Ingresa con tu e-mail y contraseña</h8>
                  </div>
                  <!--<div class="divider divider-35"></div> -->
                  
                    <div class="">E-mail
                      <div class="form-wrap">
                        <input class="form-input" id="txtEmail" type="email" name="txtEmail" data-constraints="@Email @Required" autocomplete="off">
                        <label class="form-label" for="txtEmail">Ej: jose@hotmail.com</label>
                      </div>
                    </div>
                    <div class="">Contraseña
                      <div class="form-wrap">
                        <input type="password" class="form-input" id="txtClave" name="txtClave" required>
                        <label class="form-label" for="txtClave"></label>
                      </div>
                    </div>
                    <div class="">
                      <div class="form-wrap">
                        
                          ¿No tiene una cuenta?
                          <a href="#" onclick="mostrarR()"> 
                            <b>Regístrate</b>
                          </a>

                        
                      </div>
                    </div>
                    <div class="">
                      <div class="form-wrap">
                        <p class="text-primary">
                          
                          <a href="#" onclick="mostrarR()">
                            Opciones de inicio de sesión
                          </a>

                        </p>
                      </div>
                    </div>
                    
                  </div>
                  <div class="box-pricing-button"><button class="button button-primary button-lg button-block button-pipaluk" type="submit">INGRESAR</button></div><br/>
                  </form>
              </div>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4"  style="display:none;" id = "registrarCuenta">
              <div class="box-pricing box-pricing-popular">
                <div class="box-pricing-body">
                  <div class="box-pricing-caption">
                    <h5 class="box-pricing-title">Iniciar Sesión</h5>
                    <div class="box-pricing-time">
                      <img src="../util/images/Chuspita-logo.jpg"/>
                    </div>
                    <h8>Registra tu correo y tu contraseña</h8>
                  </div>
                  <!--<div class="divider divider-35"></div> -->
                  <form id = "frmgrabarUsuario" class="rd-form rd-mailform"> <!-- rd-form rd-mailform: le da la ubicación de los textos -->
                    <div class="">E-mail
                      <div class="form-wrap">
                        <input class="form-input" id="textEmailR" type="email" name="textEmailR" data-constraints="@textEmailR @Required" autocomplete="off">
                        <label class="form-label" for="textEmailR">Ej: jose@hotmail.com</label>
                      </div>
                    </div>
                    <div class="">Contraseña
                      <div class="form-wrap">
                        <input type="password" class="form-input" id="textPassword1" name="textPassword1" required>
                      </div>
                    </div>
                    <div class="">Repita contraseña
                      <div class="form-wrap">
                        <input type="password" class="form-input" id="textPassword2" name="textPassword2" required>
                      </div>
                    </div>
                    </form>
                  </div>
                  <div class="box-pricing-button"><button id = "clicButton" class="button button-primary button-lg button-block button-pipaluk" type="submit" onClick="comprobarClave()">REGISTRAR</button></div>
                  <div class="box-pricing-button"><span class="icon fa fa-mail-reply  link-primary" onclick="mostrarI()"></span></div><br/>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    
    <?php include_once 'scripts.view.php'; ?>
    <script src="js/sesionValidar.js" type="text/javascript"></script>
    <script src="js/registrate.usuario.js" type="text/javascript"></script>
    <script type="text/javascript">

     function comprobarClave(){
          clave1 = $("#textPassword1").val();
          clave2 = $("#textPassword2").val();

          if ( clave1 === clave2)
              claveEstado = 0;
          else
              claveEstado = 1;
      /*
          if ( clave1 !== clave2)
             alertify.error("<p class = 'text-white'>Las contraseñas no son iguales</p>")
          else
            exit();
          */
          switch(claveEstado)
          {
            case 0:
                    $("#frmgrabarUsuario").submit();
                    break;
            case 1:
                    alertify.error("<p class = 'text-white'>Las contraseñas no son iguales</p>");
                    break;
          }
             
      }
    </script>
  </body>
</html>