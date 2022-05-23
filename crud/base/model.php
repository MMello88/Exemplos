<?php

class model extends conectDB {
    
  public $data;
  protected $arrJS;
  public $sqlBase = '';
  public $sqlBaseWherePK = '';
  public $inputs = [];

  function __construct() {
    parent::__construct();
    $this->data['titulo'] = '';
    $this->arrJS = [];
    $this->createSql();
  }

  protected function createSql(){
    $campos = "";
    if (!empty($this->table)){
      $sth = $this->db->prepare("SHOW FULL FIELDS FROM {$this->table}");
      if ($sth->execute()){
        $retorno = $sth->fetchAll(PDO::FETCH_CLASS);

        foreach ($retorno as $key => $value) {
          $this->field[] = $value->Field;
          $campos .= $value->Field . ",";
          if($value->Key == 'PRI'){
            $this->pk = $value->Field;
          }
        }

        $campos = rtrim($campos, ",");
        $this->sqlBase = "SELECT {$campos} FROM  {$this->table}";
        $this->sqlBaseWherePK = "SELECT {$campos} FROM  {$this->table} WHERE {$this->pk} = :{$this->pk}";
      }
    }
  }

  public function selectAll(){
    return $this->query($this->sqlBase);
  }

  public function selectByPk($id){
    return $this->select($this->sqlBaseWherePK, [$this->pk => $id]);
  }

  public function selectWhere($where = []){
    $sql = $this->sqlBase . " WHERE ";
    foreach ($where as $key => $value) {
      $sql .= "{$key} = :{$key} and ";
    }
    $sql = rtrim($sql, "and ");
    return $this->select($this->sql, $where);
  }

}