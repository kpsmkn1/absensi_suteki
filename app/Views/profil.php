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
								<h3 class="page-title"><?= $title ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active"><?= $title ?></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="card mb-0">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="profile-view">
										<div class="profile-img-wrap">
											<div class="profile-img">
												<a href="">
													<img src="<?= base_url() ?>/assets/img/<?= $all_users['foto'] ?>" alt="">
												</a>
											</div>
										</div>
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
														<h3 class="user-name m-t-0"><?= $all_users['nama'] ?></h3>
														<h5 class="company-role m-t-0 mb-0"><?= $all_users['jabatan'] ?></h5>
														<small class="text-muted">
															
															<?= ($all_users['role'] == "2") ? "admin" : "pegawai" ?>

														</small>
														<div class="staff-id">ID User : <?= (290000+$all_users['id_user']) ?></div>
														<?php if ($status == 'off') : ?>
														<div class="staff-msg">
															<a href="<?= base_url() ?>/edit_profil" class="btn btn-custom">Edit Profil</a>


															<a href="<?= base_url() ?>/ganti_password" class="btn border">Ganti Password</a>
														</div>
													<?php endif; ?>
													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<span class="title">Email</span>
															<span class="text"><?= $all_users['email'] ?></span>
														</li>
														<li>
															<span class="title">No Tlp</span>
															<span class="text"><?= $all_users['nip'] ?></span>
														</li>
														<li>
															<span class="title">Golongan</span>
															<span class="text"><?= $all_users['golongan'] ?></span>
														</li>
														
														<li>
															<span class="title">Tahun Masuk</span>
															<span class="text"><?= $all_users['grade'] ?></span>
														</li>
														<li>
															<span class="title">Status</span>
															<span class="text"><?= ($all_users['status'] == "aktif") ? "aktif" : "tidak aktif" ?></span>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card tab-box" style="display: none;">
						<div class="row user-tabs">
							<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
								<ul class="nav nav-tabs nav-tabs-bottom">
									<li class="nav-item col-sm-3"><a class="nav-link active" data-toggle="tab" href="#myprojects">Projects</a></li>
									<li class="nav-item col-sm-3"><a class="nav-link" data-toggle="tab" href="#tasks">Tasks</a></li>
								</ul>
							</div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-lg-12"> 
							<div class="tab-content profile-tab-content">
								
								<!-- Projects Tab -->
								<div id="myprojects" class="tab-pane fade show active">
									<div class="row">
											<di class="col-12">
												<p></p>

											</di>
									</div>
								</div>
								<!-- /Projects Tab -->
								
								<!-- Task Tab -->
								<div id="tasks" class="tab-pane fade">
									<div class="project-task">
										<p></p>
										<div class="tab-content">
											<div class="tab-pane show active" id="all_tasks">
												<div class="task-wrapper">
													<div class="task-list-container">
														
														<div class="task-list-footer">
															<div class="new-task-wrapper">
																<textarea  id="new-task" placeholder="Enter new task here. . ."></textarea>
																<span class="error-message hidden">You need to enter a task first</span>
																<span class="add-new-task-btn btn" id="add-task">Add Task</span>
																<span class="btn" id="close-task-panel">Close</span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="pending_tasks"></div>
											<div class="tab-pane" id="completed_tasks"></div>
										</div>
									</div>
								</div>
								<!-- /Task Tab -->
								
							</div>
						</div>
					</div>
				</div>
				<!-- /Page Content -->
				
            </div>
        </div>
		<!-- /Main Wrapper -->
		
			<?= $this->endSection(); ?>