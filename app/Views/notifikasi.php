<?= $this->extend('template/index'); ?>
<?= $this->section('content') ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Notifikasi</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Notifikasi</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card mb-0">
								
								<div class="card-body">

									<a href="<?= base_url() ?>/notifikasi/dibaca" class="btn m-3 btn-sm btn-primary">Tandai Semua Sudah Dibaca</a>

									<div class="table-responsive">
										<table class="datatable table table-stripped mb-0">
											<thead>
												<tr>
													<th width="5%">No</th>
													<th>Nama Notifkasi</th>
													<th>Waktu</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php $no=1; foreach ($allData as $k):  ?>
												<tr>
													<td><?= $no++; ?></td>
													<td><?= $k['nama'] ?></td>
													<td><?php 
													// Hitung menit yang lalu
													$waktu_awal = $k['waktu'];
													$waktu_sekarang = time();

													$selisih = $waktu_sekarang - $waktu_awal;

													if ($selisih < 60) {
															echo round($selisih)." detik yang lalu";
														}elseif($selisih < (60*60)){
															echo round(($selisih/60))." menit yang lalu";

														}elseif($selisih < (60*60*24)){
															echo round(($selisih/(60*60)))." jam yang lalu";

														}elseif($selisih < (60*60*24*3)){
															echo round(($selisih/(60*60*24)))." hari yang lalu";

														}else{
															echo date('d M Y', $waktu_awal);
														}


													 ?></td>
													<td><?= ($k['status'] == 1) ? "<span style='color:orange'>belum dibaca</span>" : "<span style='color:blue'>sudah dibaca</span>" ?></td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
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