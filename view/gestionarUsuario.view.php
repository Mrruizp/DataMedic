<?php
    require_once 'validar.datos.sesion.view.php';

    //$_POST["s_usuario"] = $dniSesion;
    
   // require_once '../controller/perfil.usuario.leer.datos.controller.php';
    
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="../images/datamedic.png">
        <title> Sistema Dental | Usuario</title>
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
  <?php include_once 'menu-izquierda.admin.view.php';?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1>Módulo Usuario</h1>
                      </div>
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="menu.principal.view.php">Inicio</a></li>
                          <li class="breadcrumb-item active">Módulo de Usuario</li>
                        </ol>
                      </div>
                    </div>
                  </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <!-- left column -->
                      <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-default">
                          <div class="card-header">
                            <h3 class="card-title">Usuario</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          
                            <div class="card-body">
                              <div class="form-group">
                           
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><ion-icon name="calendar-outline"></ion-icon> Agregar Usuario</button>
                          
                              </div>
                              <div class="form-group">
                               <div id="listado" class="table table-responsive"></div>
                                
                              </div>
                            </div>
                         
                        </div>
                        <!-- /.card -->
                            </div>
                        </div>
                    <!-- INICIO del formulario modal -->
                    
                        <form id="frmgrabar" class="form-horizontal">
                            <div class="modal fade" id="myModal">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header bg-info">
                                    <h4 class="modal-title">Registrar Usuario</h4>
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
                                    <div class="col-3">
                                        <p>
                                            
                                            DNI <input type="text" 
                                                          name="txtDoc_identidad" 
                                                          id="txtDoc_identidad" 
                                                          class="form-control input-sm" required
                                                          maxlength="8" onkeypress="ValidaSoloNumeros();">
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <p>
                                           
                                            Cargo <select id="cargo" name="cargo" class="form-control input-sm" required> 
                                                    <option></option>
                                                    <option value="1">Gerente</option>
                                                    <option value="2">Doctor</option>
                                                    <option value="3">Cliente</option>
                                                </select>
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <p>
                                          
                                            Rol  <select class="form-control" name="tipo" id="tipo">
                                                            <option></option>
                                                            <option value="A">Admin</option>
                                                            <option value="D">Doctor</option>
                                                            <option value="C">Cliente</option>
                                                        </select>
                                        </p>
                                    </div>
                                  </div> 
                                  <div class="row">
                                    <div class="col-6">
                                                    <p>
                                                        Nombres completo
                                                        <input type="text" 
                                                          name="txtNombre" 
                                                          id="txtNombre" 
                                                          class="form-control input-sm" required>
                                                    </p>
                                    </div>
                                    <div class="col-6">
                                                    <p>
                                                        Dirección
                                                        <input type="text" 
                                                          name="txtDireccion" 
                                                          id="txtDireccion" 
                                                          class="form-control input-sm" required>
                                                    </p>
                                    </div>
                                  </div> 
                                  <div class="row">
                                    <div class="col-6">
                                                    <p>
                                                        Email 
                                                        <input type="email" id="txtEmail" class="form-control input-sm" name="txtEmail" required onChange="javascript:document.getElementById('cuenta').value = this.value;">
                                                    </p>
                                    </div>
                                    <div class="col-3">
                                                    <p>
                                                        Teléfono
                                                        <input type="text" style="font-weight:normal;" id="txtTelefono" class="form-control input-sm" name="txtTelefono" required maxlength="20" onkeypress="ValidaSoloNumeros();">
                                                    </p>
                                    </div>
                                    <div class="col-3">
                                                    <p>
                                                        Estado (*)
                                                        <select id="estado" name="estado" class="form-control" required> 
                                                            <option></option>
                                                            <option value="A">Habilitado</option>
                                                            <option value="I">Deshabilitado</option>
                                                        </select>
                                                    </p>
                                                </div>     
                                  </div>
                                 
                                        <div class="row">
                                            <div class="col-6">
                                                <p>
                                                    <b>Usuario (*)</b>
                                                    <input type="text" name="cuenta" class="form-control input-sm" id="cuenta" readonly="">
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p>
                                                    <b>Contraseña (*)</b>
                                                    <input type="text" name="contrasenia" class="form-control input-sm" id="contrasenia" required>
                                                </p>
                                            </div>
                                        </div>                                               
                                  
                                   </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar">Close</button>
                                        <button type="submit" class="btn btn-outline-info"><ion-icon name="save-outline"></ion-icon>  Registrar</button>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </form>
                       
                        <small>
                        <form role="form" enctype="multipart/form-data" action="../controller/usuario.actualizar.foto.datos.controller.php" method="post">
                        <div class="box-body col-md-offset-1">
                            <div class="modal fade" id="myModalFoto" name="myModalFoto" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="titulomodal">Subir Foto</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <p>
                                                        Documento (*) <input type="text" class="form-control has-feedback-left" style="font-weight:normal;"
                                                                       id="txtDocID" name="txtDocID" 
                                                                       required="" autofocus="" 
                                                                       maxlength="8" readonly="true"
                                                                       onkeypress="ValidaSoloNumeros();">
                                                    </p>
                                                </div>
                                            </div><br/><br/><br/><br/>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-offset-3">
                                                    <section id="file-preview-zone" name="file-preview-zone"
                                                    class="card-body d-flex justify-content-between align-items-center thumbnail">

                                                            
                                                       
                                                    

                                                    </section>  
                                                </div>   
                                            </div>   
                                            <div class="row">
                                                <div class="col-xs-8 col-md-offset-2">
                                                    <div id="foto_id" name="foto_id"
                                                    class="card-body d-flex justify-content-between align-items-center input-group">
                                                        <label class="input-group-btn">
                                                            <span class="btn btn-info">
                                                               <i class="fa fa-camera"></i><input type="file" style="display: none;" multiple accept="image/png,image/jpeg" id="file-upload" name="file-upload">
                                                            </span>
                                                        </label>
                                                        <input type="text" id="p_foto" name="p_foto" class="form-control" readonly>
                                                    </div>
                                                    <span class="help-block">
                                                    Seleccione una foto 
                                                </span>
                                                </div>
                                                
                                            </div>
                                       
                                    
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" aria-hidden="true"><i class="fa fa-save"></i> Guardar Foto</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar"><i class="fa fa-close"></i> Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          </div>
                        </form>
                    </small>
                   
                 </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php include_once 'pie.view.php'; ?>

            <!-- Control Sidebar -->
            <?php include_once 'opciones-derecha.view.php'; ?>
            <!-- /.control-sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php include_once 'scripts.view.php'; ?>
        
        <script src="js/gestionarUsuario.js" type="text/javascript"></script>

        <?php include_once 'scripts.view.php'; ?>

        <script>
            $(function() {

          // We can attach the `fileselect` event to all file inputs on the page
          $(document).on('change', ':file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
          });

          // We can watch for our custom `fileselect` event like this
          $(document).ready( function() {
              $(':file').on('fileselect', function(event, numFiles, label) {

                  var input = $(this).parents('.input-group').find(':text'),
                      log = numFiles > 1 ? numFiles + ' files selected' : label;

                  if( input.length ) {
                      input.val(log);
                  } else {
                      if( log ) alert(log);
                  }

              });
          });

        });
        </script>  
        <script>
            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
         
                    reader.onload = function (e) {
                        var filePreview = document.createElement('img');
                        filePreview.id = 'file-preview';
                        //e.target.result contents the base64 data from the image uploaded
                        filePreview.src = e.target.result;
                        console.log(e.target.result);
         
                        var previewZone = document.getElementById('file-preview-zone');
                        previewZone.appendChild(filePreview);
                    }
         
                    reader.readAsDataURL(input.files[0]);
                }
            }
         
            var fileUpload = document.getElementById('file-upload');
            fileUpload.onchange = function (e) {
                readFile(e.srcElement);
            }
         
        </script>  
    </body>
</html>