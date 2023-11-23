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
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Selamat Datang <?= (session()->get('role') ==2) ? "Admin" : "Pegawai" ?></h3>
								
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					
					
					
					
					
					
				
					
				</div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->

			<?= $this->endSection(); ?>
			