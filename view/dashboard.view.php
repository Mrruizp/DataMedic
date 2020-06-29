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
        <title> Data Medic | Tablero</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include_once 'estilos.view.php'; ?>
    </head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">
  <?php include_once './menu-arriba.admin.view.php'; ?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <?php include_once 'menu-izquierda.admin.view.php'; ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tablero</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Tablero</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Número de citas atendidas</h3>
               
                <input type="hidden" id="textCitaConfEne" name="textCitaConfEne" value="<?php echo $resultado1["num_cita_conf_enero"];    ?>">
                <input type="hidden" id="textCitaConfFeb" name="textCitaConfFeb" value="<?php echo $resultado2["num_cita_conf_febrero"];  ?>">
                <input type="hidden" id="textCitaConfMar" name="textCitaConfMar" value="<?php echo $resultado3["num_cita_conf_marzo"];    ?>">
                <input type="hidden" id="textCitaConfAbr" name="textCitaConfAbr" value="<?php echo $resultado4["num_cita_conf_abril"];    ?>">
                <input type="hidden" id="textCitaConfMay" name="textCitaConfMay" value="<?php echo $resultado5["num_cita_conf_mayo"];     ?>">
                <input type="hidden" id="textCitaConfJun" name="textCitaConfJun" value="<?php echo $resultado6["num_cita_conf_junio"];    ?>">
                <input type="hidden" id="textCitaConfJul" name="textCitaConfJul" value="<?php echo $resultado7["num_cita_conf_julio"];    ?>">
                <input type="hidden" id="textCitaConfAgo" name="textCitaConfAgo" value="<?php echo $resultado8["num_cita_conf_agosto"];   ?>">
                <input type="hidden" id="textCitaConfSet" name="textCitaConfSet" value="<?php echo $resultado9["num_cita_conf_setiembre"];?>">
                <input type="hidden" id="textCitaConfOct" name="textCitaConfOct" value="<?php echo $resultado10["num_cita_conf_octubre"];  ?>">
                <input type="hidden" id="textCitaConfNov" name="textCitaConfNov" value="<?php echo $resultado11["num_cita_conf_noviembre"];?>">
                <input type="hidden" id="textCitaConfDic" name="textCitaConfDic" value="<?php echo $resultado12["num_cita_conf_diciembre"];?>">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="height:260px; min-height:260px"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <div class="col-6">
            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Número de citas atendidas hasta la fecha, por cada consultorio</h3>
                  <input type="hidden" id="textConsultorio_1" name="textConsultorio_1" value="<?php echo $resultado13["consultorio_1"];?>">
                  <input type="hidden" id="textConsultorio_2" name="textConsultorio_2" value="<?php echo $resultado14["consultorio_2"];?>">
              <!--
                  <input type="text" id="textConsultorio_1_feb" name="textConsultorio_1_feb" value="<?php echo $resultado14["consultorio_1_febrero"];?>">
                  <input type="text" id="textConsultorio_1_mar" name="textConsultorio_1_mar" value="<?php echo $resultado15["consultorio_1_marzo"];?>">
                  <input type="text" id="textConsultorio_1_abr" name="textConsultorio_1_abr" value="<?php echo $resultado16["consultorio_1_abril"];?>">
                  <input type="text" id="textConsultorio_1_may" name="textConsultorio_1_may" value="<?php echo $resultado17["consultorio_1_mayo"];?>">
                  <input type="text" id="textConsultorio_1_jun" name="textConsultorio_1_jun" value="<?php echo $resultado18["consultorio_1_junio"];?>">
                  <input type="text" id="textConsultorio_1_jul" name="textConsultorio_1_jul" value="<?php echo $resultado19["consultorio_1_julio"];?>">
                  <input type="text" id="textConsultorio_1_ago" name="textConsultorio_1_ago" value="<?php echo $resultado20["consultorio_1_agosto"];?>">
                  <input type="text" id="textConsultorio_1_set" name="textConsultorio_1_set" value="<?php echo $resultado21["consultorio_1_setiembre"];?>">
                  <input type="text" id="textConsultorio_1_oct" name="textConsultorio_1_oct" value="<?php echo $resultado22["consultorio_1_octubre"];?>">
                  <input type="text" id="textConsultorio_1_nov" name="textConsultorio_1_nov" value="<?php echo $resultado23["consultorio_1_noviembre"];?>">
                  <input type="text" id="textConsultorio_1_dic" name="textConsultorio_1_dic" value="<?php echo $resultado24["consultorio_1_diciembre"];?>">
              -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="height:260px; min-height:260px"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Número de citas por día, según su estado</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <form id="frmgrabar" class="form-horizontal">
              <div class="row col-12">
                            <div class="col-2 ">
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
                            <div class="col-1">
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
                            <div class="col-1">
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
                            <div class="col-2">
                                <p>
                                   
                                    Estado <select class="form-control" name="txtEstado" id="txtEstado">
                                                  <option></option>
                                                  <option value="Cita Atendida">Atendido</option>
                                                  <option value="Cita Confirmada">Confirmado</option>
                                                  <option value="Cita Denegada">Denegado</option>
                                                  <option value="En proceso de confirmación">En proceso</option>
                                          </select>
                                </p>
                            </div>
                            <div class="col-2">
                                <p>
                                   
                                    <br/> <button type="submit" class="btn btn-outline-info"><ion-icon name="search-outline"></ion-icon></button>
                                </p>
                            </div>
                </div>
              </form>
                <div class="row col-12">
                  <div class="col-8">
                                  <div id="listado" class="table table-responsive"></div>
                                  <input type="hidden" id="textTotalCitas" name="textTotalCitas">
                  </div>
                  <div class="col-2">
                                
                                  <!--<canvas id="pieChart" style="height:230px; min-height:230px"></canvas>-->
                  </div>
                </div>
              <div class="card-body">
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once 'pie.view.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include_once 'scripts.view.php'; ?>
<!-- jQuery -->
<script src="../util/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../util/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../util/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../util/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../util/dist/js/demo.js"></script>
<!-- page script -->
<script src="js/dashboard.js" type="text/javascript"></script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#barChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junino', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'],

      datasets: [
        

        {
          label               : 'Citas Atendidas',
          backgroundColor     : '#00a65a',
          borderColor         : '#00a65a',
          pointRadius         : true,
          pointColor          : '#00a65a',
          pointStrokeColor    : '#00a65a',
          pointHighlightFill  : '#00a65a',
          pointHighlightStroke: '#00a65a',
          data                : [
                                  $("#textCitaConfEne").val(), 
                                  $("#textCitaConfFeb").val(),  
                                  $("#textCitaConfMar").val(), 
                                  $("#textCitaConfAbr").val(), 
                                  $("#textCitaConfMay").val(), 
                                  $("#textCitaConfJun").val(), 
                                  $("#textCitaConfJul").val(),
                                  $("#textCitaConfAgo").val(),
                                  $("#textCitaConfSet").val(),
                                  $("#textCitaConfOct").val(),
                                  $("#textCitaConfNov").val(),
                                  $("#textCitaConfDic").val()]
        },
        
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }
    areaChartData.datasets[0].fill = false;
    //areaChartData.datasets[1].fill = false;
    areaChartOptions.datasetFill = false
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, { 
      type: 'line',
      data: areaChartData, 
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Consultorio Dental - Endodoncia', 
          'Consultorio denta - Cirugía y estética' 
      ],
      datasets: [
        {
          data: [$("#textConsultorio_1").val(),$("#textConsultorio_2").val()],
          backgroundColor : ['#00c0ef', '#00a65a'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })


    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
   
   var donutChartCanvas = $('#pieChart').get(0).getContext('2d')

     var donutData        = {
      labels: [
          'Número', 
          'Consultorio denta - Cirugía y estética' 
      ],
      datasets: [
        {
          data: [$("#textTotalCitas").val(),$("#textConsultorio_2").val()],
          backgroundColor : ['#00c0ef', '#00a65a'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart2 = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })

    

    //-------------
    //- BAR CHART -
    //-------------
    

    
  })
</script>
</body>
</html>
