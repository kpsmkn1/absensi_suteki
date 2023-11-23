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
					<div class="row">
						<div class="col-md-6 card offset-md-3">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title p-2">Edit Profil</h3>

										<?php if (session()->get('notif')) {
								echo session()->getFlashdata('notif');
							} ?>


									</div>


									
								</div>
							</div>
							<!-- /Page Header -->

							

							
							<form autocomplete="off" method="post" action="" enctype="multipart/form-data">
								

								

								<div class="row">
									
									<div class="col-md-12">
										<div class="form-group">
											<center><img style="border-radius: 50%; width: 100px; height: 100px;" src="<?= base_url() ?>/assets/img/<?= $allData['foto'] ?>" alt=""></center>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>ID User</label>
											<input value="<?= $allData['id_user'] ?>" type="text" readonly class="form-control">

											<input name="fotolama" value="<?= $allData['foto'] ?>" type="hidden" class="form-control">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Foto Profil</label>
											<input name="foto" value="<?= $allData['foto'] ?>" type="file" class="form-control">
										</div>
									</div>
									

								</div>

								<div class="form-group">
									<label>Nama</label>
									<input name="nama" value="<?= $allData['nama'] ?>" type="text" required class="form-control">
								</div>

								<div class="form-group">
									<label>Email</label>
									<input name="email" value="<?= $allData['email'] ?>" type="email" required class="form-control">
								</div>

								<div class="form-group">
									<label>No Tlp</label>
									<input name="nip" value="<?= $allData['nip'] ?>" type="text" required class="form-control">
								</div>

								<div class="form-group">
									<label>Jabatan</label>
									<select value="<?= $allData['jabatan'] ?>" id="jabatan" name="jabatan" required class="select form-control">
											
										<?php foreach ($allJabatan as $k) : ?>
											<option <?= ($allData['jabatan'] == $k['nama']) ? "selected" : "" ?> value="<?= $k['nama'] ?>"><?= $k['nama'] ?></option>
										<?php endforeach; ?>
										</select>
								</div>


								<div class="form-group">
									<label>Golongan</label>
									<select value="<?= $allData['golongan'] ?>" id="golongan" name="golongan" required class="select form-control">
											
										<?php foreach ($allGol as $k) : ?>
											<option <?= ($allData['golongan'] == $k['nama']) ? "selected" : "" ?> value="<?= $k['nama'] ?>"><?= $k['nama'] ?></option>
										<?php endforeach; ?>
										</select>
								</div>



								
								<div class="submit-section mb-3">
									<button class="btn btn-primary">Simpan Perubahan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /Page Content -->
				
			</div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		<?= $this->endSection(); ?>