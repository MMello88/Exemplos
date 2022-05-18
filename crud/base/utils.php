<?php

function getPost($name){
  if (isset($_POST))
    return isset($_POST[$name]) ? $_POST[$name] : "";
  return "";
}

function modalDanger($msg, $id) {
  return "
  <!-- Alert Danger Modal -->
  <div class='modal modal-alert fade show' id='$id' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='exampleModalAlertDangerLabel' aria-hidden='true'>
    <!-- .modal-dialog -->
    <div class='modal-dialog' role='document'>
      <!-- .modal-content -->
      <div class='modal-content'>
        <!-- .modal-header -->
        <div class='modal-header'>
          <h5 id='exampleModalAlertDangerLabel' class='modal-title'><i class='fa fa-exclamation-triangle text-red mr-1'></i> Ops</h5>
        </div>
        <!-- /.modal-header -->
        <!-- .modal-body -->
        <div class='modal-body'>
          <p>{$msg}</p>
        </div>
        <!-- /.modal-body -->
        <!-- .modal-footer -->
        <div class='modal-footer'>
          <button type='button' class='btn btn-light' data-dismiss='modal'>Close</button>
        </div>
        <!-- /.modal-footer -->
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- /.card-body -->
  ";
}