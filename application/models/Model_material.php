<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_material extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	public function listaMateriales(){
			$query = $this->db->get('material');
			return $query->result();
	}
	public function obtenerMaterial($id){
			$data = array('id_material' => $id);
			$this->db->query("SET sql_mode = '' ");
			$query = $this->db->get_where('material',$data);
			return $query->result();
	}
	public function insertarMaterial($data){
			$this->db->query("SET sql_mode = '' ");
			$resultado = $this->db->insert('material',$data);
			return $this ->db ->insert_id();
	}
	public function actualizarMaterial($data,$id){
			$this->db->query("SET sql_mode = '' ");
			$this->db->where('id_material',$id);
			$this->db->update('material',$data);
	}


	public function eliminarMaterial($id){
			$data = array('id_material' => $id);
			$this->db->query("SET sql_mode = '' ");
			$resultado = $this->db->delete('material',$data);
	}
}
