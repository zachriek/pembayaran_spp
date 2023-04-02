<?php

include "config/db.php";

session_start();

if (isset($_SESSION['user'])) {
	header("Location: index.php");
}

if (isset($_POST['login'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = md5(htmlspecialchars($_POST['password']));

	$cek_petugas = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");

	if (mysqli_num_rows($cek_petugas) > 0) {
		$_SESSION['user'] = mysqli_fetch_array($cek_petugas);
		echo "<script>
						window.alert('Berhasil login!');
						window.location.href = 'index.php';
					</script>";
	} else {
		$cek_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn='$username' AND password='$password'");

		if (mysqli_num_rows($cek_siswa) > 0) {
			$_SESSION['user'] = mysqli_fetch_array($cek_siswa);
			echo "<script>
						window.alert('Berhasil login!');
						window.location.href = 'index.php';
					</script>";
		} else {
			echo "<script>
						window.alert('Gagal login!');
						window.location.href = 'login.php';
					</script>";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Login | Aplikasi Pembayaran SPP</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-4 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Apllikasi Pembayaran SPP</h1>
							<p class="lead">
								Login to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center mb-4">
										<img src="img/avatars/avatar.jpg" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									<form method="POST">
										<div class="mb-3">
											<label class="form-label">Username/NISN</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="Masukkan Username/NISN" required autofocus />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan Password" required />
										</div>
										<div class="d-flex flex-column text-center mt-4">
											<button type="submit" name="login" class="btn btn-lg btn-primary">Login</button>
											<a href="register.php" class="mt-3">Don't have an account? Register</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>
</body>

</html>