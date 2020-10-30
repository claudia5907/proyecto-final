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
	});
	 		
	 
	</script> 
  </head>
  <body>
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="width: 500px !important;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px; !important">
				<h4 class="modal-title miestilo" id="exampleModalLongTitle"><b>Informacion Estudiante</b></h4>
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
								<div class="col-sm-8">
								<input type="text" class="form-control" id='nombre' name='nombre' placeholder='Nombres...' value="<?php echo $resp['NOMB_PRS'] ?>" disabled>
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Apellido Paterno:</label>
								<div class="col-sm-8">
								<input type="text" class="form-control" id='apellidos' name='apellidos' placeholder='Apellido Paterno...' value="<?php echo $resp['APELLIDO_PATERNO'] ?>" disabled>
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Apellido Materno:</label>
								<div class="col-sm-8">
								<input type="text" class="form-control" id='apellidos' name='apellidos' placeholder='Apellido Materno...' value="<?php echo $resp['APELLIDO_MATERNO'] ?>" disabled>
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Ci:</label>
								<div class="col-sm-5">
								<input type="number" class="form-control" id='ci' name="ci" placeholder='Cedula identidad...' value="<?php echo $resp['CI_PRS'] ?>" disabled>
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Direccion:</label>
								<div class="col-sm-8">
								<input type="text" class="form-control" id='direccion' name='direccion' placeholder='Direccion...' value="<?php echo $resp['DIR_PRS'] ?>" disabled>
								</div>
							</div>
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Email:</label>
								<div class="col-sm-8">
								<input type="mail" class="form-control" id='mail' name="mail" placeholder='Email ...' value="<?php echo $resp['EMAIL_ALUMNO'] ?>" disabled>
								</div>
							</div> 
							<div class='form-group'>
								<label for="codigo" class="col-sm-2 control-label">Foto:</label>
								<div class="col-sm-8">
								  <image src="<?php echo base_url()?>resources/files/estudiante/<?php echo $resp['FOTO_NOMB'] ?>" style="width:200px; height:200px" />
								</div>
							</div> 
						</div> 
					</form>
				 </div> 
					</div> 
				</div> 
			</div> 
   
  </body>
</html>