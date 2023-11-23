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
								<h3 class="page-title">Pengguna</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Pengguna</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_promotion"><i class="fa fa-plus"></i> Tambah Pengguna</a>
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
											<th>Nama Pengguna</th>
											<th>Jabatan</th>
											<th>Role</th>
											<th>Status</th>
											<th class="text-right">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach ($all_users as $k) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td>
												<h2 class="table-avatar blue-link">
													<a href="<?= base_url() ?>/profil/<?= $k['id_user'] ?>" class="avatar"><img alt="" src="assets/img/<?= $k['foto'] ?>"></a>
													<?= $k['nama'] ?>
												</h2>
											</td>
											<td><?= $k['jabatan'] ?></td>
											<td><?= ($k['role'] == 1) ? "pegawai" : "admin" ?></td>
											<td><?php 

											if ($k['status'] == 'aktif') {  ?>

												<span class="text-success">Aktif</span>
											<?php }elseif($k['status'] == 'tidak aktif') { ?>

												<span class="text-danger">Tidak Aktif</span>
											<?php }  ?></td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a onclick="getIdPengguna_edit('<?= $k['id_user'] ?>','<?= $k['nama'] ?>','<?= $k['jabatan'] ?>','<?= $k['nip'] ?>','<?= $k['email'] ?>','<?= $k['password'] ?>','<?= $k['status'] ?>','<?= $k['role'] ?>','<?= $k['grade'] ?>','<?= $k['golongan'] ?>')" class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_promotion"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a onclick="getIdPengguna_delete(<?= $k['id_user'] ?>)" class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_promotion"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
								<h5 class="modal-title">Tambah Pengguna</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post" autocomplete="off">
									<div class="form-group">
										<label>Nama <span class="text-danger">*</span></label>
										<input name="nama" required class="form-control" type="text">
									</div>
									
									<div class="form-group">
										<label>Jabatan<span class="text-danger">*</span></label>
										<select name="jabatan" required class="select form-control">
										<?php foreach ($allJabatan as $k) : ?>
											<option value="<?= $k['nama'] ?>"><?= $k['nama'] ?></option>
										<?php endforeach; ?>
										</select>
									</div>
									
									<div class="form-group">
										<label>No Tlp <span class="text-danger">*</span></label>
										<input name='nip' required class="form-control" type="number">
									</div>

									<div class="form-group">
										<label>Email <span class="text-danger">*</span></label>
										<input name="email" required class="form-control" type="email">
									</div>

									<div class="form-group">
										<label>Password <span class="text-danger">*</span></label>
										<input name="password" required class="form-control" type="text">
									</div>

									<div class="form-group">
										<label>Tahun Masuk <span class="text-danger">*</span></label>
										<input name="Grade" required class="form-control" type="text">
									</div>

									<div class="form-group">
										<label>Golongan <span class="text-danger">*</span></label>
										<select name="golongan" required class="select form-control">
										<?php foreach ($allGolongan as $k) : ?>
											<option value="<?= $k['nama'] ?>"><?= $k['nama'] ?></option>
										<?php endforeach; ?>
									</select>
									</div>

									<div class="form-group">
										<label>Role Akun<span class="text-danger">*</span></label>
										<select name="role" class="select form-control">
											<option value="1">Pegawai</option>
											<option value="2">Admin</option>
										</select>
									</div>



									<div class="form-group">
										<label>Status Akun<span class="text-danger">*</span></label>
										<select name="status" class="select form-control">
											<option value="aktif">Aktif</option>
											<option value="tidak aktif">Tidak Aktif</option>
										</select>
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
								<h5 class="modal-title">Edit Pengguna</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<form action="" method="post" autocomplete="off">

									<input type="hidden" id="id_user" name="id_user">


									<div class="form-group">
										<label>Nama <span class="text-danger">*</span></label>
										<input id="nama" name="nama" required class="form-control" type="text">
									</div>
									
									<div class="form-group">
										<label>Jabatan<span class="text-danger">*</span></label>
										<select id="jabatan" name="jabatan" required class="select form-control">
											
										<?php foreach ($allJabatan as $k) : ?>
											<option value="<?= $k['nama'] ?>"><?= $k['nama'] ?></option>
										<?php endforeach; ?>
										</select>
									</div>
									
									<div class="form-group">
										<label>No Tlp <span class="text-danger">*</span></label>
										<input id="nip" name='nip' required class="form-control" type="number">
									</div>

									<div class="form-group">
										<label>Email <span class="text-danger">*</span></label>
										<input id="email" name="email" required class="form-control" type="email">
									</div>

									<div class="form-group">
										<label>Password <span class="text-danger">*</span></label>
										<input id="password" name="password" required class="form-control" type="text">
									</div>

									<div class="form-group">
										<label>Tahun Masuk <span class="text-danger">*</span></label>
										<input id="grade" name="grade" required class="form-control" type="text">
									</div>

									<div class="form-group">
										<label>Golongan <span class="text-danger">*</span></label>
										<select id="golongan" name="golongan" class="select form-control">
										<?php foreach ($allGolongan as $k) : ?>
											<option value="<?= $k['nama'] ?>"><?= $k['nama'] ?></option>
										<?php endforeach; ?>
										</select>
									</div>

									<div class="form-group">
										<label>Role Akun<span class="text-danger">*</span></label>
										<select id="role" name="role" class="select form-control">
											<option value="1">Pegawai</option>
											<option value="2">Admin</option>
										</select>
									</div>



									<div class="form-group">
										<label>Status Akun<span class="text-danger">*</span></label>
										<select id="status" name="status" class="select form-control">
											<option value="aktif">Aktif</option>
											<option value="tidak aktif">Tidak Aktif</option>
										</select>
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
									<h3>Hapus Pengguna</h3>
									<p>Apakah yakin untuk di hapus ?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a id="arefid" href="#" class="btn btn-primary continue-btn">Hapus</a>
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