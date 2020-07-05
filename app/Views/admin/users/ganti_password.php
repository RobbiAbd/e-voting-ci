<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
    <?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="row">
    	<div class="col-md-8">
    		<div class="row">
    			<div class="col-md-6">
    				<form action="<?= base_url('admin/user/change_password') ?>" method="POST">
    					<?= csrf_field(); ?>

				  		<div class="form-group">
				          <label for="old_password">Password Lama</label>
				          <input type="password" class="form-control" name="old_password" id="old_password">
				        </div>

				        <div class="form-group">
				          <label for="new_password">Password Baru</label>
				          <input type="password" class="form-control" name="new_password" id="new_password">
				        </div>

				        <div class="form-group">
				          <label for="confirm_password">konfirmasi Password Baru</label>
				          <input type="password" class="form-control" name="confirm_password" id="confirm_password">
				        </div>

						<button type="submit" class="btn btn-primary">Submit</button>
				    </form>
    			</div>
    		</div>
    	</div>
    </div>

<?= $this->endSection() ?>