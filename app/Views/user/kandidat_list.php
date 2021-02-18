<?= $this->extend('layouts/master_voting') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="mt-4 mb-4 text-center">
    <h3>Silahkan Pilih Kandidat dibawah ini</h3>
    <hr class="yellow-line" />

    <?= $this->include('partials/msg_validation') ?>


  </div>
  <div class="row mt-5 mb-5">
    <?php foreach ($get_kandidat as $kandidat) : ?>
      <div class="col-md-4 mt-4 mb-4">
        <div class="card">
          <img src="<?= base_url('assets/avatar/' . $kandidat['avatar']) ?>" class="card-img-top" alt="<?= $kandidat['nama'] ?>">
          <div class="card-body text-center">
            <h5 class="card-title"><?= $kandidat['nama'] ?></h5>
            <div class="row">
              <div class="col">
                <button type="button" class="btn btn-warning btn-pilih-kandidat" data-id="<?= $kandidat['id_kandidat'] ?>">
                  Pilih Kandidat
                </button>
              </div>
              <div class="col">
                <button type="button" class="btn btn-info btn-visimisi" data-visi="<?= $kandidat['visi'] ?>" data-misi="<?= $kandidat['misi'] ?>">Lihat Visi Misi</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?= $this->include('partials/partials_user/footer') ?>

<!-- modal pilih kandidat -->
<div class="modal fade" id="kandidatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Yakin ingin memilih kandidat ini ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="<?= base_url('voting/kandidat/pilih') ?>" method="POST">
          <?= csrf_field(); ?>
          <input type="hidden" name="id" id="kandidat-id" value="">
          <button type="submit" class="btn btn-primary">Simpan Pilihan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal pilih kandidat -->

<!-- modal visi misi -->
<div class="modal fade" id="visiMisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Visi Misi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>Visi :</strong>
        <div class="value-visi"></div>

        <strong>Misi :</strong>
        <div class="value-misi"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal visi misi -->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    $('.btn-visimisi').on('click', function(e) {
      const visi = e.target.dataset.visi;
      const misi = e.target.dataset.misi;

      $('.value-visi').html(visi);
      $('.value-misi').html(misi);
      $('#visiMisiModal').modal();
    });

    $('.btn-pilih-kandidat').on('click', function(e) {
      const id = e.target.dataset.id;
      $('#kandidatModal #kandidat-id').val(id);
      $('#kandidatModal').modal();
    });
  });
</script>
<?= $this->endSection() ?>