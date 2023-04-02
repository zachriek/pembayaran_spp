<?php

$nisn = isset($_SESSION['user']['nisn']) ? $_SESSION['user']['nisn'] : '';

$where = !isset($_SESSION['user']['level']) ? " WHERE pembayaran.nisn='$nisn'" : '';

$query = mysqli_query($conn, "SELECT * FROM pembayaran LEFT JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas LEFT JOIN siswa ON pembayaran.nisn=siswa.nisn LEFT JOIN spp ON pembayaran.id_spp=spp.id_spp $where");
$data_spp = [];
while ($row = mysqli_fetch_array($query)) {
  $data_spp[] = $row;
}

?>

<h1 class="h3 mb-3">Histori Pembayaran</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <?php if (isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == 'admin') : ?>
          <a href="cetak_histori.php" class="btn btn-primary">Cetak Data</a>
          <hr>
        <?php endif; ?>
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Petugas</th>
              <th>Siswa</th>
              <th>Tanggal Bayar</th>
              <th>SPP</th>
              <th>Jumlah Bayar</th>
              <?php if (isset($_SESSION['user']['level'])) : ?>
                <th>Aksi</th>
              <?php endif; ?>
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
                <?php if (isset($_SESSION['user']['level'])) : ?>
                  <td>
                    <a href="?page=histori_hapus&id=<?= $data['id_pembayaran']; ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus?');">Hapus</a>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>