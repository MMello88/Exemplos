<?php
include("./base/model.php");

class dataAtividades extends model {

  function  __construct() {
    $this->field = ['id', 'nome'];
    $this->table = 'atividades';
    $this->pk = "id";
    $this->where = [];

    parent::__construct();
  }

}