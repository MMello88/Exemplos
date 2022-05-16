<?php 
include_once("../conexao/base.php");

class teste extends base {
  public $nome = "Matheus";

  function __construct() {
    parent::__construct();
  }

  public function index(){
    echo "index chegou ";
    include("../pages/usuario/index.php");
  }

  public function editar($id = ''){
    echo "editar chegou {$id}";

    include("../pages/usuario/editar.php");
  }

  public function deletar($id){
    echo "deletar chegou {$id}";
    include("../pages/usuario/deletar.php");
  }
}