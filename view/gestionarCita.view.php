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
                    <div class="row">
                      <!-- left column -->
                      <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-default">
                          <div class="card-header">
                            <h3 class="card-title">Cita</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          
                            <div class="card-body">
                              <div class="form-group">
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#myModal" id="btnagregar"><ion-icon name="calendar-outline"></ion-icon> Agregar cita</button>
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
                        <h4 class="modal-title">Registrar Cita</h4>
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
                                    
                                    DNI del Usuario<input type="text" 
                                                  name="txtDoc_id" 
                                                  id="txtDoc_id" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                            <div class="col-3">
                                <p>
                                   
                                    Fecha <select class="form-control" name="txtFecha" id="txtFecha">
                                          </select>
                                </p>
                            </div>
                            <div class="col-3">
                                <p>
                                  
                                    Hora <select class="form-control" name="txtHora" id="txtHora">
                                          </select>
                                </p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-6">
                                <p>
                                   
                                    Especialidad <select class="form-control" name="especialidad" id="especialidad" 
                                    onchange="cargarCbCodigoDoctor('#doctor',this.value,'seleccione')">
                                              
                                                 </select>
                     
                 
                                </p>
                            </div>
                            <div class="col-6">
                                <p>
                                   
                                    Doctor <select class="form-control" name="doctor" id="doctor">
                                            
                                           </select>
                                </p>
                            </div>
                            
                          </div>
                          <div class="row">
                            <div class="modal-header col-12">
                                <h5 class="modal-title"><b>Paciente</b></h5>
                            </div>
                          </div><br/>
                          <div class="row">
                            <div class="col-3">
                                <p>
                                    
                                    DNI <input type="text" 
                                                  name="txtDoc_id_paciente" 
                                                  id="txtDoc_id_paciente" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                            <div class="col-5">
                                <p>
                                    
                                    Lugar de nacimiento<input type="text" 
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
                            <div class="col-3">
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
                            
                            <div class="col-3">
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
                          <div class="col-8">
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
                          <div class="col-8">
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
                          <div class="col-12">
                              <p>
                                  
                                  Mensaje <textarea type="text" 
                                                name="txtDescripcion" 
                                                id="txtDescripcion" 
                                                class="form-control input-sm" rows="2"></textarea>
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
              <form id="frmgrabar" class="form-horizontal">
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
                            <div class="col-3">
                                <p>
                                    
                                    DNI <input type="text" 
                                                  name="txtDoc_id_paciente1" 
                                                  id="txtDoc_id_paciente1" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                            <div class="col-5">
                                <p>
                                    
                                    Lugar de nacimiento<input type="text" 
                                                  name="txtCiudad_paciente1" 
                                                  id="txtCiudad_paciente1" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    
                                    Estado Civil<select id="estadoCivil_paciente1" name="estadoCivil_paciente1" class="form-control" required> 
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
                            <div class="col-3">
                                <p>
                                    Edad
                                    <select id="edad_paciente1" name="edad_paciente1" class="form-control" required> 
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
                                                  name="txtNombre_paciente1" 
                                                  id="txtNombre_paciente1" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    
                                    Apellidos<input type="text" 
                                                  name="txtApellidos_paciente1" 
                                                  id="txtApellidos_paciente1" 
                                                  class="form-control input-sm">
                                </p>
                            </div>

                          </div>
                          <div class="row">
                            
                            <div class="col-3">
                                <p>
                                    Sexo
                                    <select id="sexo_paciente1" name="sexo_paciente1" class="form-control" required> 
                                        <option>-</option>
                                        <option value="H">Hombre</option>
                                        <option value="M">Mujer</option>
                                    </select>
                                </p>
                            </div>
                            <div class="col-5">
                                <p>
                                    
                                    Ocupacion<input type="text" 
                                                  name="txtOcupacion_paciente1" 
                                                  id="txtOcupacion_paciente1" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    
                                    Religion<input type="text" 
                                                  name="txtReligion_paciente1" 
                                                  id="txtReligion_paciente1" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-8">
                                <p>
                                    
                                    Domicilio<input type="text" 
                                                  name="txtDomicilio_paciente1" 
                                                  id="txtDomicilio_paciente1" 
                                                  class="form-control input-sm">
                                </p>
                          </div>
                          <div class="col-4">
                                <p>
                                    
                                    Teléfono<input type="text" 
                                                  name="txtTelefono_paciente1" 
                                                  id="txtTelefono_paciente1" 
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
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </form>

              <form id="frmgrabarTratamientoPaciente" class="form-horizontal">
                <div class="modal fade" id="myModalTratamientoPaciente">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-info">
                        <h4 class="modal-title" id="titulomodalTratamientoPaciente">Confirmar Cita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        
                        <div class="row">
                          <div class="col-2">
                                <p>
                                    <!--Código del paciente -->
                                    Códgo cita<input type="text" 
                                                  name="txtCod_citaTratamiento" 
                                                  id="txtCod_citaTratamiento" 
                                                  class="form-control input-sm" readonly="true">
                                </p>
                            </div>
                            <div class="col-2">
                                <p>
                                    <!--Código del paciente -->
                                    Códgo paciente<input type="text" 
                                                  name="txtCod_paciente" 
                                                  id="txtCod_paciente" 
                                                  class="form-control input-sm" readonly="true">
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    <!--Código del paciente -->
                                    Fecha<input type="text" 
                                                placeholder="ejemplo: Lunes 25 de Mayo" 
                                                  name="txtFechaTratamiento" 
                                                  id="txtFechaTratamiento" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    <!--Código del paciente -->
                                    Hora<input type="text"
                                                placeholder="ejemplo: 9:00"  
                                                  name="txtHoraTratamiento" 
                                                  id="txtHoraTratamiento" 
                                                  class="form-control input-sm">
                                </p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-8">
                                <p>
                                   
                                    Tratamiento <select class="form-control" name="comboTratamiento" id="comboTratamiento">
                                                </select>
                     
                 
                                </p>
                            </div>
                            
                          </div>
                          <div class="row">
                          <div class="col-12">
                              <p>
                                  
                                  Descripción <textarea type="text" 
                                                placeholder="ejemeplo: recetas, procedimientos análisis, etc." 
                                                name="txtDescripcionTratamientoPaciente" 
                                                id="txtDescripcionTratamientoPaciente" 
                                                class="form-control input-sm" rows="15"></textarea>
                              </p>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrarEstado">Close</button>
                        <button type="submit" class="btn btn-outline-info"><ion-icon name="save-outline"></ion-icon>  Registrar</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </form>

              <form id="frmgrabarEstado" class="form-horizontal">
                <div class="modal fade" id="myModalEstado">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-info">
                        <h4 class="modal-title" id="titulomodalEstado">Confirmar Cita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        
                        <div class="row">
                          <div class="col-2">
                                <p>
                                    <!--Código del paciente -->
                                    Códgo<input type="text" 
                                                  name="txtCod_citaEstado" 
                                                  id="txtCod_citaEstado" 
                                                  class="form-control input-sm" readonly="true">
                                </p>
                            </div>
                          <div class="col-4">
                              <p>
                                  Estado
                                  <select id="hab_desh_proc" name="hab_desh_proc" class="form-control" required> 
                                      <option>-</option>
                                      <option value="Cita Confirmada">Habilitar</option>
                                      <option value="Cita Denegada">Deshabilitar</option>
                                      <option value="En proceso de confirmación">En proceso</option>
                                  </select>
                              </p>
                          </div>
                        
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrarEstado">Close</button>
                        <button type="submit" class="btn btn-outline-info"><ion-icon name="save-outline"></ion-icon>  Registrar</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </form>
              <?php include_once 'pie.view.php'; ?>
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