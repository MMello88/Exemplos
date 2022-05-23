<?php

require_once("./base/model.php");

class dataEmpresas extends model {

  function  __construct() {
    $this->field = [];
    $this->table = 'empresas';
    $this->pk = "id";
    $this->where = [];
    parent::__construct();
    $this->inputs = [
      'id' => [
        'label' => 'Identificador',
        'name' => 'id',
        'id' => 'identificador',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'hidden'
      ],
      'atividade_id' => [
        'label' => 'Atividade',
        'name' => 'atividade_id',
        'id' => 'atividade_id',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'razao_social' => [
        'label' => 'Razão social',
        'name' => 'razao_social',
        'id' => 'razao_social',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'nome_fantasia' => [
        'label' => 'Nome Fantasia',
        'name' => 'nome_fantasia',
        'id' => 'nome_fantasia',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'cep' => [
        'label' => 'CEP',
        'name' => 'cep',
        'id' => 'cep',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'endereco' => [
        'label' => 'Endereço',
        'name' => 'endereco',
        'id' => 'endereco',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'numero' => [
        'label' => '',
        'name' => '',
        'id' => '',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'bairro' => [
        'label' => '',
        'name' => '',
        'id' => '',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'complemento' => [
        'label' => '',
        'name' => '',
        'id' => '',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'cidade' => [
        'label' => '',
        'name' => '',
        'id' => '',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'uf' => [
        'label' => '',
        'name' => '',
        'id' => '',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'celular' => [
        'label' => '',
        'name' => '',
        'id' => '',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'pago' => [
        'label' => '',
        'name' => '',
        'id' => '',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
      'dt_experiencia' => [
        'label' => '',
        'name' => '',
        'id' => '',
        'value' => '',
        'required' => 'true',
        'disabled' => 'false',
        'type' => 'text'
      ],
    ];
  }

  public function selectByUsuario($usuario_id = ''){
    
    
     $this->selectWhere(['usuario_id' => $usuario_id]) ;
  }


}