<?php
	class Materia_model extends CI_Model
	{
		function _construct()  // constructor del modelo
		{
			parent::__construct();
		}  
		public function get_materia_id($id)
		{
			if($id!=""){ 
				$this->db->where('ID_MATERIA', $id);
				$consulta = $this->db->get('materia');
				
				if($consulta->num_rows()>0){
					return $consulta->row_array();
				}else{
					return false;
				}   
			}else{
				return false;
			}
		}
		public function get_horario_id($id)
		{
			if($id!=""){ 
				$this->db->where('ID_HORARIO', $id);
				$consulta = $this->db->get('horario');
				
				if($consulta->num_rows()>0){
					return $consulta->row_array();
				}else{
					return false;
				}   
			}else{
				return false;
			}
		}
		public function get_nivel_id($id)
		{
			if($id!=""){ 
				$this->db->where('ID_NIVEL', $id);
				$consulta = $this->db->get('nivel');
				
				if($consulta->num_rows()>0){
					return $consulta->row_array();
				}else{
					return false;
				}   
			}else{
				return false;
			}
		}
		public function getListaMateria()
		{
			$sql = "  SELECT a.*
					  FROM `materia` as a  
					  ORDER BY a.`NOMB_MATERIA`"; 

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
		public function insertMateria($data)
		{
			 $this->db->insert('materia', $data);
		} 
        public function lastInsert(){
			return $this->db->insert_id();
		}
		public function delete_materia($id)
		{
			$this->db->delete('materia', array('ID_MATERIA' => $id));  
		}
        public function updateMateria($id,$data)
		{
			$this->db->where('ID_MATERIA',$id); 
			$this->db->update('materia',$data);
		}
        public function getHorarioDisponible($idAula,$turno)// esta por verse o quitar el group by g.id_granja 
		{
			$sql = "SELECT h.*
					FROM `horario` as h  
					where h.`ID_TURNO`='$turno' and h.`ID_HORARIO` not in 
																	(SELECT a.`ID_HORARIO` 
																	 FROM `asignacion_mat_doc` as a 
																	 WHERE a.`ID_AULA`='$idAula')
					order by h.`HORARIO_INI`";
			
			$query=$this->db->query($sql);
			
			if ($query->num_rows() > 0){
				return $query->result_array();
			} else{
				 return false;  
			}   
		}
        public function getMateriaDocente($materia)
        {
			$sql = "SELECT distinct d.ID_PRS,d.*
					FROM `asignacion_mat_doc` as a, docente as d 
					WHERE a.`ID_PRS`=d.ID_PRS AND
						  a.`ID_MATERIA`='$materia'
					Order by d.NOMBRES_DOC";
			
			$query=$this->db->query($sql);
			
			if ($query->num_rows() > 0){
				return $query->result_array();
			} else{
				 return false;  
			}   
		}	
		public function getMateriaDocenteGrupo($docente,$materia)
        {
			$sql = "SELECT h.*,t.TURNO,a.GRUPO,a.ID_ASIG
					FROM `asignacion_mat_doc` as a, docente as d,horario as h, turno as t  
					WHERE a.`ID_PRS`=d.ID_PRS AND h.`ID_HORARIO`=a.`ID_HORARIO` and
                          t.ID_TURNO=h.`ID_TURNO` and
						  a.`ID_MATERIA`='$materia' and a.`ID_PRS`='$docente'
					ORDER BY h.HORARIO_INI";
			
			$query=$this->db->query($sql);
			
			if ($query->num_rows() > 0){
				return $query->result_array();
			} else{
				 return false;  
			}   
		}		
	}