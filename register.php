<?php

include "config/db.php";

session_start();

if (isset($_SESSION['user'])) {
	header("Location: index.php");
}

if (isset($_POST['register'])) {
	$nisn = htmlspecialchars($_POST['nisn']);
	$nis = htmlspecialchars($_POST['nis']);
	$nama = htmlspecialchars($_POST['nama']);
	$alamat = htmlspecialchars($_POST['alamat']);
	$no_telp = htmlspecialchars($_POST['no_telp']);
	$password = md5(htmlspecialchars($_POST['password']));

	$query = mysqli_query($conn, "INSERT INTO `siswa`(`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_telp`, `password`) VALUES ('$nisn','$nis','$nama',null,'$alamat','$no_telp','$password')");

	if ($query) {
		echo "<script>
						window.alert('Berhasil registrasi!');
						window.location.href = 'login.php';
					</script>";
	} else {
		echo "<script>
						window.alert('Gagal registrasi!');
						window.location.href = 'register.php';
					</script>";
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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>Register | Aplikasi Pembayaran SPP</title>

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
							<h1 class="h2">Registrasi Siswa</h1>
							<p class="lead">
								Lorem ipsum dolor sit amet consectetur adipisicing elit.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form method="POST">
										<div class="mb-3">
											<label class="form-label">NISN</label>
											<input class="form-control form-control-lg" type="text" name="nisn" placeholder="Masukkan NISN" required autofocus />
										</div>
										<div class="mb-3">
											<label class="form-label">NIS</label>
											<input class="form-control form-control-lg" type="text" name="nis" placeholder="Masukkan NIS" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Nama</label>
											<input class="form-control form-control-lg" type="text" name="nama" placeholder="Masukkan Nama Lengkap" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Alamat</label>
											<input class="form-control form-control-lg" type="text" name="alamat" placeholder="Masukkan Alamat" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Nomor Telepon</label>
											<input class="form-control form-control-lg" type="text" name="no_telp" placeholder="Masukkan Nomor Telepon" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan Password" required />
										</div>
										<div class="d-flex flex-column text-center mt-4">
											<button type="submit" name="register" class="btn btn-lg btn-primary">Register</button>
											<a href="login.php" class="mt-3">Already have an account? Login</a>
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