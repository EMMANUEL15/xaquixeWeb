<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('tank_auth');
    }
    
    public function index(){
         $this->load->view('index');
    }
    public function salir(){
        $this->tank_auth->logout();
        redirect('Acceso/login');
    }
}