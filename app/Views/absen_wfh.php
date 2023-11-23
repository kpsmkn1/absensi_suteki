<?= $this->extend('template/index'); ?>
<?= $this->section('content') ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Presensi WFH ( Work From Home)</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Presensi WFH </li>
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
							<li class="nav-item"><a class="nav-link <?= ($jabasen == "wfo") ? "active" : "" ?>" href="<?= base_url() ?>/list_absen">WFO</a></li>


							<li class="nav-item"><a class="nav-link <?= ($jabasen == "wfh") ? "active" : "" ?>" href="<?= base_url() ?>/absen_wfh">WFH</a></li>

							<li class="nav-item"><a class="nav-link <?= ($active == "") ? "active" : "" ?>" href="<?= base_url() ?>/absen_wfh">Belum Dikonfirmasi</a></li>

							<li class="nav-item"><a class="nav-link <?= ($active == "day") ? "active" : "" ?>" href="<?= base_url() ?>/absen_wfh/day">Hari Ini</a></li>

						

							<li class="nav-item"><a class="nav-link <?= ($active == "semua") ? "active" : "" ?>" href="<?= base_url() ?>/absen_wfh/semua">Semua</a></li>

							
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
													<th>Maps</th>
													<th>Jam Absen</th>
													
													<th>J.Absen</th>
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
														<td><a target="_blank" href="<?= base_url() ?>/assets/foto_wfh/<?= $k['foto'] ?>"><img style="width: 40px;" src="<?= base_url() ?>/assets/foto_wfh/<?= $k['foto'] ?>" alt=""></a></td>
														<td><?= $k['tanggal'] ?></td>
														<td>
															<?php 

															

															$text = $k['lokasi'];
															$a = explode('|', $text);

															$string1 = preg_replace("/[^0-9\.\-]/","",$a[0]);
															$string2 = preg_replace("/[^0-9\.\-]/","",$a[1]);
															
															$linkmaps = "https://maps.google.com/?q=".$string1.",".$string2;
															
															 ?>
															 <a target="_blank" href="<?= $linkmaps ?>">
															 	<img width="40px" src="<?= base_url() ?>/assets/img/maps.png" alt="">
															 </a>
														</td>
														<td><?= $k['jam_absen'] ?></td>
														<td><?= $k['nama_absen'] ?></td>
														
														
														<td><?= $k['status'] ?></td>
														<td>
															<?php if ($k['status'] == "sudah diverifikasi") : ?>
															<a class="btn-sm btn btn-default border" href="javascript:void">Konfirmasi</a>
														<?php else: ?>
															<a class="btn-sm btn btn-warning" href="<?= base_url() ?>/confirm_wfh/<?= $k['id_wph'] ?>" onclick="return confirm('yakin ?')">Konfirmasi</a>
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