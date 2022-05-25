<?php

require_once("./base/model.php");

class dataEmpresas extends model {

  function  __construct() {
    $this->table = 'empresas';
    $this->pk = "id";
    parent::__construct();
    $this->atividades = $this->getModel("dataAtividades");
    $data = $this->atividades->selectAll();
    $pago = [
      (object)["id" => "Sim", "nome" => "Sim"],
      (object)["id" => "Não", "nome" => "Não"],
    ];
    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['atividade_id']['label'] = 'Atividade';
    $this->inputs['atividade_id']['select'] = $data;
    $this->inputs['razao_social']['label'] = 'Razão social';
    $this->inputs['nome_fantasia']['label'] = 'Nome Fantasia';
    $this->inputs['cep']['label'] = 'CEP';
    $this->inputs['cep']['required'] = false;
    $this->inputs['endereco']['label'] = 'Endereço';
    $this->inputs['numero']['label'] = 'Número';
    $this->inputs['bairro']['label'] = 'Bairro';
    $this->inputs['complemento']['label'] = 'Complemento';
    $this->inputs['complemento']['required'] = false;
    $this->inputs['cidade']['label'] = 'Cidade';
    $this->inputs['uf']['label'] = 'Estado';
    $this->inputs['celular']['label'] = 'Celular';
    //$this->inputs['pago']['label'] = 'Pago';
    //$this->inputs['pago']['select'] = $pago;
    $this->inputs['pago']['type'] = 'hidden';
    $this->inputs['pago']['value'] = 'Não';
    $this->inputs['dt_experiencia']['label'] = 'Data Experiência';
    $this->inputs['dt_experiencia']['type'] = 'date';
  }

  public function salvar($_arr){
    //tratar o array
    
    if(!isset($_arr['atividade_id'])){
      setflashdata(indicator("Por favor, Preencher o campo Atividade", "danger"));
    } else if(!isset($_arr['razao_social'])){
      setflashdata(indicator("Por favor, Preencher o campo Razão Social", "danger"));
    } else if(!isset($_arr['nome_fantasia'])){
      setflashdata(indicator("Por favor, Preencher o campo Nome Fantasia", "danger"));
    } else if(!isset($_arr['cep'])){
      setflashdata(indicator("Por favor, Preencher o campo CEP", "danger"));
    } else if(!isset($_arr['endereco'])){
      setflashdata(indicator("Por favor, Preencher o campo Endereço", "danger"));
    } else if(!isset($_arr['numero'])){
      setflashdata(indicator("Por favor, Preencher o campo Número", "danger"));
    } else if(!isset($_arr['bairro'])){
      setflashdata(indicator("Por favor, Preencher o campo Bairro", "danger"));
    } else if(!isset($_arr['cidade'])){
      setflashdata(indicator("Por favor, Preencher o campo Cidade", "danger"));
    } else if(!isset($_arr['celular'])){
      setflashdata(indicator("Por favor, Preencher o campo Celular", "danger"));
    } else if(!isset($_arr['dt_experiencia'])){
      setflashdata(indicator("Por favor, Preencher o campo Data Experiência", "danger"));
    } else {
      $id = $this->inserir($_arr);
      return $id;
    }

    return false;
  }

  public function alterar($_arr){
    
  }

  


}