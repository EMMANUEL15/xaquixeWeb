<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_producto extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	public function listaProductos(){
			$query = $this->db->get('producto');
			return $query->result();
	}
	public function obtenerProducto($sku){
			$data = array('sku' => $sku);
			$this->db->query("SET sql_mode = '' ");
			$query = $this->db->get_where('producto',$data);
			return $query->result();
	}
	public function insertarProducto($data){
			$this->db->query("SET sql_mode = '' ");
			$resultado = $this->db->insert('producto',$data);
			return $this ->db ->insert_id();
	}
	public function actualizaProducto($data,$sku){
			$this->db->query("SET sql_mode = '' ");
			$this->db->where('sku',$sku);
			$this->db->update('producto',$data);
	}


	public function eliminarProducto($sku){
			$data = array('sku' => $sku);
			$this->db->query("SET sql_mode = '' ");
			$resultado = $this->db->delete('producto',$data);
	}
}
