<nav class="navbar navbar-person">
    <div class="navbar-header">
    	<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
     </button> 
     <a class="navbar-brand" href="?option=home"><img src="img/logo-initec-blanco.png" alt="Logo Initec"></a>
 </div>

 <div class="collapse navbar-collapse js-navbar-collapse">
		<!-- <ul class="nav navbar-nav">
			<li class="dropdown mega-dropdown">
				<a href="#" class="data-toggle" data-toggle="dropdown">Home</a>				
								
			</li>
            <li class="dropdown mega-dropdown">
    			<a href="#" class="data-toggle" data-toggle="dropdown">About </a>				
								
			</li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Contact</a></li>
        </ul> -->
        <ul class="nav navbar-nav navbar-right">
        <!-- <li class="dropdown mega-dropdown">
			<a href="#" class="data-toggle" data-toggle="dropdown">Home</a>				
		</li>
        <li class="dropdown mega-dropdown">
            <a href="#" class="data-toggle" data-toggle="dropdown">About</a>             
        </li>
        <li class="dropdown mega-dropdown">
            <a href="#" class="data-toggle" data-toggle="dropdown">Products</a>             
        </li>
        <li class="dropdown mega-dropdown">
            <a href="#" class="data-toggle" data-toggle="dropdown">Contact</a>             
        </li> -->
        <li>
            <div class="center" id="sesion">
                <?php 
                if(isset($_SESSION['idUsuVid'])){
                        //echo '<button id="'.$_SESSION['cod_Us'].'" class="btn log center-block">'.$_SESSION['idUsuVid'].'</button>';
                    ?>  

                    <ul class="nav navbar-right top-nav">

                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['idUsuVid']."  "; ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!--<li>
                                    <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                                </li> -->
                                <!-- <li class="divider"></li> -->
                                <li>
                                    <a href="?option=logout"><i class="glyphicon glyphicon-log-out"></i> Cerrar sesion</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <?php
                }
                else
                {
                    ?>
                    <button data-toggle="modal" data-target="#squarespaceModal" class="btn log center-block">Iniciar sesion</button>
                    <?php } ?>
                </div>
                <!--<button class="btn log">Iniciar Sesion</button>-->
            </li>
        <!-- <li><fb:login-button class="btn text-center log" scope="public_profile,email" onlogin="checkLoginState();">
    </fb:login-button></li> -->
</ul>
</div><!-- /.nav-collapse -->
</nav>
<!-- 
  <ul class="nav navbar-right top-nav">
                
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
                            
                            <a href="#" data-toggle="modal" data-target="#squarespaceModal" class=""><i class="fa fa-fw fa-gear"></i>Ajustes</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="?option=logout"><i class="fa fa-fw fa-sign-out"></i> Cerrar sesion</a>
                        </li>
                    </ul>
                </li>
            </ul> -->