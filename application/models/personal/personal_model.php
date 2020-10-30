<?php
	class Personal_model extends CI_Model
	{
		function _construct()  // constructor del modelo
		{
			parent::__construct();
		}  
		public function get_alumno_id($id)
		{
			if($id!=""){ 
				$this->db->where('ID_PRS', $id);
				$consulta = $this->db->get('alumno');
				
				if($consulta->num_rows()>0){
					return $consulta->row_array();
				}else{
					return false;
				}   
			}else{
				return false;
			}
		}
		public function get_docente_id($id)
		{
			if($id!=""){ 
				$this->db->where('ID_PRS', $id);
				$consulta = $this->db->get('docente');
				
				if($consulta->num_rows()>0){
					return $consulta->row_array();
				}else{
					return false;
				}   
			}else{
				return false;
			}
		}
		public function getPersonaAlumno()
		{
			$sql = "  SELECT a.*
					  FROM `alumno` as a 
					   
					  ORDER BY a.`NOMB_PRS`"; 

			$query = $this->db->query($sql);

			if($query->num_rows()){			
				return $query->result_array();				
			} else{			
				return false;				
			}		
		}
		public function getPersonaDocente()
		{
			$sql = "  SELECT a.*
					  FROM `docente` as a 
					   
					  ORDER BY a.`NOMBRES_DOC`"; 

			$query = $this->db->query($sql);

			if($query->num_rows()){			
				return $query->result_array();				
			} else{			
				return false;				
			}		
		}
		public function insertAlumno($data)
		{
			 $this->db->insert('alumno', $data);
		} 
		public function insertDocente($data)
		{
			 $this->db->insert('docente', $data);
		} 
        public function lastInsert(){
			return $this->db->insert_id();
		}
		public function delete_personal($id,$estado)
		{
			if($estado==0){
				$newEstado=1;
			}else{
				$newEstado=0;
			}			
			$data['ESTADO_ALUMNO']=$newEstado;
			$this->db->where('ID_PRS',$id); 
			$this->db->update('alumno',$data);
		}
		public function delete_personal_docente($id,$estado)
		{
			if($estado==0){
				$newEstado=1;
			}else{
				$newEstado=0;
			}			
			$data['ESTADO_DOCENTE']=$newEstado;
			$this->db->where('ID_PRS',$id); 
			$this->db->update('docente',$data);
		}
        public function updateAlumno($id,$data)
		{
			$this->db->where('ID_PRS',$id); 
			$this->db->update('alumno',$data);
		} 
		public function updateDocente($id,$data)
		{
			$this->db->where('ID_PRS',$id); 
			$this->db->update('docente',$data);
		}
        public function getPersonalRHH()
		{
			$sql = "  SELECT p.*
					  FROM `persona` as p 
					  WHERE p.`ESTADO` = '1' 
					  ORDER BY p.`NOMB_PRS`"; 

			$query = $this->db->query($sql);

			if($query->num_rows()){			
				return $query->result_array();				
			} else{			
				return false;				
			}		
		}
		public function verificar_ci($ci)
		{
			$sql="SELECT a.ID_PRS
				  FROM `alumno` as a 
				  where a.`CI_PRS`='$ci'";                 
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
		public function verificar_ci_docente($ci)
		{
			$sql="SELECT a.ID_PRS
				  FROM `docente` as a 
				  where a.`CI_PRS`='$ci'";                 
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