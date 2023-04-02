<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$query = mysqli_query($conn, "SELECT * FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id_kelas");
$siswa = [];
while ($row = mysqli_fetch_array($query)) {
  $siswa[] = $row;
}

?>

<h1 class="h3 mb-3">Data Siswa</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <a href="?page=siswa_tambah" class="btn btn-primary">+ Tambah Data</a>
        <hr>
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>NISN</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Alamat</th>
              <th>No Telepon</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($siswa as $key => $data) : ?>
              <tr>
                <td><?= ++$key; ?>.</td>
                <td><?= $data['nisn']; ?></td>
                <td><?= $data['nis']; ?></td>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['nama_kelas'] ?? '-'; ?></td>
                <td><?= $data['alamat']; ?></td>
                <td><?= $data['no_telp']; ?></td>
                <td>
                  <a href="?page=siswa_hapus&id=<?= $data['nisn']; ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus?');">Hapus</a>
                  <a href="?page=siswa_ubah&id=<?= $data['nisn']; ?>" class="btn btn-outline-primary">Ubah</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>