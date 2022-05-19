<?php 
include("./base/controller.php");

class login extends controller {

  public $usuario;

  function __construct() {
    if (isset($_SESSION['usuario'])) redirect("/dashboard");
    parent::__construct();
    $this->usuario = $this->getModel('dataUsuario');
  }

  public function index(){
    $this->data['titulo'] = "Principal";

    if ($_POST){
      $this->usuario->doLogin($_POST);      
    }
    
    $this->view("./pages/login/index.php");
  }
}