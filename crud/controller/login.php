<?php 
include("./base/controller.php");

class login extends controller {

  function __construct() {
    parent::__construct();
  }

  public function index(){
    $this->data['titulo'] = "Principal";
    $this->view("./pages/login/index.php");
  }
}