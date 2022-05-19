<?php
include("./base/model.php");

class dataUsuario extends model {

  function  __construct() {
    parent::__construct();

    $this->field = ['id', 'nome', 'email', 'senha', 'tipo'];
    $this->table = 'usuario';
    $this->pk = "id";
    $this->where = ['tipo'];
  }

  public function usuario($id){

  }

  public function inserir($arr){
    $arr['senha'] = md5($arr['senha']);
    return $this->insert('insert into usuario (id, nome, email, senha, tipo) values (null, :nome, :email, :senha, :tipo)', $arr);
  }

  public function selectByEmail($email){
    return $this->select('select id, nome, email, tipo, senha from usuario where email = :email', ['email' => $email]);
  }

}