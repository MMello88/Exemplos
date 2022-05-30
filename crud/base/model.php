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

          if($value->Field == 'ativo'){
            $this->inputs[$value->Field]['type'] = 'hidden';
          }
        }

        $campos = rtrim($campos, ",");
        $insertCampo = rtrim($insertCampo, ",");
        $insertParam = rtrim($insertParam, ",");

        $this->sqlBase = "SELECT {$campos} FROM  {$this->table} WHERE ativo = 'Sim'";
        $this->sqlBaseUsuario = "SELECT {$campos} FROM  {$this->table} WHERE usuario_id = :usuario_id AND ativo = 'Sim'";
        $this->insertBase = "INSERT INTO {$this->table} ({$insertCampo}) VALUES ({$insertParam})";
        $this->sqlBaseWherePK = "SELECT {$campos} FROM  {$this->table} WHERE {$this->pk} = :{$this->pk} AND ativo = 'Sim'";
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

  public function inserir($arrData){
    return $this->insert($this->insertBase, $arrData);
  }

  public function alterar($arrData){
    if(!isset($arrData[$this->pk])){
      return false;
    } else {
      $campos = '';
      $newArr[$this->pk] = $arrData[$this->pk];
      foreach ($this->field as $key => $field) {
        if ($field !== $this->pk){
          if(isset($arrData[$field])){
            $campos .=  " {$field} = :{$field},";
            $newArr[$field] = $arrData[$field];
          }
        } 
      }
      $campos = rtrim($campos, ",");
      $sql = "update {$this->table} set {$campos} where {$this->pk} = :{$this->pk}";
      return $this->update($sql, $newArr);
    }
    
  }

  public function deleteLogico(){
    $id = $_POST['id'];
    $tabela = $_POST['tabelaDel'];
    $campo = $_POST['campoDel'];
    $valor = $_POST['valorDel'];
    $sql = "UPDATE {$tabela} SET {$campo} = '{$valor}' WHERE id = {$id}";
    return $this->update($sql);
  }

  public function selectByUsuario($sqlWhere = ''){
    return $this->select($this->sqlBaseUsuario . $sqlWhere, ['usuario_id' => $_SESSION['usuario']->id]);
  }

  public function selectAll($sqlWhere = ''){
    return $this->query($this->sqlBase . $sqlWhere);
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


}