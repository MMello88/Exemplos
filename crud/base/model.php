<?php

class model extends conectDB {
    
  public $data;
  protected $arrJS;

  function __construct() {
    parent::__construct();
    $this->data['titulo'] = '';
    $this->arrJS = [];
  }
}