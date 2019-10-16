<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('tank_auth');
        $this->load->model('Model_material');
    }
	public function listaMaterial(){
		$resultado = $this->Model_material->listaMateriales();
		$data['material'] = $resultado;
	  	$this->load->view('materialLista',$data);
	}
	public function agregarMaterial(){
		if($_POST){
				$data = array(
				'id_material'	=> $_POST['idMaterial'],
				'nombre'		=> $_POST['vacante'],
				'cantidad'  	=> $_POST['lugar']);
				$this->Model_material->insertarMaterial($data);
			}
	}
	public function updateMaterial($id){
			$resultado = $this->Model_material->obtenerMaterial($id);
			$data['material'] = $resultado[0];
        	$this->load->view('materialUpdate',$data);
    }
    public function guardarEdicionMaterial(){
    	if($_POST){
			$data = array(
				'id_material'	=> $_POST['idMaterial'],
				'nombre'		=> $_POST['vacante'],
				'cantidad'  	=> $_POST['lugar']);
			$resultado = $this->Model_material->actualizarMaterial($data,$_POST['idVacante']);
		}
	}
}