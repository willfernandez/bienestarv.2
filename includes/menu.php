<div class="navbar navbar-inverse" style="position: static;">
<div class="navbar-inner">
<div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Gesti&oacute;n</a>
          <div class="nav-collapse navbar-inverse-collapse collapse" style="height: 0px;">
          <ul class="nav">
            
                <li><a href="frmHome.php">Inicio</a></li>
                <li><a href="frmLogin.php" target='_Blanck'>Fichas</a></li>
                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">
                    Busquedas
                    <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                    <li><a href="frmAlumnos.php">Alumnos</a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"> </a></li>
                    <li class="divider"></li>
                    <li><a href="#"></a></li>
                    </ul>
                    
                </li>
                 <li class="dropdown" id="menu2">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">
                    Reportes
                    <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                    <li><a href="frmDatoGenenarles.php">Datos Generales</a></li>
                    <li><a href="frmAspectFamiliar.php">Aspecto Familiar</a></li>
                     <li><a href="frmConvivencia.php">Convivencia </a></li>
                    <li class="divider"></li>
                   <li><a href="frmDeudas.php">Deudas</a></li>
                   <li><a href="frmEducativo.php">Educación</a></li>
                      <li><a href="frmSalud.php">Salud</a></li>
                    </ul>
                    
                </li>
                <li><a href="http://www.ujcm.edu.pe/web2/" target="_Blanck">Ir a Pagina Web</a></li>
                 <?php if($_SESSION['email']=='fwillss@hotmail.com'){ ?>
                 <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">
                    Configuración
                    <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                    <li><a href="frmConfiguracion.php" >Configuración</a></li>
                    <li><a href="frmUsuario.php" >Usuarios</a></li>
                    </ul>
                    
                </li>
                  <?php    } ?>
                 <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">
                    Usuarios
                    <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                    <li><a href="#">Editar Perfil</a></li>
                    <li class="divider"></li>
                    <li><a href="#" onclick="cerrarSesionAd('Salir');" >Cerrar Sesión</a></li>
                    </ul>
                    
                </li>

                </ul>
            <p class="navbar-text pull-right" >Ud. se a logeado como: <a href="#" style="color:#0088CC;"><?php echo $_SESSION['nombresU'].' '.$_SESSION['apellidosU'] ?></a></p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
</div>