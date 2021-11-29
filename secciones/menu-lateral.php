        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper"><a href="inicio.php"><h5>SYSINVENTORY</h5> </a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
              <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="inicio.php"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt=""></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">

                  <li class="back-btn"><a href="index.htmlinicio.php"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>

                  <li class="sidebar-main-title">
                      <img src="imagenes/uploads/<?php echo $resultado[12]; ?>" class="img-fluid logoLeft" alt="">
                  </li>

                  <?php if ($_SESSION["permiso"] == 1 || $_SESSION["permiso"] == 2 || $_SESSION["permiso"] == 3) { ?>

                  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="inicio.php"><i data-feather="square"> </i><span>Inicio</span></a></li>

                  <?php if ($_SESSION["permiso"] == 1 || $_SESSION["permiso"] == 2) { ?>

                  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="clientes.php"><i data-feather="user-check"> </i><span>Clientes</span></a></li>

                  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="proveedores.php"><i data-feather="user-plus"> </i><span>Proveedores</span></a></li>

                  <?php } ?>

                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="sliders"></i><span>Almacen</span></a>
                    <ul class="sidebar-submenu">

                      <?php if ($_SESSION["permiso"] == 1 || $_SESSION["permiso"] == 2) { ?>

                      <li><a href="categorias.php">Categorias</a></li>
                      <li><a href="productos.php">Productos</a></li>

                      <?php } ?>

                      <li><a href="inventarios.php">Inventario</a></li>
                    </ul>
                  </li>

                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="shopping-cart"></i><span>Ventas</span></a>
                    <ul class="sidebar-submenu">

                      <?php if ($_SESSION["permiso"] == 1 || $_SESSION["permiso"] == 3) { ?>

                      <li><a href="generar-ventas.php">Generar Venta</a></li>

                      <?php } ?>

                      <li><a href="ventas.php">Administrar Ventas</a></li>
                    </ul>
                  </li>

                  <?php if ($_SESSION["permiso"] == 1 || $_SESSION["permiso"] == 2) { ?>

                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="shopping-bag"></i><span>Compras</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="generar-compras.php">Generar Compra</a></li>
                      <li><a href="compras.php">Administrar Compras</a></li>
                    </ul>
                  </li>

                  <?php } ?>

                  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="desarrolladora.php"><i data-feather="github"> </i><span>Desarrolladora</span></a></li>

                <?php } else {
                  echo '<li class="sidebar-list"><a href="cierre.php" class="btn btn-info d-grid col-9 mx-auto mt-3">SALIR</a></li>';
                } ?>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>
