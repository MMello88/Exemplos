<?php
include("./base/model.php");

class dataEnderecos extends model {

  function  __construct() {
    $this->field = ['id', 'nome', 'rua', 'numero', 'bairro', 'complemento', 'cep', 'estado', 'cidade', 'telefone', 'principal', 'usuario_id'];
    $this->table = 'enderecos';
    $this->pk = "id";
    $this->where = [];

    parent::__construct();
  }

}