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
    <script type="text/javascript" src="<?php echo base_url() ?>resources/js/jquery/jquery.validate.js"></script>
	 
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
				$("#form_insert_materia").on("submit", function(event){
					event.preventDefault();
					var parametros=new FormData($(this)[0]);
					 
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>materia/gestion_materia/insert_update_materia",
						data: parametros, 
						dataType: "html",
						contentType: false, //importante enviar este parametro en false
						processData: false, //importante enviar este parametro  
						success: function(msg){
							$("#nombre").val("");
							$("#descripcion").val("");
							$("#codigo").val("");
							pone_materia_registrados(); 
						}
					}); 
				});  	
		    } 
		});
			
	});
	 		
	/***********************************************************************************/
	function pone_materia_registrados()
	{
	    $.ajax({
		  beforeSend: function(){ 
				$("#materia_registrados").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
		   },
		  url: '<?php echo base_url()?>materia/gestion_materia/pone_materia_regs',
		  type: 'POST',
		  data: null,
		  success: function(x){
				$("#materia_registrados").html(x);
			 },
		   error: function(jqXHR,estado,error){
				$("#materia_registrados").html('Hubo un error: '+estado+' '+error);
				alert("Hubo un error al consultar materias registrados, contacte a soporte inmediatamente...!");
		   }
		});
	}
	/*******************************************************************************/	
    function eliminar_materia(id)
	{
		swal({
		  title: '¿Estás seguro?',
		  text: "Quieres eliminar la Materia seleccionada?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar',
		  cancelButtonText: 'No'
		}).then(function () {
			$.ajax({
			  beforeSend: function(){
					$("#materia_registrados").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
			   },
			  url: '<?php echo base_url()?>materia/gestion_materia/eliminar_materia/'+id,
			  type: 'POST',
			  data: null,
			  success: function(x){
					
					pone_materia_registrados();
				 },
			   error: function(jqXHR,estado,error){
				 $("#materia_registrados").html('Hubo un error: '+estado+' '+error);
				 alert("Hubo un error al consultar materias registrados, contacte a soporte inmediatamente...!");
			   }
			}); 
		}); 
	}	
	function editar_materia(id)
	{
		$.ajax({
		  beforeSend: function(){ 
				$("#modal_editar_materia").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
		   },
		  url: '<?php echo base_url()?>materia/gestion_materia/mostrar_form_editar',
		  type: 'POST',
		  data: {id:id},
		  success: function(x){
				$("#modal_editar_materia").html(x);
			 },
		   error: function(jqXHR,estado,error){
				$("#modal_editar_materia").html('Hubo un error: '+estado+' '+error);
				alert("Hubo un error al consultar materias registrados, contacte a soporte inmediatamente...!");
		   }
		});
	}
	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Only alphabetical characters");
	</script>
	
	
	
  </head>
  <body onload="pone_materia_registrados();">
        <!-- Main content -->
        <section class="content">
        <div class='row'>
			<div class='col-md-12'> 
				<div class='box box-warning'>
					<div class="box-header with-border">
						<h3 class='miestilo'>Crear Nueva Materia</h3>
					</div>
					<form class="form-horizontal" method="post"   enctype="multipart/form-data" action="#" id="form_insert_materia" autocomplete="off">
						<div class='box-body'> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Codigo Materia:</label>
								<div class="col-sm-5">
								<input type="text" class="form-control" id='codigo' name='codigo' placeholder='Codigo Materia...' required>
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Nombre:</label>
								<div class="col-sm-5">
								<input type="text" class="form-control" id='nombre' name='nombre' placeholder='Nombre Materia...' required>
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Descripcion:</label>
								<div class="col-sm-5">
								<input type="text" class="form-control" id='descripcion' name="descripcion" placeholder='Descripcion Materia...' required>
								</div>
							</div> 
							  
						</div>
						<div class='box-footer'>
							<button type='submit' class='btn btn-primary pull-right' id='btn-reg-usr'><i class="fa fa-user-plus"></i> Registrar</button>
							<input type="hidden" id="tipo" name="tipo" value="insert" />
						</div>
					</form>
				 </div> 
			 </div> 
			<div class='col-md-12'>
				<div id='materia_registrados'></div>
			</div>
        </div>
        </section>
        <div class="modal fade " id="modal_editar_materia" style="overflow-y: scroll;overflow:hidden;" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"></div>

   
  </body>
</html>