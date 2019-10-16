<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function datos_usuario($id){
	    $this->db->query("SET sql_mode = '' ");
        $query = $this->db->get_where('users',array('id' => $id));
        return $query->result();
    }
	public function listaUsuarios(){
	    $this->db->query("SET sql_mode = '' ");
		$query = $this->db->get_where('users');
		return $query->result();
	}
	public function actualizarDatos($id,$data){
	    $this->db->query("SET sql_mode = '' ");
		$this->db->where('id',$id);
		$this->db->update('users',$data);
	}
	public function actualizarCorreo($ID,$data){
	    $this->db->query("SET sql_mode = '' ");
		$this->db->where('id',$id);
		$this->db->update('users',$data);
	}
	public function eliminarUsuario($idUsuario){
	    $this->db->query("SET sql_mode = '' ");
		$this->db->delete('users',array('id' => $idUsuario));
	}
	public function vacantesLista(){
	    $this->db->query("SET sql_mode = '' ");
		$query = $this->db->get_where('vacantes');
		return $query->result();
    }
    public function obtenerVacante($id){
        $this->db->query("SET sql_mode = '' ");
		$query = $this->db->get_where('bolsa',array('id' => $id));
		return $query->result();
	}
}
