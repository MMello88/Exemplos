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

    protected function view($views){
      extract($this->data);
      extract($_SESSION);
      include("./pages/layout/header.php");
      include($views);
      include("./pages/layout/footer.php");
    }

    protected function viewLogado($views){
      extract($this->data);
      extract($_SESSION);
      include("./pages/layout/header_logado.php");
      if (is_array($views)){
        foreach ($views as $key => $value) {
          include($value);
        }
      } else {
        include($views);
      }
      include("./pages/layout/footer_logado.php");
    }


    protected function getModel($model){
      include("./model/{$model}.php");
      return new $model();
    }

    public function getIndicadorMessage(){
      if (isset($_SESSION['flash_message']))
        echo $_SESSION['flash_message'];
      unset($_SESSION['flash_message']);
    }

}