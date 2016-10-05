 <!-- MODAL CAMBIO CONTASEÑA -->
<!--<button data-toggle="modal" data-target="#squarespaceModal" class="btn btn-primary center-block">Click Me</button>-->


<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">X</span><span class="sr-only">Cerrar</span></button>
            <h3 class="modal-title" id="lineModalLabel">Cambiar Contraseña</h3>
        </div>
        <div class="modal-body">
             
            <!-- content goes here -->
            <form>
              <div class="form-group">
                <label for="PasswordActual">Contraseña actual</label>
                <input type="password" class="form-control" id="PasswordActual" required>
              </div>
              <div class="form-group">
                <label for="NewPassword">Nueva contraseña</label>
                <input type="password" class="form-control" id="NewPassword" >
              </div>
              <div class="form-group">
                <label for="NewPassword1">Repetir contraseña</label>
                <input type="password" class="form-control" id="NewPassword1" >
              </div>
              
              <button type="submit" class="btn btn-primary" id="changePsw">Guardar Cambios</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><span aria-hidden="true">Cancelar</span><span class="sr-only">Cerrar</span></button>
            </form>
            <div class="mensaje"></div>
        </div>
        
    </div>
  </div>
</div>

<!-- CONTENIDO PAGINA -->
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand user" id="<?php echo $_SESSION['cod']; ?>" href="#"><?php echo $_SESSION['idUsu']; ?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <!--  -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Cuenta <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Mensajes</a>
                        </li>
                        <li>
                            <!--<a href="#"><i class="fa fa-fw fa-gear"></i> Ajustes</a> -->
                            <a href="#" data-toggle="modal" data-target="#squarespaceModal" class=""><i class="fa fa-fw fa-gear"></i>Ajustes</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="?option=logout"><i class="fa fa-fw fa-sign-out"></i> Cerrar sesion</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="#"><i class="fa fa-ellipsis-v"></i> Rol  <select name="rol" id="rol"><option value="">Seleccionar</option></select></a>
                    </li>
                        <div class="opciones-rol"></div>
                        <!--<li >
                            <a href="charts.html" ><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                        </li> 
                        <li>
                            <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
                        </li>
                        <li>
                            <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                        </li>
                        <li>
                            <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <li>
                                    <a href="#">Dropdown Item</a>
                                </li>
                                <li>
                                    <a href="#">Dropdown Item</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                        </li>
                        <li>
                            <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                        </li> -->
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid sector">
                <div class="page-header">
                    <h1>Bienvenido <?php echo $_SESSION['idUsu']; ?></h1>
                </div>
               
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery 
    <script src="js/jquery.js"></script>
    <script src="js/app.js"></script>

    <!-- Bootstrap Core JavaScript 
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript 
        <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

-->