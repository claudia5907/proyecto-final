<?php
	class Asignacion_model extends CI_Model
	{
		function _construct()  // constructor del modelo
		{
			parent::__construct();
		}  
		public function get_asignacion_id($id)
		{
			if($id!=""){ 
				$this->db->where('ID_ASIG', $id);
				$consulta = $this->db->get('asignacion_mat_doc');
				
				if($consulta->num_rows()>0){
					return $consulta->row_array();
				}else{
					return false;
				}   
			}else{
				return false;
			}
		}
		public function getListaAsnaciones()
		{
			$sql = "SELECT a.* 
					FROM `asignacion_mat_doc` as a,aula as au, materia as m,nivel as n,
						 docente as d, horario as h
					WHERE a.`ID_AULA`=au.`ID_AULA` AND a.`ID_MATERIA`=m.`ID_MATERIA` AND
						  a.`ID_NIVEL`=n.`ID_NIVEL` AND a.`ID_PRS`=d.ID_PRS AND
						  a.`ID_HORARIO`=h.ID_HORARIO
					order by `FECHA_ASIG`"; 

			$query = $this->db->query($sql);

			if($query->num_rows()){			
				return $query->result_array();				
			} else{			
				return false;				
			}		
		}
		public function getListaNivel()
		{
			$sql = "  SELECT a.*
					  FROM `nivel` as a  
					  ORDER BY a.`ID_NIVEL`"; 

			$query = $this->db->query($sql);

			if($query->num_rows()){			
				return $query->result_array();				
			} else{			
				return false;				
			}		
		}
		public function getListaTurno()
		{
			$sql = "  SELECT a.*
					  FROM `turno` as a  
					  ORDER BY a.`ID_TURNO`"; 

			$query = $this->db->query($sql);

			if($query->num_rows()){			
				return $query->result_array();				
			} else{			
				return false;				
			}		
		}
		public function getListaTurnoHorario($turno)
		{
			$sql = "  SELECT a.*
					  FROM `horario` as a
					  WHERE a.ID_TURNO='$turno'					  
					  ORDER BY a.`HORARIO_INI`"; 

			$query = $this->db->query($sql);

			if($query->num_rows()){			
				return $query->result_array();				
			} else{			
				return false;				
			}		
		}
		public function insertAsignacion($data)
		{
			 $this->db->insert('asignacion_mat_doc', $data);
		} 
        public function lastInsert(){
			return $this->db->insert_id();
		}
		public function delete_asignacion($id)
		{
			$this->db->delete('asignacion_mat_doc', array('ID_ASIG' => $id));  
		}
        public function updateAsignacion($id,$data)
		{
			$this->db->where('ID_ASIG',$id); 
			$this->db->update('asignacion_mat_doc',$data);
		}
        		
	}