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
      print_r($_POST);
      if(!isset($_POST['id']))
        $this->empresa->salvar($_POST);
      //else $this->empresa->update($_POST);
    }
    
    $this->data['empresa'] = $this->empresa->selectByUsuario($_SESSION['usuario']->id);

    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu.php", 
      "./pages/usuario/empresa.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }
}