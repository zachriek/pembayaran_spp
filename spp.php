<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$query = mysqli_query($conn, "SELECT * FROM spp");
$spp = [];
while ($row = mysqli_fetch_array($query)) {
  $spp[] = $row;
}

?>

<h1 class="h3 mb-3">Data SPP</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <a href="?page=spp_tambah" class="btn btn-primary">+ Tambah Data</a>
        <hr>
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Tahun</th>
              <th>Nominal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($spp as $key => $data) : ?>
              <tr>
                <td><?= ++$key; ?>.</td>
                <td><?= $data['tahun']; ?></td>
                <td><?= "Rp " . number_format($data['nominal'], 2, ',', '.'); ?></td>
                <td>
                  <a href="?page=spp_hapus&id=<?= $data['id_spp']; ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus?');">Hapus</a>
                  <a href="?page=spp_ubah&id=<?= $data['id_spp']; ?>" class="btn btn-outline-primary">Ubah</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>