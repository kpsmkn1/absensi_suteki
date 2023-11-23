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
										<h3 class="text-center page-title p-4"><?= $absen ?></h3>
										<center><span><?= $jam1 ?> - <?= $jam2 ?></span></center>
<?php if (session()->get('notif')) {
								echo session()->getFlashdata('notif');
							} ?>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							<form autocomplete="off" method="post" action="" enctype="multipart/form-data">
								

								<div class="form-group">
									<label>Tanggal</label>
									<input type="hidden" name="absen" value="<?= md5($unix) ?>">
									
									<input value="<?= date('Y-m-d') ?>" type="text" readonly class="form-control">
								</div>

								<div class="form-group">
									<label>Ip Saya</label>
									<input type="text" id="ipku" name="ipku" readonly class="form-control">
								</div>


								<div class="form-group">
									<label>Waktu Absen</label>
									<input name="jamnow" id="jamnow" value="Loading..." type="text" readonly class="form-control">
								</div>

								



								<script>
									function jalan_time(){
										date = new Date();
										detik = date.getSeconds();
										menit = date.getMinutes();
										jam = date.getHours();

										if((jam+"").length === 1){
										    jam = "0"+jam;
										}
										if((menit+"").length === 1){
										    menit = "0"+menit;
										}

										if((detik+"").length === 1){
										    detik = "0"+detik;
										}


										var timenow = jam + ":"+ menit+ ":"+detik;
										document.getElementById('jamnow').value = timenow;
									}
									setInterval(function(){
										jalan_time();
									},1000)
								</script>

								<div class="form-group">
									<label>Pilih Jenis Absen</label>
									<select onchange="gantijenisabsen(this)" required name="jenisabsen" class="form-control" id="">
										<option selected disabled value="">Pilih Absen</option>
										<option value="WFO">WFO [ Work From Office ]</option>
										<option value="WFH">WFH [ Work From House ]</option>
									</select>
								</div>

								<div class="form-group" id="btn_absen" style="display: none;">
									<label>Lokasi Absen</label>
									<input name="lokasi" id="lokasi" value="" type="text" readonly class="form-control">
								</div>

								<div class="form-group" id="btn_foto" style="display: none;">
									<label>Dokumentasi ( <i class="text-muted">Dokumentasi Pekerjaan yang Dikerjakan Dari Rumah</i> )</label>
									<input name="foto" id="foto" type="file" class="form-control">
								</div>



								<div class="form-group">
									<div style="color:red; " id="tampil"></div>
								</div>
								
								<?php  ?>
								<div class="submit-section mb-3">
									<button class="btn btn-primary">Mulai Absen</button>
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