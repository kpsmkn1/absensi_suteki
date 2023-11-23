<?php 
	$db = \Config\Database::connect();
	$data = $db->query("SELECT * FROM tb_website")->getResultArray()[0];
	$id_user = session()->get('id_user');
	$user = $db->query("SELECT * FROM tb_users WHERE id_user='$id_user'")->getResultArray()[0];

	$notif = $db->query("SELECT * FROM tb_notif WHERE status='1'")->getResultArray();
	$notifCount = $db->query("SELECT count(*) FROM tb_notif WHERE status='1'")->getResultArray()[0];

	$jumlah_notif =  $notifCount['count(*)'];

	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$ex = explode("8080", $actual_link);

	$actual_link = $ex[1];

	function getActive($url,$li){
		$url = str_replace("/", "", $url);
		$li  = str_replace("/", "", $li);

		if ($li == $url) {
			return 'active';
		}else {
			return "no";
		}
	}

 ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Dashboard</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>/assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>/assets/css/line-awesome.min.css">
		
		<!-- Datatable CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>/assets/css/dataTables.bootstrap4.min.css">

		
		<!-- Chart CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/morris/morris.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="<?= base_url() ?>/assets/js/html5shiv.min.js"></script>
			<script src="<?= base_url() ?>/assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
	
    <body>
    	<input type="hidden" value="<?= base_url() ?>" id="base_url">
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="<?= base_url() ?>" class="logo">
						<img src="<?= base_url() ?>/assets/img/logo.png" width="40" height="40" alt="">
					</a>
                </div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
                <div class="page-title-box">

					<h3><?= $data['nama'] ?></h3>
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
				
					<!-- Search -->
					<li class="nav-item">
						<div class="top-nav-search">
							<a href="javascript:void(0);" class="responsive-search">
								<i class="fa fa-search"></i>
						   </a>
							<form action="search.html">
								<input class="form-control" type="text" placeholder="Search here">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</li>
					<!-- /Search -->
				
				
			

					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img src="<?= base_url() ?>/assets/img/<?= $user['foto'] ?>" alt="">
							<span class="status online"></span></span>
							<span><?= $user['nama'] ?></span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?= base_url() ?>/profil">Profil Saya</a>
							
							<a class="dropdown-item" href="<?= base_url() ?>/keluar">Keluar</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="settings.html">Pengaturan</a>
						<a class="dropdown-item" href="login.html">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
            </div>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li>
								<span style="color:white; text-align: center; display: block; padding: 0px 10px;"><i class="la la-clock"></i> <i id="clock"></i></span>
							
							</li>

							
							<li><hr></li>
							


							<li class="<?= getActive($actual_link,"absen"); ?> <?= getActive($actual_link,""); ?><?= getActive($actual_link,"absen"); ?> <?= getActive($actual_link,"absen_day"); ?>"> 
								<a href="<?= base_url() ?>/absen"><i class="la la-clipboard"></i> <span>Presensi</span></a>
							</li>

							<li class="
							<?= getActive($actual_link,"list_absen"); ?>
							<?= getActive($actual_link,"list_absen/all"); ?>
							<?= getActive($actual_link,"list_absen/week"); ?>
							<?= getActive($actual_link,"list_absen/month"); ?>
							<?= getActive($actual_link,"list_absen/year"); ?>
							<?= getActive($actual_link,"presensi"); ?>


							"> 
								<a href="<?= base_url() ?>/presensi"><i class="la la-calendar"></i> <span>Data Presensi</span></a>
							</li>

							

							<li class="menu-title"> 
								<span><br>Pengaturan</span>
							</li>

							<li class="<?= getActive($actual_link,"profil"); ?> <?= getActive($actual_link,"ganti_password"); ?> <?= getActive($actual_link,"edit_profil"); ?>"> 
								<a href="<?= base_url() ?>/profil"><i class="la la-user"></i> <span>Akun Saya</span></a>
							</li>

							

							<li> 
								<a onclick="return confirm('apakah anda ingin keluar ?')" href="<?= base_url() ?>/keluar"><i class="la la-sign-out"></i> <span>Keluar</span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->


			<?= $this->renderSection('content') ?>



        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="<?= base_url() ?>/assets/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?= base_url() ?>/assets/js/popper.min.js"></script>
        <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="<?= base_url() ?>/assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Datatable JS -->
		<script src="<?= base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
		<script src="<?= base_url() ?>/assets/js/dataTables.bootstrap4.min.js"></script>

		<!-- Chart JS -->
		<script src="<?= base_url() ?>/assets/plugins/morris/morris.min.js"></script>
		<script src="<?= base_url() ?>/assets/plugins/raphael/raphael.min.js"></script>
		<script src="<?= base_url() ?>/assets/js/chart.js"></script>
		
		<!-- Custom JS -->
		<script src="<?= base_url() ?>/assets/js/app.js"></script>
		<script src="<?= base_url() ?>/assets/js/my.js"></script>
		
    </body>
</html>