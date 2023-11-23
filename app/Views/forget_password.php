<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Reset Password</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>/assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
				
					
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Reset Password</h3>
							<?php 

							if(session()->getFlashdata('notif')){
								echo session()->getFlashdata('notif');
							}


							 ?>
							<!-- Account Form -->
							<form action="" method="post" autocomplete="off">
								
							<?php if (!session()->get('lupa_password')) : ?>
								<div class="form-group">
									<label>Email</label>
									<input value="<?= old('email');?>" name="email" required autofocus class="form-control" type="email">
								</div>
							<?php else: ?>
								<div class="form-group">
									<label>Email</label>
									<input value="<?= session()->get('lupa_password'); ?>" name="email" readonly class="form-control" type="email">
								</div>


								<div class="form-group">
									<label>No Tlp</label>
									<input value="<?= session()->get('lupa_password2'); ?>" name="nip" required class="form-control" type="number">
								</div>
							<?php if (session()->get('lupa_password2')) : ?>

								<div class="form-group">
									<label>Password Baru</label>
									<input value="<?= old('password');?>" name="password" required autofocus class="form-control" type="text">
								</div>

							<?php endif; ?>


							<?php endif; ?>
								
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Submit</button>
								</div>
								<div class="account-footer">
									<p>Sudah Ingat ? <a href="<?= base_url() ?>/login">Login Sekarang</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="<?= base_url() ?>/assets/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?= base_url() ?>/assets/js/popper.min.js"></script>
        <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="<?= base_url() ?>/assets/js/app.js"></script>
		
    </body>
</html>