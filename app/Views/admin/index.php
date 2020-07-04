<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
    <?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="/assets/stisla/assets/img/unsplash/andre-benz-1214056-unsplash.jpg">
                  <div class="hero-inner">
                    <h2>Welcome, <?= session()->nama ?>!</h2>
                    <p class="lead">Selamat datang di Dashboard Admin</p>
                  </div>
        </div>

<?= $this->endSection() ?>