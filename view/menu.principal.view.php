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
      <!-- Swiper-->
      <section class="section swiper-container swiper-slider swiper-slider-modern" data-loop="true" data-autoplay="5000" data-simulate-touch="true" data-nav="true" data-slide-effect="fade">
        <div class="swiper-wrapper text-left">
          <div class="swiper-slide context-dark" data-slide-bg="../util/images/slider-1-1920x729.jpg">
            <div class="swiper-slide-caption">
              <div class="container">
                <div class="row justify-content-center justify-content-xxl-start">
                  <div class="col-md-10 col-xxl-6">
                    <div class="slider-modern-box">
                      <h1 class="slider-modern-title"><span data-caption-animate="slideInDown" data-caption-delay="0">Organic Food</span></h1>
                      <p data-caption-animate="fadeInRight" data-caption-delay="400">Herber provides local citizens and guests of our town with quality organic fruits, vegetables, and other products.</p>
                      <div class="oh button-wrap"><a class="button button-primary button-ujarak" href="about-us.html" data-caption-animate="slideInLeft" data-caption-delay="400">Read more</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide context-dark" data-slide-bg="../util/images/slider-2-1920x729.jpg">
            <div class="swiper-slide-caption">
              <div class="container">
                <div class="row justify-content-center justify-content-xxl-start">
                  <div class="col-md-10 col-xxl-6">
                    <div class="slider-modern-box">
                      <h1 class="slider-modern-title"><span data-caption-animate="slideInLeft" data-caption-delay="0">Quality Control</span></h1>
                      <p data-caption-animate="fadeInRight" data-caption-delay="400">We control the process of farming at Herber to deliver the best organic products to our customers throughout the state.</p>
                      <div class="oh button-wrap"><a class="button button-primary button-ujarak" href="about-us.html" data-caption-animate="slideInLeft" data-caption-delay="400">Read more</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide" data-slide-bg="../util/images/slider-3-1920x729.jpg">
            <div class="swiper-slide-caption">
              <div class="container">
                <div class="row justify-content-center justify-content-xxl-start">
                  <div class="col-md-10 col-xxl-6">
                    <div class="slider-modern-box">
                      <h1 class="slider-modern-title"><span data-caption-animate="slideInDown" data-caption-delay="0">Eco-Friendly</span></h1>
                      <p data-caption-animate="fadeInRight" data-caption-delay="400">As the leading organic farm, we maintain an eco-friendly policy of growing and selling healthy food without any additives.</p>
                      <div class="oh button-wrap"><a class="button button-primary button-ujarak" href="about-us.html" data-caption-animate="slideInUp" data-caption-delay="400">Read more</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Swiper Navigation-->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <!-- Swiper Pagination-->
        <div class="swiper-pagination swiper-pagination-style-2"></div>
      </section>

      <!-- Icons Ruby-->
      <section class="section section-md bg-default section-top-image">
        <div class="container">
          <div class="row row-30 justify-content-center">
            <div class="col-sm-6 col-lg-4 wow fadeInRight" data-wow-delay="0s">
              <article class="box-icon-ruby">
                <div class="unit box-icon-ruby-body flex-column flex-md-row text-md-left flex-lg-column align-items-center text-lg-center flex-xl-row text-xl-left">
                  <div class="unit-left">
                    <div class="box-icon-ruby-icon linearicons-leaf"></div>
                  </div>
                  <div class="unit-body">
                    <h4 class="box-icon-ruby-title"><a href="single-service.html">Natural &amp; Organic</a></h4>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4 wow fadeInRight" data-wow-delay=".1s">
              <article class="box-icon-ruby">
                <div class="unit box-icon-ruby-body flex-column flex-md-row text-md-left flex-lg-column align-items-center text-lg-center flex-xl-row text-xl-left">
                  <div class="unit-left">
                    <div class="box-icon-ruby-icon linearicons-shovel"></div>
                  </div>
                  <div class="unit-body">
                    <h4 class="box-icon-ruby-title"><a href="single-service.html">Best Equipment</a></h4>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4 wow fadeInRight" data-wow-delay=".2s">
              <article class="box-icon-ruby">
                <div class="unit box-icon-ruby-body flex-column flex-md-row text-md-left flex-lg-column align-items-center text-lg-center flex-xl-row text-xl-left">
                  <div class="unit-left">
                    <div class="box-icon-ruby-icon linearicons-sun"></div>
                  </div>
                  <div class="unit-body">
                    <h4 class="box-icon-ruby-title"><a href="single-service.html">Dedicated Team</a></h4>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>

      <!-- Trending products-->
      <section class="section section-md bg-default">
        <div class="container">
          <div class="row row-40 justify-content-center">
            <div class="col-sm-8 col-md-7 col-lg-6 wow fadeInLeft" data-wow-delay="0s">
              <div class="product-banner"><img src="../util/images/home-banner-1-570x715.jpg" alt="" width="570" height="715"/>
                <div class="product-banner-content">
                  <div class="product-banner-inner" style="background-image: url(../util/images/bg-brush.png)">
                    <h3 class="text-secondary-1">organic</h3>
                    <h2 class="text-primary">Vegetables</h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 col-lg-6">
              <div class="row row-30 justify-content-center">
                <div class="col-sm-6 col-md-12 col-lg-6">
                  <div class="oh-desktop">
                    <!-- Product-->
                    <article class="product product-2 box-ordered-item wow slideInRight" data-wow-delay="0s">
                      <div class="unit flex-row flex-lg-column">
                        <div class="unit-left">
                          <div class="product-figure"><img src="../util/images/product-5-270x280.png" alt="" width="270" height="280"/>
                            <div class="product-button"><a class="button button-md button-white button-ujarak" href="cart-page.html">Add to cart</a></div>
                          </div>
                        </div>
                        <div class="unit-body">
                          <h6 class="product-title"><a href="single-product.html">Avocados</a></h6>
                          <div class="product-price-wrap">
                            <div class="product-price product-price-old">$59.00</div>
                            <div class="product-price">$28.00</div>
                          </div><a class="button button-sm button-secondary button-ujarak" href="cart-page.html">Add to cart</a>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6">
                  <div class="oh-desktop">
                    <!-- Product-->
                    <article class="product product-2 box-ordered-item wow slideInLeft" data-wow-delay="0s">
                      <div class="unit flex-row flex-lg-column">
                        <div class="unit-left">
                          <div class="product-figure"><img src="../util/images/product-6-270x280.png" alt="" width="270" height="280"/>
                            <div class="product-button"><a class="button button-md button-white button-ujarak" href="cart-page.html">Add to cart</a></div>
                          </div>
                        </div>
                        <div class="unit-body">
                          <h6 class="product-title"><a href="single-product.html">Corn</a></h6>
                          <div class="product-price-wrap">
                            <div class="product-price">$27.00</div>
                          </div><a class="button button-sm button-secondary button-ujarak" href="cart-page.html">Add to cart</a>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6">
                  <div class="oh-desktop">
                    <!-- Product-->
                    <article class="product product-2 box-ordered-item wow slideInLeft" data-wow-delay="0s">
                      <div class="unit flex-row flex-lg-column">
                        <div class="unit-left">
                          <div class="product-figure"><img src="../util/images/product-8-270x280.png" alt="" width="270" height="280"/>
                            <div class="product-button"><a class="button button-md button-white button-ujarak" href="cart-page.html">Add to cart</a></div>
                          </div>
                        </div>
                        <div class="unit-body">
                          <h6 class="product-title"><a href="single-product.html">Artichokes</a></h6>
                          <div class="product-price-wrap">
                            <div class="product-price">$23.00</div>
                          </div><a class="button button-sm button-secondary button-ujarak" href="cart-page.html">Add to cart</a>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6">
                  <div class="oh-desktop">
                    <!-- Product-->
                    <article class="product product-2 box-ordered-item wow slideInRight" data-wow-delay="0s">
                      <div class="unit flex-row flex-lg-column">
                        <div class="unit-left">
                          <div class="product-figure"><img src="../util/images/product-7-270x280.png" alt="" width="270" height="280"/>
                            <div class="product-button"><a class="button button-md button-white button-ujarak" href="cart-page.html">Add to cart</a></div>
                          </div>
                        </div>
                        <div class="unit-body">
                          <h6 class="product-title"><a href="single-product.html">Broccoli</a></h6>
                          <div class="product-price-wrap">
                            <div class="product-price">$25.00</div>
                          </div><a class="button button-sm button-secondary button-ujarak" href="cart-page.html">Add to cart</a>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Section CTA 2-->
      <section class="section text-center">
        <div class="parallax-container" data-parallax-img="../util/images/bg-parallax-1.jpg">
          <div class="parallax-content section-xl section-inset-custom-1 context-dark bg-overlay-40">
            <div class="container">
              <h2 class="oh font-weight-normal"><span class="d-inline-block wow slideInDown" data-wow-delay="0s">Our Approach</span></h2>
              <p class="oh big text-width-large"><span class="d-inline-block wow slideInUp" data-wow-delay=".2s">Our farm strictly combines the traditions of organic farming with the latest innovations to make our products healthy and safe for the clients.</span></p><a class="button button-primary button-icon button-icon-left button-ujarak wow fadeInUp" href="https://www.youtube.com/watch?v=-AhmuMqZB0s" data-lightgallery="item" data-wow-delay=".1s"><span class="icon mdi mdi-play"></span>View presentation</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Trending products-->
      <section class="section section-md bg-default section-top-image">
        <div class="container">
          <div class="row row-40 justify-content-center flex-md-row-reverse">
            <div class="col-sm-8 col-md-7 col-lg-6 wow fadeInLeft" data-wow-delay="0s">
              <div class="product-banner"><img src="../util/images/home-banner-2-570x715.jpg" alt="" width="570" height="715"/>
                <div class="product-banner-content">
                  <div class="product-banner-inner" style="background-image: url(../util/images/bg-brush.png)">
                    <h3 class="text-primary">fresh</h3>
                    <h2 class="text-secondary">Fruits</h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 col-lg-6">
              <div class="row row-30 justify-content-center">
                <div class="col-sm-6 col-md-12 col-lg-6">
                  <div class="oh-desktop">
                    <!-- Product-->
                    <article class="product product-2 box-ordered-item wow slideInRight" data-wow-delay="0s">
                      <div class="unit flex-row flex-lg-column">
                        <div class="unit-left">
                          <div class="product-figure"><img src="../util/images/product-1-270x280.png" alt="" width="270" height="280"/>
                            <div class="product-button"><a class="button button-md button-white button-ujarak" href="cart-page.html">Add to cart</a></div>
                          </div>
                        </div>
                        <div class="unit-body">
                          <h6 class="product-title"><a href="single-product.html">Peaches</a></h6>
                          <div class="product-price-wrap">
                            <div class="product-price product-price-old">$59.00</div>
                            <div class="product-price">$28.00</div>
                          </div><a class="button button-sm button-secondary button-ujarak" href="cart-page.html">Add to cart</a>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6">
                  <div class="oh-desktop">
                    <!-- Product-->
                    <article class="product product-2 box-ordered-item wow slideInLeft" data-wow-delay="0s">
                      <div class="unit flex-row flex-lg-column">
                        <div class="unit-left">
                          <div class="product-figure"><img src="../util/images/product-3-270x280.png" alt="" width="270" height="280"/>
                            <div class="product-button"><a class="button button-md button-white button-ujarak" href="cart-page.html">Add to cart</a></div>
                          </div>
                        </div>
                        <div class="unit-body">
                          <h6 class="product-title"><a href="single-product.html">Apples</a></h6>
                          <div class="product-price-wrap">
                            <div class="product-price">$21.00</div>
                          </div><a class="button button-sm button-secondary button-ujarak" href="cart-page.html">Add to cart</a>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6">
                  <div class="oh-desktop">
                    <!-- Product-->
                    <article class="product product-2 box-ordered-item wow slideInLeft" data-wow-delay="0s">
                      <div class="unit flex-row flex-lg-column">
                        <div class="unit-left">
                          <div class="product-figure"><img src="../util/images/product-4-270x280.png" alt="" width="270" height="280"/>
                            <div class="product-button"><a class="button button-md button-white button-ujarak" href="cart-page.html">Add to cart</a></div>
                          </div>
                        </div>
                        <div class="unit-body">
                          <h6 class="product-title"><a href="single-product.html">Kiwis</a></h6>
                          <div class="product-price-wrap">
                            <div class="product-price">$26.00</div>
                          </div><a class="button button-sm button-secondary button-ujarak" href="cart-page.html">Add to cart</a>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6">
                  <div class="oh-desktop">
                    <!-- Product-->
                    <article class="product product-2 box-ordered-item wow slideInRight" data-wow-delay="0s">
                      <div class="unit flex-row flex-lg-column">
                        <div class="unit-left">
                          <div class="product-figure"><img src="../util/images/product-2-270x280.png" alt="" width="270" height="280"/>
                            <div class="product-button"><a class="button button-md button-white button-ujarak" href="cart-page.html">Add to cart</a></div>
                          </div>
                        </div>
                        <div class="unit-body">
                          <h6 class="product-title"><a href="single-product.html">Blueberries</a></h6>
                          <div class="product-price-wrap">
                            <div class="product-price">$23.00</div>
                          </div><a class="button button-sm button-secondary button-ujarak" href="cart-page.html">Add to cart</a>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- About us-->
      <section class="section">
        <div class="parallax-container" data-parallax-img="../util/images/bg-parallax-2.jpg">
          <div class="parallax-content section-xl context-dark bg-overlay-68">
            <div class="container">
              <div class="row row-lg row-50 justify-content-center border-classic border-classic-big">
                <div class="col-sm-6 col-md-5 col-lg-3 wow fadeInLeft" data-wow-delay="0s">
                  <div class="counter-creative">
                    <div class="counter-creative-number"><span class="counter">12</span><span class="icon counter-creative-icon fl-bigmug-line-trophy55"></span>
                    </div>
                    <h6 class="counter-creative-title">Awards</h6>
                  </div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3 wow fadeInLeft" data-wow-delay=".1s">
                  <div class="counter-creative">
                    <div class="counter-creative-number"><span class="counter">2</span><span class="symbol">k</span><span class="icon counter-creative-icon fl-bigmug-line-up104"></span>
                    </div>
                    <h6 class="counter-creative-title">Products</h6>
                  </div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3 wow fadeInLeft" data-wow-delay=".2s">
                  <div class="counter-creative">
                    <div class="counter-creative-number"><span class="counter">679</span><span class="icon counter-creative-icon fl-bigmug-line-sun81"></span>
                    </div>
                    <h6 class="counter-creative-title">Happy Clients</h6>
                  </div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3 wow fadeInLeft" data-wow-delay=".3s">
                  <div class="counter-creative">
                    <div class="counter-creative-number"><span class="counter">13</span><span class="icon counter-creative-icon fl-bigmug-line-user143"></span>
                    </div>
                    <h6 class="counter-creative-title">Farmers</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>
      <!-- Team of professionals-->
      <section class="section section-md bg-default">
        <div class="container">
          <div class="oh">
            <h2 class="wow slideInUp" data-wow-delay="0s">Our Team</h2>
          </div>
          <div class="row row-30 justify-content-center">
            <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInRight" data-wow-delay="0s">
              <!-- Team Classic-->
              <article class="team-classic"><a class="team-classic-figure" href="#"><img src="../util/images/team-1-370x406.jpg" alt="" width="370" height="406"/></a>
                <div class="team-classic-caption">
                  <h5 class="team-classic-name"><a href="#">Ryan Wilson</a></h5>
                  <p class="team-classic-status">Founder</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInRight" data-wow-delay=".1s">
              <!-- Team Classic-->
              <article class="team-classic"><a class="team-classic-figure" href="#"><img src="../util/images/team-2-370x406.jpg" alt="" width="370" height="406"/></a>
                <div class="team-classic-caption">
                  <h5 class="team-classic-name"><a href="#">Jill Peterson</a></h5>
                  <p class="team-classic-status">Garden Manager</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInRight" data-wow-delay=".2s">
              <!-- Team Classic-->
              <article class="team-classic"><a class="team-classic-figure" href="#"><img src="../util/images/team-3-370x406.jpg" alt="" width="370" height="406"/></a>
                <div class="team-classic-caption">
                  <h5 class="team-classic-name"><a href="#">Sam Robinson</a></h5>
                  <p class="team-classic-status">Farmyard Coordinator</p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>

      <!-- What people say-->
      <section class="section context-dark">
        <div class="parallax-container" data-parallax-img="../util/images/bg-parallax-3.jpg">
          <div class="parallax-content section-md bg-overlay-24">
            <div class="container">
              <div class="oh">
                <h2 class="wow slideInUp" data-wow-delay="0s">What People Say</h2>
              </div>
              <!-- Owl Carousel-->
              <div class="owl-carousel owl-modern" data-items="1" data-stage-padding="15" data-margin="30" data-dots="true" data-animation-in="fadeIn" data-animation-out="fadeOut" data-autoplay="true">
                <!-- Quote Lisa-->
                <article class="quote-lisa">
                  <div class="quote-lisa-body"><a class="quote-lisa-figure" href="#"><img class="img-circles" src="../util/images/user-16-100x100.jpg" alt="" width="100" height="100"/></a>
                    <div class="quote-lisa-text">
                      <p class="q">I picked up a head of your lettuce at a local grocery store today. What an amazing and beautiful lettuce it is! I’ve never seen another so full and green and tempting.</p>
                    </div>
                    <h5 class="quote-lisa-cite"><a href="#">Samantha Peterson</a></h5>
                    <p class="quote-lisa-status">Regular Client</p>
                  </div>
                </article>
                <!-- Quote Lisa-->
                <article class="quote-lisa">
                  <div class="quote-lisa-body"><a class="quote-lisa-figure" href="#"><img class="img-circles" src="../util/images/user-17-100x100.jpg" alt="" width="100" height="100"/></a>
                    <div class="quote-lisa-text">
                      <p class="q">I wanted to tell you how amazing it was to see the farm and how much we love the food. Your apples and carrots are just wonderful and their taste is great.</p>
                    </div>
                    <h5 class="quote-lisa-cite"><a href="#">John Wilson</a></h5>
                    <p class="quote-lisa-status">Regular Client</p>
                  </div>
                </article>
                <!-- Quote Lisa-->
                <article class="quote-lisa">
                  <div class="quote-lisa-body"><a class="quote-lisa-figure" href="#"><img class="img-circles" src="../util/images/user-18-100x100.jpg" alt="" width="100" height="100"/></a>
                    <div class="quote-lisa-text">
                      <p class="q">The food from your farm is wonderful. So many nights when we sit down to dinner we can say everything on this plate is locally grown and delicious. Thank you!</p>
                    </div>
                    <h5 class="quote-lisa-cite"><a href="#">Kate Anderson</a></h5>
                    <p class="quote-lisa-status">Regular Client</p>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Improve your interior with deco-->
      <section class="section section-md bg-default section-top-image">
        <div class="container">
          <div class="oh h2-title">
            <h2 class="wow slideInUp" data-wow-delay="0s">Our Gallery</h2>
          </div>
          <div class="row row-30" data-lightgallery="group">
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInLeft" data-wow-delay="0s">
                  <div class="thumbnail-mary-figure"><img src="../util/images/grid-gallery-1-370x303.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="../util/images/gallery-original-1-1200x800.jpg" data-lightgallery="item"><img src="../util/images/grid-gallery-1-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Watermelons</a></h4>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInUp" data-wow-delay=".1s">
                  <div class="thumbnail-mary-figure"><img src="../util/images/grid-gallery-2-370x303.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="../util/images/gallery-original-2-1200x800.jpg" data-lightgallery="item"><img src="../util/images/grid-gallery-2-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Grapes</a></h4>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInRight" data-wow-delay=".0s">
                  <div class="thumbnail-mary-figure"><img src="../util/images/grid-gallery-3-370x303.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="util/images/gallery-original-3-800x1200.jpg" data-lightgallery="item"><img src="../util/images/grid-gallery-3-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Mandarin Oranges</a></h4>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInUp" data-wow-delay=".1s">
                  <div class="thumbnail-mary-figure"><img src="../util/images/grid-gallery-4-370x303.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="../util/images/gallery-original-4-800x1200.jpg" data-lightgallery="item"><img src="../util/images/grid-gallery-4-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Lemons</a></h4>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInLeft" data-wow-delay="0s">
                  <div class="thumbnail-mary-figure"><img src="../util/images/grid-gallery-5-370x303.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="util/images/gallery-original-5-800x1200.jpg" data-lightgallery="item"><img src="../util/images/grid-gallery-5-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Organic Food</a></h4>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInDown" data-wow-delay=".1s">
                  <div class="thumbnail-mary-figure"><img src="../util/images/grid-gallery-6-370x303.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="util/images/gallery-original-6-1200x800.jpg" data-lightgallery="item"><img src="../util/images/grid-gallery-6-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Salad</a></h4>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section section-md section-last bg-gray-100">
        <div class="container">
          <div class="oh">
            <h2 class="wow slideInUp" data-wow-delay="0s">Our Partners</h2>
          </div>
          <!-- Owl Carousel-->
          <div class="owl-carousel owl-clients owl-dots-secondary" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="4" data-margin="30" data-dots="true" data-animation-in="fadeIn" data-animation-out="fadeOut"><a class="clients-modern" href="#"><img src="../util/images/clients-1-270x145.png" alt="" width="270" height="145"/></a><a class="clients-modern" href="#"><img src="../util/images/clients-2-270x145.png" alt="" width="270" height="145"/></a><a class="clients-modern" href="#"><img src="../util/images/clients-3-270x145.png" alt="" width="270" height="145"/></a><a class="clients-modern" href="#"><img src="../util/images/clients-4-270x145.png" alt="" width="270" height="145"/></a></div>
        </div>
      </section>

      <!-- Latest posts-->
      <section class="section section-md bg-default">
        <div class="container">
          <div class="oh">
            <h2 class="wow slideInUp" data-wow-delay="0s">Our Blog</h2>
          </div>
          <div class="row row-50 justify-content-center">
            <div class="col-sm-9 col-md-6 col-lg-5 col-xl-4 wow fadeInLeft" data-wow-delay="0s">
              <!-- Post Creative-->
              <article class="post post-creative post-creative-2">
                <div class="post-creative-header">
                  <div class="group-md">
                    <div>
                      <div class="unit flex-column flex-sm-row unit-spacing-sm align-items-center">
                        <div class="unit-left"><img class="img-circles" src="../util/images/user-4-49x49.jpg" alt="" width="49" height="49"/>
                        </div>
                        <div class="unit-body">
                          <div class="post-creative-author"><span class="text">by</span><a href="#"> Ann Smith</a></div>
                        </div>
                      </div>
                    </div>
                    <div class="post-creative-time">
                      <time datetime="2018-05-17">May 17, 2018</time>
                    </div>
                  </div>
                </div><a class="post-creative-figure" href="blog-post.html"><img src="../util/images/post-16-370x267.jpg" alt="" width="370" height="267"/></a>
                <div class="post-creative-footer">
                  <div class="post-creative-title"><a href="blog-post.html">Why Organic Farming Keeps Getting Popular Globally</a></div>
                </div>
              </article>
            </div>
            <div class="col-sm-9 col-md-6 col-lg-5 col-xl-4 wow fadeInLeft" data-wow-delay=".1s">
              <!-- Post Creative-->
              <article class="post post-creative post-creative-2">
                <div class="post-creative-header">
                  <div class="group-md">
                    <div>
                      <div class="unit flex-column flex-sm-row unit-spacing-sm align-items-center">
                        <div class="unit-left"><img class="img-circles" src="../util/images/user-6-49x49.jpg" alt="" width="49" height="49"/>
                        </div>
                        <div class="unit-body">
                          <div class="post-creative-author"><span class="text">by</span><a href="#"> Kate Williams</a></div>
                        </div>
                      </div>
                    </div>
                    <div class="post-creative-time">
                      <time datetime="2018-05-04">May 04, 2018</time>
                    </div>
                  </div>
                </div><a class="post-creative-figure" href="blog-post.html"><img src="../util/images/post-17-370x267.jpg" alt="" width="370" height="267"/></a>
                <div class="post-creative-footer">
                  <div class="post-creative-title"><a href="blog-post.html">Everyday Dinner Choices for a Healthier, Happier You</a></div>
                </div>
              </article>
            </div>
            <div class="col-sm-9 col-md-6 col-lg-5 col-xl-4 wow fadeInLeft" data-wow-delay=".2s">
              <!-- Post Creative-->
              <article class="post post-creative post-creative-2">
                <div class="post-creative-header">
                  <div class="group-md">
                    <div>
                      <div class="unit flex-column flex-sm-row unit-spacing-sm align-items-center">
                        <div class="unit-left"><img class="img-circles" src="../util/images/user-5-49x49.jpg" alt="" width="49" height="49"/>
                        </div>
                        <div class="unit-body">
                          <div class="post-creative-author"><span class="text">by</span><a href="#"> Peter McMillan</a></div>
                        </div>
                      </div>
                    </div>
                    <div class="post-creative-time">
                      <time datetime="2018-05-17">May 17, 2018</time>
                    </div>
                  </div>
                </div><a class="post-creative-figure" href="blog-post.html"><img src="../util/images/post-18-370x267.jpg" alt="" width="370" height="267"/></a>
                <div class="post-creative-footer">
                  <div class="post-creative-title"><a href="blog-post.html">Standardizing the Organic Industry in the USA</a></div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>

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
  </body>
</html>