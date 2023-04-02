<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$query = mysqli_query($conn, "SELECT * FROM petugas");
$petugas = [];
while ($row = mysqli_fetch_array($query)) {
  $petugas[] = $row;
}

?>

<h1 class="h3 mb-3">Data Petugas</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <a href="?page=petugas_tambah" class="btn btn-primary">+ Tambah Data</a>
        <hr>
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Level</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($petugas as $key => $data) : ?>
              <tr>
                <td><?= ++$key; ?>.</td>
                <td><?= $data['nama_petugas']; ?></td>
                <td><?= $data['username']; ?></td>
                <td class="text-capitalize"><?= $data['level']; ?></td>
                <td>
                  <a href="?page=petugas_hapus&id=<?= $data['id_petugas']; ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus?');">Hapus</a>
                  <a href="?page=petugas_ubah&id=<?= $data['id_petugas']; ?>" class="btn btn-outline-primary">Ubah</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>