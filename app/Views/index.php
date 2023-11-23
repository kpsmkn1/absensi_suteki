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
								<h3 class="page-title">Welcome <?= (session()->get('role') ==2) ? "Admin" : "Pegawai" ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Dashboard</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-users"></i></span>
									<div class="dash-widget-info">
										<h3><?= $total_pengguna; ?></h3>
										<span>Pengguna</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-address-card"></i></span>
									<div class="dash-widget-info">
										<h3><?= $total_absen_hari_ini ?></h3>
										<span>Absen Hari Ini</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
									<div class="dash-widget-info">
										<h3><?= $jumlahdataWPH; ?></h3>
										<span>Verifikasi (WFH)</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-calendar"></i></span>
									<div class="dash-widget-info">
										<h3><?= date('d M Y') ?></h3>
										<span>Waktu</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					<!-- Statistics Widget -->
					<div class="row">
						
						
						<div class="col-md-8 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0">Pengguna </h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table custom-table mb-0">
											<thead>
												<tr>
													<th>Nama</th>
													<th>Jabatan</th>
													<th>Status</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($AllUsers as $k) : ?>
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="<?= base_url() ?>/profil/<?= $k['id_user'] ?>" class="avatar"><img alt="" src="assets/img/<?= $k['foto'] ?>"></a>
															<a href="client-profile.html"><?= $k['nama'] ?><span><?= ($k['role'] == 2) ? "Admin" : "Pegawai" ?></span></a>
														</h2>
													</td>
													<td><?= $k['jabatan'] ?></td>
													<td><?php 

											if ($k['status'] == 'aktif') {  ?>

												<span class="text-success">Aktif</span>
											<?php }elseif($k['status'] == 'tidak aktif') { ?>

												<span class="text-danger">Tidak Aktif</span>
											<?php }  ?></td>
													
													<td class="text-right">
														<a href="<?= base_url() ?>/pengguna" class="btn-sm btn btn-warning">Edit</a>
													</td>
												</tr>
												
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<a href="<?= base_url() ?>/pengguna">Lihat Semua</a>
								</div>
							</div>
						</div>
						
						<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
							<div class="card flex-fill">
								<div class="card-body">
									<h4 class="card-title">Absen Hari Ini</h4>

								<?php foreach ($query2rOW as $k) : ?>
									<div class="leave-info-box">
										<div class="media align-items-center">
											<a href="profile.html" class="avatar"><img alt="" src="assets/img/user.jpg"></a>
											<div class="media-body">
												<div class="text-sm my-0"><?= $k['nama'] ?></div>
											</div>
										</div>
										<div class="row align-items-center mt-3">
											<div class="col-6">
												<h6 class="mb-0"><?= $k['tanggal'] ?></h6>
												<span class="text-sm text-muted"><?= $k['absen_masuk'] ?></span>
											</div>
											<div class="col-6 text-right">
												<span class="badge bg-inverse-success">
													Hadir <?= $k['absen_masuk'] ?>|<?= $k['absen_siang'] ?>|<?= $k['absen_pulang'] ?>
														
													</span>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
								<?php if (count($query2rOW) == 0) { ?>
									<div class="alert alert-danger">
										<p>Tidak Ada Data</p>
									</div>
								<?php } ?>


									<div class="load-more text-center">
										<a class="text-dark" href="<?= base_url() ?>/list_absen">Lihat Semua</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Statistics Widget -->
					
				
					
				</div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->

			<?= $this->endSection(); ?>
			