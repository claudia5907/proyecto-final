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
			$("#form_usuario").validate({
				rules: {
					tipo_usr: { required: true},
					prs: { required: true},
					pass : {
						required: true,
						minlength : 5
					},
					pass2 : {
						required: true,
						minlength : 5,
						equalTo : "#pass"
					} 
				},
				messages: {
					tipo_usr: { required: "<font color='red'>Campo requerido</font>"},
					prs: { required: "<font color='red'>Campo requerido</font>"},
					pass: { required: "<font color='red'>Campo Requerido",minlength:"<font color='red'>Minimo 5 caracteres</font>"},
					pass2: { required: "<font color='red'>Campo Requerido",minlength:"<font color='red'>Minimo 5 caracteres</font>",equalTo:"<font color='red'>Las contraseñas no son iguales.</font>"} 
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
					$("#form_usuario").on("submit", function(event){
						event.preventDefault();
						var parametros=new FormData($(this)[0]);
						 
						$.ajax({
							type: "POST",
							url: "<?php echo base_url(); ?>usuarios/gestion_usuarios/registra_users",
							data: parametros, 
							dataType: "html",
							contentType: false, //importante enviar este parametro en false
							processData: false, //importante enviar este parametro  
							success: function(msg){
								$("#clave").val("");
								$("#pass").val(""); 
								pone_users_registrados(); 
							}
						});  
					});  	
				} 
			});
		});
 		
	/***********************************************************************************/
	function pone_users_registrados()
	{
	   $.ajax({
		  beforeSend: function(){ 
				$("#users_registrados").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
		   },
		  url: '<?php echo base_url()?>usuarios/gestion_usuarios/pone_users_regs',
		  type: 'POST',
		  data: null,
		  success: function(x){
			 $("#nombre").val("");
			 $("#clave").val("");
			 $("#tipo_usr").val("");
			 $("#pass").val("");
			 $("#users_registrados").html(x);
			 },
		   error: function(jqXHR,estado,error){
			 $("#users_registrados").html('Hubo un error: '+estado+' '+error);
			 alert("Hubo un error al consultar usuarios registrados, contacte a soporte inmediatamente...!");
		   }
		});
	}
	/*******************************************************************************/	
    function eliminar_usr(id,estado)
	{
		if(estado==0){
			msg='Activar';
		}else{
			msg='Inactivar';
		}
		swal({
		  title: '¿Estás seguro?',
		  text: "Quieres "+msg+" al usuario seleccionado?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si',
		  cancelButtonText: 'No'
		}).then(function () {
			$.ajax({
			  beforeSend: function(){
					$("#users_registrados").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Espere un momento...</span>');
			   },
			  url: '<?php echo base_url()?>usuarios/gestion_usuarios/eliminar_usr/'+id+'/'+estado,
			  type: 'POST',
			  data: null,
			  success: function(x){
					var Tn = noty({
						text: "Se completo la solicitud correctamente.",
						theme: 'relax',
						layout: 'center',
						type: 'information',
						timeout: 3000,
					});
					pone_users_registrados();
				 },
			   error: function(jqXHR,estado,error){
				 $("#users_registrados").html('Hubo un error: '+estado+' '+error);
				 alert("Hubo un error al consultar usuarios registrados, contacte a soporte inmediatamente...!");
			   }
			}); 
		}); 
	}	
	</script>
	
	
	
  </head>
  <body onload="pone_users_registrados();">

     
		<?php  
		 // $cons= new ConexionMySQL();
		?>
        <!-- Main content -->
        <section class="content">
        <div class='row'>
			<div class='col-md-12'> 
				<div class='box box-warning'>
					<div class="box-header with-border">
						<h3 class='miestilo'>Crear Nuevo Usuario</h3>
					</div>
					<form class="form-horizontal"  method="post"  enctype="multipart/form-data" action="#" id="form_usuario" autocomplete="off">
						<div class='box-body'>
								<div class='form-group'>
									<label for="codigo" class="col-sm-2 control-label">Tipo Usuario:</label>
									<div class="col-sm-5">
										<select name="tipo_usr" id="tipo_usr" class="form-control">
											<option>Seleccione...</option>
											<?php 
											  $selectTipo=$this->usuarios_model->getListaTipoUsr();
											  foreach($selectTipo as $tipo){
												echo '<option value="'.$tipo['ID_TIPO_USR'].'">'.$tipo['TIPO_USR'].'</option>';
											   }
											?>
										</select>
									</div>
								</div>
								<div class='form-group' id="prs" ><!--style="display:none"-->
									<label for="codigo" class="col-sm-2 control-label">Personal:</label>
									<div class="col-sm-5">
										<select name="prs" id="prs" class="form-control">
											<option>Seleccione...</option>
										<?php 
											  $selectPrs=$this->personal_model->getPersonalRHH();
											  foreach($selectPrs as $prs){
												echo '<option value="'.$prs['ID_PRS'].'">'.$prs['NOMB_PRS'].' '.$prs['APELLIDO_PRS'].'</option>';
											   }
											?>
									  </select>
									</div>
								</div>  
								<div class='form-group'>
									<label for="codigo" class="col-sm-2 control-label">Usuario:</label>
									<div class="col-sm-5">
									<input type="text" class="form-control" id='clave' name="clave" placeholder='Login del usuario...'>
									</div>
								</div>

								<div class='form-group'>
									<label for="codigo" class="col-sm-2 control-label">Password:</label>
									<div class="col-sm-5">
									<input type="password" class="form-control" id='pass' name="pass" placeholder='Password del usuario...'>
									</div>
								</div>
								<div class='form-group'>
									<label for="codigo" class="col-sm-2 control-label">Confirma Password:</label>
									<div class="col-sm-5">
									<input type="password" class="form-control" id='pass2' name="pass2" placeholder='Confirma el password del usuario...'>
									</div>
								</div>

							
						</div>
						<div class='box-footer'>
						 <button type='submit' class='btn btn-primary pull-right'   id='btn-reg-usr'><i class="fa fa-user-plus" > Registrar</i></button> 
						</div>
					</form>
				 </div>
			 </div>

			<div class='col-md-12'>
				<div id='users_registrados'></div>
			</div>
        </div>
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
         

   
  </body>
</html>