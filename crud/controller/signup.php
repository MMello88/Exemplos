<?php 
include("./base/controller.php");

class signup extends controller {

  function __construct() {
    parent::__construct();
  }

  public function index(){
    $this->data['titulo'] = "Principal";
    //$this->data['error'] = indicator("Por favor, Preencher o campo Nome", "danger");

    /*
        if ($_POST){
      $this->data['error'] = modalDanger("Por favor, Preencher o campo Nome", "modalsignup");
      $_POST['email'];
      $_POST['nome'];
      $_POST['senha'];
      //$this->usuario->inserir($_POST);
    }
    */
    $this->view("./pages/signup/index.php");
  }

  public function cadastrar(){
    
  }
}