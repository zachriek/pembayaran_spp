<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

if (isset($_POST['tambah_spp'])) {
  $tahun = htmlspecialchars($_POST['tahun']);
  $nominal = htmlspecialchars($_POST['nominal']);

  $query = mysqli_query($conn, "INSERT INTO spp(tahun,nominal) VALUES('$tahun','$nominal')");

  if ($query) {
    echo "<script>
						window.alert('SPP baru berhasil dibuat!');
						window.location.href = 'index.php?page=spp';
					</script>";
  } else {
    echo "<script>
						window.alert('SPP gagal dibuat!');
						window.location.href = 'index.php?page=spp_tambah';
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
                <option value="<?= $year; ?>"><?= $year; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="nominal" class="form-label">Nominal - <span class="text-sm fw-bold" id="nominal_value"></span></label>
            <input type="number" class="form-control" name="nominal" id="nominal" placeholder="Masukkan Nominal" required>
          </div>
          <hr>
          <a href="?page=spp" class="btn btn-outline-primary">Kembali</a>
          <button type="submit" name="tambah_spp" class="btn btn-primary mx-1">Simpan</button>
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

  nominalValue.textContent = formatNumber(0);
  nominalInput.addEventListener('focus', (e) => e.target.value = '');
  nominalInput.addEventListener('change', (e) => {
    nominalValue.textContent = formatNumber(e.target.value);
  })
</script>