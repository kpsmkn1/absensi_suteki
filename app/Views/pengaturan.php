<?= $this->extend('template/index'); ?>
<?= $this->section('content') ?>
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-10 offset-md-1">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										

									


									</div>





									<div class="col-sm-12">
										<div class="card">
											<h3 class="p-3 page-title">Pengaturan</h3>
												<?php if (session()->get('notif')) {
								echo session()->getFlashdata('notif');
							} ?>

									<div class="card-body">
										<!-- <h4 class="card-title">Rounded justified</h4> -->
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
											<li class="nav-item"><a class="nav-link active" href="#solid-rounded-justified-tab1" data-toggle="tab">Website</a></li>
											<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2" data-toggle="tab">Jabatan</a></li>
											<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab3" data-toggle="tab">Golongan</a></li>
											<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab4" data-toggle="tab">Jam Kerja</a></li>
											<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab5" data-toggle="tab">Network</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane show active" id="solid-rounded-justified-tab1">
												

						<form>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Nama Website <span class="text-danger">*</span></label>
											<input name="nama" class="form-control" type="text" value="<?= $allData[0]['nama'] ?>">

											<input type="hidden" value="<?= $allData[0]['id_website'] ?>" name='id_website'>
										</div>
									</div>
									
								</div>
								<div class="row mt-4">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Konfirmasi Jika Pegawai Baru Yang Mendaftar</label>
											<select name="konfirmasi" class="form-control select">
												<option value="konfirmasi">Konfirmasi</option>
												<option <?= ($allData[0]['konfirmasi'] == "tidak") ? "selected" : "" ?> value="tidak">Tidak Perlu Konfirmasi</option>
											</select>
										</div>
									</div>
								</div>
								
								
								
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Simpan Perubahan</button>
								</div>
						</form>	


											</div>
											<div class="tab-pane" id="solid-rounded-justified-tab2">
												


							<form action="" method="post">
								<div class="row">
									<div class="col-sm-8">
										<div class="table-responsive">
							
								<!-- Promotion Table -->
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Jabatan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach ($allJabatan as $k) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $k['nama'] ?></td>
											
											<td>
												<a href="#" onclick="getIdjabatan_delete(<?= $k['id_jabatan'] ?>)" data-toggle="modal" data-target="#delete_promotion"><i class="fa fa-trash-o m-r-5"></i> Hapus</a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								<!-- /Promotion Table -->
								
							</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Tambah Jabatan Baru <span class="text-danger">*</span></label>
											<input name="jabatan" required class="form-control" type="text" value="">
										</div>

										<div class="submit-section">
									<button class="btn-sm btn btn-primary">Simpan Perubahan</button>
								</div>


									</div>

									


									
								</div>
						</form>	

											</div>
											<div class="tab-pane" id="solid-rounded-justified-tab3">
												

													<form action="" method="post">
								<div class="row">
									<div class="col-sm-8">
										<div class="table-responsive">
							
								<!-- Promotion Table -->
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Golongan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach ($allGolongan as $k) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $k['nama'] ?></td>
											
											<td>
												<a href="#" onclick="getIdgolongan_delete(<?= $k['id_gol'] ?>)" data-toggle="modal" data-target="#delete_golongan"><i class="fa fa-trash-o m-r-5"></i> Hapus</a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								<!-- /Promotion Table -->
								
							</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Tambah Golongan Baru <span class="text-danger">*</span></label>
											<input name="golongan" required class="form-control" type="text" value="">
										</div>

										<div class="submit-section">
									<button class="btn-sm btn btn-primary">Simpan Perubahan</button>
								</div>


									</div>

									


									
								</div>
						</form>	


											</div>




											<div class="tab-pane" id="solid-rounded-justified-tab4">
												

						
							<div class="row">
								<div class="col-12">
									

											<div class="table-responsive">
							
								<!-- Promotion Table -->
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>Jam Masuk</th>
											<th>Absen Siang</th>
											<th>Jam Pulang</th>
										</tr>
										<tr>
										<?php foreach ($allJamKerja as $k) : ?>
											<th><?= $k['jam1'] ?> - <?= $k['jam2'] ?><br> <a onclick="jam_edit('<?= $k['nama'] ?>','<?= $k['id_jamkerja'] ?>','<?= $k['jam1'] ?>','<?= $k['jam2'] ?>')"  href="#" data-toggle="modal" data-target="#add_promotion"><button class="btn btn-sm btn-default border">Edit</button></a>
											</th>
										<?php endforeach; ?>

											<!-- <th>09:30 - 11:30 <br> <button onclick="jam_edit(2)" class="btn btn-sm btn-default border">Edit</button></th>

											<th>15:00 - 15:30<br> <button onclick="jam_edit(3)" class="btn btn-sm btn-default border">Edit</button></th> -->
										</tr>
									</thead>
									
								</table>
								<!-- /Promotion Table -->
								
							</div>


								</div>
							</div>
					

											</div>


					<div class="tab-pane" id="solid-rounded-justified-tab5">
							<div class="row">
								<div class="col-12">

									<div class="alert alert-dark">Alamat IP Saat Ini : 

										<span id="tampil"></span>
										<button  class="btn btn-sm border btn-warning" onclick="ajax_online()">Lihat IP</button>
									 	
									 </div>
									<form autocomplete="off" method="post" action="">
										<input type="hidden" name="ipkantor">
							<?php $no=1; foreach ($ipkantor as $k) :?>
								<div class="form-group">
									<label class="text-muted">IP Kantor <?= $no; ?></label>
									<input value="<?= $k['ip_name'] ?>" name="ip_name<?= $no; ?>" type="text" class="form-control">
								</div>
							<?php $no++; endforeach; ?>
							
								

								<p class="text-muted">List Alamat IP digunakan Untuk Absensi ( WFO )</p>
								
								<div class="submit-section mb-3">
									<button class="btn btn-primary">Simpan</button>
								</div>
							</form>
								</div>
							</div>
						</div>





										</div>
									</div>
								</div>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							
						</div>
					</div>
                </div>
				<!-- /Page Content -->

				<!-- Delete Promotion Modal -->
				<div class="modal custom-modal fade" id="delete_promotion" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Hapus Jabatan</h3>
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


							<!-- Delete Promotion Modal -->
				<div class="modal custom-modal fade" id="delete_golongan" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Hapus Golongan</h3>
									<p>Apakah yakin untuk di hapus ?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a id="arefid2" href="#" class="btn btn-primary continue-btn">Hapus</a>
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

				<!-- Add Promotion Modal -->
				<div id="add_promotion" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"><span id="juduljam">asd</span></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post" autocomplete="off">
									
									
									<div class="form-group">
										<label>Jam Mulai <span class="text-danger">*</span></label>
										<input id="jam1" value="" name='jam1' required class="form-control" type="time">
										<input name="jamKerja" type="hidden" id="jamKerja">
									</div>

									<div class="form-group">
										<label>Jam Selesai <span class="text-danger">*</span></label>
										<input  id="jam2" name='jam2' required class="form-control" type="time">
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



				
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
<?= $this->endSection(); ?>