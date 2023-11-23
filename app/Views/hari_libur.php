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
								<h3 class="page-title">Jadwal Hari Libur</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Jadwal Libur</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_promotion"><i class="fa fa-plus"></i> Tambah Hari Libur</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">

							<?php if (session()->get('notif')) {
								echo session()->getFlashdata('notif');
							} ?>



							<div class="table-responsive">
							
								<!-- Promotion Table -->
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Nama Hari Libur</th>
											<th>Tanggal</th>
											<th>Waktu</th>
											<th class="text-right">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach ($all_libur as $k) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $k['nama'] ?></td>
											<td><?= $k['waktu'] ?></td>
											<td>
												<?php 
													// Hitung menit yang lalu
													$waktu_awal = strtotime($k['waktu']);
													$waktu_sekarang = time();

													$selisih = $waktu_sekarang - $waktu_awal;

													if ($selisih < 60) {
														if ($selisih < 0) {
															$newselisih = str_replace("-", "", $selisih);


															if ($newselisih > 60 AND $newselisih < 64800) {
																echo "Hari Ini";
															}elseif($newselisih > (60*60*24)){
															echo round(($newselisih/(60*60*24)))." hari yang akan datang";
														}



														}else {

															echo "Hari Ini";
														}
														


														}elseif($selisih < (60*60*24)){
															echo "Hari Ini";

														}elseif($selisih < (60*60*24*3)){
															echo round(($selisih/(60*60*24)))." hari yang lalu";

														}else{
															echo date('d M Y', $waktu_awal);
														}


													 ?>

											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a onclick="getIdharilibur_edit('<?= $k['id_libur'] ?>','<?= $k['nama'] ?>','<?= $k['waktu'] ?>')" class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_promotion"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a onclick="getIdharilibur_delete('<?= $k['id_libur'] ?>')" class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_promotion"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								<!-- /Promotion Table -->
								
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Promotion Modal -->
				<div id="add_promotion" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Tambah Hari Libur</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post" autocomplete="off">
									<div class="form-group">
										<label>Nama Hari Libur<span class="text-danger">*</span></label>
										<input name="nama" required class="form-control" type="text">
									</div>

									<div class="form-group">
										<label>Tanggal <span class="text-danger">*</span></label>
										<input min="<?= date('Y-m-d') ?>" name="tanggal" required class="form-control" type="date">
									</div>
									
									
									
									


									<div class="submit-section">
										<button class="btn btn-success submit-btn">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Promotion Modal -->
				
				<!-- Edit Promotion Modal -->
				<div id="edit_promotion" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Hari Libur</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<form action="" method="post" autocomplete="off">
									<div class="form-group">
										<label>Nama Hari Libur<span class="text-danger">*</span></label>
										<input id="nama" required autofocus name="nama" required class="form-control" type="text">
										<input type="hidden" id="idLibur" name="idLibur">
									</div>

									<div class="form-group">
										<label>Tanggal<span class="text-danger">*</span></label>
										<input min="<?= date('Y-m-d') ?>" name="tanggal" id="tanggal" required class="form-control" type="date">
									</div>
									
									<div class="submit-section">
										<button class="btn btn-success submit-btn">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Promotion Modal -->
				
				<!-- Delete Promotion Modal -->
				<div class="modal custom-modal fade" id="delete_promotion" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Hapus Hari Libur</h3>
									<p>Apakah yakin untuk di hapus ?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a id="hreflibur" href="#" class="btn btn-primary continue-btn">Hapus</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Batal</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Delete Promotion Modal -->
			
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
		<?= $this->endSection(); ?>