<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $titulo?></title>
	<link rel="shortcut icon" href="<?php echo base_url()?>resources/imagenes/favicon.ico" />
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Main CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>resources/css/main.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url()?>resources/dist/css/ionicons.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url()?>resources/dist/plugins/iCheck/square/blue.css">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		.transp-block {
			/*background: #000 url(<?php echo base_url()?>resources/img/maprial_logo.jpg) no-repeat;*/
			width: 851px;
			height: 315px; 
		}
		img.transparent {
			filter:alpha(opacity=75);
			opacity:.75;
		}
		 
		.fondo-radial {
			width: 100%; 
			height: auto; 
			margin: 0 auto; 
			background-position: center center; 
			background: -webkit-radial-gradient(circle, red, white); 
			background: -moz-radial-gradient(circle, red, white); 
			background: -ms-radial-gradient(circle, red, white); 
			background: radial-gradient(circle, red, white);
		}
	</style>
	<script type="text/javascript">
	function fn_olvido_contrasenia()
	{
		url="<?php echo base_url()?>ingreso/olvido_contrasenia";
		window.location.replace(url);
	}
	</script>
  </head>
  <body background="<?php echo base_url() ?>resources/img/fondo.jpg">
  <div class="transp-block"  >
    <!--<center><img class="transparent" src="<?php echo base_url()?>resources/img/maprial_logo.jpg" alt="" align="center"/></center>-->
    <form action="<?php echo base_url()?>ingreso/validar" method="post" class="AjaxForms MainLogin" data-type-form="login" autocomplete="off">
        <p style="text-align: center"><img width="210" src="<?php echo base_url() ?>resources/img/new_logo.png" class="logo" /></p>
		<!--<p class="text-center text-muted lead text-uppercase">login</p>-->
        <div class="form-group">
          <label class="control-label" for="UserName">Usuario</label>
          <input class="form-control" name="usuario" id="UserName" type="text" required="">
        </div>
        <div class="form-group">
          <label class="control-label" for="Pass">Contraseña</label>
          <input class="form-control" name="pass" id="Pass" type="password" required="">
        </div>
        <p class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>        
        </p>
		<p class="text-center">
            <button type="button" onClick="fn_olvido_contrasenia()" class="btn btn-primary btn-block">Olvido sus datos de acceso?</button>        
        </p>
    </form>

    <div class="MsjAjaxForm"></div>
    <!-- jQuery 3.1.1 -->
	<script src="<?php echo base_url()?>resources/js/jquery-3.1.1.min.js"></script>
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
	 
	</div>
  </body>
 
</html>
