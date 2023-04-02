<?php

if (!isset($_SESSION['user']['level'])) {
  header("Location: index.php");
}

$siswa_query = mysqli_query($conn, "SELECT * FROM siswa");
$data_siswa = [];
while ($row = mysqli_fetch_array($siswa_query)) {
  $data_siswa[] = $row;
}

$spp_query = mysqli_query($conn, "SELECT * FROM spp");
$data_spp = [];
while ($row2 = mysqli_fetch_array($spp_query)) {
  $data_spp[] = $row2;
}

$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

if (isset($_POST['tambah_pembayaran'])) {
  $id_petugas = $_SESSION['user']['id_petugas'];
  $nisn = htmlspecialchars($_POST['nisn']);
  $tgl_bayar = htmlspecialchars($_POST['tgl_bayar']);
  $bulan_bayar = strtolower(htmlspecialchars($_POST['bulan_bayar']));
  $tahun_dibayar = htmlspecialchars($_POST['tahun_dibayar']);
  $id_spp = htmlspecialchars($_POST['id_spp']);
  $jumlah_bayar = htmlspecialchars($_POST['jumlah_bayar']);

  $query = mysqli_query($conn, "INSERT INTO pembayaran(id_petugas,nisn,tgl_bayar,bulan_bayar,tahun_dibayar,id_spp,jumlah_bayar) VALUES('$id_petugas','$nisn','$tgl_bayar','$bulan_bayar','$tahun_dibayar','$id_spp','$jumlah_bayar')");

  if ($query) {
    echo "<script>
						window.alert('Pembayaran berhasil dibuat!');
						window.location.href = 'index.php?page=histori';
					</script>";
  } else {
    echo "<script>
						window.alert('Pembayaran gagal dibuat!');
						window.location.href = 'index.php?page=pembayaran';
					</script>";
  }
}

?>

<h1 class="h3 mb-3">Pembayaran</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST">
          <div class="mb-4">
            <label for="nisn" class="form-label">Siswa</label>
            <select name="nisn" id="nisn" class="form-select" required autofocus>
              <option value="">Pilih Siswa</option>
              <?php foreach ($data_siswa as $siswa) : ?>
                <option value="<?= $siswa['nisn']; ?>"><?= $siswa['nama']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="tgl_bayar" class="form-label">Tanggal Bayar</label>
            <input type="date" class="form-control" name="tgl_bayar" id="tgl_bayar" placeholder="Masukkan Tanggal Bayar" required>
          </div>
          <div class="mb-4">
            <label for="bulan_bayar" class="form-label">Bulan Bayar</label>
            <select class="form-select" id="bulan_bayar" name="bulan_bayar" required>
              <option value="">Pilih Bulan Bayar</option>
              <?php foreach ($bulan as $bulan) : ?>
                <option value="<?= $bulan; ?>"><?= $bulan; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="tahun_dibayar" class="form-label">Tahun Dibayar</label>
            <select class="form-select" id="tahun_dibayar" name="tahun_dibayar" required>
              <option value="">Pilih Tahun Dibayar</option>
              <?php for ($year = date('Y'); $year >= 1900; $year--) : ?>
                <option value="<?= $year; ?>"><?= $year; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="id_spp" class="form-label">SPP</label>
            <select class="form-select" id="id_spp" name="id_spp" required>
              <option value="">Pilih SPP</option>
              <?php foreach ($data_spp as $spp) : ?>
                <option value="<?= $spp['id_spp']; ?>">
                  <?= "Rp " . number_format($spp['nominal'], 2, ',', '.'); ?> (<?= $spp['tahun']; ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="jumlah_bayar" class="form-label">Jumlah Bayar - <span class="text-sm fw-bold" id="jumlah_bayar_value"></span></label>
            <input type="number" class="form-control" name="jumlah_bayar" id="jumlah_bayar" placeholder="Masukkan Jumlah Bayar" required>
          </div>
          <hr>
          <button type="submit" name="tambah_pembayaran" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const jumlahBayarInput = document.querySelector("input#jumlah_bayar");
  const jumlahBayarValue = document.querySelector("#jumlah_bayar_value");

  function formatNumber(number) {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(number)
  }

  jumlahBayarValue.textContent = formatNumber(0);
  jumlahBayarInput.addEventListener('focus', (e) => e.target.value = '');
  jumlahBayarInput.addEventListener('change', (e) => {
    jumlahBayarValue.textContent = formatNumber(e.target.value);
  })
</script>