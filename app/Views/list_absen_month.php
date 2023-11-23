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

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Data Presensi</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Data Presensi</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card mb-0">
								
								<div class="card-body">

			<div class="row">

				<div class="col-sm-12"> 
					<div class="card-body">
						<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
							<?php 
							if (session()->get('role') == '2') { ?>
								<li class="nav-item"><a class="nav-link <?= ($jabasen == "wfo") ? "active" : "" ?>" href="<?= base_url() ?>/list_absen">WFO</a></li>


							<li class="nav-item"><a class="nav-link <?= ($jabasen == "wfh") ? "active" : "" ?>" href="<?= base_url() ?>/absen_wfh">WFH</a></li>
							<?php }

							 ?>

							<li class="nav-item"><a class="nav-link <?= ($active == "") ? "active" : "" ?>" href="<?= base_url() ?>/list_absen">Hari Ini</a></li>

							

							<li class="nav-item"><a class="nav-link <?= ($active == "month") ? "active" : "" ?>" href="<?= base_url() ?>/list_absen/month">Bulan Ini</a></li>

							
						</ul>
				
					</div>
				</div>



			
			</div>

								<?php foreach ($allData as $k) { ?>
									
									<div class="card p-2 mb-4">
										<h2>Juni 2022</h2>
										<table border="1" cellpadding="10">
											<tr>
												<td>Tepat Waktu</td>
												<td>3</td>
												<td>Telat</td>
												<td>24</td>
											</tr>
											<tr>
												<td>Salah Masuk</td>
												<td>3</td>
												<td>Tidak Masuk</td>
												<td>24</td>
											</tr>
											<tr>
												<td>Hari Kerja</td>
												<td>3</td>
												<td>Jam Kerja</td>
												<td>24</td>
											</tr>
										</table>
									</div>

								<?php } ?>	


								</div>
							</div>
						</div>
					</div>
				
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->

<?= $this->endSection(); ?>