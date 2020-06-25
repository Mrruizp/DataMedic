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
                        <h1>Módulo Cita</h1>
                      </div>
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="menu.principal.view.php">Inicio</a></li>
                          <li class="breadcrumb-item active">Módulo de Cita</li>
                        </ol>
                      </div>
                    </div>
                  </div><!-- /.container-fluid -->
                </section>
                <!-- Main content -->
                <section class="content">
                  <div class="container-fluid">
                      <form id="frmgrabar" class="form-horizontal">
                      <div class="row">
                        <!-- left column -->
                        <div class="col-md-8">
                          <!-- general form elements -->
                          <div class="card card-default">
                            <div class="card-header">
                              <h3 class="card-title">Cita</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            
                              <div class="card-body">

                                <div class="row">
                                  <div class="col-4">
                                        <p>
                                            
                                            DNI del Usuario<input type="text" 
                                                          name="txtDoc_id" 
                                                          id="txtDoc_id" 
                                                          class="form-control input-sm" 
                                                          value="<?php echo $resultado["doc_id"];  ?>"
                                                          readonly ="true">
                                        </p>
                                  </div>
                                  <div class="col-3">
                                        <p>
                                           
                                            Fecha de la Cita<input type="text" 
                                                          name="txtFecha" 
                                                          id="txtFecha" 
                                                          class="form-control input-sm" 
                                                          readonly ="true">
                                        </p>
                                    </div>
                                    <div class="col-1">
                                        <p>
                                           
                                            Hora<input type="text" 
                                                          name="txtHora" 
                                                          id="txtHora" 
                                                          class="form-control input-sm" 
                                                          readonly ="true">
                                        </p>
                                    </div>
                                    <div class="col-1">
                                        <p>
                                           
                                            Horario<input type="text" 
                                                          name="txtHorario" 
                                                          id="txtHorario" 
                                                          class="form-control input-sm" 
                                                          readonly ="true">
                                        </p>
                                    </div>
                                  <div class="col-1">
                                      <p>
                                          <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                         <!-- Código--> <input type="hidden" 
                                                        name="txtCodigo" 
                                                        id="txtCodigo" 
                                                        class="form-control input-sm" 
                                                        readonly="true">
                                      </p>
                                    </div>
                                    <div class="col-1">
                                      <p>
                                          
                                         <!-- Código Horario--><input type="hidden" 
                                                        name="txtHorario_atencion_id" 
                                                        id="txtHorario_atencion_id" 
                                                        class="form-control input-sm" 
                                                        readonly="true">
                                      </p>
                                    </div>
                                    <div class="col-1">
                                      <p>
                                          
                                         <!-- Código Consultorio--><input type="hidden" 
                                                        name="txtCodigoConsultorio" 
                                                        id="txtCodigoConsultorio" 
                                                        class="form-control input-sm" 
                                                        readonly="true">
                                      </p>
                                    </div>
                                    
                                    
                                  </div>
                                  <div class="row">
                                    <div class="col-4">
                                        <p>
                                           
                                            Nombre del Consultorio <select class="form-control" name="cbConsultorio" id="cbConsultorio" readOnly="true">
                                                        </select>
                                              <!--          
                                            <input type="text" 
                                                          name="txtConsultorio" 
                                                          id="txtConsultorio" 
                                                          class="form-control input-sm" 
                                                          readonly ="true">                         
                                               -->
                                        </p>
                                    </div>
                                    <div class="col-5">
                                        <p>
                                           
                                            Doctor <input type="text" 
                                                          name="txtDoctor" 
                                                          id="txtDoctor" 
                                                          class="form-control input-sm" 
                                                          readonly ="true"> 
                                            
                                        </p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="modal-header col-12">
                                        <h5 class="modal-title"><b>Paciente</b></h5>
                                    </div>
                                  </div><br/>
                                  <div class="row">
                                    <div class="col-2">
                                        <p>
                                            
                                            DNI <input type="text" 
                                                          name="txtDoc_id_paciente" 
                                                          id="txtDoc_id_paciente" 
                                                          class="form-control input-sm" maxlength="8"
                                                          onkeypress="ValidaSoloNumeros();">
                                        </p>
                                    </div>
                                    <div class="col-5">
                                        <p>
                                            
                                            Lugar de Nacimiento<input type="text" 
                                                          name="txtCiudad_paciente" 
                                                          id="txtCiudad_paciente" 
                                                          class="form-control input-sm">
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p>
                                            
                                            Estado Civil<select id="estadoCivil_paciente" name="estadoCivil_paciente" class="form-control" required> 
                                                            <option></option>
                                                            <option value="S">Soltero(a)</option>
                                                            <option value="C">Casado(a)</option>
                                                            <option value="V">Viudo(a)</option>
                                                            <option value="D">Divorciado(a)</option>
                                                        </select>
                                        </p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-2">
                                        <p>
                                            Edad
                                            <select id="edad_paciente" name="edad_paciente" class="form-control" required> 
                                                <option>-</option>
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
                                                <option value="32">32</option>
                                                <option value="33">33</option>
                                                <option value="34">34</option>
                                                <option value="35">35</option>
                                                <option value="36">36</option>
                                                <option value="37">37</option>
                                                <option value="38">38</option>
                                                <option value="39">39</option>
                                                <option value="40">40</option>
                                                <option value="41">41</option>
                                                <option value="42">42</option>
                                                <option value="43">43</option>
                                                <option value="44">44</option>
                                                <option value="45">45</option>
                                                <option value="46">46</option>
                                                <option value="47">47</option>
                                                <option value="48">48</option>
                                                <option value="49">49</option>
                                                <option value="50">50</option>
                                                <option value="51">51</option>
                                                <option value="52">52</option>
                                                <option value="53">53</option>
                                                <option value="54">54</option>
                                                <option value="55">55</option>
                                                <option value="56">56</option>
                                                <option value="57">57</option>
                                                <option value="58">58</option>
                                                <option value="59">59</option>
                                                <option value="60">60</option>
                                                <option value="61">61</option>
                                                <option value="62">62</option>
                                                <option value="63">63</option>
                                                <option value="64">64</option>
                                                <option value="65">65</option>
                                                <option value="66">66</option>
                                                <option value="67">67</option>
                                                <option value="68">68</option>
                                                <option value="69">69</option>
                                                <option value="70">70</option>
                                                <option value="71">71</option>
                                                <option value="72">72</option>
                                                <option value="73">73</option>
                                                <option value="74">74</option>
                                                <option value="75">75</option>
                                                <option value="76">76</option>
                                                <option value="77">77</option>
                                                <option value="78">78</option>
                                                <option value="79">78</option>
                                                <option value="80">80</option>
                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-5">
                                        <p>
                                            
                                            Nombres<input type="text" 
                                                          name="txtNombre_paciente" 
                                                          id="txtNombre_paciente" 
                                                          class="form-control input-sm">
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p>
                                            
                                            Apellidos<input type="text" 
                                                          name="txtApellidos_paciente" 
                                                          id="txtApellidos_paciente" 
                                                          class="form-control input-sm">
                                        </p>
                                    </div>

                                  </div>
                                  <div class="row">
                                    
                                    <div class="col-2">
                                        <p>
                                            Sexo
                                            <select id="sexo_paciente" name="sexo_paciente" class="form-control" required> 
                                                <option>-</option>
                                                <option value="H">Hombre</option>
                                                <option value="M">Mujer</option>
                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-5">
                                        <p>
                                            
                                            Ocupacion<input type="text" 
                                                          name="txtOcupacion_paciente" 
                                                          id="txtOcupacion_paciente" 
                                                          class="form-control input-sm">
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p>
                                            
                                            Religion<input type="text" 
                                                          name="txtReligion_paciente" 
                                                          id="txtReligion_paciente" 
                                                          class="form-control input-sm">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-7">
                                        <p>
                                            
                                            Domicilio<input type="text" 
                                                          name="txtDomicilio_paciente" 
                                                          id="txtDomicilio_paciente" 
                                                          class="form-control input-sm">
                                        </p>
                                  </div>
                                  <div class="col-4">
                                        <p>
                                            
                                            Teléfono<input type="text" 
                                                          name="txtTelefono_paciente" 
                                                          id="txtTelefono_paciente" 
                                                          class="form-control input-sm">
                                        </p>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="modal-header col-12 text-center">
                                        <h5 class="modal-title"><b>Persona Responsable del Paciente</b></h5>
                                    </div>
                                  </div><br/>
                                <div class="row">
                                  <div class="col-7">
                                        <p>
                                            
                                            Nombre Completo<input type="text" 
                                                          name="txtPersonaResponsable_paciente" 
                                                          id="txtPersonaResponsable_paciente" 
                                                          class="form-control input-sm">
                                        </p>
                                  </div>
                                  <div class="col-4">
                                        <p>
                                            
                                            Teléfono<input type="text" 
                                                          name="txtTelefonoResponsable_paciente" 
                                                          id="txtTelefonoResponsable_paciente" 
                                                          class="form-control input-sm">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-11">
                                      <p>
                                          
                                          Mensaje <textarea type="text" 
                                                        name="txtDescripcion" 
                                                        id="txtDescripcion" 
                                                        class="form-control input-sm" rows="4"></textarea>
                                      </p>
                                  </div>
                              </div>
                            </div>
                            <div class="text-center">
                            <button type="submit" class="btn btn-outline-info"><ion-icon name="save-outline"></ion-icon>  Registrar</button>
                          </div><br/>
                          </div>
                            
                      </div>
                    </div>
                  </form>
                </div>
            </div> 
           

            <!-- Control Sidebar -->
            <?php // include_once 'opciones-derecha.view.php'; ?>
            <!-- /.control-sidebar -->
            
            <div class="control-sidebar-bg"></div>
         
        <!-- ./wrapper -->
        <?php include_once 'scripts.view.php'; ?>
        <script src="js/gestionarCita.js" type="text/javascript"></script>
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