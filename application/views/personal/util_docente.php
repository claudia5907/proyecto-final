<?php 
$var_hola=$this->session->userdata("nombre_de_usuario");

?>
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
		$("#form_edit_insert_docente").validate({
			rules: {
				nombre: { required: true,lettersonly: true},
				apellidoPaterno: { required: true,lettersonly: true },
				apellidoMaterno: { required: true,lettersonly: true }, 
				ci:{required: true,
				    remote: {
							url: "<?php echo base_url(); ?>personal/gestion_personal/verificar_ci_docente",
							type: "post",
							data: { id_prs: function() { return $("#id_prs").val(); } }
					}
 				}, 				
				dia: { required: true },
				mes: { required: true },
				anio: { required: true },
				direccion: { required: true },
				especialidad: { required: true },
				mail: { required: true, email: true },
				customFile1:{ required: true ,  accept: "jpg|jpeg|png|ico|bmp"} 
			},
			messages: {
				nombre: { required: "<font color='red'>Campo requerido</font>",lettersonly:"<font color='red'>Ingrese solo letras</font>"},
				apellidoPaterno: { required: "<font color='red'>Campo Requerido",lettersonly:"<font color='red'>Ingrese solo letras</font>"},
				apellidoMaterno: { required: "<font color='red'>Campo Requerido",lettersonly:"<font color='red'>Ingrese solo letras</font>"},    
				 
				ci: { required: "<font color='red'>Campo Requerido",remote: "<font color='red'>Ya existe esta Cedula</font>"}, //number:"<font color='red'>Solo valor Numerico</font>"
				dia: { required: "<font color='red'>Campo Requerido</font>"},
				mes: { required: "<font color='red'>Campo Requerido</font>"},
				anio: { required: "<font color='red'>Campo Requerido</font>"},
				direccion: { required: "<font color='red'>Campo Requerido</font>"},
				especialidad: { required: "<font color='red'>Campo Requerido</font>"},
				mail: { required: "<font color='red'>Campo Requerido</font>", email: "<font color='red'>Ingrese un Email valido</font>"},
				customFile1:{ required: "<font color='red'>Campo Requerido</font>",accept: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."} 
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
				$("#form_edit_insert_docente").on("submit", function(event){
					event.preventDefault();
					var parametros=new FormData($(this)[0]);
					 
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>personal/gestion_personal/insert_update_personal_docente",
						data: parametros, 
						dataType: "html",
						contentType: false, //importante enviar este parametro en false
						processData: false, //importante enviar este parametro  
						success: function(msg){
							$("#nombre").val("");
							$("#apellidoPaterno").val("");
							$("#apellidoMaterno").val("");
							$("#ci").val("");
							$("#direccion").val("");
							$("#mail").val("");
							$("#customFile1").val("");
							$("#dia").val("");
							$("#mes").val("");
							$("#anio").val("");
							$("#especialidad").val("");
							pone_personal_registrados_docente(); 
						}
					}); 
				}); 	
		    } 
		});
		
	});
	 		
	/***********************************************************************************/
	function pone_personal_registrados_docente()
	{
	    $.ajax({
		  beforeSend: function(){ 
				$("#personal_registrados_docente").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
		   },
		  url: '<?php echo base_url()?>personal/gestion_personal/pone_personal_regs_docente',
		  type: 'POST',
		  data: null,
		  success: function(x){
				$("#personal_registrados").html(x);
				$('#tabla_estudiante').dataTable( {
					"sDom": '<"H"Cfr>t<"F"ip>',
					"bJQueryUI": true,
					"bPaginate": false, 
					"sScrollY": 400,
					"bInfo": false,
					"bSort": false 
				});
				 
			 },
		   error: function(jqXHR,estado,error){
				$("#personal_registrados_docente").html('Hubo un error: '+estado+' '+error);
				alert("Hubo un error al consultar docente registrados, contacte a soporte inmediatamente...!");
		   }
		});
	}
	/*******************************************************************************/	
    function eliminar_docente(id,estado)
	{
		if(estado==0){
			msg='Activar';
		}else{
			msg='Inactivar';
		}
		swal({
		  title: '¿Estás seguro?',
		  text: "Quieres "+msg+" al Docente seleccionado?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si,',
		  cancelButtonText: 'No'
		}).then(function () {
			$.ajax({
			  beforeSend: function(){
					$("#personal_registrados").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
			   },
			  url: '<?php echo base_url()?>personal/gestion_personal/eliminar_personal_docente/'+id+'/'+estado,
			  type: 'POST',
			  data: null,
			  success: function(x){
					
					pone_personal_registrados_docente();
				 },
			   error: function(jqXHR,estado,error){
				 $("#personal_registrados").html('Hubo un error: '+estado+' '+error);
				 alert("Hubo un error al consultar docente registrados, contacte a soporte inmediatamente...!");
			   }
			}); 
		}); 
	}	
	function editar_docente(id)
	{
		$.ajax({
		  beforeSend: function(){ 
				$("#modal_editar_docente").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
		   },
		  url: '<?php echo base_url()?>personal/gestion_personal/mostrar_form_editar_docente',
		  type: 'POST',
		  data: {id:id},
		  success: function(x){
				$("#modal_editar_docente").html(x);
			 },
		   error: function(jqXHR,estado,error){
				$("#modal_editar_docente").html('Hubo un error: '+estado+' '+error);
				alert("Hubo un error al consultar usuarios registrados, contacte a soporte inmediatamente...!");
		   }
		});
	}
	function fn_mostrar_datos_docente(id)
	{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>personal/gestion_personal/mostrar_foto_docente",
			data: {id:id}, 
			 
			success: function(msg){
				$("#modal_info_datos_docente").html(msg);	 
			}
		}); 
	}
	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Only alphabetical characters");
	</script>
	
	
	
  </head>
  <body onload="pone_personal_registrados_docente();">
        <!-- Main content -->
        <section class="content">
        <div class='row'>
			<div class='col-md-12'> 
				<div class='box box-warning'>
					<div class="box-header with-border">
						<h3 class='miestilo'>Crear Nuevo Docente</h3>
					</div>
					<form class="form-horizontal" method="post"   enctype="multipart/form-data" action="#" id="form_edit_insert_docente" autocomplete="off">
						<div class='box-body'> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Nombre(s):</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" id='nombre' name='nombre' placeholder='Nombres...'>
								</div>
							</div> 
							<div class='form-group'>
								<label for="apellidoPaterno" class="col-sm-2 control-label">Apellido Paterno:</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" id='apellidoPaterno' name='apellidoPaterno' placeholder='Apellido Paterno...'>
								</div>
							</div>
							<div class='form-group'>
								<label for="apellidoMaterno" class="col-sm-2 control-label">Apellido Materno:</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" id='apellidoMaterno' name='apellidoMaterno' placeholder='Apellido Materno...'>
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Ci:</label>
								<div class="col-sm-2">
								<input type="text" class="form-control" id='ci' style="text-transform:uppercase;"  name="ci" placeholder='Cedula identidad...'>
								<input type="hidden" id="id_prs" name="id_prs" value=""/>
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Fecha Nac.:</label>
								<div class="col-sm-2">
									<select id="dia" name="dia" class="form-control">
										<option value="" disabled>Dia</option>
									    <?php
											for($i=1;$i<=31;$i++){
										?>
										<option value="<?php echo $i ?>"><?php echo $i ?></option>
										<?php 
											}
										?>
									</select> 
								</div>
								<div class="col-sm-2">
									<select id="mes" name="mes" class="form-control">
										<option value="" disabled>Mes</option>
									    <?php
										$array=array();
										$array[1]="Enero";
										$array[2]="Febrero";
										$array[3]="Marzo";
										$array[4]="Abril";
										$array[5]="Mayo";
										$array[6]="Junio";
										$array[7]="Julio";
										$array[8]="Agosto";
										$array[9]="Septiembre";
										$array[10]="Octubre";
										$array[11]="Noviembre";
										$array[12]="Diciembre";
											for($j=1;$j<=count($array);$j++){
										?>
										<option value="<?php echo $j ?>"><?php echo $array[$j] ?></option>
										<?php 
											}
										?>
									</select> 
								</div>
								<div class="col-sm-2">
									<select id="anio" name="anio" class="form-control">
										<option value="" disabled>Año</option>
									    <?php
											for($i=2015;$i>=1980;$i--){
										?>
										<option value="<?php echo $i ?>"><?php echo $i ?></option>
										<?php 
											}
										?>
									</select> 
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Direccion:</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" id='direccion' name='direccion' placeholder='Direccion...' >
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Email:</label>
								<div class="col-sm-6">
								<input type="mail" class="form-control" id='mail' name="mail" placeholder='Email ...'>
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Foto:</label>
								<div class="col-sm-6">
								<input type="file" class="form-control custom-file-input" id="customFile1"  name="customFile1" accept="image/*">
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Especialidad:</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" id='especialidad' name='especialidad' placeholder='Direccion...' >
								</div>
							</div>
						</div>
						<div class='box-footer'>
							<input type='submit' class='btn btn-primary pull-right' id='btn-reg-usr' value='Registrar'>
							<input type="hidden" id="tipo" name="tipo" value="insert" />
						</div>
					</form>
				 </div> 
			 </div> 
			<div class='col-md-12'>
				<div id='personal_registrados'></div>
			</div>
        </div>
        </section>
        <div class="modal fade " id="modal_editar_docente" style="overflow-y: scroll;overflow:hidden;" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"></div>
        <div class="modal fade " id="modal_info_datos_docente" style="overflow-y: scroll;overflow:hidden;" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"></div>

   
  </body>
</html>