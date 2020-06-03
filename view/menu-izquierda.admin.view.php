<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="menu.principal.view.php" class="brand-link">
      <img src="../images/datamedic.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="text-info text-bold">Data Medic</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="fotos/<?php echo $fotoUsuario; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><p><?php echo $nombreUsuario; ?></p></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <div class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Menú Principal
              </p>
            </div>
          </li>
          <?php
                /* Crear la variable POST para enviarle al controlador */
                $_POST["codigo_cargo_usuario"] = $s_codigoCargo; // $s_codigoCargo = 1 o 2
                /* Crear la variable POST para enviarle al controlador */
//                    print_r($s_codigoCargo);
                require_once '../controller/obtener.opciones.menu.controller.php';

//                print_r($resultadoOpcionesMenuBD);

                for ($i = 0; $i < count($resultadoOpcionesMenuBD); $i++) {
                    echo '<li class="nav-item has-treeview">';
                    echo '<a href="#" class="nav-link">';
                    echo '<ion-icon name="desktop-outline"></ion-icon>';
                    echo '<p>';
                    echo '<span class="text-info text-bold">&nbsp;&nbsp;' . $resultadoOpcionesMenuBD[$i]["nombre"] . '</span>';
                    echo '<i class="fas fa-angle-left right"></i>';
                    echo '</p>';
                    echo '</a>';
                    

                    /* Mostrar los items a los que tiene acceso el usuario */
                    echo '<ul class="nav nav-treeview">';
                    /* Crear la variable POST para enviarle al controlador */
                    $_POST["codigo_menu"] = $resultadoOpcionesMenuBD[$i]["codigo_menu"];
//                    echo $_POST["codigo_menu"];
                    /* Crear la variable POST para enviarle al controlador */

                    require '../controller/obtener.opciones.menu.item.controller.php';

                    for ($j = 0; $j < count($resultadoOpcionesMenuItemBD); $j++) {
                        echo '<li class="nav-item"><a href="' . $resultadoOpcionesMenuItemBD[$j]["archivo"] . ' " class="nav-link"><i class="far fa-circle nav-icon"></i><p> ' . $resultadoOpcionesMenuItemBD[$j]["nombre"] . '</p></a></li>';
                    }
                    echo '</ul>';
                    /* Mostrar los items a los que tiene acceso el usuario */

                    echo '</li>';
                }
                ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>