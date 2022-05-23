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

function input($label, $name, $id, $value, $type, $required = 'false', $disabled = 'false'){
  return "
  <div class='form-group'>
    <label for='{$id}'>{$label}</label>
    <input name='{$name}' type='{$type}' class='form-control' id='{$id}' value='{$value}' required='{$required}' disabled='{$disabled}' placeholder='{$label}'>
  </div>
  ";
}