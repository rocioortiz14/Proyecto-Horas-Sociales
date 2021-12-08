      <!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="inicio.php"><img class="img-fluid" src="assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>

          <?php if ($_SESSION["permiso"] == 1) { ?>

          <div class="left-header col horizontal-wrapper ps-0">
            <ul class="horizontal-menu">
              <li class="level-menu outside"><a class="nav-link" href="#!"><i data-feather="settings"></i><span> Configuraciones</span></a>
                <ul class="header-level-menu menu-to-be-close">
                  <li><a href="usuarios.php" data-original-title="" title=""><i data-feather="user"></i><span>Usuarios</span></a></li>
                  <li><a href="permisos.php" data-original-title="" title=""><i data-feather="user-x"></i><span>Permisos</span></a></li>
                  <li><a href="conexiones.php" data-original-title="" title=""><i data-feather="activity"></i><span>Conexiones</span></a></li>
                  <li><a href="empresa.php" data-original-title="" title=""><i data-feather="heart"></i><span>Empresa</span></a></li>
                  <li><a href="empleados.php" data-original-title="" title=""><i data-feather="award"></i><span>Empleados</span></a></li>
                </ul>
              </li>
            </ul>
          </div>

          <?php } ?>

          <?php if ($_SESSION["permiso"] == 2) { ?>

          <div class="left-header col horizontal-wrapper ps-0">
            <ul class="horizontal-menu">
              <li class="level-menu outside"><a class="nav-link" href="empleados.php"><i data-feather="award"></i><span> Empleados</span></a></li>
            </ul>
          </div>

          <?php } ?>

          <?php if ($_SESSION["permiso"] == 1 || $_SESSION["permiso"] == 2 || $_SESSION["permiso"] == 3) { ?>

          <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">
              <li class="profile-nav onhover-dropdown p-0 me-0">
                <div class="media profile-media"><img class="b-r-10" src="imagenes/users.png" alt="">
                  <div class="media-body"><span><?php echo $_SESSION["usuario"]; ?></span>
                    <p class="mb-0 font-roboto"><?php echo $data[1]; ?> <i class="middle fa fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="#"><i data-feather="user"></i><span> Cuenta </span></a></li>
                  <li><a href="cierre.php"><i data-feather="log-in"> </i><span> Salir</span></a></li>
                </ul>
              </li>
            </ul>
          </div>

          <?php } ?>

        </div>
      </div>
      <!-- Page Header Ends -->
