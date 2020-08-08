<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
    <?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="row">
    	<div class="col-md-8">
    		<div class="row">
    			<div class="col-md-6">
    				<form action="<?= base_url('admin/token/bulk_add') ?>" method="POST">
    					<?= csrf_field(); ?>

				  		<div class="form-group">
				          <label for="jumlah">Jumlah token</label>
				          <input type="text" class="form-control" name="jumlah" id="jumlah" value="">
				        </div>

				        <div class="form-group">
	                      <label for="expired_at">Kadaluarsa Pada</label>
	                      <select class="custom-select" id="expired_at" name="expired_at">
							
							<!-- value dalam bentuk detik -->
	                        <option value="180">
	                        	3 menit
	                        </option>

	                        <option value="300">
	                        	5 menit
	                        </option>

	                        <option value="600">
	                        	10 menit
	                        </option>

	                        <option value="3600">
	                        	1 jam
	                        </option>
	                        
	                        <option value="7200">
	                        	2 jam
	                        </option>

	                      </select>
	                    </div>
						<button type="submit" class="btn btn-primary">Generate</button>
				    </form>
    			</div>
    		</div>
    	</div>
    </div>

<?= $this->endSection() ?>