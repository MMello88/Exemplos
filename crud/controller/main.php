<?php 
include("./base/controller.php");

class main extends controller {

  function __construct() {
    parent::__construct();
  }

  public function index(){
    $this->data['titulo'] = "Principal";
    $this->view("./pages/main/index.php");
  }
}