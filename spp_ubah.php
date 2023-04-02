<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$id_spp = $_GET['id'];

$spp_query = mysqli_query($conn, "SELECT * FROM spp WHERE id_spp='$id_spp'");
$data = mysqli_fetch_array($spp_query);

if (isset($_POST['ubah_spp'])) {
  $tahun = htmlspecialchars($_POST['tahun']);
  $nominal = htmlspecialchars($_POST['nominal']);

  $query = mysqli_query($conn, "UPDATE spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp='$id_spp'");

  if ($query) {
    echo "<script>
						window.alert('SPP berhasil diubah!');
						window.location.href = 'index.php?page=spp';
					</script>";
  } else {
    echo "<script>
						window.alert('SPP gagal diubah!');
					</script>";
  }
}

?>

<h1 class="h3 mb-3">Tambah Data SPP</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST">
          <div class="mb-4">
            <label for="tahun" class="form-label">Tahun</label>
            <select class="form-select" id="tahun" name="tahun" autofocus required>
              <option value="">Pilih Tahun</option>
              <?php for ($year = date('Y'); $year >= 1900; $year--) : ?>
                <?php if ($year == $data['tahun']) : ?>
                  <option value="<?= $data['tahun']; ?>" selected><?= $data['tahun']; ?> (DIPILIH)</option>
                <?php else : ?>
                  <option value="<?= $year; ?>"><?= $year; ?></option>
                <?php endif; ?>
              <?php endfor; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="nominal" class="form-label">Nominal - <span class="text-sm fw-bold" id="nominal_value"><?= $data['nominal']; ?></span></label>
            <input type="number" class="form-control" name="nominal" id="nominal" placeholder="Masukkan Nominal" value="<?= $data['nominal']; ?>" required>
          </div>
          <hr>
          <a href="?page=spp" class="btn btn-outline-primary">Kembali</a>
          <button type="submit" name="ubah_spp" class="btn btn-primary mx-1">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const nominalInput = document.querySelector("input#nominal");
  const nominalValue = document.querySelector("#nominal_value");

  function formatNumber(number) {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(number)
  }

  nominalValue.textContent = formatNumber(nominalValue.textContent);
  nominalInput.addEventListener('focus', (e) => e.target.value = '');
  nominalInput.addEventListener('change', (e) => {
    nominalValue.textContent = formatNumber(e.target.value);
  })
</script>