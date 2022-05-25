<?php 
require_once("./base/controller.php");

class usuario extends controller {

  public $usuario;
  public $empresa;
  public $enderecos;

  function __construct() {
    parent::__construct();
    $this->usuario = $this->getModel('dataUsuario');
    $this->empresa = $this->getModel('dataEmpresas');
    $this->enderecos = $this->getModel('dataEnderecos');
    $this->data['titulo'] = "Usuário";
  }

  public function index(){
    $this->addJS('usuario.js');
    $this->viewLogado("./pages/usuario/index.php");
  }

  public function editar($id = ''){
    echo "editar chegou {$id}";
    $this->view("./pages/usuario/editar.php");
  }

  public function deletar($id){
    echo "deletar chegou {$id}";
    $this->view("./pages/usuario/deletar.php");
  }

  public function logout(){
    session_destroy();
    redirect("");
  }

  public function overview(){
    $this->data['view_perfil'] = 'overview';
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/overview.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  public function parceiro($detalhes = ''){
    $this->data['view_perfil'] = 'parceiro';
    $this->data['detalhes'] = $detalhes;
    if(in_array($_SESSION['usuario']->tipo,["Laboratório"])){
      if (empty($detalhes)){
        $this->_parceiro();
      } else if($detalhes == 'site'){
        $this->_site();
      }
    } else {
      redirect("/dashboard");
    }
  }

  private function _parceiro(){
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu_parceiro.php", 
      "./pages/usuario/parceiro.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  private function _site(){
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu_parceiro.php", 
      "./pages/usuario/site.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  public function perfil($detalhes = ''){
    $this->data['view_perfil'] = 'perfil';
    $this->data['detalhes'] = $detalhes;
    if (empty($detalhes)){
      $this->_perfil();
    } else if ($detalhes == 'enderecos'){
      $this->_enderecos();
    } else if ($detalhes == 'carteira'){
      $this->_carteira();
    } else if ($detalhes == 'senha'){
      $this->_senha();
    } else if ($detalhes == 'empresa'){
      $this->_empresa();
    } 
  }

  private function _perfil(){
    if($_POST){
      $this->usuario->doUpdatePerfil($_POST);
    }
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu.php", 
      "./pages/usuario/perfil.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  private function _enderecos(){
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu.php", 
      "./pages/usuario/enderecos.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  private function _carteira() {
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu.php", 
      "./pages/usuario/carteira.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  private function _senha() {
    if($_POST){
      $this->usuario->doTrocarSenha($_POST);
    }

    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu.php", 
      "./pages/usuario/senha.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  private function _empresa() {

    if($_POST){
      if(empty($_POST['id'])){
        $_POST['id'] = null;
        $id_empresa = $this->empresa->salvar($_POST);
        
        $this->usuario->alterar(['empresa_id' => $id_empresa, 'id' => $_SESSION['usuario']->id]);
      }
      //else $this->empresa->update($_POST);
    }
    
    $empresa = $this->empresa->selectByPk($_SESSION['usuario']->empresa_id);
    if(!empty($empresa)){
      $this->empresa->inputs['id'] = $empresa[0]->id;
      $this->empresa->inputs['atividade_id']['value'] = $empresa[0]->atividade_id;
      $this->empresa->inputs['razao_social']['value'] = $empresa[0]->razao_social;
      $this->empresa->inputs['nome_fantasia']['value'] = $empresa[0]->nome_fantasia;
      $this->empresa->inputs['cep']['value'] = $empresa[0]->cep;
      $this->empresa->inputs['endereco']['value'] = $empresa[0]->endereco;
      $this->empresa->inputs['numero']['value'] = $empresa[0]->numero;
      $this->empresa->inputs['bairro']['value'] = $empresa[0]->bairro;
      $this->empresa->inputs['complemento']['value'] = $empresa[0]->complemento;
      $this->empresa->inputs['cidade']['value'] = $empresa[0]->cidade;
      $this->empresa->inputs['uf']['value'] = $empresa[0]->uf;
      $this->empresa->inputs['celular']['value'] = $empresa[0]->celular;
      $this->empresa->inputs['pago']['value'] = $empresa[0]->pago;
      $this->empresa->inputs['dt_experiencia']['value'] = $empresa[0]->dt_experiencia;
    }

    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu.php", 
      "./pages/usuario/empresa.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }
}