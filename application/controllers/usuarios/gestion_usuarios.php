<?php
class Gestion_usuarios extends CI_Controller {
	
	function Gestion_usuarios(){

		parent::__construct();	
		/*
		require_once("Excel_archivos/PHPExcel");
        require_once("Excel_archivos/PHPExcel/Reader/Excel2007.php"); 	
		*/
		//c:\xampp\htdocs\cobranzas\resources\libreriaExcel\Classes\
		//require_once("resources/libreriaExcel/Classes/PHPExcel.php");
		//require_once("resources/libreriaExcel/Classes/PHPExcel/Reader/Excel2007.php"); 	
		
		$this->load->library('PHPExcel/PHPExcel');
		//$this->load->library('Excel_archivos/PHPExcel/IOFactory');
		
		$this->load->helper(array('form', 'url'));		
		//$this->load->model('perfil_model','contacts');
		$this->load->model('usuarios/usuarios_model');   
		$this->load->model('personal/personal_model');   
		$this->load->model('ingreso_model');
        $this->load->model('privilegios_model');
		 
		
		$session_id = $this->session->userdata('logueando'); 
        if($session_id['clave']==""){
            redirect("ingreso");
        }
	}
	
	function index(){	
		if($this->session->userdata("ingreso")!=""){
		   redirect("ingreso");
        }
	   $data['titulo']="::Instituto|Usuarios";
	   $this->layout->view('usuarios/util_usr',$data);
	}
	public function pone_users_regs()
	{
		$respUsr=$this->usuarios_model->getListaUsr();
		if($respUsr){
		 echo "<div class='box box-primary'>";
		 echo "<div class='box-header'>";
		 echo "<h3 class='miestilo'>Usuarios Registrados.</h3>";
		 echo "</div>";
		 echo "<div class='box-body'>";
		 echo "<table id='tabla_users' border='1' class='table table-hover table-condensed display' style='font-size:12px !important;'>";
		 echo "<thead>";
		 echo "<tr>";
		 echo "<th style='text-align: center;'>TIPO USUARIO</th>";
		 echo "<th style='text-align: center;'>NOMBRE</th>";
		 echo "<th style='text-align: center;'>OPCIONES</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 foreach($respUsr as $e){
			 
			 if($e['ESTADO_USUARIO']==0){
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
			 if($e['ID_TIPO_USR']==1){
				$boton=""; 
			 }else{
				 $boton="<button type='button' class='btn btn-primary pull-center' onclick='eliminar_usr(".$e['ID_USR'].",".$estado1.");' id='btn-reg-usr'>".$mensaje."</button>";
			 }
			 
			 
			 
		   echo "<tr>";
		   echo "<td style='text-align: left;'>".strtoupper($e['TIPO_USR'])."</td>"; 
		   echo "<td style='text-align: left;'>".strtoupper($e['NOMB_PRS'].' '.$e['APELLIDO_PRS'])."</td>";
		   echo "<td style='text-align: center;'>".$boton."</td>";
		   echo "</tr>";
		 }
		 echo "</tbody>";
		 echo "</table>";
		 echo "</div>";
		 echo "</div>";
		}else{
		 echo "<b>Actualmente no hay usuarios registrados...</b>";
		}
	}
	public function eliminar_usr($id,$estado)
	{
		$this->usuarios_model->delete_users($id,$estado); 
	}
	public function registra_users()
	{
		$data['ID_TIPO_USR']=$_POST['tipo_usr'];
		$data['ID_PRS']=$_POST['prs']; 
		$data['LOGIN']=$_POST['clave'];
		$data['CONTRASENIA']=MD5($_POST['pass']);
		
		$resp=$this->usuarios_model->insertar_usuarios($data);
		if(!$resp){
			echo "1";
		}else{
			echo "0";
		}
		
	}   	
}
?>