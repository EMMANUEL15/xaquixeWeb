<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('tank_auth');
        $this->load->model('Alumnos');
    }
    
    public function index(){
        //$this->Sistema->log($this->tank_auth->get_username(), 'GET', 'Acceso/', '', $this->input->ip_address());
         $resultado = $this->Usuarios->vacantesLista();
         $datos['vacantes'] = $resultado;

         $this->load->view('index',$datos);
    }
    public function forgotPassword(){
        $resultado = $this->Sistema->log($this->tank_auth->get_username(), 'GET', 'Acceso/', '', $this->input->ip_address());
        $this->load->view('forgot_password');
    }
    public function recoverPassword000(){
        if($_POST){
            $username = $_POST['username'];
            $email    = $_POST['email'];
            $asingnarClave = $this->tank_auth->forgot_password($username);
            if(!is_null($asingnarClave)){
                if($email == $asingnarClave['email']){
                     $codigo['clave']= $asingnarClave['new_pass_key'];
                     $codigo['user']= $asingnarClave['user_id'];
                    $this->load->view('revover_password',$codigo);
                }else{
                    echo "<script>
                        alert('¡Usuario o Correo incorrecto!')
                        window.location= 'forgotPassword'
                      </script>"; 
                }
            }else{
                echo "<script>
                        alert('¡Usuario o Correo incorrecto!')
                        window.location= 'forgotPassword'
                      </script>"; 
            }    
        }
    }
    public function recoverCount(){
        if($_POST and $_SESSION){
                $verificarClave = $this->tank_auth->can_reset_password($_SESSION['codigoUsuario'],$_SESSION['codigoSeguridad']);
                if(!is_null($verificarClave)){
                     $resetPassword = $this->tank_auth->reset_password($_SESSION['codigoUsuario'],$_SESSION['codigoSeguridad'],$_POST['password']);
                     echo "<script>
                        alert('¡su password ha sido cambiado exitosamente!')
                        window.location= 'login'
                      </script>"; 
                }
        }
    }
    public function login(){
        $this->Sistema->log($this->tank_auth->get_username(), 'GET', 'Acceso/login1', '', $this->input->ip_address());
        if ($this->tank_auth->is_logged_in()) { 
            $this->Sistema->log($this->tank_auth->get_username(), 'GET', 'Acceso/login2', 'Redireccion a principal', $this->input->ip_address());
            redirect('cbtis/Acceso/principal'); 
        }
                
        if ($_POST){
            $this->Sistema->log($this->tank_auth->get_username(), 'POST', 'Acceso/login3', 'Intento de acceso con credenciales '.$_POST['username'].' - '.$_POST['password'], $this->input->ip_address());
            $login = $this->tank_auth->login($_POST['username'], $_POST['password'], false, true, true);
            if ($login==1) { redirect('Acceso/principal'); } else { $this->load->view('login', $data); }
         } else { $this->load->view('login', $data); }
    }
    public function nuevoUsuarioCANCEL(){
        $data = array(
                //'id'          => $_POST['rfc'],
                'nombre'            => $_POST['nombre'],
                'primerApellido'    => $_POST['apellidoPaterno'],
                'segundoApellido'   => $_POST['apellidoMaterno'],
                'username'          => $_POST['usuario'],
                'password'          => $_POST['pass'],
                'email'             => $_POST['correo'],
                'last_ip'           => '',
                'nivel'             => '3',
                'permisos'          => '0000000000'
            );

        $datos = $this->tank_auth->create_users($data,FALSE);

        if(is_null($datos)){
            echo "<script>
                    alert('¡ el usuario ya existe!')
                    window.history.back();
                  </script>"; 
        }else{
            echo "creado dexitosamte";
            redirect('Acceso/login');   
        }
    }
    public function salir(){
        $this->tank_auth->logout();
        redirect('Acceso/login');
    }
    public function principal(){
        if(!$this->tank_auth->is_logged_in()) { 
            $this->Sistema->log($this->tank_auth->get_username(), 'GET', 'Acceso/principal', 'ACCESO NO AUTORIZADO', $this->input->ip_address());
            redirect('Acceso/login'); }

        $data['titulo'] = 'Dashboard InvenTI v0.01';
        $data['miga1'] = 'Principal';
        $data['miga2'] = 'Dashboard';
        $data['id_user'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();

        $datos_usuario = $this->Usuarios->datos_usuario($data['id_user']);
        $datos['usuario'] = $datos_usuario;

        $resultado = $this->Usuarios->obtenerVacante($data['id_user']);
        $datos['vacantes'] = $resultado;

        $this->Sistema->log($this->tank_auth->get_username(), 'GET', 'Acceso/principal', '', $this->input->ip_address());
        $this->load->view('principal',$datos);
    }
    public function vacantes(){
        $datos_usuario = $this->Usuarios->datos_usuario($this->tank_auth->get_user_id());
        if($datos_usuario[0]->permisos[2] === '1'){
            $datos['usuario'] = $datos_usuario;
            $resultado = $this->Usuarios->vacantesLista();
            $datos['vacantes'] = $resultado;
            $this->load->view('vacantesListado',$datos);
        }else{
        redirect('Acceso/principal');
      }
    }
    public function deleteUser(){
        $password = $_POST['password'];
        $data = $this->tank_auth->delete_user($password);
        redirect('Acceso/principal');
    }

    /*  -------  ENCUENSTA  ----------------------------------------------------------------------  */

    public function encuesta(){
         $this->load->view('resgistrar');
    }
    public function guardarEgresado(){
        if($_POST){
            $telefono2='';
            $correo2='';
            if (isset($_POST['telefono2'])) {   $telefono2  = $_POST['telefono2'];      }else{      $telefono2   = '';  }
            if (isset($_POST['correo2']))   {       $correo2    = $_POST['correo2'];        }else{      $correo2     = '';  }
            $data = array(
            'numero'            => $_POST['control'],
            'apellidoPaterno'   => $_POST['apellidoPaterno'],
            'apellidoMaterno'   => $_POST['apellidoMaterno'],
            'nombre'            => $_POST['Nombre'],
            'genero'            => $_POST['genero'],
            'curp'              => $_POST['curp'],
            'carrera'           => $_POST['carrera'],
            'turno'             => $_POST['turno'],
            'lada'              => $_POST['lada'],
            'telefono1'         => $_POST['telefono1'],
            'telefono2'         => $telefono2,
            'telefonoMovil'     => $_POST['telefonoMovil'],
            'correo1'           => $_POST['correo'],
            'correo2'           => $correo2 );

            $sku = $this->Alumnos->insertarAlumno($data);
            redirect('Acceso/preguntas/'.$_POST['control']);
        }else{
            redirect('Acceso/index');
        }
    }
    public function preguntas($numero){
        $this->load->view('cuestionario');
    }
     public function guardarEncuesta(){
        echo "<a href='https://docs.google.com/forms/d/e/1FAIpQLSfzTU3LQU5aIA6PunhOiJw96eVliRVN4HJECLC9J8Ev5gCvnQ/viewform?vc=0&c=0&w=1' >escuensta DGTI</a>";
    }


}