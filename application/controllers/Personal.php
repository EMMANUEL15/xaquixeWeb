<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('tank_auth');
        $this->load->model('Model_personal');
    }
	public function listadoPersonal(){
		$resultado = $this->Model_personal->listaPersonal();
		$data['personal'] = $resultado;
	  	$this->load->view('PersonalLista',$data);
	}
	public function agregarPersonal(){
		if($_POST){
			$data = array(
				'rfc_e'			=> $_POST['rfc'],
				'nombre'		=> $_POST['nombre'],
				'apellido1'		=> $_POST['apellido1'],
				'apellido2'		=> $_POST['apellido2'],
				'calle'			=> $_POST['calle'],
				'numero'		=> $_POST['numero'],
				'colonia'		=> $_POST['col'],
				'municipio'		=> $_POST['municipio'],
				'estado'		=> $_POST['estado'],
				'puesto'  		=> $_POST['puesto']);
			$this->Model_personal->insertarPersonal($data);
		}
	}
	public function updatePersonal($id){
			$resultado = $this->Model_personal->obtenerPersonal($id);
			$data['personal'] = $resultado[0];
        	$this->load->view('PersonalUpdate',$data);
    }
    public function guardarEdicionPersonal(){
    	if($_POST){
			$data = array(
				'rfc_e'			=> $_POST['rfc'],
				'nombre'		=> $_POST['nombre'],
				'apellido1'		=> $_POST['apellido1'],
				'apellido2'		=> $_POST['apellido2'],
				'calle'			=> $_POST['calle'],
				'numero'		=> $_POST['numero'],
				'colonia'		=> $_POST['col'],
				'municipio'		=> $_POST['municipio'],
				'estado'		=> $_POST['estado'],
				'puesto'  		=> $_POST['puesto']);
			$resultado = $this->Model_personal->actualizaPersonal($data,$_POST['id']);
		}
	}
} 