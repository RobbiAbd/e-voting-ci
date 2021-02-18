<?= $this->extend('layouts/master_voting') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="mt-4 mb-4 text-center">
    <h2>Pemilihan berhasil</h2>

    <a href="<?= base_url('voting') ?>" class="btn btn-success mt-4">Keluar</a>
  </div>

  <?= $this->endSection() ?>