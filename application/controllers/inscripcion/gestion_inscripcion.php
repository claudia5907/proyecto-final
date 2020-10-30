<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestion_inscripcion extends CI_Controller {

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
    function Gestion_inscripcion(){
       parent::__construct();
        $this->load->model('ingreso_model');
        $this->load->model('privilegios_model'); 
        $this->load->model('aula/aula_model');
        $this->load->model('materia/materia_model');
        $this->load->model('personal/personal_model');
        $this->load->model('asignacion/asignacion_model');
        $this->load->model('inscripcion/inscripcion_model');
	    
        $session_id = $this->session->userdata('logueando'); 
        
        if($session_id['clave']==""){
            redirect("ingreso");
        }
    } 
    public function index(){ 
	    $data['titulo']="Instituto|Inscripcion";
		$this->layout->view('inscripcion/util_inscripcion',$data);
 	}
	 public function alumno(){ 
	    $data['titulo']="Instituto|Inscripcion";
		$this->layout->view('inscripcion/util_inscripcion',$data);
 	} 
	public function insert_update_inscripcion($id="")
	{
		$tipo=$_POST['tipo'];
		
		$data['ID_ASIG']=$_POST['grupo'];
		$data['ID_PRS']=$_POST['alumno'];
		$data['FECHA_INICIO']=$_POST['finicio'];
		
		 
		if($id==""){
			 
			$resp=$this->inscripcion_model->insertInscripcion($data);
		}else{
			echo $id;
			 
			$resp=$this->inscripcion_model->updateInscripcion($id,$data);
		} 
	}
	public function get_lista_horarios()
	{
		$aula=$_POST['aula'];
		$respTurno=$this->materia_model->getListaTurno();
		$resp="";
		if($respTurno){
			foreach($respTurno as $turno){
				$resp.="<optgroup label='".strtoupper($turno['TURNO'])."' >";
				 
					$i=1;
					$respHorario=$this->materia_model->getHorarioDisponible($aula,$turno['ID_TURNO']);
					if($respHorario){
						foreach($respHorario as $horario){
							$resp.="<option value='".$horario['ID_HORARIO']."'>".$i.".- ".strtoupper($horario['HORARIO_INI']." A ".$horario['HORARIO_FIN'] )."</option>";
							 
							$i++;
						}
					}
					$resp.="</optgroup>"; 
			}
		}
		echo $resp;  
	}
	public function pone_inscripcion_regs()
	{
		$resp=$this->inscripcion_model->getListaInscripciones();
		if($resp){
		 echo "<div class='box box-primary'>";
		 echo "<div class='box-header'>";
		 echo "<h3 class='miestilo'>Inscripciones Registrados.</h3>";
		 echo "</div>";
		 echo "<div class='box-body'>";
		 echo "<table id='tabla_users' border='1' class='table table-hover table-condensed display' style='font-size:12px !important;'>";
		 echo "<thead>";
		 echo "<tr>";
		 echo "<th style='text-align: center;'>ALUMNO</th>";
		 echo "<th style='text-align: center;'>MATERIA</th>"; 
		 echo "<th style='text-align: center;'>DOCENTE</th>"; 
		 echo "<th style='text-align: center;'>NIVEL</th>"; 
		 echo "<th style='text-align: center;'>AULA</th>"; 
		 echo "<th style='text-align: center;'>HORARIO</th>"; 
		 echo "<th style='text-align: center;'>FECHA INICIO</th>"; 
		 echo "<th style='text-align: center;'>OPCIONES</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 foreach($resp as $e){ 
		   
		   echo "<tr>";
		   echo "<td style='text-align: left;'>".strtoupper($e['estudiante'])."</td>";
		   echo "<td style='text-align: left;'>".strtoupper($e['NOMB_MATERIA'])."</td>"; 
		   echo "<td style='text-align: left;'>".strtoupper($e['docente'])."</td>"; 
		   echo "<td style='text-align: left;'>".strtoupper($e['NOMB_NIVEL'])."</td>"; 
		   echo "<td style='text-align: left;'>".strtoupper($e['NOMB_AULA'])."</td>"; 
		   echo "<td style='text-align: left;'>".($e['HORARIO_INI']." A ".$e['HORARIO_FIN'])."</td>"; 
		   echo "<td style='text-align: left;'>".$e['FECHA_INICIO']."</td>";
		   echo "<td style='text-align: center;'><button type='button' class='btn btn-primary pull-center' data-toggle='modal' data-target='#modal_editar_asignacion' onclick='editar_asignacion(".$e['ID_INSC'].");' id='btn-reg-usr'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>
</button> <button type='button' class='btn btn-primary pull-center' onclick='eliminar_asignacion(".$e['ID_INSC'].");' id='btn-reg-usr'><i class='fa fa-trash' aria-hidden='true'></i>
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
					<strong>Warning!</strong> Actualmente no hay Incripciones registrados.
				  </div>';
		}
	}
	public function eliminar_asignacion($id)
	{
		$this->asignacion_model->delete_asignacion($id); 
	}
	public function mostrar_form_editar_asignacion()
	{
		$data['resp']=$this->asignacion_model->get_asignacion_id($_POST['id']);
        $this->load->view('asignacion/form_asignacion',$data);	
			
	} 
}

/* End of file ingreso.php */
/* Location: ./application/controllers/ingreso.php */