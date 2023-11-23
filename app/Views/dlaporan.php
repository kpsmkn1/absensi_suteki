<?= $this->extend('template/index'); ?>
<?= $this->section('content') ?>
			<style>
				<style>
.cd-table-container{
  background: #fff;
  box-shadow: 1px 2px 26px rgba(0, 0, 0, 0.2);
  padding: 15px;
  max-width: 720px;
}
/* Table Design */
.cd-table{
  width: 100%;
  color: #666;
  margin: 10px auto;
  border-collapse: collapse;
}

.cd-table tr,
.cd-table td{
  border: 1px solid #ccc;
  padding: 10px;
}
.cd-table th{
  background: #017721;
  color: #fff;
  text-align: center;
  padding: 10px;
}

/* Search Box */
.cd-search{
  padding: 10px;
  border: 1px solid #ccc;
  width: 100%;
  box-sizing: border-box;
}

/* Search Title */
.cd-title{
  color: #666;
  margin: 15px 0;
}
</style>
			</style>
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<a href="<?= base_url() ?>/laporan"><div class="row">
							<div class="col">
								<h3 class="page-title"><i style="color:black;" class="fa fa-arrow-left"></i> Detail Riwayat Kehadiran</h3>
								
							</div>
						</div></a>
					</div>
					<!-- /Page Header -->
					
					<div class="row">

<!-- id_user	nama	foto	email	password	nip	jabatan	golongan	grade	cookie	status	role	id_absen	tanggal	tanggal_time	absen_masuk	absen_siang	absen_pulang	jabsen -->
						<?php foreach ($AllData as $k) { ?>
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<h5><?= $k['tanggal']; ?></h5>
									<div class="table-responsive">
										<table class="mb-0 cd-table order-table table">
											<thead>

												<tr>
													<th>Masuk</th>
													<th>Tengah</th>
													<th>Pulang</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td width="33%" align="center"><?= $j1; ?></td>
													<td width="33%" align="center"><?= $j2; ?></td>
													<td width="33%" align="center"><?= $j3; ?></td>
												</tr>
												<tr>
													<td width="33%" align="center"><?= $k['absen_masuk']; ?></td>
													<td width="33%" align="center"><?= $k['absen_siang']; ?></td>
													<td width="33%" align="center"><?= $k['absen_pulang']; ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>

						

					</div>
					
					
					
				</div>			
			</div>
			<!-- /Main Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		<script>

			function goDetail(e) {
				var url = "<?= base_url() ?>/dlaporan/"+e;
				location.href = url;
			}
			(function() {
	'use strict';

var TableFilter = (function() {
 var Arr = Array.prototype;
		var input;
  
		function onInputEvent(e) {
			input = e.target;
			var table1 = document.getElementsByClassName(input.getAttribute('data-table'));
			Arr.forEach.call(table1, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, filter);
				});
			});
		}

		function filter(row) {
			var text = row.textContent.toLowerCase();
       //console.log(text);
      var val = input.value.toLowerCase();
      //console.log(val);
			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
		}

		return {
			init: function() {
				var inputs = document.getElementsByClassName('table-filter');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = onInputEvent;
				});
			}
		};
 
	})();

  /*console.log(document.readyState);
	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
      console.log(document.readyState);
			TableFilter.init();
		}
	}); */
  
 TableFilter.init(); 
})();
		</script>
<?= $this->endSection(); ?>