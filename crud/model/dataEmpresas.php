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
    $this->inputs['id']['disabled'] = true;
    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['atividade_id']['label'] = 'Atividade';
    $this->inputs['atividade_id']['select'] = $data;
    $this->inputs['razao_social']['label'] = 'Razão social';
    $this->inputs['nome_fantasia']['label'] = 'Nome Fantasia';
    $this->inputs['cep']['label'] = 'CEP';
    $this->inputs['endereco']['label'] = 'Endereço';
    $this->inputs['numero']['label'] = 'Número';
    $this->inputs['bairro']['label'] = 'Bairro';
    $this->inputs['complemento']['label'] = 'Complemento';
    $this->inputs['complemento']['required'] = false;
    $this->inputs['cidade']['label'] = 'Cidade';
    $this->inputs['uf']['label'] = 'Estado';
    $this->inputs['celular']['label'] = 'Celular';
    $this->inputs['pago']['label'] = 'Pago';
    $this->inputs['pago']['select'] = $pago;
    $this->inputs['dt_experiencia']['label'] = 'Data Experiência';
    $this->inputs['dt_experiencia']['type'] = 'date';
  }

  public function salvar($_arr){
    //tratar o array
    if(!isset($_arr['atividade_id'])){
      setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
    } else if(!isset($_arr['razao_social'])){
      setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
    } else if(!isset($_arr['nome_fantasia'])){
      setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
    } else if(!isset($_arr['cep'])){
      setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
    } else if(!isset($_arr['endereco'])){
      setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
    } else if(!isset($_arr['numero'])){
      setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
    } else if(!isset($_arr['bairro'])){
      setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
    } else if(!isset($_arr['complemento'])){
      setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
    } else if(!isset($_arr['razao_social'])){
      setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
    } else if(!isset($_arr['razao_social'])){
      setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
    }
    $this->inserir($_arr);
  }

  public function selectByUsuario($usuario_id = ''){
    
    
    print_r($this->selectWhere(['usuario_id' => $usuario_id]));
  }


}