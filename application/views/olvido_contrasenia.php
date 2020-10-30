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
	<script type="text/javascript" src="<?php echo base_url() ?>resources/js/jquery/jquery.validate.js"></script>
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
	$(document).ready(function()
	{
		$("#formulario_recuperacion").validate({
			rules: {
				 
				email: { required: true, email: true } 
			},
			messages: {
				 
				mail: { required: "<font color='red'>Campo Requerido</font>", email: "<font color='red'>Ingrese un Email valido</font>"}  
			}, 
			success: function ( label, element ) {
				// Add the span element, if doesn't exists, and apply the icon classes to it.
				if ( !$( element ).next( "span" )[ 0 ] ) {
					$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
				}
			},
			errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-6" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
			highlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
				$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
			},
			unhighlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
				$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
			},
		    submitHandler: function() {
				 alert("Mensaje enviado"); 	
		    } 
		});
	});
	function fn_redireecionar()
	{
		url="<?php echo base_url()?>ingreso";
		window.location.replace(url);
	}
	</script>
  </head>
  <body background="<?php echo base_url() ?>resources/img/fondo.jpg">
  <div class="transp-block"  >
    <!--<center><img class="transparent" src="<?php echo base_url()?>resources/img/maprial_logo.jpg" alt="" align="center"/></center>-->
    <form action="#" method="post" class="AjaxForms MainLogin" id="formulario_recuperacion" data-type-form="login" autocomplete="off">
        <p style="text-align: center"><img width="210" src="<?php echo base_url() ?>resources/img/new_logo.png" class="logo" /></p>
		<!--<p class="text-center text-muted lead text-uppercase">login</p>-->
        <div class="form-group">
          <label class="control-label" for="UserName">E-mail</label>
          <input class="form-control" name="email" id="email" type="text" placeholder='Ingrese su Email...'>
        </div>
        
        <p class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>        
        </p>
		<p class="text-center">
            <button type="button" onClick="fn_redireecionar()" class="btn btn-primary btn-block">Volver a login?</button>        
        </p>
    </form>

    <div class="MsjAjaxForm"></div>
   
	</div>
  </body>
 
</html>
