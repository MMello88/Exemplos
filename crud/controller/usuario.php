<?php 
require_once("./base/controller.php");
require_once("./controller/page404.php");

class usuario extends controller {

  public $usuario;
  public $empresa;
  public $enderecos;
  public $carteira;
  public $modulos;
  public $menus;
  public $submenus;
  public $projeto;

  function __construct() {
    parent::__construct();
    $this->usuario = getModel('dataUsuario');
    $this->empresa = getModel('dataEmpresas');
    $this->enderecos = getModel('dataEnderecos');
    $this->carteira = getModel('dataCarteira');
    $this->modulos = getModel('dataModulos');
    $this->menus = getModel('dataMenus');
    $this->projetos = getModel('dataProjetos');
    $this->data['titulo'] = "Usuário";
  }

  public function index(){
    $this->addJS('usuario.js');
    $this->viewLogado("./pages/usuario/index.php");
  }

  public function logout(){
    session_destroy();
    redirect("");
  }

  public function overview(){
    $this->data['view_perfil'] = 'overview';
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/perfil/overview.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  public function parceiro($detalhes = '', $id = ''){
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

  public function perfil($detalhes = '', $id = ''){
    $this->data['view_perfil'] = 'perfil';
    $this->data['detalhes'] = $detalhes;
    if (empty($detalhes)){
      $this->_perfil();
    } else if ($detalhes == 'enderecos'){
      $this->_enderecos();
    } else if ($detalhes == 'getEnderecos'){
      echo json_encode(["data" => $this->enderecos->selectByUsuario()]);
    } else if ($detalhes == 'getCarteira'){
      echo json_encode(["data" => $this->carteira->selectByUsuario()]);
    } else if ($detalhes == 'carteira'){
      $this->_carteira();
    } else if ($detalhes == 'senha'){
      $this->_senha();
    } else if ($detalhes == 'empresa'){
      $this->_empresa();
    } 
  }

  public function modulo($detalhes = '', $id = ''){
    $this->data['view_perfil'] = 'modulo';
    $this->data['detalhes'] = $detalhes;
    if (empty($detalhes)){
      $this->_modulo();
    } else if ($detalhes == 'getModulos'){
      echo json_encode(["data" => $this->modulos->selectAll()]);
    } 
  }

  public function menu($detalhes = '', $id = ''){
    $this->data['view_perfil'] = 'menu';
    $this->data['detalhes'] = $detalhes;
    if (empty($detalhes)){
      $this->_menus();
    } else if ($detalhes == 'getMenus'){
      echo json_encode(["data" => $this->menus->selectAll()]);
      
    } else if ($detalhes == 'submenus'){
      $this->_submenus($id);
    } else if ($detalhes == 'getSubmenus'){
      $this->submenus = getModel('dataSubmenus', $id);
      echo json_encode(["data" => $this->submenus->selectWhere(['id_menu' => $id])]);
    }
  }

  public function projeto($detalhes = '', $id = ''){
    $this->data['view_perfil'] = 'projeto';
    $this->data['detalhes'] = $detalhes;
    if (empty($detalhes)){
      $this->_projeto();
    } else if ($detalhes == 'getProjetos'){
      echo json_encode(["data" => $this->projetos->selectAll()]);
    }
  }

  public function plano($detalhes = '', $id = ''){
    $this->data['view_perfil'] = 'plano';
    $this->data['detalhes'] = $detalhes;
    if (empty($detalhes)){
      $this->_plano();
    }
  }

  private function _parceiro(){
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu_parceiro.php", 
      "./pages/usuario/perfil/parceiro.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  private function _plano(){
    //$this->planos->doGravarAjax();

    $this->addJS('planos.js');
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu_plano.php", 
      "./pages/usuario/plano/plano.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  
  }

  private function _site(){
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu_parceiro.php", 
      "./pages/usuario/perfil/site.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  private function _menus(){
    
    if (!$this->menus->doGravarAjax()){
      
      $this->addJS('menus.js');
      $this->viewLogado([
        "./pages/usuario/layout/header.php", 
        "./pages/usuario/layout/menu_menu.php", 
        "./pages/usuario/menu/menus.php", 
        "./pages/usuario/layout/footer.php"
      ]);
    }
  }

  private function _submenus($id){
    $this->submenus = getModel('dataSubmenus', $id);
    $data = $this->menus->selectWhere(['id' => $id]);
    if (count($data) > 0){
      if (!$this->submenus->doGravarAjax()){
        
        $this->addJS('submenus.js');
        $this->viewLogado([
          "./pages/usuario/layout/header.php", 
          "./pages/usuario/menu/submenus.php", 
          "./pages/usuario/layout/footer.php"
        ]);
      }
    } else {
      $page404 = new page404();
      $page404->index();
    }
  }

  private function _projeto(){
    if (!$this->projetos->doGravarAjax()){

      $this->addJS('projetos.js');
      $this->viewLogado([
        "./pages/usuario/layout/header.php", 
        "./pages/usuario/layout/menu_projeto.php", 
        "./pages/usuario/projeto/projeto.php", 
        "./pages/usuario/layout/footer.php"
      ]);
    }
  }

  private function _modulo(){
    if (!$this->modulos->doGravarAjax()){
      
      $this->addJS('modulos.js');
      $this->viewLogado([
        "./pages/usuario/layout/header.php", 
        "./pages/usuario/layout/menu_modulo.php", 
        "./pages/usuario/modulo/modulo.php", 
        "./pages/usuario/layout/footer.php"
      ]);
    }
  }

  private function _perfil(){
    if($_POST){
      $this->usuario->doUpdatePerfil($_POST);
    }
    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu.php", 
      "./pages/usuario/perfil/perfil.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  private function _enderecos(){

    if (!$this->enderecos->doGravarAjax()){
      
      $this->addJS('enderecos.js');
      $this->viewLogado([
        "./pages/usuario/layout/header.php", 
        "./pages/usuario/layout/menu.php", 
        "./pages/usuario/perfil/enderecos.php", 
        "./pages/usuario/layout/footer.php"
      ]);
    }
  }

  private function _carteira() {
    if (!$this->carteira->doGravarAjax()){
      
      $this->addJS('carteira.js');

      $this->viewLogado([
        "./pages/usuario/layout/header.php", 
        "./pages/usuario/layout/menu.php", 
        "./pages/usuario/perfil/carteira.php", 
        "./pages/usuario/layout/footer.php"
      ]);
    }
  }

  private function _senha() {
    
    $this->usuario->doTrocarSenha();
    

    $this->viewLogado([
      "./pages/usuario/layout/header.php", 
      "./pages/usuario/layout/menu.php", 
      "./pages/usuario/perfil/senha.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }

  private function _empresa() {

    $this->empresa->doGravar();
    
    $empresa = $this->empresa->selectByPk($_SESSION['usuario']->empresa_id);
    if(!empty($empresa)){
      $this->empresa->inputs['id']['value'] = $empresa[0]->id;
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
      "./pages/usuario/perfil/empresa.php", 
      "./pages/usuario/layout/footer.php"
    ]);
  }
}