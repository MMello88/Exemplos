<?php
include("./base/model.php");

class dataEmpresas extends model {

  function  __construct() {
    $this->field = ['id', 'atividade_id', 'razao_social', 'nome_fantasia', 'cep', 'endereco', 'numero', 'bairro', 'complemento', 'cidade', 'uf', 'celular', 'pago', 'dt_experiencia'];
    $this->table = 'empresas';
    $this->pk = "id";
    $this->where = [];

    parent::__construct();
  }

}