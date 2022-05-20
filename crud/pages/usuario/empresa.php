                  <!-- grid column -->
                  <div class="col-lg-8">
                    <!-- .card -->
                    <div class="card card-fluid">
                      <h6 class="card-header"> Dados do Usuário </h6><!-- .card-body -->
                      <div class="card-body">
                        <!-- form -->
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                          <input type="hidden" name="usuario_id" value="<?= $usuario->id ?>">
                         
                          <!-- form-group -->
                          <div class="form-group">
                            <label for="input01">Nome completo</label>
                            <input name="nome" type="text" class="form-control" id="input01" value="<?= $usuario->nome ?>" required>
                          </div>
                          <!-- /form row -->
                          <!-- .form-group -->
                          <div class="form-group">
                            <label for="input03">Email</label>
                            <input name="email" type="email" class="form-control" id="input03" value="<?= $usuario->email ?>" required disabled>
                          </div>
                          <!-- /.form-group -->
                          <!-- .form-group -->
                          <div class="form-group">
                            <label for="input04">CPF ou CNPJ</label>
                            <input name="cpf_cnpj" type="text" class="form-control" id="input04" value="<?= $usuario->cpf_cnpj ?>" required>
                          </div>
                          <!-- /.form-group -->
                          <!-- .form-group -->
                          <div class="form-group">
                            <label for="input05">Telefone</label>
                            <input name="telefone" type="text" class="form-control" id="input05" value="<?= $usuario->telefone ?>" required>
                          </div>
                          <!-- /.form-group -->
                          <hr>
                          <!-- .form-actions -->
                          <div class="form-actions">
                            <button type="submit" value="perfil" class="btn btn-primary ml-auto">Alterar</button>
                          </div><!-- /.form-actions -->
                        </form><!-- /form -->
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->
                  </div><!-- /grid column -->