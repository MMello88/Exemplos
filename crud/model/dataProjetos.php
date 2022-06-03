<?php
require_once("./base/model.php");

class dataProjetos extends model {

  function  __construct() {
    $this->table = 'projetos';
    $this->pk = "id";
    parent::__construct();
    $this->modulos = $this->getModel('dataModulos');
    $this->menus = $this->getModel('dataMenus');

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Projeto";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['col'] = '12';
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['modulos_id']['label'] = "Modulo";
    $this->inputs['modulos_id']['select'] = $this->modulos->selectAll();
    $this->inputs['modulos_id']['order'] = 2;
    $this->inputs['modulos_id']['col'] = '6';
    $this->inputs['modulos_id']['required'] = true;

    $this->inputs['menus_id']['label'] = "Menus";
    $this->inputs['menus_id']['select'] = $this->menus->selectAll();
    $this->inputs['menus_id']['order'] = 3;
    $this->inputs['menus_id']['col'] = '6';
    $this->inputs['menus_id']['required'] = true;

    $this->inputs['ativo']['order'] = 4;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->ordernar();
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


  public function getAll() {
    $sql = "SELECT p.id, p.nome, p.modulos_id, p.menus_id, p.ativo, m.nome modulo, n.nome menu
              FROM projetos p
             INNER JOIN modulos m ON m.id = p.modulos_id
             INNER JOIN menus n ON n.id = p.menus_id
             AND p.ativo = 'Sim'";
    return $this->query($sql);
  }
}