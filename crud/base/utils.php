<?php

function redirect($page){
  header("Location: " . BASE_URL . "{$page}");
  exit;
}

function getPost($name){
  if (isset($_POST))
    return isset($_POST[$name]) ? $_POST[$name] : "";
  return "";
}

function indicator($msg, $alert) {
  return "
  <div class='row'>
    <div class='col-lg-12'>
      <div class='alert alert-{$alert} alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <a href='#' class='alert-link'>{$msg}</a>
      </div>
    </div>
  </div>
  ";
}

function setflashdata($msg) {
  $_SESSION['flash_message'] = $msg;
}

function input($label, $name, $id, $value, $type, $select = [], $col = '12', $required = false, $disabled = false){
  $display = $type == 'hidden' ? 'none' : 'inline-block';
  if ($disabled) $required = false;
  $required = $required ? "required" : "";
  $disabled = $disabled ? "disabled" : "";

  if (count($select) > 0){
    $html = "
      
        <div class='col-md-{$col} mb-3'>
          <label for='{$id}' style='display:{$display}'>{$label}</label>
          <div class='form-label-group'>
            <select class='custom-select' id='{$id}' name='{$name}' {$required} {$disabled}>
              <option value=''> Selecionar... </option>";
              foreach ($select as  $valor) {
                $active = $value == $valor->id ?  "selected" : "";
                $html .="<option value='{$valor->id}' $active> {$valor->nome} </option>";
              }
      $html .="</select> <label for='{$id}'>{$label}</label>
          </div>
        </div>
      
    ";
    return $html;
  } else {
    return "
    
      <div class='col-md-{$col} mb-3'>
        <label for='{$id}' style='display:{$display}'>{$label}</label>
        <input name='{$name}' type='{$type}' class='form-control' id='{$id}' value='{$value}' placeholder='{$label}' {$required} {$disabled}>
      </div>
    
    ";
  }
}

function formCard($inputs, $titulo, $titulo_button = 'Alterar'){
  $html = "
  <!-- .card -->
  <div class='card card-fluid'>
    <h6 class='card-header'> {$titulo} </h6><!-- .card-body -->
    <div class='card-body'>
      <!-- form -->
      <form action='{$_SERVER['PHP_SELF']}' method='POST'>
        <div class='form-row'>";
       
          foreach($inputs as $key => $value) {
            //if (isset($value['value']))
              //print_r($inputs);
            $html .= input($value['label'], $value['name'], $value['id'], $value['value'], $value['type'], $value['select'], $value['col'], $value['required'], $value['disabled']);
          }
  $html .= " </div>
        <hr>
        <!-- .form-actions -->
        <div class='form-actions'>
          <button type='submit' value='perfil' class='btn btn-primary ml-auto'>{$titulo_button}</button>
        </div><!-- /.form-actions -->
      </form><!-- /form -->
    </div><!-- /.card-body -->
  </div><!-- /.card -->
  ";

  return $html;
}