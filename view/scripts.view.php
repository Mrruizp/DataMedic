<!-- jQuery -->
<script src="../util/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../util/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../util/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../util/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../util/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../util/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../util/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../util/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../util/plugins/moment/moment.min.js"></script>
<script src="../util/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../util/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../util/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../util/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<!--<script src="../util/dist/js/adminlte.js"></script>-->
<script src="../util/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../util/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../util/dist/js/demo.js"></script>
<!--sweetalert-->
<script src="../util/plugins/swa/sweetalert-dev.js"></script>
<script src="../util/plugins/datatables/jquery.dataTables.js"></script>
<script src="../util/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../util/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src = "https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"> </script>
<!-- overlayScrollbars -->
<script src="../util/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script>
            function mostrarR() {
							        document.getElementById('iniciarSesion').style.display    = 'none';
							        document.getElementById('registrarCuenta').style.display  = 'block';

							    }
			function mostrarI() {
							        document.getElementById('iniciarSesion').style.display    = 'block';
							        document.getElementById('registrarCuenta').style.display  = 'none';

							    }
</script>
 <script>
                function ValidaSoloNumeros() {/* no permite el ingreso de carÃ¡cteres que no sean numeros*/
                if ((event.keyCode < 48) || (event.keyCode/* cÃ³digo de la tecla fÃ­sica*/ > 57)) /* del 48 al 56 corresponde solo numeros*/
                event.returnValue = false;
            }
</script>