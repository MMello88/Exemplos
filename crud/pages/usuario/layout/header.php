          <div class="page">
            <!-- .page-cover -->
            <header class="page-cover">
              <div class="text-center">
                <?php if(empty($usuario->avatar)) : ?>
                  <a href="#" class="user-avatar user-avatar-xl"><img src="<?= ASSETS_URL ?>/assets/images/avatars/unknown-profile.jpg" alt=""></a>
                <?php else:  ?>
                  <a href="#" class="user-avatar user-avatar-xl"><img src="<?= ASSETS_URL ?>/assets/images/avatars/<?= $usuario->avatar ?>" alt=""></a>
                <?php endif; ?>
                <h2 class="h4 mt-2 mb-0"> <?= $usuario->nome ?> </h2>
              </div><!-- .cover-controls -->
            </header><!-- /.page-cover -->
            <!-- .page-navs -->
            <nav class="page-navs">
              <!-- .nav-scroller -->
              <div class="nav-scroller">
                <!-- .nav -->
                <div class="nav nav-center nav-tabs">
                  <?php if($usuario->tipo == "Administrador") : ?>
                  <a class="nav-link <?= $view_perfil == "overview" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/overview">Visão Geral</a> 
                  <?php endif; ?>
                  <a class="nav-link <?= $view_perfil == "perfil" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/perfil">Sua Conta</a>
                  <?php if($usuario->tipo == "Administrador") : ?>
                  <a class="nav-link <?= $view_perfil == "admin" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/admin">Administrador</a> 
                  <?php endif; ?>
                </div><!-- /.nav -->
              </div><!-- /.nav-scroller -->
            </nav><!-- /.page-navs -->