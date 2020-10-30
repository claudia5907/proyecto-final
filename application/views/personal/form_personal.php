<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title><?php echo $titulo?></title>
    <!-- Main CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>resources/css/main.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url()?>resources/dist/css/ioniconss.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url()?>resources/plugins/iCheck/square/blues.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->  
	
	<script src="<?php echo base_url()?>resources/js/main.js"></script> 
    <script src="<?php echo base_url()?>resources/plugins/fastclick/fastclick.min.js"></script> 
	<script src="<?php echo base_url()?>resources/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
	<link href="<?php echo base_url()?>resources/plugins-/dataTables/media/css/demo_table_jui--.css" media="screen" rel="stylesheet" type="text/css"/>
    <!--<script src="<?php echo base_url()?>resources/dist/js/source_parameters.js"></script>-->
	 
	<script type="text/javascript">
	$(document).ready(function()
	{
		 
		$("#form_editar_alumno").validate({
			rules: {
				nombre: { required: true,lettersonly: true},
				apellidoPaterno: { required: true,lettersonly: true },
				apellidoMaterno: { required: true,lettersonly: true }, 
				ci:{ required: true, number:true,min: 1 }, 	 				
				dia: { required: true },
				mes: { required: true },
				anio: { required: true },
				direccion: { required: true },
				mail: { required: true, email: true },
				customFile1:{accept: "jpg|jpeg|png|ico|bmp"} 
			},
			messages: {
				nombre: { required: "<font color='red'>Campo requerido</font>",lettersonly:"<font color='red'>Ingrese solo letras</font>"},
				apellidoPaterno: { required: "<font color='red'>Campo Requerido",lettersonly:"<font color='red'>Ingrese solo letras</font>"},
				apellidoMaterno: { required: "<font color='red'>Campo Requerido",lettersonly:"<font color='red'>Ingrese solo letras</font>"},    
				 
				ci: { required: "<font color='red'>Campo Requerido",number:"<font color='red'>Solo valor Numerico</font>", min:"<font color='red'>Mayor a 0</font>"}, 
				dia: { required: "<font color='red'>Campo Requerido</font>"},
				mes: { required: "<font color='red'>Campo Requerido</font>"},
				anio: { required: "<font color='red'>Campo Requerido</font>"},
				direccion: { required: "<font color='red'>Campo Requerido</font>"},
				mail: { required: "<font color='red'>Campo Requerido</font>", email: "<font color='red'>Ingrese un Email valido</font>"},
				customFile1:{accept: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."} 
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
				$("#form_editar_alumno").on("submit", function(event){
					event.preventDefault();
					var parametros=new FormData($(this)[0]);
					 
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>personal/gestion_personal/insert_update_personal/<?php echo $resp['ID_PRS']?>",
						data: parametros, 
						dataType: "html",
						contentType: false, //importante enviar este parametro en false
						processData: false, //importante enviar este parametro  
						success: function(msg){
							$("#modal_editar_estudiante").modal("hide");
							pone_personal_registrados();	
						}
					}); 
				}); 	
		    } 
		});	
	});
	function fn_cerrar_ventana()
    {
		$("#modal_editar_estudiante").modal("hide");
	}	
	 
	</script> 
  </head>
  <body>
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="width: 500px !important;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px; !important">
				<h4 class="modal-title miestilo" id="exampleModalLongTitle"><b>Editar Informacion Estudiante</b></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class="modal-body" style="padding: 10px; !important">
				<div class="panel-body" style="padding: 0px; !important">
					<form class="form-horizontal" method="post"  enctype="multipart/form-data" action="#" id="form_editar_alumno" autocomplete="off">
						<div class='box-body'> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Nombre(s):</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" id='nombre' name='nombre' placeholder='Nombres...' value="<?php echo $resp['NOMB_PRS'] ?>">
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Apellido Paterno:</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" id='apellidoPaterno' name='apellidoPaterno' placeholder='Apellido Paterno...' value="<?php echo $resp['APELLIDO_PATERNO'] ?>">
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Apellido Materno:</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" id='apellidoMaterno' name='apellidoMaterno' placeholder='Apellido Materno...' value="<?php echo $resp['APELLIDO_MATERNO'] ?>">
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Ci:</label>
								<div class="col-sm-6">
								<input type="number" class="form-control" id='ci' name="ci" placeholder='Cedula identidad...' value="<?php echo $resp['CI_PRS'] ?>">
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Direccion:</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" id='direccion' name='direccion' placeholder='Direccion...' value="<?php echo $resp['DIR_PRS'] ?>">
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Email:</label>
								<div class="col-sm-6">
								<input type="mail" class="form-control" id='mail' name="mail" placeholder='Email ...' value="<?php echo $resp['EMAIL_ALUMNO'] ?>">
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Foto:</label>
								<div class="col-sm-6">
									<input type="file" class="form-control custom-file-input" id="customFile1"  name="customFile1" accept="image/*" >
								</div>
							</div> 	
						</div>
						<div class='box-footer'>
							<button type='submit' class='btn btn-primary pull-right' id='btn-reg-usr'><i class="fa fa-pencil-square-o"></i> Modificar</button> 
							<button type='button' class='btn btn-primary pull-right' id='btn-reg-usr' onClick="fn_cerrar_ventana()"><i class="fa fa-pencil-square-o"></i> Cancelar</button>
							<input type="hidden" id="tipo" name="tipo" value="update" />
						</div> 
					</form>
				 </div> 
					</div> 
				</div> 
			</div> 
   
  </body>
</html>