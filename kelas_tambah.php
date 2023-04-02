<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

if (isset($_POST['tambah_kelas'])) {
  $nama_kelas = htmlspecialchars($_POST['nama_kelas']);
  $kompetensi_keahlian = htmlspecialchars($_POST['kompetensi_keahlian']);

  $query = mysqli_query($conn, "INSERT INTO kelas(nama_kelas,kompetensi_keahlian) VALUES('$nama_kelas','$kompetensi_keahlian')");

  if ($query) {
    echo "<script>
						window.alert('Kelas baru berhasil dibuat!');
						window.location.href = 'index.php?page=kelas';
					</script>";
  } else {
    echo "<script>
						window.alert('Kelas gagal dibuat!');
						window.location.href = 'index.php?page=kelas_tambah';
					</script>";
  }
}

?>

<h1 class="h3 mb-3">Tambah Data Kelas</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST">
          <div class="mb-4">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Masukkan Nama Kelas" required autofocus>
          </div>
          <div class="mb-4">
            <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian</label>
            <input type="text" class="form-control" name="kompetensi_keahlian" id="kompetensi_keahlian" placeholder="Masukkan Kompetensi Keahlian" required>
          </div>
          <hr>
          <a href="?page=kelas" class="btn btn-outline-primary">Kembali</a>
          <button type="submit" name="tambah_kelas" class="btn btn-primary mx-1">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>