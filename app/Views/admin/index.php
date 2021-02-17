<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="hero text-white hero-bg-image hero-bg-parallax" data-background="/assets/stisla/assets/img/unsplash/andre-benz-1214056-unsplash.jpg">
  <div class="hero-inner">
    <h2>Welcome, <?= session()->nama ?>!</h2>
    <?php if (session()->get('id_level') == 1) : ?>
      <p class="lead">Selamat datang di Dashboard Admin</p>
    <?php elseif (session()->get('id_level') == 2) : ?>
      <p class="lead">Selamat datang di Dashboard Petugas</p>
    <?php elseif (session()->get('id_level') == 3) : ?>
      <p class="lead">Selamat datang di Dashboard Pendata</p>
    <?php elseif (session()->get('id_level') == 4) : ?>
      <p class="lead">Selamat datang di Dashboard Pemilih</p>
    <?php endif; ?>
  </div>
</div>

<?= $this->endSection() ?>