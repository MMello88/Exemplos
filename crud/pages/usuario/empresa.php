                  <?php print_r($empresa); ?>
                  <!-- grid column -->
                  <div class="col-lg-8">
                    <!-- .card -->
                    <div class="card card-fluid">
                      <h6 class="card-header"> Dados do Usuário </h6><!-- .card-body -->
                      <div class="card-body">
                        <!-- form -->
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                          <input type="hidden" name="usuario_id" value="<?= $usuario->id ?>">
                          <input type="hidden" name="usuario_id" value="<?= $usuario->id ?>">
                         
                          <?php
                            foreach($this->empresa->inputs as $key => $value) {
                              echo input($value['label'], $value['name'], $value['id'], $value['value'], $value['type'], $value['required'], $value['disabled']);
                            }
                          ?>
                          
                          <!-- .form-group -->
                          <div class="form-group">
                            <label for="input05">Telefone</label>
                            <input name="telefone" type="text" class="form-control" id="input05" value="<?= $usuario->telefone ?>" required disabled>
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