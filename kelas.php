<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$query = mysqli_query($conn, "SELECT * FROM kelas");
$kelas = [];
while ($row = mysqli_fetch_array($query)) {
  $kelas[] = $row;
}

?>

<h1 class="h3 mb-3">Data Kelas</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <a href="?page=kelas_tambah" class="btn btn-primary">+ Tambah Data</a>
        <hr>
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Kelas</th>
              <th>Kompetensi Keahlian</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($kelas as $key => $data) : ?>
              <tr>
                <td><?= ++$key; ?>.</td>
                <td><?= $data['nama_kelas']; ?></td>
                <td><?= $data['kompetensi_keahlian']; ?></td>
                <td>
                  <a href="?page=kelas_hapus&id=<?= $data['id_kelas']; ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus?');">Hapus</a>
                  <a href="?page=kelas_ubah&id=<?= $data['id_kelas']; ?>" class="btn btn-outline-primary">Ubah</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>