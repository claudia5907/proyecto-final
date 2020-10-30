<?php //include "./class_lib/sesionSecurity.php"; $_SESSION['']
$nameUser=$this->session->userdata("nombre_de_usuario");
$id_tipo=$this->session->userdata("id_tipo");

?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo isset($titulo)?$titulo:$newitulo?></title>
	<link rel="shortcut icon" href="<?php echo base_url()?>resources/imagenes/favicon.ico" />
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Main CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>resources/css/main.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url()?>resources/dist/css/ionicons.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url()?>resources/plugins/iCheck/square/blue.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<div class="MsjAjaxForm"></div>
	<!-- jQuery 3.1.1 -->
	<script src="<?php echo base_url()?>resources/js/jquery-3.1.1.min.js"></script>
	<!-- jQueryUI 1.12 -->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url()?>resources/js/bootstrap.min.js"></script>
	<!-- Script AjaxForms-->
	<script src="<?php echo base_url()?>resources/js/AjaxForms.js"></script>
	<!-- Sweet Alert 2-->
	<script src="<?php echo base_url()?>resources/js/sweetalert2.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url()?>resources/dist/js/app.js"></script>
	<!-- Script main-->
	<script src="<?php echo base_url()?>resources/js/main.js"></script>
    <script src="<?php echo base_url()?>resources/plugins/morris/morris.min.js"></script>
    <script src="<?php echo base_url()?>resources/plugins/morris/raphael-min.js"></script>
    <script src="<?php echo base_url()?>resources/dist/js/source_init.js"></script>
	<script src="<?php echo base_url()?>resources/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url()?>resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
	
	<link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet"> 
	<style>
	@import url('https://fonts.googleapis.com/css?family=Tangerine');
      .miestilo {
        font-family: 'Tangerine', serif;
        font-size: 48px;
		text-shadow: 4px 4px 4px #aaa;
		color: red;
      }	 
     .miestilo2{
		 font-family: 'Lobster Two', cursive;
		 font-size: 24px;
		 color: green;
	 }	
	 
    </style>
	
  </head>
  <!--<body onload="revisa_compras();revisa_ventas();pone_gastos();pone_users();genera_grafica();genera_grafica_existe();revisa_caducidades();">-->
  <body >
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="<?php echo base_url()?>inicio" class="logo">
					  <!-- mini logo for sidebar mini 50x50 pixels -->
					  <span class="logo-mini"><b>S</b>M</span>
					  <!-- logo for regular state and mobile devices -->
					  <span class="logo-lg"><b>Sistema</b> Academico</span>
				</a>
			<!-- Header Navbar -->
			  <?php
			   error_reporting(0);
			   $fp = fopen("files/contador.txt","r"); // Abrimos el fichero donde guardaremos y leeremos las visitas
			   $visitas = intval(fgets($fp)); // Leemos las visitas y usamos intval para asegurarnos de que devuelve un entero
			   ?>
					<nav class="navbar navbar-static-top" role="navigation">
					  <!-- Sidebar toggle button-->
					  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					  </a>
					  <!-- Navbar Right Menu -->
					  <div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
						  <!-- Messages: style can be found in dropdown.less-->
						  <li class="dropdown messages-menu">
							<!-- Menu toggle button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							  <i class="fa fa-envelope-o"></i>
							  <span class="label label-success"><?php echo $visitas; ?></span>
							</a>
							<ul class="dropdown-menu">
							  <li class="header">Numero de accesos a la aplicacion.</li>
							  <li>
								<!-- inner menu: contains the messages -->
								<ul class="menu">
								  <li><!-- start message -->
									<a href="">
									  <div class="pull-left">
										<!-- User Image -->
										<img src="<?php echo base_url()?>resources/dist/img/information_image.png" class="img-circle" alt="User Image">
									  </div>
									  <!-- Message title and timestamp -->
									  <h4>
										Se ha accesado a la aplicacion:
									  </h4>
									  <!-- The message -->
									  <p><?php echo $visitas; ?> veces.</p>
									</a>
								  </li><!-- end message -->
								</ul><!-- /.menu -->
							  </li>
							</ul>
						  </li><!-- /.messages-menu -->

						  <!-- Notifications Menu -->
						  <li class="dropdown notifications-menu">
							<!-- Menu toggle button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							  <i class="fa fa-bell-o"></i>
							  <span class="label label-danger num_noti">0</span>
							</a>
							<ul class="dropdown-menu">
							  <li class="header">Productos Para Caducar...</li>

							  <li>

								<!-- Inner Menu: contains the notifications -->
								<ul class="menu arti_caducos">

								</ul>
							  </li>
							  <!--<li class="footer"><a href="#">View all</a></li>-->
							</ul>
						  </li>
						  <!-- Tasks Menu -->
						  <li class="dropdown tasks-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							  <i class="fa fa-flag-o"></i>
							  <span class="label label-warning">0</span>
							</a>
							<ul class="dropdown-menu">
							  <li class="header">0 tareas pendientes.</li>
							  <!--
							  <li>
								<!-- Inner menu: contains the tasks
								<ul class="menu">
								  <li><!-- Task item
									<a href="#">
									  <!-- Task title and progress text
									  <!--<h3>
										Design some buttons
										<small class="pull-right">20%</small>
									  </h3>
									  <!-- The progress bar
									  <div class="progress xs">
										<!-- Change the css width attribute to simulate progress
										<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
										  <span class="sr-only">20% Complete</span>
										</div>
									  </div>
									</a>
								  </li><!-- end task item
								</ul>
							  </li>

							  <li class="footer">
								<a href="#">View all tasks</a>
							  </li>-->
							</ul>
						  </li>
						  <!-- User Account Menu -->
						   <?php 
							$imgPerfil='avatar.png';
							?>
						  <li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							  <!-- The user image in the navbar-->
							  <img src="<?php echo base_url()?>resources/dist/img/<?php echo $imgPerfil?>" class="user-image" alt="User Image">
							  <!-- hidden-xs hides the username on small devices so only the image appears. -->
							  <span class="hidden-xs"><?php echo $nameUser; ?></span>
							</a>
							<ul class="dropdown-menu">
							  <!-- The user image in the menu -->
							  <li class="user-header">
							    
								<img src="<?php echo base_url()?>resources/dist/img/<?php echo $imgPerfil?>" class="img-circle" alt="User Image">
								<p>
								  Usuario: <?php echo $nameUser; ?>
								  <!--<small>Member since Nov. 2012</small>-->
								</p>
							  </li>
							  <!-- Menu Body -->
							  <!--<li class="user-body">
								<div class="col-xs-4 text-center">
								  <a href="#">Followers</a>
								</div>
								<div class="col-xs-4 text-center">
								  <a href="#">Sales</a>
								</div>
								<div class="col-xs-4 text-center">
								  <a href="#">Friends</a>
								</div>
							  </li>-->
							  <!-- Menu Footer-->
							  <li class="user-footer">
								<a href="#!" class="btn btn-info btn-block"><i class='fa fa-user'></i> Perfil</a>
								<a href="<?php echo base_url()?>ingreso/salir" class="btn btn-danger btn-block btn-exit-system"><i class='fa fa-power-off'></i> Salir</a>
							  </li>
							</ul>
						  </li>
						  <!-- Control Sidebar Toggle Button -->
						  <!--<li>
							<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
						  </li>-->
						</ul>
					  </div>
					</nav>

      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <?php
		date_default_timezone_set("America/La_Paz" ); 
         
        //include('class_lib/class_conecta_mysql.php');
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        /*
	    $db=new ConexionMySQL();
        $consulta=$db->consulta("Select nombre_empresa from parametros");
        while($sw=$db->buscar_array($consulta)){
          $name_empresa=$sw['nombre_empresa'];
        }*/
		$name_empresa="Instituto de nivelacion C&R";
        ?>
			    
        <!-- /.sidebar -->
		
			<section class="sidebar">

			  <!-- Sidebar user panel (optional) -->
			  <div class="user-panel">
				<div class="pull-left image">
				  <img src="<?php echo base_url()?>resources/dist/img/<?php echo $imgPerfil?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
				  <p><?php echo $nameUser?></p>
				  <!-- Status -->
				  <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
				</div>
			  </div>

			  <!-- search form (Optional) 
			  <form action="#" method="get" class="sidebar-form">
				<div class="input-group">
				  <input type="text" name="q" class="form-control" placeholder="Search...">
				  <span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
				  </span>
				</div>
			  </form>
			   search form -->

			  <!-- Sidebar Menu -->
			  <ul class="sidebar-menu">
				<li class="header">MENU</li>
				<!-- Optionally, you can add icons to the links -->
				<?php 
				if($id_tipo=='1'){
				?> 
				<li class="treeview">
				  <a href="#"><i class="fa fa-server"></i> <span>Mtto. de Archivos.</span> <i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
					<li><a href="<?php echo base_url()?>personal/gestion_personal/alumno"><i class="fa fa-users"></i> Alumno.</a></li>
					<li><a href="<?php echo base_url()?>personal/gestion_personal/docente"><i class="fa fa-user"></i> Docente.</a></li>
					<li><a href="<?php echo base_url()?>materia/gestion_materia"><i class="fa fa-book"></i> Materia.</a></li>
					<li><a href="<?php echo base_url()?>aula/gestion_aula"><i class="fa fa-university"></i> Aula.</a></li> 
				  </ul>
				</li>
				<li class="treeview">
				  <a href="#"><i class="fa fa-barcode"></i> <span>Registros.</span> <i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
					<li><a href="<?php echo base_url()?>asignacion/gestion_asignacion/docente"><i class="fa fa-newspaper-o"></i> Asignacion Docente.</a></li>
					<li><a href="<?php echo base_url()?>asignacion/gestion_asignacion/alumno"><i class="fa fa-list-alt"></i> Inscripcion Alumno.</a></li> 
				  </ul>
				</li>
				<li class="treeview">
				  <a href="#"><i class="fa fa-line-chart"></i> <span>Reportes.</span> <i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
					<li><a href="<?php echo base_url()?>reporte/gestion_reportes/asignacion_docente"><i class="fa fa-id-card-o"></i> Asignacion Docente.</a></li>
					<li><a href="<?php echo base_url()?>reporte/gestion_reportes/asignacion_alumno"><i class="fa fa-id-card"></i> Inscripcion Alumno.</a></li> 
				  </ul>
				</li>
				<li class="treeview">
				  <a href="#"><i class="fa fa-terminal"></i> <span>Utilerias.</span> <i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
					<!--<li><a href="parametros.php"><i class="fa fa-map-o"></i> Parametros de Aplicacion.</a></li>
					<li><a href="valida_cambio.php?opt=582963741"><i class="fa fa-folder-open"></i> Respaldo de BD.</a></li>-->
					<li><a href="<?php echo base_url()?>usuarios/gestion_usuarios"><i class="fa fa-user"></i> Usuarios.</a></li>
				  </ul>
				</li>
				<?php 
				}elseif($id_tipo=='2'){
				?> 
				 <li class="treeview">
				  <a href="#"><i class="fa fa-barcode"></i> <span>Registros.</span> <i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
					<li><a href="<?php echo base_url()?>inscripcion/gestion_inscripcion/alumno"><i class="fa fa-list-alt"></i> Inscripcion Alumno.</a></li> 
				  </ul>
				</li>
				<li class="treeview">
				  <a href="#"><i class="fa fa-line-chart"></i> <span>Reportes.</span> <i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
					<li><a href="<?php echo base_url()?>reporte/gestion_reportes/horarios"><i class="fa fa-id-card-o"></i> Horarios.</a></li>
					<li><a href="<?php echo base_url()?>reporte/gestion_reportes/asignacion_alumno"><i class="fa fa-id-card"></i> Inscripcion Alumno.</a></li> 
				  </ul>
				</li>
				<?php
				}elseif($id_tipo=='3'){
					?>
					 
					<?php
				}elseif($id_tipo=='4'){
					?>
					 
					<?php
				}elseif($id_tipo=='5'){
					?>
					 
					<?php
				}
				?>
			  </ul><!-- /.sidebar-menu -->
			</section>

      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
			  <div class="miestilo2">
			  <?php
			  echo $name_empresa;
			  ?>
				<small><?php echo $fecha; ?></small>
				<?php
				if($id_tipo!=1){
					//echo "<small><b>|| CIUDAD:</b> ".strtoupper($ciudad)."</small>";
				}
				?> 
				</div>			
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>inicio"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Inicio</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class='row'>
			   <?php 
			  if(isset($content_for_layout)){
				echo $content_for_layout;
			  }
			?>
			</div>
              
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
         <footer class="main-footer">
			<!-- To the right -->
			<div class="pull-right hidden-xs">
			  Soluciones en Informatica.
			</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; <?php echo date("Y")?> Soluciones en Informatica | <a href=''></a></strong> | All rights reserved.
		  </footer>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper --> 
  </body>
</html>
