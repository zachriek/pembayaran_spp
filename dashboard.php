<?php

$jumlah_kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM kelas"))[0];
$jumlah_siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM siswa"))[0];
$jumlah_admin = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM petugas WHERE level='admin'"))[0];
$jumlah_petugas = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM petugas WHERE level='petugas'"))[0];

?>

<h1 class="h3 mb-3">Dasbor <strong class="text-capitalize"><?= $_SESSION['user']['level']; ?></strong></h1>
<div class="row">
  <div class="col-lg-3 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col mt-0">
            <h5 class="card-title">Kelas</h5>
          </div>

          <div class="col-auto">
            <div class="stat text-primary">
              <i class="align-middle" data-feather="bookmark"></i>
            </div>
          </div>
        </div>
        <h1 class="mt-1 mb-3"><?= $jumlah_kelas; ?></h1>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col mt-0">
            <h5 class="card-title">Siswa</h5>
          </div>

          <div class="col-auto">
            <div class="stat text-primary">
              <i class="align-middle" data-feather="users"></i>
            </div>
          </div>
        </div>
        <h1 class="mt-1 mb-3"><?= $jumlah_siswa; ?></h1>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col mt-0">
            <h5 class="card-title">Admin</h5>
          </div>

          <div class="col-auto">
            <div class="stat text-primary">
              <i class="align-middle" data-feather="user-check"></i>
            </div>
          </div>
        </div>
        <h1 class="mt-1 mb-3"><?= $jumlah_admin; ?></h1>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col mt-0">
            <h5 class="card-title">Petugas</h5>
          </div>

          <div class="col-auto">
            <div class="stat text-primary">
              <i class="align-middle" data-feather="user-plus"></i>
            </div>
          </div>
        </div>
        <h1 class="mt-1 mb-3"><?= $jumlah_petugas; ?></h1>
      </div>
    </div>
  </div>
</div>