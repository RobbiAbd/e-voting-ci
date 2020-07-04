<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
    <?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="row">
    	<div class="col-md-8">
    		<div class="row">
    			<div class="col-md-6">
    				<form action="<?= base_url('admin/user/add') ?>" method="POST">
    					<?= csrf_field(); ?>
				  		<div class="form-group">
				          <label for="nama">Nama</label>
				          <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama','',true) ?>">
				        </div>

				        <div class="form-group">
				          <label for="email">Email</label>
				          <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email','',true) ?>">
				        </div>

				        <div class="form-group">
				          <label for="password">Password</label>
				          <input type="password" class="form-control" name="password" id="password" value="<?= set_value('password','',true) ?>">
				        </div> 

				        <div class="form-group">
	                      <label for="level">Level</label>
	                      <select class="custom-select" id="level" name="level">
	                        <?php foreach($level as $item) : ?>
	                        	<option value="<?= $item['id_level'] ?>"><?= $item['level'] ?></option>
	                        <?php endforeach; ?>
	                      </select>
	                    </div>
						<button type="submit" class="btn btn-primary">Submit</button>
				    </form>
    			</div>
    		</div>
    	</div>
    </div>

<?= $this->endSection() ?>