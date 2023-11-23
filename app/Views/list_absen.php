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

									<div class="table-responsive">
										<table class="datatable table table-stripped mb-0">
											<thead>
												<tr>
													<th width="5%">No</th>
													<th>Nama</th>
													<th>Tanggal</th>
													<th>Absen Masuk</th>
													<th>Absen Siang</th>
													<th>Absen Pulang</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php $no=1; foreach ($allData as $k) : ?>
													<tr>
														<td><?= $no++; ?></td>
														<td>
															<h2 class="table-avatar blue-link">
																<a href="<?= base_url() ?>/profil/<?= $k['id_user'] ?>" class="avatar"><img alt="" src="<?= base_url() ?>/assets/img/<?= $k['foto'] ?>"></a>
																<?= $k['nama'] ?>
															</h2>
														</td>
														<td><?= $k['tanggal'] ?></td>
														<td><?= $k['absen_masuk'] ?></td>
														<td><?= $k['absen_siang'] ?></td>
														<td><?= $k['absen_pulang'] ?></td>
														<td><?= $k['status'] ?></td>
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