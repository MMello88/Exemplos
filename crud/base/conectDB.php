<?php

class conectDB {
  protected $field = [];
  protected $table = "";
  protected $pk = "";
  protected $where = [];
  public $db;

  function __construct() {
    $dsn = 'mysql:host=localhost;port=3306;dbname=pet';
    $username = 'root';
    $password = '';
    $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ); 
    
    try{    
      $this->db = new PDO($dsn, $username, $password, $options);
    }catch (PDOException $e){
        die ('DB Error conection. Error: ' . $e->message);
    }
  }

  public function insert($sql, $param = null){
    $this->db->prepare($sql)->execute($param);
  }

  public function select($sql, $param = []){
    $sth = $this->db->prepare($sql);
    if ($sth->execute($param))
      return $sth->fetchAll(PDO::FETCH_CLASS);
    return null;
  }

  public function query($sql){
    return $this->db->query($sql)->fetchAll(PDO::FETCH_CLASS);
  }

  public function update($sql, $param = []){
    $this->db->prepare($sql)->execute($param);
  }

  public function delete($sql, $param = []){
    $this->db->prepare($sql)->execute($param);
  }

  protected function addJS($js){
    $this->arrJS[] = $js;
  }
}