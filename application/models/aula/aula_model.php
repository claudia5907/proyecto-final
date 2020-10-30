<?php
	class Aula_model extends CI_Model
	{
		function _construct()  // constructor del modelo
		{
			parent::__construct();
		}  
		public function get_aula_id($id)
		{
			if($id!=""){ 
				$this->db->where('ID_AULA', $id);
				$consulta = $this->db->get('aula');
				
				if($consulta->num_rows()>0){
					return $consulta->row_array();
				}else{
					return false;
				}   
			}else{
				return false;
			}
		}
		public function getListaAula()
		{
			$sql = "  SELECT a.*
					  FROM `aula` as a  
					  ORDER BY a.`NOMB_AULA`"; 

			$query = $this->db->query($sql);

			if($query->num_rows()){			
				return $query->result_array();				
			} else{			
				return false;				
			}		
		}
		public function insertAula($data)
		{
			 $this->db->insert('aula', $data);
		} 
        public function lastInsert(){
			return $this->db->insert_id();
		}
		public function delete_aula($id)
		{
			$this->db->delete('aula', array('ID_AULA' => $id));  
		}
        public function updateAula($id,$data)
		{
			$this->db->where('ID_AULA',$id); 
			$this->db->update('aula',$data);
		}
        		
	}