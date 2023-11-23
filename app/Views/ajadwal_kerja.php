<?= $this->extend('template/index'); ?>
			<?= $this->section('content') ?>
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 offset-md-3">
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Jadwal Kerja</h3>
										<?php if (session()->get('notif')) {
								echo session()->getFlashdata('notif');
							} ?>


									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							<div>
								<form action="<?= base_url() ?>/jadwal_kerja" method="post">
									<input type="hidden" name="id_users">
									<ul class="list-group notification-list">
									<?php $no=1; foreach ($allData as $k) : ?>
									<li class="list-group-item">
										<?= $k['nama'] ?>
										<div class="status-toggle">
											<input name="<?= $k['id_kerja'] ?>" <?= ($k['status'] == 'masuk') ? "checked" : "" ?> type="checkbox" id="staff_module<?= $no; ?>" class="check">
											<label for="staff_module<?= $no; ?>" class="checktoggle">checkbox</label>
										</div>
									</li>
									<?php $no++; endforeach; ?>
									
								</ul>

								<button type="submit" class="btn btn-primary m-3">Simpan Perubahan</button>
								</form>
							</div>  
						</div>
					</div>
				</div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
		<!-- /Main Wrapper -->
		<?= $this->endSection(); ?>