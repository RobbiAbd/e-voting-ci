<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- datatables -->
<div class="card">
  <div class="card-header">
    <h4>Tabel Token</h4>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-2">
            <a href="<?= base_url('admin/token/bulk_add') ?>" class="btn btn-primary mb-4">Bulk Token</a>
          </div>
          <div class="col-md-2">
            <a href="<?= base_url('admin/token/add') ?>" class="btn btn-primary mb-4">Tambah</a>
          </div>
          <div class="col-md-4">
            <button type="button" class="btn btn-danger mb-4" data-toggle="modal" data-target="#deleteAllModal">
              Hapus Semua
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped" id="datatables">
        <thead>
          <tr>
            <th class="text-center">
              #
            </th>
            <th>Token</th>
            <th>Jumlah Max Pengguna</th>
            <th>Total Pengguna Saat ini</th>
            <th>Expired At</th>
            <th>Date Created</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- modal delete all -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteAllModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin ingin menghapus semua data.</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="<?= base_url('admin/token/delete_all') ?>" method="POST">
          <?= csrf_field(); ?>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- modal delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin ingin menghapus data ini.</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="<?= base_url('admin/token/delete') ?>" method="POST">
          <?= csrf_field(); ?>
          <input type="hidden" id="delete-input-id" name="id" value="">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    var table = $('#datatables').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?= base_url('ajax/get_token') ?>",
        "type": "POST",
        data: function(data) {
          data._csrf = getCsrf();
        },
        complete: function(data) {
          setCsrf(JSON.parse(data.responseText).csrf);
        }
      },

      //optional
      "lengthMenu": [
        [5, 10, 25, 100],
        [5, 10, 25, 100]
      ],
      "columnDefs": [{
        "targets": [],
        "orderable": false,
      }, ],

    });

    $('#datatables tbody').on('click', '.btn-delete', function(e) {
      const id = e.target.dataset.id;
      $('#deleteModal #delete-input-id').val(id);
      $('#deleteModal').modal();
    });
  });
</script>
<?= $this->endSection() ?>