<?php
/******
* Creando modelos de validacion de usuarios 
****/
  class Usuarios_model extends CI_Model
  {
    function _construct()  // constructor del modelo
    {
        parent::__construct();
    }
	public function get_usuarios_id($id="")
    {
	     
        if($id!=""){
            $this->db->where('id', $id);
            $consulta = $this->db->get('usuarios');
            
            if($consulta->num_rows()>0){
                return $consulta->row_array();
            }
            else{
                return false;
            }   
        }
        else{
            return false;
        } 
    }
	public function getListaTipoUsr()
	{
		$sql = "SELECT p.* 
				FROM `tipo_usuario` AS p
				ORDER BY p.DESCRIPCION";
			
		$query=$this->db->query($sql);
			
		if ($query->num_rows() > 0){
			return $query->result_array();
		} else{
			return false;
		} 
	}
	public function getListaUsr()
	{
		$sql = "Select u.*,t.*,p.*
				from usuario as u,tipo_usuario as t, persona as p
				where u.`ID_TIPO_USR`=t.`ID_TIPO_USR` AND
                      p.`ID_PRS`=u.`ID_PRS`";
			
		$query=$this->db->query($sql);
			
		if ($query->num_rows() > 0){
			return $query->result_array();
		} else{
			return false;
		} 
	}
	public function insertar_usuarios($data)
    {
        $this->db->insert('usuario', $data);
    }
	public function delete_users($id,$estado)
	{
		//$this->db->delete('usuario', array('ID_USR' => $id)); 
		if($estado==0){
			$newEstado=1;
		}else{
			$newEstado=0;
		}			
		$data['ESTADO_USUARIO']=$newEstado;
		$this->db->where('ID_USR',$id); 
		$this->db->update('usuario',$data);
	}
    public function lastInsert(){
		return $this->db->insert_id();
	} 
  }
?>