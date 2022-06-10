# HTML PAGES

```html
                  <!-- grid column -->
                  <div class="col-lg-8">
                    <!-- .page-section -->
                    <div class="page-section">
                      <!-- .card -->
                      <div class="card card-fluid">
                        <div class="card-header">
                          <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalForm">Adicionar</button>
                        </div>
                        <!-- .card-body -->
                        <div class="card-body">
                          <!-- .table -->
                          <table id="datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                              <tr>
                                <th> [colunas] </th>
                                <th style="width:100px; min-width:100px;">&nbsp;</th>
                              </tr>
                            </thead>
                          </table><!-- /.table -->
                        </div><!-- /.card-body -->
                      </div><!-- /.card -->
                    </div><!-- /.page-section -->
                  </div><!-- /grid column -->

                  <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
                    <!-- .modal-dialog -->
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                      <!-- .modal-content -->
                      <div class="modal-content">
                        <!-- .modal-header -->
                        <div class="modal-header">
                          <h5 id="modalFormLabel" class="modal-title"> [titulo] </h5>
                        </div><!-- /.modal-header -->
                        <!-- .modal-body -->
                        <div class="modal-body">
                          <?= formCard($this->[model]->inputs, '', 'Salvar') ?>
                        </div><!-- /.modal-body -->
                        <!-- .modal-footer -->
                        <div class="modal-footer">
                          <button type='submit' form="formAdd" value='perfil' class='btn btn-primary ml-auto'>Salvar</button>
                          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
                        </div><!-- /.modal-footer -->
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div>
```

# PHP Model

```php
<?php
require_once("./base/model.php");

class data[Tabela] extends model {

  function  __construct() {
    $this->table = '[tabela]';
    $this->pk = "id";
    parent::__construct();

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "[titulo p/ coluna]";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['ativo']['order'] = 2;
    $this->inputs['ativo']['value'] = 'Sim';

    /**
     * A função ordernar caso tenho configurado sua ordenação
     */
    $this->ordernar();
  }

  private function validate($_arr){
    $arrMessage = [];
    if((!isset($_POST['[campo]'])) or (empty($_POST['[campo]']))) {
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo [titulo p/ coluna]!',
      ];
    } else if((!isset($_POST['[campo]'])) or (empty($_POST['[campo]']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo [titulo p/ coluna]!',
      ];
    } else {
      return true;
    }
    echo json_encode($arrMessage);
    return false;
  }

  public function doGravarAjax(){
    if($_POST){
      if ($this->validate()){
        if(empty($_POST['id'])){
          $id = $this->inserir($_POST);
          $_POST['id'] = $id;
          echo json_encode([
            'status' => 'true', 
            'title' => 'Pronto',
            'message' => 'Cadastro realizado com sucesso!',
            'data' => $_POST
          ]);
        } else {
          if(isset($_POST['tabelaDel'])){
            if ($this->deleteLogico()) {
              echo json_encode([
                'status' => 'true',
                'title' => 'Pronto',
                'message' => 'Delete realizado com sucesso!',
              ]);
            } else {
              echo json_encode([
                'status' => 'false',
                'title' => 'Falha',
                'message' => 'Falha ao realizar o delete. Tente novamente em instantes.',
              ]);
            }
          } else {
            if($this->alterar($_POST)){
              echo json_encode([
                'status' => 'true',
                'title' => 'Pronto',
                'message' => 'Dados alterado com sucesso!',
                'data' => $_POST
              ]);
            } else {
              echo json_encode([
                'status' => 'false',
                'title' => 'Falha',
                'message' => 'Falha ao realizar a alteração. Tente novamente em instantes.',
              ]);
            }
          }
        }
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}
```

# PHP Controller

```php
<?php 
require_once("./base/controller.php");

class [controller] extends controller {

  public $[model];
  
  /**
   * Obrigatório fazer a criação.
   */
  function __construct() {
    /**
     * utilizar o if para as paginas controladas pelo login
     */
    if (!isset($_SESSION['usuario'])) redirect("/login");
    parent::__construct();
    $this->[model] = getModel('data[model]');
  }

  /**
   * Obrigatório criar o index
   */
  public function index(){
    /**
     * JS se necessário
     */
    $this->addJS('[controller].js');
    /**
     * viewLogado contem o layout para paginas logados
     * o parametro pode ser array, quando requerer incluir outro layout
     */
    $this->viewLogado("./pages/[controller]/index.php");

    /**
     * view contem o layout para paginas não logado
     */
    $this->view("./pages/[controller]/index.php");
  }

  public function [method]($[param1] = '', $[param2] = ''){
    if (!$this->[model]->doGravarAjax()){
      
      $this->addJS('[controller].js');

      $this->viewLogado("./pages/[controller]/index.php");
    }
  }
```