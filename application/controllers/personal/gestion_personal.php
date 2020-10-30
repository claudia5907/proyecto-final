<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestion_personal extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    function Gestion_personal(){
       parent::__construct();
       $this->load->model('ingreso_model');
       $this->load->model('privilegios_model'); 
       $this->load->model('personal/personal_model');
       
       $session_id = $this->session->userdata('logueando');  
        if($session_id['clave']==""){
            redirect("ingreso");
        }
    } 
    public function index(){ 
	    $data['titulo']="Instituto|Personal";
        $this->layout->view('modulos/transportista/transportistas',$data);
	}
	public function alumno()
    {
        $data['titulo']="Instituto|Alumno";
        $this->layout->view('personal/util_prs',$data);
    }
	public function insert_update_personal($id="")
	{
		$tipo=$_POST['tipo'];
		$data['NOMB_PRS']=$_POST['nombre'];
		$data['APELLIDO_PATERNO']=$_POST['apellidoPaterno']; 
		$data['APELLIDO_MATERNO']=$_POST['apellidoMaterno']; 
		$data['CI_PRS']=$_POST['ci'];
		$data['DIR_PRS']=strtoupper($_POST['direccion']);
		$data['EMAIL_ALUMNO']=$_POST['mail'];
		$data['FECHA_NACIMIENTO']=$_POST['anio']."-".$_POST['mes']."-".$_POST['dia'];
		
		if($id==""){
			
			$this->load->library('upload'); 
			if(isset($_FILES['customFile1']["name"])){	
				if($_FILES['customFile1']["name"]!=""){
					//$data['TIPO_ARCHIVO']=$_FILES['customFile1']["type"];
					//$data['NOMBRE_ARCHIVO']=$_FILES['customFile1']["name"];
					$data['TAMANIO']=$_FILES['customFile1']["size"];
					$prefijo = substr(md5(uniqid(rand())),0,7);
					$archivo = $_FILES['customFile1']['name'];
					$fecha=date("Ymd");
					$extencion=new SplFileInfo($archivo);
					$newName=$prefijo."_".$fecha.".".$extencion->getExtension();
					$url_archivo = getcwd()."/resources/files/estudiante/".$newName;
					//$data['ruta_archivo']=$url_archivo;
					$data['FOTO_NOMB']=$newName;
					$nameArchivo=$prefijo."_".$archivo;
					//$data['RUTA_ARCHIVO'] = 'resources/files/vouchers/'.$newName;
					//$url_destino = (string) 'resources/files/vouchers/thumbs/'.$newName;
					
					copy($_FILES['customFile1']['tmp_name'],$url_archivo);
					$nombArchivo=$newName;
					//echo $url_archivo;
					
					//if($_FILES['customFile1']["type"]!='application/pdf'){
					//	 miniatura($url_archivo,$url_destino , 100, 100);
					//} 
				}
			}
			$resp=$this->personal_model->insertAlumno($data);
		}else{
			echo $id;
			if(isset($_FILES['customFile1']["name"])){	
				if($_FILES['customFile1']["name"]!=""){
					//$data['TIPO_ARCHIVO']=$_FILES['customFile1']["type"];
					//$data['NOMBRE_ARCHIVO']=$_FILES['customFile1']["name"];
					$data['TAMANIO']=$_FILES['customFile1']["size"];
					$prefijo = substr(md5(uniqid(rand())),0,7);
					$archivo = $_FILES['customFile1']['name'];
					$fecha=date("Ymd");
					$extencion=new SplFileInfo($archivo);
					$newName=$prefijo."_".$fecha.".".$extencion->getExtension();
					$url_archivo = getcwd()."/resources/files/estudiante/".$newName;
					//$data['ruta_archivo']=$url_archivo;
					$data['FOTO_NOMB']=$newName;
					$nameArchivo=$prefijo."_".$archivo;
					//$data['RUTA_ARCHIVO'] = 'resources/files/vouchers/'.$newName;
					//$url_destino = (string) 'resources/files/vouchers/thumbs/'.$newName;
					
					copy($_FILES['customFile1']['tmp_name'],$url_archivo);
					$nombArchivo=$newName;
					//echo $url_archivo;
					
					//if($_FILES['customFile1']["type"]!='application/pdf'){
					//	 miniatura($url_archivo,$url_destino , 100, 100);
					//} 
				}
			}
			$resp=$this->personal_model->updateAlumno($id,$data);
		} 
	}
	public function pone_personal_regs()
	{
		$respPrs=$this->personal_model->getPersonaAlumno();
		if($respPrs){
		 echo "<div class='box box-primary'>";
		 echo "<div class='box-header'>";
		 echo "<h3 class='miestilo'>Estuduantes Registrados.</h3>";
		 echo "</div>";
		 echo "<div class='box-body'>";
		 echo "<table id='tabla_estudiante' border='1' class='table table-hover table-condensed display' style='font-size:12px !important;'>";
		 echo "<thead>";
		 echo "<tr>";
		 echo "<th style='text-align: center;'>NOMBRE</th>";
		 echo "<th style='text-align: center;'>APELLIDO PATERNO</th>";
		 echo "<th style='text-align: center;'>APELLIDO MATERNO</th>";
		 echo "<th style='text-align: center;'>CI</th>";
		 echo "<th style='text-align: center;'>DIRECCION</th>"; 
		 echo "<th style='text-align: center;'>ESTADO</th>";
		 echo "<th style='text-align: center;'>OPCIONES</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
         $estado='';
         $estado1=0;
         $disabled='';
         $mensaje='';
		 foreach($respPrs as $e){ 
			$path_file= base_url().'resources/files/estudiante/'.$e['FOTO_NOMB']; 
			$img='<a href="#" onclick="fn_mostrar_foto_estudiante('.$e['ID_PRS'].')"  title="Ver Foto" data-toggle="modal" data-target="#modal_info_foto">
				<img src="'.$path_file.'" width="110" height="110" title="" class="file_imgs" />												
			  </a>';
			 if($e['ESTADO_ALUMNO']==0){
				  $estado="Inactivo";
				  $disabled='disabled';
				  $mensaje='Activar';
				  $estado1=0;
			 }else{
				 $estado="Activo";
				 $disabled='';
				 $mensaje='Inactivar';
				 $estado1=1;
			 }
			  
		   echo "<tr>";
		   echo "<td style='text-align: left;'>".strtoupper($e['NOMB_PRS'])."</td>"; 
		   echo "<td style='text-align: left;'>".strtoupper($e['APELLIDO_PATERNO'])."</td>";
		   echo "<td style='text-align: left;'>".strtoupper($e['APELLIDO_MATERNO'])."</td>";
		   echo "<td style='text-align: left;'>".$e['CI_PRS']."</td>";
		   echo "<td style='text-align: left;'>".$e['DIR_PRS']."</td>"; 
		   echo "<td style='text-align: center;'>".$estado."</td>";
		   echo "<td style='text-align: center;'><button type='button' class='btn btn-primary pull-center' data-toggle='modal' data-target='#modal_info_datos'  ".$disabled." onclick='fn_mostrar_datos_estudiante(".$e['ID_PRS'].");' id='btn-reg-usr'><i class='fa fa-info-circle' aria-hidden='true'></i></button> <button type='button' class='btn btn-primary pull-center' data-toggle='modal' data-target='#modal_editar_estudiante' ".$disabled." onclick='editar_alumno(".$e['ID_PRS'].");' id='btn-reg-usr'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>
</button> <button type='button' class='btn btn-primary pull-center' onclick='eliminar_alumno(".$e['ID_PRS'].",".$estado1.");' id='btn-reg-usr'>".$mensaje."</i>
</button></td>";
		   echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "</table>";
		 echo "</div>";
		 echo "</div>";
		}else{
		 
		 echo '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Warning!</strong> Actualmente no hay estudiantes registrados.
				  </div>';
		}
	}
	public function eliminar_personal($id,$estado)
	{
		$this->personal_model->delete_personal($id,$estado); 
	}
	public function eliminar_personal_docente($id,$estado)
	{
		$this->personal_model->delete_personal_docente($id,$estado); 
	}
	public function mostrar_form_editar()
	{
		$data['resp']=$this->personal_model->get_alumno_id($_POST['id']);
        $this->load->view('personal/form_personal',$data);	
			
	} 
	public function mostrar_foto_estudiante()
	{
	 
		$data['resp']=$this->personal_model->get_alumno_id($_POST['id']);
        $this->load->view('personal/form_personal_info',$data);	
	}
	function verificar_ci(){
		$cedula_id = trim(strtoupper($_POST['ci']));
		$resp_transp=$this->personal_model->verificar_ci($cedula_id);
		$valido = true;
		if($resp_transp){
			$valido = false;
			if(isset($_POST['id_prs'])){
				if($resp_transp->ID_PRS==trim($_POST['id_prs'])){
					$valido = true;
				}
			}
		}
		header('Content-type: application/json');
		echo json_encode($valido);
	}
	function verificar_ci_docente(){
		$cedula_id = trim(strtoupper($_POST['ci']));
		$resp_transp=$this->personal_model->verificar_ci_docente($cedula_id);
		$valido = true;
		if($resp_transp){
			$valido = false;
			if(isset($_POST['id_prs'])){
				if($resp_transp->ID_PRS==trim($_POST['id_prs'])){
					$valido = true;
				}
			}
		}
		header('Content-type: application/json');
		echo json_encode($valido);
	}
	public function docente()
    {
        $data['titulo']="Instituto|Docente";
        $this->layout->view('personal/util_docente',$data);
    }
	public function pone_personal_regs_docente()
	{
		$respPrs=$this->personal_model->getPersonaDocente();
		if($respPrs){
		 echo "<div class='box box-primary'>";
		 echo "<div class='box-header'>";
		 echo "<h3 class='miestilo'>Estuduantes Registrados.</h3>";
		 echo "</div>";
		 echo "<div class='box-body'>";
		 echo "<table id='tabla_estudiante' border='1' class='table table-hover table-condensed display' style='font-size:12px !important;'>";
		 echo "<thead>";
		 echo "<tr>";
		 echo "<th style='text-align: center;'>NOMBRE</th>";
		 echo "<th style='text-align: center;'>APELLIDO PATERNO</th>";
		 echo "<th style='text-align: center;'>APELLIDO MATERNO</th>";
		 echo "<th style='text-align: center;'>CI</th>";
		 echo "<th style='text-align: center;'>DIRECCION</th>"; 
		 echo "<th style='text-align: center;'>ESTADO</th>";
		 echo "<th style='text-align: center;'>OPCIONES</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
         $estado='';
         $estado1=0;
         $disabled='';
         $mensaje='';
		 foreach($respPrs as $e){ 
			$path_file= base_url().'resources/files/docente/'.$e['FOTO_NOMB']; 
			$img='<a href="#" onclick="fn_mostrar_foto_docente('.$e['ID_PRS'].')"  title="Ver Foto" data-toggle="modal" data-target="#modal_info_foto">
				<img src="'.$path_file.'" width="110" height="110" title="" class="file_imgs" />												
			  </a>';
			 if($e['ESTADO_DOCENTE']==0){
				  $estado="Inactivo";
				  $disabled='disabled';
				  $mensaje='Activar';
				  $estado1=0;
			 }else{
				 $estado="Activo";
				 $disabled='';
				 $mensaje='Inactivar';
				 $estado1=1;
			 }
			  
		   echo "<tr>";
		   echo "<td style='text-align: left;'>".strtoupper($e['NOMBRES_DOC'])."</td>"; 
		   echo "<td style='text-align: left;'>".strtoupper($e['APELLIDO_PATERNO'])."</td>";
		   echo "<td style='text-align: left;'>".strtoupper($e['APELLIDO_MATERNO'])."</td>";
		   echo "<td style='text-align: left;'>".$e['CI_PRS']."</td>";
		   echo "<td style='text-align: left;'>".$e['DIR_PRS']."</td>"; 
		   echo "<td style='text-align: center;'>".$estado."</td>";
		   echo "<td style='text-align: center;'><button type='button' class='btn btn-primary pull-center' data-toggle='modal' data-target='#modal_info_datos_docente'  ".$disabled." onclick='fn_mostrar_datos_docente(".$e['ID_PRS'].");' id='btn-reg-usr'><i class='fa fa-info-circle' aria-hidden='true'></i></button> <button type='button' class='btn btn-primary pull-center' data-toggle='modal' data-target='#modal_editar_docente' ".$disabled." onclick='editar_docente(".$e['ID_PRS'].");' id='btn-reg-usr'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>
</button> <button type='button' class='btn btn-primary pull-center' onclick='eliminar_docente(".$e['ID_PRS'].",".$estado1.");' id='btn-reg-usr'>".$mensaje."</i>
</button></td>";
		   echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "</table>";
		 echo "</div>";
		 echo "</div>";
		}else{
		 
		 echo '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Warning!</strong> Actualmente no hay Docentes registrados.
				  </div>';
		}
	}
	public function mostrar_form_editar_docente()
	{
		$data['resp']=$this->personal_model->get_docente_id($_POST['id']);
        $this->load->view('personal/form_personal_docente',$data);	
			
	} 
	public function insert_update_personal_docente($id="")
	{
		$tipo=$_POST['tipo'];
		$data['NOMBRES_DOC']=$_POST['nombre'];
		$data['APELLIDO_PATERNO']=$_POST['apellidoPaterno']; 
		$data['APELLIDO_MATERNO']=$_POST['apellidoMaterno']; 
		$data['CI_PRS']=$_POST['ci'];
		$data['DIR_PRS']=strtoupper($_POST['direccion']);
		$data['EMAIL_DOCENTE']=$_POST['mail'];
		$data['ESPECIALIDAD']=$_POST['especialidad'];
		$data['FECHA_NACIMIENTO']=$_POST['anio']."-".$_POST['mes']."-".$_POST['dia'];
		
		if($id==""){
			
			$this->load->library('upload');   
			if(isset($_FILES['customFile1']["name"])){	
				if($_FILES['customFile1']["name"]!=""){
					//$data['TIPO_ARCHIVO']=$_FILES['customFile1']["type"];
					//$data['NOMBRE_ARCHIVO']=$_FILES['customFile1']["name"];
					$data['TAMANIO']=$_FILES['customFile1']["size"];
					$prefijo = substr(md5(uniqid(rand())),0,7);
					$archivo = $_FILES['customFile1']['name'];
					$fecha=date("Ymd");
					$extencion=new SplFileInfo($archivo);
					$newName=$prefijo."_".$fecha.".".$extencion->getExtension();
					$url_archivo = getcwd()."/resources/files/estudiante/".$newName;
					//$data['ruta_archivo']=$url_archivo;
					$data['FOTO_NOMB']=$newName;
					$nameArchivo=$prefijo."_".$archivo;
					//$data['RUTA_ARCHIVO'] = 'resources/files/vouchers/'.$newName;
					//$url_destino = (string) 'resources/files/vouchers/thumbs/'.$newName;
					
					copy($_FILES['customFile1']['tmp_name'],$url_archivo);
					$nombArchivo=$newName;
					//echo $url_archivo;
					
					//if($_FILES['customFile1']["type"]!='application/pdf'){
					//	 miniatura($url_archivo,$url_destino , 100, 100);
					//} 
				}
			}
			$resp=$this->personal_model->insertDocente($data);
		}else{
			echo $id;
			if(isset($_FILES['customFile2']["name"])){	
				if($_FILES['customFile2']["name"]!=""){
					//$data['TIPO_ARCHIVO']=$_FILES['customFile1']["type"];
					//$data['NOMBRE_ARCHIVO']=$_FILES['customFile1']["name"];
					$data['TAMANIO']=$_FILES['customFile1']["size"];
					$prefijo = substr(md5(uniqid(rand())),0,7);
					$archivo = $_FILES['customFile2']['name'];
					$fecha=date("Ymd");
					$extencion=new SplFileInfo($archivo);
					$newName=$prefijo."_".$fecha.".".$extencion->getExtension();
					$url_archivo = getcwd()."/resources/files/docente/".$newName;
					//$data['ruta_archivo']=$url_archivo;
					$data['FOTO_NOMB']=$newName;
					$nameArchivo=$prefijo."_".$archivo;
					//$data['RUTA_ARCHIVO'] = 'resources/files/vouchers/'.$newName;
					//$url_destino = (string) 'resources/files/vouchers/thumbs/'.$newName;
					
					copy($_FILES['customFile2']['tmp_name'],$url_archivo);
					$nombArchivo=$newName;
					//echo $url_archivo;
					
					//if($_FILES['customFile1']["type"]!='application/pdf'){
					//	 miniatura($url_archivo,$url_destino , 100, 100);
					//} 
				}
			}
			$resp=$this->personal_model->updateDocente($id,$data);
		} 
	}
	public function mostrar_foto_docente()
	{
	 
		$data['resp']=$this->personal_model->get_docente_id($_POST['id']);
        $this->load->view('personal/form_personal_info_docente',$data);	
	}
}

/* End of file ingreso.php */
/* Location: ./application/controllers/ingreso.php */