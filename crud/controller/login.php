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
      
      if(!isset($_POST['email'])){
        $this->setflashdata(indicator("Por favor, Preencher o campo Email", "danger"));
      }  else if(!isset($_POST['senha'])){
        $this->setflashdata(indicator("Por favor, Preencher o campo Senha", "danger"));
      }

      $datas = $this->usuario->selectByEmail($_POST['email']);

      if ($datas == null){
        $this->setflashdata(indicator("Este e-mail não existe. ", "warning"));
      } else {
        if ($datas[0]->senha == md5($_POST['senha'])){
          $_SESSION['usuario'] = $datas[0];
          $this->setflashdata(indicator("Login realizado com sucesso! ", "success"));
          redirect("/dashboard");
        } else {
          $this->setflashdata(indicator("Usuário ou senha estão incorretos. ", "danger"));
        }
      }
    }
    $this->view("./pages/login/index.php");
  }
}