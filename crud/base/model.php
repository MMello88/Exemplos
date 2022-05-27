<?php

class model extends conectDB {
    
  public $data;
  protected $arrJS;
  public $sqlBase = '';
  public $sqlBaseWherePK = '';
  public $insertBase = '';
  public $sqlBaseUsuario = '';
  public $inputs = [];

  function __construct() {
    parent::__construct();
    $this->data['titulo'] = '';
    $this->arrJS = [];
    $this->createSql();
  }

  protected function createSql(){
    $campos = "";
    $insertParam = "";
    $insertCampo = "";
    if (!empty($this->table)){
      $sth = $this->db->prepare("SHOW FULL FIELDS FROM {$this->table}");
      if ($sth->execute()){
        $retorno = $sth->fetchAll(PDO::FETCH_CLASS);

        foreach ($retorno as $key => $value) {
          $this->field[] = $value->Field;

          $this->inputs[$value->Field] = [
            'label' => $value->Field,
            'name' => $value->Field,
            'id' => $value->Field,
            'value' => '',
            'select' => null,
            'required' => $value->Null == 'NO',
            'disabled' => false,
            'type' => 'text',
            'col' => '12',
            'order' => $key
          ];

          $campos .= $value->Field . ",";
          $insertCampo .= $value->Field . ",";
          $insertParam .= ":" . $value->Field . ",";

          if($value->Key == 'PRI'){
            $this->pk = $value->Field;
            $this->inputs[$value->Field]['type'] = 'hidden';
          }
        }

        $campos = rtrim($campos, ",");
        $insertCampo = rtrim($insertCampo, ",");
        $insertParam = rtrim($insertParam, ",");

        $this->sqlBase = "SELECT {$campos} FROM  {$this->table}";
        $this->sqlBaseUsuario = "SELECT {$campos} FROM  {$this->table} WHERE usuario_id = :usuario_id";
        $this->insertBase = "INSERT INTO {$this->table} ({$insertCampo}) VALUES ({$insertParam})";
        $this->sqlBaseWherePK = "SELECT {$campos} FROM  {$this->table} WHERE {$this->pk} = :{$this->pk}";
      }
    }
  }

  public function ordernar(){
    $arr = [];
    for ($i=0; $i < count($this->inputs); $i++) { 
      foreach ($this->inputs as $key => $value) {
        if ($value['order'] == $i){
          break;
        }
      }
      $arr[$key] = $value;
    }
    
    $this->inputs = $arr;
  }

  public function inserir($_arr){
    return $this->insert($this->insertBase, $_arr);
  }

  public function selectByUsuario(){
    return $this->select($this->sqlBaseUsuario, ['usuario_id' => $_SESSION['usuario']->id]);
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
      $sql .= " {$key} = :{$key} and";
    }
    $sql = rtrim($sql, "and");
    
    return $this->select($sql, $where);
  }

  protected function getModel($model){
    require_once("./model/{$model}.php");
    return new $model();
  }

  public function alterar($arrAss){
    if(!isset($arrAss[$this->pk])){
      return false;
    } else {
      $campos = '';
      $newArr[$this->pk] = $arrAss[$this->pk];
      foreach ($this->field as $key => $field) {
        if ($field !== $this->pk){
          if(isset($arrAss[$field])){
            $campos .=  " {$field} = :{$field},";
            $newArr[$field] = $arrAss[$field];
          }
        } 
      }
      $campos = rtrim($campos, ",");
      $sql = "update {$this->table} set {$campos} where {$this->pk} = :{$this->pk}";
      return $this->update($sql, $newArr);
    }
    
  }
}