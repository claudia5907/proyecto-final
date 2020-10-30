<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestion_aula extends CI_Controller {

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
    function Gestion_aula(){
       parent::__construct();
       $this->load->model('ingreso_model');
       $this->load->model('privilegios_model'); 
       $this->load->model('aula/aula_model');
       
        $session_id = $this->session->userdata('logueando'); 
        
        if($session_id['clave']==""){
            redirect("ingreso");
        }
    } 
    public function index(){ 
	    $data['titulo']="Instituto|Aula";
		$this->layout->view('aula/util_aula',$data);
 	}
	 
	public function insert_update_aula($id="")
	{
		$tipo=$_POST['tipo'];
		$data['NOMB_AULA']=$_POST['nombre'];
		$data['DESC_AULA']=$_POST['descripcion'];
		 
		if($id==""){
			$resp=$this->aula_model->insertAula($data);
		}else{
			echo $id;
			$resp=$this->aula_model->updateAula($id,$data);
		} 
	}
	public function pone_aula_regs()
	{
		$respMat=$this->aula_model->getListaAula();
		if($respMat){
		 echo "<div class='box box-primary'>";
		 echo "<div class='box-header'>";
		 echo "<h3 class='miestilo'>Aula Registrados.</h3>";
		 echo "</div>";
		 echo "<div class='box-body'>";
		 echo "<table id='tabla_users' border='1' class='table table-hover table-condensed display' style='font-size:12px !important;'>";
		 echo "<thead>";
		 echo "<tr>";
		 echo "<th style='text-align: center;'>NOMBRE</th>";
		 echo "<th style='text-align: center;'>DESCRIPCION</th>"; 
		 echo "<th style='text-align: center;'>OPCIONES</th>";
		 echo "</tr>";
		 echo "</thead>";
		 echo "<tbody>";
		 foreach($respMat as $e){ 
		   echo "<tr>";
		   echo "<td style='text-align: left;'>".strtoupper($e['NOMB_AULA'])."</td>";
		   echo "<td style='text-align: left;'>".$e['DESC_AULA']."</td>"; 
		   echo "<td style='text-align: center;'><button type='button' class='btn btn-primary pull-center' data-toggle='modal' data-target='#modal_editar_aula' onclick='editar_aula(".$e['ID_AULA'].");' id='btn-reg-usr'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>
</button> <button type='button' class='btn btn-primary pull-center' onclick='eliminar_aula(".$e['ID_AULA'].");' id='btn-reg-usr'><i class='fa fa-trash' aria-hidden='true'></i>
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
					<strong>Warning!</strong> Actualmente no hay Aulas registrados.
				  </div>';
		}
	}
	public function eliminar_aula($id)
	{
		$this->aula_model->delete_aula($id); 
	}
	public function mostrar_form_editar()
	{
		$data['resp']=$this->aula_model->get_aula_id($_POST['id']);
        $this->load->view('aula/form_aula',$data);	
			
	} 
}

/* End of file ingreso.php */
/* Location: ./application/controllers/ingreso.php */