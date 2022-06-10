<?php
require_once("./base/model.php");

class dataModulos extends model {

  function  __construct() {
    $this->table = 'modulos';
    $this->pk = "id";
    parent::__construct();

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Modulo";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['ativo']['order'] = 2;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->ordernar();
  }

  protected function validate(){
    return true;
  }
  
  public function doGravarAjax(){
    if($_POST){
      if(empty($_POST['id'])){
        $id = $this->inserir($_POST);
        $_POST['id'] = $id;
        echo json_encode([
          'status' => 'true', 
          'title' => 'Pronto',
          'message' => 'Cadastro realizado com sucesso!',
          'data' => $_POST
        ]);
      } else {
        if(isset($_POST['tabelaDel'])){
          if ($this->deleteLogico()) {
            echo json_encode([
              'status' => 'true',
              'title' => 'Pronto',
              'message' => 'Delete realizado com sucesso!',
            ]);
          } else {
            echo json_encode([
              'status' => 'false',
              'title' => 'Falha',
              'message' => 'Falha ao realizar o delete. Tente novamente em instantes.',
            ]);
          }
        } else {
          if($this->alterar($_POST)){
            echo json_encode([
              'status' => 'true',
              'title' => 'Pronto',
              'message' => 'Dados alterado com sucesso!',
              'data' => $_POST
            ]);
          } else {
            echo json_encode([
              'status' => 'false',
              'title' => 'Falha',
              'message' => 'Falha ao realizar a alteração. Tente novamente em instantes.',
            ]);
          }
        }
      }
      return true;
    } else {
      return false;
    }
  }

}