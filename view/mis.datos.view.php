<?php
    require_once 'validar.datos.sesion.view.php';
?>
<?php

    //Creando y asignando un valor a la variable $_POST["dniUsuarioSesion"];
    $_POST["s_email"] = $email;
    
    require_once '../controller/perfil.usuario.leer.datos.controller.php';
    
    
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>La Chuspita</title>
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
      <header class="section page-header">
        <?php include_once './menu-arriba.admin.view.php'; ?>
      </header>
      <div class="page">
      <!-- Page Header-->
        <!-- Why choose us-->
      <section class="section section-xs section-first bg-default"><!-- section section-md section-first bg-default-->
        <div class="container">
          <div class="row row-90 justify-content-center">
            <!--<div class="col-md-10 col-lg-5 col-xl-6"><img src="images/about-1-519x446.jpg" alt="" width="519" height="446"/>
            </div>-->
            <div class="col-md-12 col-lg-12 col-xl-12">
              <h3 style="color: #ff4a4a">¡Hola!</h3>
              <p>Bienvenido a tu cuenta, aquí podrás administrar todos los datos necesarios para comprar en 
                <a href="menu-arriba.admin.view.php" style="color: #ff4a4a">lachuspita.pe
                </a>
              </p>
              <!-- Bootstrap tabs-->
              <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-4">
                <!-- Nav tabs-->
                <ul class="nav nav-tabs">
                  <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-4-1" data-toggle="tab">Mis datos</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-4-2" data-toggle="tab">Mis compras</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-4-3" data-toggle="tab">Mis listas</a></li>
                </ul>
                <!-- Tab panes-->
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="tabs-4-1">
                    <section class=""> <!-- section section-md section-first bg-default text-md-left: alinear las letras -->
                      <form class="rd-form rd-mailform">
                      <div class="container">
                        <div class="row row-50 justify-content-center">
                          <div class="col-md-10 col-lg-6">
                            <h4 class="text-spacing-50">Datos Personales</h4>
                            
                              <div class="row row-14 gutters-14">
                                <div class="col-sm-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="checkout-first-name-1" type="text" name="name" data-constraints="@Required"/>
                                    <label class="form-label" for="checkout-first-name-1">Nombres</label>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="checkout-last-name-1" type="text" name="name" data-constraints="@Required"/>
                                    <label class="form-label" for="checkout-last-name-1">Apellidos</label>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <select class="form-input select-filter" data-minimum-results-for-search="Infinity" data-constraints="@Required">
                                      <option>Tipo de documento</option>
                                      <option value="1">DNI</option>
                                      <option value="2">Pasaporte</option>
                                      <option value="3">Carné de Extranjería</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="checkout-address-1" type="text" name="name" data-constraints="@Required" maxlength="11"
                                    onkeypress="ValidaSoloNumeros();"/>
                                    <label class="form-label" for="checkout-address-1">Número de documento</label>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="checkout-address-1" type="text" name="name" data-constraints="@Required" maxlength="9"
                                    onkeypress="ValidaSoloNumeros();"/>
                                    <label class="form-label" for="checkout-address-1">Teléfono fijo</label>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="checkout-address-1" type="text" name="name" data-constraints="@Required" maxlength="9"
                                      onkeypress="ValidaSoloNumeros();"/>
                                    <label class="form-label" for="checkout-address-1">Teléfono celular</label>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="textFecNac" type="text" name="textFecNac" data-constraints="@Required"/>
                                    <label class="form-label" for="textFecNac">Fecha de nacimiento: día/mes/año</label>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="textCorreo" type="text" name="textCorreo" data-constraints="@Required"/>
                                    <label class="form-label" for="textCorreo">Correo</label>
                                  </div>
                                </div>
                                <!--<div class="col-sm-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="textAlias" type="text" name="textAlias" data-constraints="@Required"/>
                                    <label class="form-label" for="textAlias">Alias</label>
                                  </div>
                                </div> -->
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <select class="form-input select-filter" id="cbDepartamento" name="cbDepartamento" data-constraints="@Required" 
                                    onchange="cargarCbCodigoProvinciaDepartamento('#cbProvincia',this.value,'seleccione')">
                                      <option>Departamento</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <select class="form-input" id="cbProvincia" name="cbProvincia" data-constraints="@Required"
                                    onchange="cargarCbCodigoDistritoProvincia('#cbDistrito',this.value,'seleccione')">
                                      <option>Provincia</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <select class="form-input select-filter" id="cbDistrito" name="cbDistrito" data-constraints="@Required">
                                      <option>Distrito</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="textDireccion" type="text" name="textDireccion" data-constraints="@Required"/>
                                    <label class="form-label" for="textDireccion">Dirección</label>
                                  </div>
                                </div>                                
                                
                              </div>
                              <!--<label class="checkbox-inline">
                                <input name="input-checkbox-1" value="checkbox-1" type="checkbox"/>My Billing Address and Shipping Address are the same
                              </label> -->
                            
                          </div>
                          <div class="col-md-10 col-lg-6">
                            <h4 class="text-spacing-50">Datos Empresa</h4>
                            
                              <div class="row row-14 gutters-14">
                                <div class="col-sm-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="textRazonSocial" type="text" name="textRazonSocial" data-constraints="@Required"/>
                                    <label class="form-label" for="textRazonSocial">Razón social</label>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="textRuc" type="text" name="textRuc" data-constraints="@Required" maxlength="11"
                                    onkeypress="ValidaSoloNumeros();"/>
                                    <label class="form-label" for="textRuc">RUC</label>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <select class="form-input select-filter" id="cbDepartamentoEmp" name="cbDepartamentoEmp" data-constraints="@Required"
                                    onchange="cargarCbCodigoProvinciaDepartamento('#cbProvinciaEmp',this.value,'seleccione')">
                                      <option>Departamento</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <select class="form-input select-filter" id="cbProvinciaEmp" name="cbProvinciaEmp" data-constraints="@Required"
                                    onchange="cargarCbCodigoDistritoProvincia('#cbDistritoEmp',this.value,'seleccione')">
                                      <option>Provincia</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <select class="form-input select-filter" id="cbDistritoEmp" name="cbDistritoEmp" data-minimum-results-for-search="Infinity" data-constraints="@Required">
                                      <option>Distrito</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="textDireccion" type="text" name="textDireccion" data-constraints="@Required"/>
                                    <label class="form-label" for="textDireccion">Dirección</label>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="textTelFijo" type="text" name="textTelFijo" data-constraints="@Required" maxlength="9"
                                    onkeypress="ValidaSoloNumeros();"/>
                                    <label class="form-label" for="textTelFijo">Teléfono fijo</label>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-wrap">
                                    <input class="form-input" id="textTelCelular" type="text" name="textTelCelular" data-constraints="@Required" maxlength="9"
                                   onkeypress="ValidaSoloNumeros();"/>
                                    <label class="form-label" for="textTelCelular">Teléfono celular</label>
                                  </div>
                                </div>
                                <div class="col-12">
                                  <div class="form-wrap">
                                    <div class="group-md group-middle">
                                      <button class="button button-primary button-lg button-block button-pipaluk" type="submit">GUARDAR</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>
                  <div class="tab-pane fade" id="tabs-4-2">
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="text-center text-sm-left offset-top-30">
                      <ul class="row-16 list-0 list-custom list-marked list-marked-sm list-marked-secondary">
                        <li>Nostrud exercitation</li>
                        <li>Laboris nisi</li>
                        <li>Officia deserunt</li>
                        <li>Eiusmod tempor</li>
                        <li>Dolore magna</li>
                        <li>Minim veniam</li>
                      </ul>
                    </div>
                    <div class="group-md group-middle"><a class="button button-width-xl-230 button-primary button-pipaluk" href="#">Read more</a><a class="button button-width-xl-310 button-default-outline button-wapasha" href="contact-us.html">Contact us</a></div>
                  </div>
                  <div class="tab-pane fade" id="tabs-4-3">
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <div class="text-center text-sm-left offset-top-30">
                      <ul class="row-16 list-0 list-custom list-marked list-marked-sm list-marked-secondary">
                        <li>Minim veniam</li>
                        <li>Nostrud exercitation</li>
                        <li>Eiusmod tempor</li>
                        <li>Dolore magna</li>
                        <li>Laboris nisi</li>
                        <li>Officia deserunt</li>
                      </ul>
                    </div>
                    <div class="group-md group-middle"><a class="button button-width-xl-230 button-primary button-pipaluk" href="#">Read more</a><a class="button button-width-xl-310 button-default-outline button-wapasha" href="contact-us.html">Contact us</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div><br/>




      <!-- Page Footer-->
      <footer class="section footer-variant-2 footer-modern context-dark section-top-image section-top-image-dark">
        <div class="footer-variant-2-content">
          <div class="container">
            <div class="row row-40 justify-content-between">
              <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="oh-desktop">
                  <div class="wow slideInRight" data-wow-delay="0s">
                    <div class="footer-brand"><a href="index.html"><img src="../util/images/Chuspita-logo.jpg" alt="" width="154" height="42"/></a></div>
                    <p>Herber is an organic farm located in California. We offer healthy foods and products to our clients.</p>
                    <ul class="footer-contacts d-inline-block d-md-block">
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-phone"></span></div>
                          <div class="unit-body"><a class="link-phone" href="tel:#">+1 323-913-4688</a></div>
                        </div>
                      </li>
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-clock-o"></span></div>
                          <div class="unit-body">
                            <p>Mon-Sat: 07:00AM - 05:00PM</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-location-arrow"></span></div>
                          <div class="unit-body"><a class="link-location" href="#">4730 Crystal Springs Dr, Los Angeles, CA 90027</a></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4 col-xl-4">
                <div class="oh-desktop">
                  <div class="inset-top-18 wow slideInDown" data-wow-delay="0s">
                    <h5>Newsletter</h5>
                    <p>Join our email newsletter for news and tips.</p>
                    <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                      <div class="form-wrap">
                        <input class="form-input" id="subscribe-form-5-email" type="email" name="email" data-constraints="@Email @Required">
                        <label class="form-label" for="subscribe-form-5-email">Enter Your E-mail</label>
                      </div>
                      <button class="button button-block button-white" type="submit">Subscribe</button>
                    </form>
                    <div class="group-lg group-middle">
                      <p class="text-white">Follow Us</p>
                      <div>
                        <ul class="list-inline list-inline-sm footer-social-list-2">
                          <li><a class="icon fa fa-facebook" href="#"></a></li>
                          <li><a class="icon fa fa-twitter" href="#"></a></li>
                          <li><a class="icon fa fa-google-plus" href="#"></a></li>
                          <li><a class="icon fa fa-instagram" href="#"></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-xl-3">
                <div class="oh-desktop">
                  <div class="inset-top-18 wow slideInLeft" data-wow-delay="0s">
                    <h5>Gallery</h5>
                    <div class="row row-10 gutters-10">
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="../util/images/gallery-image-1-129x120.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="../util/images/gallery-original-7-800x1200.jpg" data-lightgallery="item"><img src="../util/images/gallery-image-1-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="../util/images/gallery-image-2-129x120.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="../util/images/gallery-original-8-1200x800.jpg" data-lightgallery="item"><img src="../util/images/gallery-image-2-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="../util/images/gallery-image-3-129x120.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="../util/images/gallery-original-9-800x1200.jpg" data-lightgallery="item"><img src="../util/images/gallery-image-3-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="../util/images/gallery-image-4-129x120.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="../util/images/gallery-original-10-1200x800.jpg" data-lightgallery="item"><img src="../util/images/gallery-image-4-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-variant-2-bottom-panel">
          <div class="container">
            <!-- Rights-->
            <div class="group-sm group-sm-justify">
              <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span> <span>La Chuspita</span>. All rights reserved
              </p>
              <p class="rights"><a href="privacy-policy.html">Privacy Policy</a></p>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    <?php include_once 'scripts.view.php'; ?>
    <script src="js/mis.datos.js" type="text/javascript"></script>
    <script src="js/cbCodigo.js" type="text/javascript"></script>
  </body>
</html>