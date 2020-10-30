<?php
/******
* Creando modelos de validacion de usuarios 
****/
  class Privilegios_model extends CI_Model
  {
    function _construct()  // constructor del modelo
    {
        parent::__construct();
    }
    public function validar_privilegios($id_usuario)
    {
        $sql="select s.`ID_SUB`,s.`NOMB_SUB`,s.MENU_ITEM,s.ENLACE
			  from `tipo_usuario`  as t,`privilegio_usr` as p,
				   `sub_modulo` as s,usuario as u,`personalgp` as per
			  where t.`ID_TIPO_USR`=p.`ID_TIPO_USR` and 
				    s.`ID_SUB`=p.`ID_SUB` and
				    u.`ID_TIPO_USR`=t.`ID_TIPO_USR` and
				    u.`PERSONALGP_IDEMPLEADO`=per.`personalgp_IdEmpleado` and
				    per.`personalgp_IdEmpleado`='$id_usuario'
			  order by s.GRUPO,s.MENU_ITEM";
       $query=$this->db->query($sql);    
        
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
        
    }
    public function validar_grupos($id_usuario)
    {
        $sql="select distinct s.GRUPO
              from `tipo_usuario`  as t,`privilegio_usr` as p,
                   `sub_modulo` as s,`usuario` as u,`personalgp` as per
              where t.`ID_TIPO_USR`=p.`ID_TIPO_USR` and 
                    s.`ID_SUB`=p.`ID_SUB` and
                    u.`ID_TIPO_USR`=t.`ID_TIPO_USR` and
                    u.`PERSONALGP_IDEMPLEADO`=per.`personalgp_IdEmpleado` and
                    per.`PERSONALGP_IDEMPLEADO`='$id_usuario'
              order by s.GRUPO,s.MENU_ITEM";
        $query=$this->db->query($sql);              
                
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
        
    }
    public function validar_item($grupo,$id_usuario)
    {
        $sql="select s.`ID_SUB`,s.`NOMB_SUB`,s.MENU_ITEM,s.ENLACE
			  from `tipo_usuario`  as t,`privilegio_usr` as p,
				   `sub_modulo` as s,usuario as u,`personalgp` as per
			  where t.`ID_TIPO_USR`=p.`ID_TIPO_USR` and 
					s.`ID_SUB`=p.`ID_SUB` and
					u.`ID_TIPO_USR`=t.`ID_TIPO_USR` and
					u.`PERSONALGP_IDEMPLEADO`=per.`personalgp_IdEmpleado` and
					s.`GRUPO`='$grupo' and
					per.`personalgp_IdEmpleado`='$id_usuario'
			 order by s.MENU_ITEM";
       $query=$this->db->query($sql);    
        
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
        
    }
    public function validar_area($id_usuario)
    {
        $sql="select distinct a.`COD_AREA_TRAB`, a.`NOMB_AREA_TRAB`
              from `tipo_usuario`  as t,`privilegios` as p,
                   `sub_modulos` as s,usuario as u,`personal` as per,
                   `area_trabajo` as a
              where t.`COD_TIPO_USR`=p.`COD_TIPO_USR` and 
                    s.`COD_SUB`=p.`COD_SUB` and
                    u.`COD_TIPO_USR`=t.`COD_TIPO_USR` and
                    u.`COD_PRS`=per.`COD_PRS` and
                    per.`COD_PRS`='$id_usuario' and
                    a.`COD_AREA_TRAB`=s.`COD_AREA_TRAB`
              order by s.GRUPO,s.MENU_ITEM";
       $query=$this->db->query($sql);    
        
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
        
    }
  }