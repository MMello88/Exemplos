            <!-- .page-inner -->
            <div class="page-inner">
              <!-- .page-section -->
              <div class="page-section">
                <?= $this->getIndicadorMessage(); ?>
                <!-- grid row -->
                <div class="row">
                  <!-- grid column -->
                  <div class="col-lg-4">
                    <!-- .card -->
                    <div class="card card-fluid">
                      <h6 class="card-header"> Detalhes </h6><!-- .nav -->
                      <nav class="nav nav-tabs flex-column border-0">
                        <a href="<?= BASE_URL ?>/usuario/perfil" class="nav-link <?=  empty($detalhes) ? "active": "" ?>">Usuário</a> 
                        <a href="<?= BASE_URL ?>/usuario/perfil/enderecos" class="nav-link <?=  $detalhes == "enderecos" ? "active": "" ?>">Endereços <?= $detalhes ?></a> 
                        <a href="<?= BASE_URL ?>/usuario/perfil/carteira" class="nav-link <?=  $detalhes == "carteira" ? "active": "" ?>">Sua carteira</a> 
                        <a href="<?= BASE_URL ?>/usuario/perfil/senha" class="nav-link <?=  $detalhes == "senha" ? "active": "" ?>">Trocar senha</a> 
                        <?php if($usuario->tipo == 'Administrador') : ?>
                        <a href="<?= BASE_URL ?>/usuario/perfil/admin" class="nav-link <?=  $detalhes == "admin" ? "active": "" ?>">Administrador</a> 
                        <?php endif; ?>
                      </nav><!-- /.nav -->
                    </div><!-- /.card -->
                  </div><!-- /grid column -->