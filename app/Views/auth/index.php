<?= $this->extend('layouts/master_auth') ?>

<?= $this->section('title') ?>
    <?= esc($title); ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <h4 class="text-dark font-weight-normal">Selamat Datang Di <span class="font-weight-bold">Evoting App</span></h4>
            <p class="text-muted">Silahkan masuk dengan akun anda.</p>
            
            <!-- untuk form validasi error -->
            <?= $this->include('partials/msg_validation') ?>

            <form method="POST" action="<?= base_url('login') ?>" >
              <?= csrf_field() ?>
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" value="<?= set_value('email', '', true) ?>" required>
                <div class="invalid-feedback">
                  email tidak boleh kosong
                </div>
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                  password tidak boleh kosong
                </div>
              </div>

              <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  Login
                </button>
              </div>

            </form>

            <div class="text-center mt-5 text-small">
              Copyright &copy; Evoting App. Design by Stisla and Made by RobbiAbd
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="assets/stisla/assets/img/unsplash/login-bg.jpg">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold">Hallo,</h1>
                <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>

                <div id="digital-clock" class="font-weight-bold text-muted-transparent">
                  <p id="time"></p>
                  <p id="date"></p>
                </div>
              </div>
              Photo by <a class="text-light bb" href="#">Justin Kauffman</a> on <a class="text-light bb" href="#">Unsplash</a>
            </div>
          </div>
        </div>
      </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
  <script>
    window.setInterval(ut, 1000);

    function ut() {
      var d = new Date();
      document.getElementById("time").innerHTML = d.toLocaleTimeString();
      document.getElementById("date").innerHTML = d.toLocaleDateString();
    }
  </script>
<?= $this->endSection() ?>