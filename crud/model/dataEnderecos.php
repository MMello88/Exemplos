<?php
require_once("./base/model.php");

class dataEnderecos extends model {

  function  __construct() {
    $this->table = 'enderecos';
    $this->pk = "id";
    parent::__construct();
  }

}