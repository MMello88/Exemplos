<?php 
include("./base/controller.php");

class usuario extends controller {

  public $usuario;

  function __construct() {
    $this->usuario = $this->getModel('dataUsuario');
    parent::__construct();
    $this->data['titulo'] = "Usuário";
  }

  public function index(){
    $this->addJS('usuario.js');
    $this->viewLogado("./pages/usuario/index.php");
  }

  public function editar($id = ''){
    echo "editar chegou {$id}";
    $this->view("./pages/usuario/editar.php");
  }

  public function deletar($id){
    echo "deletar chegou {$id}";
    $this->view("./pages/usuario/deletar.php");
  }
}