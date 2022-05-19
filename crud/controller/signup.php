<?php 
include("./base/controller.php");

class signup extends controller {

  private $usuario;

  function __construct() {
    if (isset($_SESSION['usuario'])) redirect("/dashboard");
    parent::__construct();
    $this->usuario = $this->getModel('dataUsuario');
  }

  public function index(){
    $this->data['titulo'] = "Principal";
    
    if ($_POST){
      
      if(!isset($_POST['nome'])){
        $this->setflashdata(indicator("Por favor, Preencher o campo Nome", "danger"));
      } else if(!isset($_POST['email'])){
        $this->setflashdata(indicator("Por favor, Preencher o campo Email", "danger"));
      }  else if(!isset($_POST['senha'])){
        $this->setflashdata(indicator("Por favor, Preencher o campo Senha", "danger"));
      }
      
      $data = $this->usuario->selectByEmail($_POST['email']);
      
      if ($data == null){
        if($this->usuario->inserir($_POST)){
          $data = $this->usuario->selectByEmail($_POST['email'])[0];
          $_SESSION['usuario'] = $data;
          $this->setflashdata(indicator("Cadastro realizado com sucesso!", "success"));
          redirect("/dashboard");
        } else {
          $this->setflashdata(indicator("Falha ao realizar o cadatro", "danger"));
        }
      } else {
        $this->setflashdata(indicator("Este e-mail já existe. ", "warning"));
      }
    }
    
    $this->view("./pages/signup/index.php");
  }

  public function cadastrar(){
    
  }
}