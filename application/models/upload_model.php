<?php
/******
* Creando modelos de validacion de usuarios 
****/
  class Upload_model extends CI_Model
  {
    function _construct()  // constructor del modelo
    {
        parent::__construct();
    }
    public function cargar_base_datos($bd,$direcion)
    {
	    $DB2 = $this->load->database($bd,TRUE);
		
		$DB2->query('DROP database IF EXISTS '.$bd.';');
		$DB2->query('create database IF NOT EXISTS '.$bd.';'); 
		$DB3 = $this->load->database($bd,TRUE);
		$queries = explode(';', file_get_contents($direcion));//BD_algALG.sql
		  
		  foreach($queries as $sql){
			if(trim($sql)!=""){
			  $resp=$DB3->query($sql);
			}
		  }	
		  $this->load->database("default",TRUE);
    }
	public function insert_upload($data)
	{
	   $this->db->insert('inc_upload_bd', $data);
	}
	public function delete_upload($name)
	{
	  $this->db->delete('inc_upload_bd', array('NOMBRE' => $name));
	}
  }
?>