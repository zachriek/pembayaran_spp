<?php

include "config/db.php";

session_start();

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$query = mysqli_query($conn, "SELECT * FROM pembayaran LEFT JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas LEFT JOIN siswa ON pembayaran.nisn=siswa.nisn LEFT JOIN spp ON pembayaran.id_spp=spp.id_spp");
$data_spp = [];
while ($row = mysqli_fetch_array($query)) {
  $data_spp[] = $row;
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

  <link rel="canonical" href="https://demo-basic.adminkit.io/" />

  <title>Aplikasi Pembayaran SPP - Cetak Histori Pembayaran</title>

  <link href="css/app.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
  <section class="mt-5">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Petugas</th>
                    <th>Siswa</th>
                    <th>Tanggal Bayar</th>
                    <th>SPP</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data_spp as $key => $data) : ?>
                    <tr>
                      <td><?= ++$key; ?>.</td>
                      <td><?= $data['nama_petugas']; ?></td>
                      <td><?= $data['nama']; ?></td>
                      <td><?= date('d M Y', strtotime($data['tgl_bayar'])); ?></td>
                      <td><?= "Rp " . number_format($data['nominal'], 2, ',', '.'); ?> (<?= $data['tahun']; ?>)</td>
                      <td><?= "Rp " . number_format($data['jumlah_bayar'], 2, ',', '.'); ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    window.print();
    window.addEventListener('afterprint', () => window.location.href = 'index.php?page=histori');
  </script>
</body>

</html>