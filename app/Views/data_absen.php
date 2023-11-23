<?= $this->extend('template/index'); ?>
<?= $this->section('content') ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Verifikasi Data Absensi</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Data Absensi</li>
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
							<li class="nav-item"><a class="nav-link <?= ($active == "") ? "active" : "" ?>" href="<?= base_url() ?>/data_absen">Belum Dikonfirmasi</a></li>

							<li class="nav-item"><a class="nav-link <?= ($active == "izin") ? "active" : "" ?>" href="<?= base_url() ?>/data_absen/izin">Izin</a></li>

							
							<li class="nav-item"><a class="nav-link <?= ($active == "cuti") ? "active" : "" ?>" href="<?= base_url() ?>/data_absen/cuti">Cuti</a></li>


							<li class="nav-item"><a class="nav-link <?= ($active == "semua") ? "active" : "" ?>" href="<?= base_url() ?>/data_absen/semua">Semua</a></li>

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
													<th>Foto</th>
													<th>Tanggal</th>
													<th>Keterangan</th>
													<th>J.Absensi</th>
													
													<th>Waktu Absen</th>
													<th>Status</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php $no=1; foreach ($allData as $k) : ?>
													<tr>
														<td><?= $no++; ?></td>
														<td>
															<h2 class="table-avatar blue-link">
																<a href="<?= base_url() ?>/profil/<?= $k['id_user'] ?>">
																<?= $k['nama'] ?></a>
															</h2>
														</td>
														<td><a target="_blank" href="<?= base_url() ?>/assets/foto_absen/<?= $k['foto'] ?>"><img style="width: 40px;" src="<?= base_url() ?>/assets/foto_absen/<?= $k['foto'] ?>" alt=""></a></td>
														<td><?= $k['tanggal'] ?></td>
														<td><?= $k['ket'] ?></td>
														<td><?= $k['alasan'] ?></td>
														
														<td>
															<ul>
														<?php 
															$w = explode(',', $k['waktu_absen']);
															foreach ($w as $x) {
																echo "<li>".$x."</li>";
															}

														 ?>
														 	
														 	</ul>
														</td>
														<td><?= $k['status'] ?></td>
														<td>
															<?php if ($k['status'] == "sudah dikonfirmasi") : ?>
															<a class="btn-sm btn btn-default border" href="javascript:void">Konfirmasi</a>
														<?php else: ?>
															<a class="btn-sm btn btn-warning" href="<?= base_url() ?>/confirm_absen/<?= $k['id_user'] ?>/<?= $k['tanggal'] ?>" onclick="return confirm('yakin ?')">Konfirmasi</a>
														<?php endif; ?>
														</td>
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