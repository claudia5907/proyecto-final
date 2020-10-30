<?php
	class Ingreso_model extends CI_Model
	{
		function _construct()  // constructor del modelo
		{
			parent::__construct();
		} 
		public function validar($usuario,$password)
		{
			$sql="SELECT a.*
				  FROM usuario a 
				  WHERE a.LOGIN='$usuario' AND a.CONTRASENIA='$password'";
						
			$query=$this->db->query($sql);
			if($query->num_rows()>0)
			{
				return $query->row();
			}
			else
			{
				return false;
			}
		} 
	}