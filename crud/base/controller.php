<?php
include("conectDB.php");
include("utils.php");

class controller extends conectDB {
    
    public $data;
    protected $arrJS;

    function __construct() {
      parent::__construct();
      $this->data['titulo'] = '';
      $this->arrJS = [];
    }

    protected function addJS($js){
      $this->arrJS[] = $js;
    }

    protected function view($page){
      include("./pages/layout/header.php");
      include($page);
      include("./pages/layout/footer.php");
    }

    protected function viewLogado($page){
      include("./pages/layout/header_logado.php");
      include($page);
      include("./pages/layout/footer_logado.php");
    }

    protected function getModel($model){
      include("./model/{$model}.php");
      return new $model();
    }
}