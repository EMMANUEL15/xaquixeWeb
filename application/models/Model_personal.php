<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_personal extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	public function listaPersonal(){
			$query = $this->db->get('empleado');
			return $query->result();
	}
	public function obtenerProducto($id){
			$data = array('rfc_e' => $id);
			$this->db->query("SET sql_mode = '' ");
			$query = $this->db->get_where('empleado',$data);
			return $query->result();
	}
	public function insertarProducto($data){
			$this->db->query("SET sql_mode = '' ");
			$resultado = $this->db->insert('empleado',$data);
			return $this ->db ->insert_id();
	}
	public function actualizaProducto($data,$id){
			$this->db->query("SET sql_mode = '' ");
			$this->db->where('rfc_e',$id);
			$this->db->update('empleado',$data);
	}


	public function eliminarProducto($id){
			$data = array('rfc_e' => $id);
			$this->db->query("SET sql_mode = '' ");
			$resultado = $this->db->delete('empleado',$data);
	}
}
