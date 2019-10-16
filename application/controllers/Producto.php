<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('tank_auth');
        $this->load->model('Model_producto');
    }
	public function listaProductos(){
		$resultado = $this->Model_producto->listaProductos();
		$data['productos'] = $resultado;
	  	$this->load->view('ProductoLista',$data);
	}
	public function agregarMaterial(){
		if($_POST){
				$data = array(
				'sku'			=> $_POST['sku'],
				'medida'		=> $_POST['medida'],
				'cantidad'		=> $_POST['cantidad'],
				'precio'  		=> $_POST['precio']);
				$this->Model_producto->insertarProducto($data);
			}
	}
	public function updateMaterial($sku){
			$resultado = $this->Model_producto->obtenerProducto($sku);
			$data['producto'] = $resultado[0];
        	$this->load->view('ProductoUpdate',$data);
    }
    public function guardarEdicionMaterial(){
    	if($_POST){
			$data = array(
				'sku'			=> $_POST['sku'],
				'medida'		=> $_POST['medida'],
				'cantidad'		=> $_POST['cantidad'],
				'precio'  		=> $_POST['precio']);
			$resultado = $this->Model_producto->actualizaProducto($data,$_POST['sku']);
		}
	}
} 