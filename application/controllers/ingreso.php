<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ingreso extends CI_Controller {

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
    function Ingreso(){
       parent::__construct();
       $this->load->model('ingreso_model');
       $this->load->model('privilegios_model'); 
       $this->load->model('personal/personal_model');
    } 
    public function index(){
	    $session_id = $this->session->userdata('logueando');
        if($session_id['clave']!=""){
		   redirect("inicio");
        }else{
            $data['titulo']="::Instituto|Inicio";
            $this->load->view('inicio',$data);
        }
	}
    /*
    *validamos si el usuario existe o no.
    */
    public function validar()
    {
		$usuario=test_input($_POST['usuario']);
		$password=test_input(MD5($_POST['pass']));
         
		//visitas/
	    $fp = fopen("files/contador.txt","r"); // Abrimos el fichero donde guardaremos y leeremos las visitas
	    $visitas = intval(fgets($fp)); // Leemos las visitas y usamos intval para asegurarnos de que devuelve un entero
	    $visitas++; // Incrementamos las visitas
	    fclose($fp); // Cerramos el archivo pues lo vamos a volver a abrir en modo escritura
	    $fp = fopen("files/contador.txt","w"); // Abrimos el archivo en modo escritura
	    fputs($fp,$visitas); // Escribimos las visitas sumadas
		 
        $respuesta=$this->ingreso_model->validar($usuario,$password);
        
        if($usuario=="" || $password ==""){
            $dato['titulo']="::Instituto | Login";
            $dato['usuario']=$usuario;
            $this->load->view('inicio',$dato);
        }
        else{
            
             if($respuesta){
                
                $sess_array = array(
                          'clave' => $usuario,
                          'password' => $password);
                $this->session->set_userdata('logueando',$sess_array); 
                
                $this->session->set_userdata("id_tipo",$respuesta->ID_TIPO_USR);
				$this->session->set_userdata("id_tabla_prs",$respuesta->ID_PRS); 
                $this->session->set_userdata("nombre_de_usuario",$respuesta->LOGIN); 
                $this->session->set_userdata("clave",$respuesta->CONTRASENIA);
                 
				echo "
						<script>
						  document.location.href = '".base_url()."inicio';
						</script>
					  ";
            }
            else{
				echo "<script>
						swal(
						  'Nombre o contraseña invalidos',
						  'Por favor verifique sus datos e intente nuevamente',
						  'error'
						);
					  </script>"; 
            }
        } 
    }
	public function salir()
	{
	   $data['titulo']="::Instituto | Logout";
	   $this->session->sess_destroy();
	   $this->load->view('inicio',$data);
	}
	public function olvido_contrasenia()
	{
		$data['titulo']="::Instituto|olvido";
        $this->load->view('olvido_contrasenia',$data);
	}
}
/* End of file ingreso.php */
/* Location: ./application/controllers/ingreso.php */