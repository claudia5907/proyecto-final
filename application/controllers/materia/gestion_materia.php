<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestion_materia extends CI_Controller {

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
    function Gestion_materia(){
       parent::__construct();
       $this->load->model('ingreso_model');
       $this->load->model('privilegios_model'); 
       $this->load->model('materia/materia_model');
       
        $session_id = $this->session->userdata('logueando'); 
        
        if($session_id['clave']==""){
            redirect("ingreso");
        }
    } 
    public function index(){ 
	    $data['titulo']="Instituto|Materia";
		$this->layout->view('materia/util_mat',$data);
 	}
	 
	public function insert_update_materia($id="")
	{
		$tipo=$_POST['tipo'];
		$data['COD_MATERIA']=$_POST['codigo'];
		$data['NOMB_MATERIA']=$_POST['nombre'];
		$data['DESC_MATERIA']=$_POST['descripcion'];
		 
		if($id==""){
			$resp=$this->materia_model->insertMateria($data);
		}else{
			echo $id;
			$resp=$this->materia_model->updateMateria($id,$data);
		} 
	}
	public function pone_materia_regs()
	{
		$respMat=$this->materia_model->getListaMateria();
		if($respMat){
		 echo "<div class='box box-primary'>";
		 echo "<div class='box-header'>";
		 echo "<h3 class='miestilo'>Materias Registrados.</h3>";
		 echo "</div>";
		 echo "<div class='box-body'>";
		 echo "<table id='tabla_users' border='1' class='table table-hover table-condensed display' style='font-size:12px !important;'>";
		 echo "<thead>";
		 echo "<tr>";
		 echo "<th style='text-align: center;'>CODIGO</th>";
		 echo "<th style='text-align: center;'>NOMBRE</th>";
		 echo "<th style='text-align: center;'>DESCRIPCION</th>"; 
		 echo "<th style='text-align: center;'>OPCIONES</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 foreach($respMat as $e){ 
		   echo "<tr>";
		   echo "<td style='text-align: left;'>".strtoupper($e['COD_MATERIA'])."</td>"; 
		   echo "<td style='text-align: left;'>".strtoupper($e['NOMB_MATERIA'])."</td>";
		   echo "<td style='text-align: left;'>".$e['DESC_MATERIA']."</td>"; 
		   echo "<td style='text-align: center;'><button type='button' class='btn btn-primary pull-center' data-toggle='modal' data-target='#modal_editar_materia' onclick='editar_materia(".$e['ID_MATERIA'].");' id='btn-reg-usr'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>
</button> <button type='button' class='btn btn-primary pull-center' onclick='eliminar_materia(".$e['ID_MATERIA'].");' id='btn-reg-usr'><i class='fa fa-trash' aria-hidden='true'></i>
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
					<strong>Warning!</strong> Actualmente no hay Materias registrados.
				  </div>';
		}
	}
	public function eliminar_materia($id)
	{
		$this->materia_model->delete_materia($id); 
	}
	public function mostrar_form_editar()
	{
		$data['resp']=$this->materia_model->get_materia_id($_POST['id']);
        $this->load->view('materia/form_materia',$data);	
			
	} 
	public function get_lista_docente_asignado()
	{
		$materia=$_POST['materia'];
		  
		$resp="<option value=''>Seleccione...</option>"; 
		$i=1;
		$respDocente=$this->materia_model->getMateriaDocente($materia);
		if($respDocente){
			foreach($respDocente as $docente){
				$resp.="<option value='".$docente['ID_PRS']."'>".$i.".- ".strtoupper($docente['NOMBRES_DOC']." ".$docente['APELLIDO_PAT']." ".$docente['APELLIDO_MATERNO'] )."</option>";
				 
				$i++;
			}
		}
					
		echo $resp; 
	}
	public function get_lista_grupo_materia()
	{
		$docente=$_POST['docente'];
		$materia=$_POST['materia'];
		  
		$resp="<option value=''>Seleccione...</option>"; 
		$i=1;
		$respGrupo=$this->materia_model->getMateriaDocenteGrupo($docente,$materia);
		if($respGrupo){
			foreach($respGrupo as $grupo){
				$resp.="<option value='".$grupo['ID_ASIG']."'>".$i.".- <b>[".strtoupper($grupo['GRUPO']." - ".$grupo['TURNO']."]</b> ".$grupo['HORARIO_INI']." ".$grupo['HORARIO_FIN'] )."</option>";
				 
				$i++;
			}
		}
					
		echo $resp; 
	}
}

/* End of file ingreso.php */
/* Location: ./application/controllers/ingreso.php */