              <?php if (isset($validation)) : ?>
                    <div class="alert alert-danger" role="alert">
                      <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <!-- untuk pesan session -->
                  <?php if (session()->has('danger')) : ?>
                    <div class="alert alert-danger" role="alert">
                      <?= session()->getFlashdata('danger') ?>
                    </div>
                  <?php endif; ?>

                   <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('success') ?>
                    </div>
                  <?php endif; ?>