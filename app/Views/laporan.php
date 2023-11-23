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
						<div class="row">
							<div class="col">
								<h3 class="page-title">Laporan Data Absensi</h3>
								
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<div class="row">
										<div class="col-md-auto">
											<a style="background-color: #017721;;" href="<?= base_url() ?>/download_laporan/<?= $id ?>" class="btn btn-success"><i class="fa fa-download"></i> Export To Excel</a>
										</div>

										<div class="col-md-auto">
											<select onchange="changeSelect(this)" class="form-control" id="">
												<option <?= ($id=='day' OR $id==null) ? 'selected' : '' ?> value="day">Hari Ini</option>
												<option <?= ($id=='month') ? 'selected' : '' ?> value="month">Bulan ini</option>
											</select>
										</div>

										<div class="col-md-auto">
											<input type="text" class="cd-search table-filter" data-table="order-table" placeholder="Cari .." />
										</div>


									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="mb-0 cd-table order-table table">
											<thead>
												<tr>
													<th>No</th>
													<th>No Tlp</th>
													<th>Nama</th>
													<th>Jabatan</th>
													<th>Golongan</th>
													<th>Masuk</th>
													<th>Izin</th>
													<th>Sakit</th>
													<th>Terlambat</th>
													
												</tr>
											</thead>
											<tbody>
												
												<?php $no=1; foreach ($AllData as $k) { ?>
												<tr onclick="goDetail('<?= $k['id_user'] ?>')">
													<td><?= $no++; ?></td>
													<td><?= $k['nip'] ?></td>
													<td><?= $k['nama'] ?></td>
													<td><?= $k['jabatan'] ?></td>
													<td><?= $k['golongan'] ?></td>
													<td><?= $k['M'] ?></td>
													<td><?= $k['I'] ?></td>
													<td><?= $k['S'] ?></td>
													<td><?= $k['A'] ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						
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