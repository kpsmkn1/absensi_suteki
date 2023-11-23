<?php 
		if (session()->get('role') == 2) {
            echo $this->extend('template/index');
        }else {
            echo $this->extend('template/pegawai_template');
        }

 ?>
			
<?= $this->section('content') ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 card offset-md-3">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title p-4">Ganti Password</h3>

										<?php if (session()->get('notif')) {
								echo session()->getFlashdata('notif');
							} ?>


									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							<form autocomplete="off" method="post" action="">
								

								<div class="form-group">
									<label>Password Sekarang</label>
									<input value="<?= $allData['password'] ?>" type="text" readonly class="form-control">
								</div>


								<div class="form-group">
									<label>Password Baru</label>
									<input required name="p1" type="password" class="form-control">
								</div>
								<div class="form-group">
									<label>Konfirmasi Password Baru</label>
									<input name="p2" type="password" class="form-control">
								</div>
								<div class="submit-section mb-3">
									<button class="btn btn-primary">Ubah Password</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /Page Content -->
				
			</div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		<?= $this->endSection(); ?>