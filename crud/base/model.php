<?php

class model extends conectDB {
    
  public $data;
  protected $arrJS;
  public $sqlBase = '';
  public $sqlBaseWherePK = '';
  public $insertBase = '';
  public $inputs = [];

  function __construct() {
    parent::__construct();
    $this->data['titulo'] = '';
    $this->arrJS = [];
    $this->createSql();
  }

  /*
    $this->inputs = [
      'id' => [
        'label' => 'Identificador',
        'name' => 'id',
        'id' => 'identificador',
        'value' => '',
        'select' => null,
        'required' => true,
        'disabled' => true,
        'type' => 'hidden'
      ],
      'atividade_id' => [
        'label' => 'Atividade',
        'name' => 'atividade_id',
        'id' => 'atividade_id',
        'value' => '',
        'select' => $data,
        'required' => true,
        'disabled' => false,
        'type' => 'text'
      ],
    ]
  */
  protected function createSql(){
    $campos = "";
    $camposParam = "";
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
            'type' => 'text'
          ];
          $campos .= $value->Field . ",";
          $camposParam .= ":" . $value->Field . ",";
          if($value->Key == 'PRI'){
            $this->pk = $value->Field;
            $this->inputs[$value->Field]['type'] = 'hidden';
          }
        }

        $campos = rtrim($campos, ",");
        $camposParam = rtrim($camposParam, ",");
        $this->sqlBase = "SELECT {$campos} FROM  {$this->table}";
        $this->insertBase = "INSERT INTO {$this->table} ({$campos}) VALUES ({$camposParam})";
        $this->sqlBaseWherePK = "SELECT {$campos} FROM  {$this->table} WHERE {$this->pk} = :{$this->pk}";
      }
    }
  }

  public function inserir($_arr){
    $this->insert($this->insertBase, $_arr);
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
}