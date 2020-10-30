<?php
	class Inscripcion_model extends CI_Model
	{
		function _construct()  // constructor del modelo
		{
			parent::__construct();
		}  
		public function get_inscripcion_id($id)
		{
			if($id!=""){ 
				$this->db->where('ID_INSC', $id);
				$consulta = $this->db->get('inscripcion');
				
				if($consulta->num_rows()>0){
					return $consulta->row_array();
				}else{
					return false;
				}   
			}else{
				return false;
			}
		}
		public function getListaInscripciones()
		{
			$sql = "SELECT i.`ID_INSC`,i.`FECHA_INICIO`,CONCAT(a.NOMB_PRS,' ',a.APELLIDO_PATERNO,' ',a.APELLIDO_MATERNO) as estudiante, 
			             CONCAT(d.NOMBRES_DOC,' ',d.APELLIDO_PATERNO,' ',d.APELLIDO_MATERNO) as docente,n.NOMB_NIVEL,aa.NOMB_AULA,
						 hh.HORARIO_INI,hh.HORARIO_FIN,i.`FECHA_INICIO`,mm.NOMB_MATERIA
FROM `inscripcion` as i, alumno as a, asignacion_mat_doc as am, docente as d,nivel as n, aula as aa,horario as hh,materia as mm
WHERE a.`ID_PRS`=i.`ID_PRS` and i.`ID_ASIG`=am.ID_ASIG AND
      d.ID_PRS=am.ID_PRS and n.`ID_NIVEL`=am.ID_NIVEL AND aa.ID_AULA=am.ID_AULA AND
      hh.`ID_HORARIO`=am.`ID_HORARIO` and mm.ID_MATERIA=am.ID_MATERIA"; 

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
		public function insertInscripcion($data)
		{
			 $this->db->insert('inscripcion', $data);
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