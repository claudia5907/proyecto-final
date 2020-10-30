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
		$("#aula2").change(function(){
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
		$("#form_editar_asignacion").validate({
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
				$("#form_editar_asignacion").on("submit", function(event){
					event.preventDefault();
					var parametros=new FormData($(this)[0]);
					 
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>asignacion/gestion_asignacion/insert_update_asignacion/<?php echo $resp['ID_ASIG']?>",
						data: parametros, 
						dataType: "html",
						contentType: false, //importante enviar este parametro en false
						processData: false, //importante enviar este parametro  
						success: function(msg){
							$("#modal_editar_asignacion").modal("hide");
							pone_asignaciones_registrados();	
						}
					}); 
				});	  	
		    } 
		}); 
	});
	function fn_cerrar_ventana()
    {
		$("#modal_editar_asignacion").modal("hide");
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
					<form class="form-horizontal" method="post"  enctype="multipart/form-data" action="#" id="form_editar_asignacion" autocomplete="off">
						<div class='box-body'> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-3 control-label">Grupo:</label>
								<div class="col-sm-8">
								<input type="text" class="form-control" id='nombre' name='nombre' placeholder='Nombre Grupo...' value="<?php echo $resp['GRUPO'] ?>">
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-3 control-label">Materia:</label>
								<div class="col-sm-8">
									<select name="materia" id="materia" class="form-control">
										<option value="">Seleccione...</option>
										<?php 
										$i=1;
										$respMat=$this->materia_model->getListaMateria();
										if($respMat){
											foreach($respMat as $materia){
												$selected = ($materia['ID_MATERIA'] == $resp["ID_MATERIA"]) ? 'selected = "selected"' : '';
												?>
												<option value="<?php echo $materia['ID_MATERIA'] ?>" <?php echo $selected ?>><?php echo $i.".- [".strtoupper($materia['COD_MATERIA']."] ".$materia['NOMB_MATERIA']) ?></option>
												<?php
												$i++;
											}
										}
										?> 
									</select> 
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-3 control-label">Docente:</label>
								<div class="col-sm-8">
									<select name="docente" id="docente" class="form-control">
										<option value="">Seleccione...</option>
										<?php 
										$i=1;
										$respDoc=$this->personal_model->getPersonaDocente();
										if($respDoc){
											foreach($respDoc as $docente){
												$selected = ($docente['ID_PRS'] == $resp["ID_PRS"]) ? 'selected = "selected"' : '';
												?>
												<option value="<?php echo $docente['ID_PRS'] ?>" <?php echo $selected ?>><?php echo $i.".- ".strtoupper($docente['NOMBRES_DOC']." ".$docente['APELLIDO_PATERNO']) ?></option>
												<?php
												$i++;
											}
										}
										?> 
									</select>
								</div>
							</div>	
							<div class='form-group'>
								<label for="codigo" class="col-sm-3 control-label">Nivel:</label>
								<div class="col-sm-8">
									<select name="nivel" id="nivel" class="form-control">
										<option value="">Seleccione...</option>
										<?php 
										$i=1;
										$respNivel=$this->materia_model->getListaNivel();
										if($respNivel){
											foreach($respNivel as $nivel){
												$selected = ($nivel['ID_NIVEL'] == $resp["ID_NIVEL"]) ? 'selected = "selected"' : '';
												?>
												<option value="<?php echo $nivel['ID_NIVEL'] ?>" <?php echo $selected ?>><?php echo $i.".- ".strtoupper($nivel['NOMB_NIVEL']) ?></option>
												<?php
												$i++;
											}
										}
										?> 
									</select> 
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-3 control-label">Aula:</label>
								<div class="col-sm-8">
									<select name="aula2" id="aula2" class="form-control">
										<option value="">Seleccione...</option>
										<?php 
										$i=1;
										$respAula=$this->aula_model->getListaAula();
										if($respAula){
											foreach($respAula as $aula){
												$selected = ($aula['ID_AULA'] == $resp["ID_AULA"]) ? 'selected = "selected"' : '';
												?>
												<option value="<?php echo $aula['ID_AULA'] ?>" <?php echo $selected ?>><?php echo $i.".- ".strtoupper($aula['NOMB_AULA']) ?></option>
												<?php
												$i++;
											}
										}
										?> 
									</select>
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-3 control-label">Horarios:</label>
								<div class="col-sm-8">
									<select name="horario" id="horario" class="form-control">
										<option value="">Seleccione...</option>
										<?php  
										$respTurno=$this->materia_model->getListaTurno();
										if($respTurno){
											foreach($respTurno as $turno){
												?>
												<optgroup label="<?php echo strtoupper($turno['TURNO']) ?>">
												<?php 
												    $i=1;
													$respHorario=$this->materia_model->getListaTurnoHorario($turno['ID_TURNO']);
													if($respHorario){
														foreach($respHorario as $horario){
															$selected = ($horario['ID_HORARIO'] == $resp["ID_HORARIO"]) ? 'selected = "selected"' : '';
															?>
															<option value="<?php echo $horario['ID_HORARIO'] ?>"  <?php echo $selected ?>><?php echo $i.".- ".strtoupper($horario['HORARIO_INI']." A ".$horario['HORARIO_FIN'] ) ?></option>
															<?php
															$i++;
														}
													}
												?>
												</optgroup>
												<?php
												
											}
										}
										?> 
									</select>
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-3 control-label">Cupo:</label>
								<div class="col-sm-8">
								<input type="number" class="form-control" id='cupo' name='cupo' placeholder='Capacidad grupo...' value="<?php echo $resp['CUPO'] ?>">
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