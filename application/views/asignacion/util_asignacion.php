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
		$("#form_insert_asignar").validate({
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
				$("#form_insert_asignar").on("submit", function(event){
					event.preventDefault();
					var parametros=new FormData($(this)[0]);
					 
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>asignacion/gestion_asignacion/insert_update_asignacion",
						data: parametros, 
						dataType: "html",
						contentType: false, //importante enviar este parametro en false
						processData: false, //importante enviar este parametro  
						success: function(msg){
							$("#nombre").val("");
							$("#materia").val("");
							$("#docente").val("");
							$("#nivel").val("");
							$("#aula").val("");
							$("#horario").val("");
							$("#cupo").val("");
							pone_asignaciones_registrados(); 
						}
					}); 
				});  	
		    } 
		});
		
        $("#aula").change(function(){
		   // console.log("select"+$(this).val());
			var aula=$(this).val();  
			  
			$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>asignacion/gestion_asignacion/get_lista_horarios",
					data: "aula="+aula,
					beforeSend: function() {},
					success:function(msg){
						$("#horario").empty().removeAttr("disabled").append(msg);	
						 
					},
					error: function(){}
				}); 
		   
		}); 		
	});
	 		
	/***********************************************************************************/
	function pone_asignaciones_registrados()
	{
	    $.ajax({
		  beforeSend: function(){ 
				$("#asignaciones_registrados").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
		   },
		  url: '<?php echo base_url()?>asignacion/gestion_asignacion/pone_asignacion_regs',
		  type: 'POST',
		  data: null,
		  success: function(x){
				$("#asignaciones_registrados").html(x);
			 },
		   error: function(jqXHR,estado,error){
				$("#asignaciones_registrados").html('Hubo un error: '+estado+' '+error);
				alert("Hubo un error al consultar Asignaciones registrados, contacte a soporte inmediatamente...!");
		   }
		});
	}
	/*******************************************************************************/	
    function eliminar_asignacion(id)
	{
		swal({
		  title: '¿Estás seguro?',
		  text: "Quieres eliminar la asignacion seleccionada?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar',
		  cancelButtonText: 'No'
		}).then(function () {
			$.ajax({
			  beforeSend: function(){
					$("#asignaciones_registrados").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
			   },
			  url: '<?php echo base_url()?>asignacion/gestion_asignacion/eliminar_asignacion/'+id,
			  type: 'POST',
			  data: null,
			  success: function(x){
					
					pone_asignaciones_registrados();
				 },
			   error: function(jqXHR,estado,error){
				 $("#asignaciones_registrados").html('Hubo un error: '+estado+' '+error);
				 alert("Hubo un error al consultar asignaciones registrados, contacte a soporte inmediatamente...!");
			   }
			}); 
		}); 
	}	
	function editar_asignacion(id)
	{
		$.ajax({
		  beforeSend: function(){ 
				$("#modal_editar_asignacion").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
		   },
		  url: '<?php echo base_url()?>asignacion/gestion_asignacion/mostrar_form_editar_asignacion',
		  type: 'POST',
		  data: {id:id},
		  success: function(x){
				$("#modal_editar_asignacion").html(x);
			 },
		   error: function(jqXHR,estado,error){
				$("#modal_editar_asignacion").html('Hubo un error: '+estado+' '+error);
				alert("Hubo un error al consultar asignacion registrados, contacte a soporte inmediatamente...!");
		   }
		});
	}
	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Only alphabetical characters");
	</script>
	
	
	
  </head>
  <body onload="pone_asignaciones_registrados();">
        <!-- Main content -->
        <section class="content">
        <div class='row'>
			<div class='col-md-12'> 
				<div class='box box-warning'>
					<div class="box-header with-border">
						<h3 class='miestilo'>Crear Nueva Asignacion</h3>
					</div>
					<form class="form-horizontal" method="post"   enctype="multipart/form-data" action="#" id="form_insert_asignar" autocomplete="off">
						<div class='box-body'> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Nombre Grupo:</label>
								<div class="col-sm-5">
								<input type="text" class="form-control" id='nombre' name='nombre' placeholder='Nombre Grupo...' value="">
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Materia:</label>
								<div class="col-sm-5">
									<select name="materia" id="materia" class="form-control">
										<option value="">Seleccione...</option>
										<?php 
										$i=1;
										$respMat=$this->materia_model->getListaMateria();
										if($respMat){
											foreach($respMat as $materia){
												?>
												<option value="<?php echo $materia['ID_MATERIA'] ?>"><?php echo $i.".- [".strtoupper($materia['COD_MATERIA']."] ".$materia['NOMB_MATERIA']) ?></option>
												<?php
												$i++;
											}
										}
										?> 
									</select> 
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Docente:</label>
								<div class="col-sm-5">
									<select name="docente" id="docente" class="form-control">
										<option value="">Seleccione...</option>
										<?php 
										$i=1;
										$respDoc=$this->personal_model->getPersonaDocente();
										if($respDoc){
											foreach($respDoc as $docente){
												?>
												<option value="<?php echo $docente['ID_PRS'] ?>"><?php echo $i.".- ".strtoupper($docente['NOMBRES_DOC']." ".$docente['APELLIDO_PATERNO']) ?></option>
												<?php
												$i++;
											}
										}
										?> 
									</select>
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Nivel:</label>
								<div class="col-sm-5">
									<select name="nivel" id="nivel" class="form-control">
										<option value="">Seleccione...</option>
										<?php 
										$i=1;
										$respNivel=$this->materia_model->getListaNivel();
										if($respNivel){
											foreach($respNivel as $nivel){
												?>
												<option value="<?php echo $nivel['ID_NIVEL'] ?>"><?php echo $i.".- ".strtoupper($nivel['NOMB_NIVEL']) ?></option>
												<?php
												$i++;
											}
										}
										?> 
									</select> 
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Aula:</label>
								<div class="col-sm-5">
									<select name="aula" id="aula" class="form-control">
										<option value="">Seleccione...</option>
										<?php 
										$i=1;
										$respAula=$this->aula_model->getListaAula();
										if($respAula){
											foreach($respAula as $aula){
												?>
												<option value="<?php echo $aula['ID_AULA'] ?>"><?php echo $i.".- ".strtoupper($aula['NOMB_AULA']) ?></option>
												<?php
												$i++;
											}
										}
										?> 
									</select>
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Horarios:</label>
								<div class="col-sm-5">
									
									<select name="horario" id="horario" class="form-control">  
									</select>
									
									 
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Cupo:</label>
								<div class="col-sm-5">
								<input type="number" class="form-control" id='cupo' name='cupo' placeholder='Capacidad grupo...' value="">
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
				<div id='asignaciones_registrados'></div>
			</div>
        </div>
        </section>
        <div class="modal fade " id="modal_editar_asignacion" style="overflow-y: scroll;overflow:hidden;" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"></div>

   
  </body>
</html>