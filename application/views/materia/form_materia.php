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
		$("#form_insert_materia").validate({
			rules: {
				codigo: { required: true},
				nombre: { required: true,lettersonly: true },
				descripcion: { required: true} 
			},
			messages: {
				codigo: { required: "<font color='red'>Campo requerido</font>"},
				nombre: { required: "<font color='red'>Campo Requerido",lettersonly:"<font color='red'>Ingrese solo letras</font>"},
				descripcion: { required: "<font color='red'>Campo Requerido"} 
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
					element.parents( ".col-sm-5" ).addClass( "has-feedback" );

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
				$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
			},
			unhighlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
			},
		    submitHandler: function() {
				$("#form_editar_materia").on("submit", function(event){
					event.preventDefault();
					var parametros=new FormData($(this)[0]);
					 
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>materia/gestion_materia/insert_update_materia/<?php echo $resp['ID_MATERIA']?>",
						data: parametros, 
						dataType: "html",
						contentType: false, //importante enviar este parametro en false
						processData: false, //importante enviar este parametro  
						success: function(msg){
							$("#modal_editar_materia").modal("hide");
							pone_materia_registrados();	
						}
					}); 
				});	  	
		    } 
		}); 
	});
	function fn_cerrar_ventana()
    {
		$("#modal_editar_materia").modal("hide");
	}	 		
	 
	</script> 
  </head>
  <body>
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="width: 500px !important;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px; !important">
				<h4 class="modal-title miestilo" id="exampleModalLongTitle"><b>Editar Informacion Materia</b></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class="modal-body" style="padding: 10px; !important">
				<div class="panel-body" style="padding: 0px; !important">
					<form class="form-horizontal" method="post"  enctype="multipart/form-data" action="#" id="form_editar_materia" autocomplete="off">
						<div class='box-body'> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Codigo:</label>
								<div class="col-sm-8">
								<input type="text" class="form-control" id='codigo' name='codigo' placeholder='Codigo Materia...' value="<?php echo $resp['COD_MATERIA'] ?>">
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Nombre:</label>
								<div class="col-sm-8">
								<input type="text" class="form-control" id='nombre' name='nombre' placeholder='Nombre materia...' value="<?php echo $resp['NOMB_MATERIA'] ?>">
								</div>
							</div>
							 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Direccion:</label>
								<div class="col-sm-8">
								<input type="text" class="form-control" id='descripcion' name='descripcion' placeholder='Descripcion...' value="<?php echo $resp['DESC_MATERIA'] ?>">
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