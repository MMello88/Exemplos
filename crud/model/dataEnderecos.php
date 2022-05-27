<?php
require_once("./base/model.php");

class dataEnderecos extends model {

  function  __construct() {
    $this->table = 'enderecos';
    $this->pk = "id";
    parent::__construct();
    $this->inputs['id']['disabled'] = true;
    $this->inputs['nome']['label'] = "Nome";
    $this->inputs['rua']['label'] = "Rua";
    $this->inputs['numero']['label'] = "Número";
  }

  public function doGravar(){
    if($_POST){
      if(empty($_POST['id'])){
        $this->inserir($_POST);
      } else {
        $this->alterar($_POST);
      }
    }
  }

}