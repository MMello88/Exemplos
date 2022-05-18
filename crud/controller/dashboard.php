<?php 
include("./base/controller.php");

class dashboard extends controller {

  function __construct() {
    parent::__construct();
  }

  public function index(){
    $this->data['titulo'] = "Principal";
    $this->viewLogado("./pages/dashboard/index.php");
  }
}