<?= $this->extend('template/index'); ?>
			<?= $this->section('content') ?>

			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Jadwal Kerja</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Jadwal Kerja</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="<?= base_url() ?>/jadwal_libur" class="btn add-btn"><i class="fa fa-plus"></i> Tambah Hari Libur</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card mb-0">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
										
											<!-- Calendar -->
											<div id="calendar"></div>
											<!-- /Calendar -->
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
			
			
				
				
            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		


        	<?= $this->endSection(); ?>

    <!-- Datetimepicker JS -->
		