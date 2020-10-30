<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

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
	function Inicio()
	{
		parent::__construct();
        $this->load->model('ingreso_model');
        $this->load->model('privilegios_model'); 
		date_default_timezone_set("America/La_Paz" ); 
	} 
	public function index()
	{
       $session_id = $this->session->userdata('logueando'); 
       
       $data['titulo']="::Instituto | Inicio";
       if($session_id['clave']!=""){
		   $id_tipo=$this->session->userdata("id_tipo");
		   if($id_tipo==3){
			    
		   }else{
			   $this->layout->view('presentacion', $data);
		   }
           
       } 
       else{
         redirect("ingreso");
       } 
	}
	public function mostrar_grafico()
	{
		echo '[{"label":"Tarjetas Entel","value":9180},{"label":"Tarjetas Viva","value":0},{"label":"Tarjetas Tigo","value":0}]';
		//echo "[{ year: '2008', value: 80 },{ year: '2009', value: 10 },{ year: '2010', value: 5 },{ year: '2011', value: 5 },{ year: '2012', value: 20 }]";
		//echo "[{ year: '2008', value: 20 },{ year: '2009', value: 10 },{ year: '2010', value: 5 },{ year: '2011', value: 5 },{ year: '2012', value: 20 }]";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */