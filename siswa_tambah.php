<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$kelas_query = mysqli_query($conn, "SELECT * FROM kelas");
$kelas = [];
while ($row = mysqli_fetch_array($kelas_query)) {
  $kelas[] = $row;
}

if (isset($_POST['tambah_siswa'])) {
  $nisn = htmlspecialchars($_POST['nisn']);
  $nis = htmlspecialchars($_POST['nis']);
  $nama = htmlspecialchars($_POST['nama']);
  $id_kelas = htmlspecialchars($_POST['id_kelas']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $no_telp = htmlspecialchars($_POST['no_telp']);
  $password = md5(htmlspecialchars($_POST['password']));

  $query = mysqli_query($conn, "INSERT INTO siswa(nisn,nis,nama,id_kelas,alamat,no_telp,password) VALUES('$nisn','$nis','$nama','$id_kelas','$alamat','$no_telp','$password')");

  if ($query) {
    echo "<script>
						window.alert('Siswa baru berhasil dibuat!');
						window.location.href = 'index.php?page=siswa';
					</script>";
  } else {
    echo "<script>
						window.alert('Siswa gagal dibuat!');
						window.location.href = 'index.php?page=siswa_tambah';
					</script>";
  }
}

?>

<h1 class="h3 mb-3">Tambah Data Siswa</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST">
          <div class="mb-4">
            <label for="nisn" class="form-label">NISN</label>
            <input type="number" class="form-control" name="nisn" id="nisn" placeholder="Masukkan NISN" required autofocus>
          </div>
          <div class="mb-4">
            <label for="nis" class="form-label">NIS</label>
            <input type="number" class="form-control" name="nis" id="nis" placeholder="Masukkan NIS" required>
          </div>
          <div class="mb-4">
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Siswa" required>
          </div>
          <div class="mb-4">
            <label for="id_kelas" class="form-label">Kelas</label>
            <select name="id_kelas" id="id_kelas" class="form-select" required>
              <option value="">Pilih Kelas</option>
              <?php foreach ($kelas as $data) : ?>
                <option value="<?= $data['id_kelas'] ?>"><?= $data['nama_kelas']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" placeholder="Masukkan Alamat" required></textarea>
          </div>
          <div class="mb-4">
            <label for="no_telp" class="form-label">Nomor Telepon</label>
            <input type="number" class="form-control" name="no_telp" id="no_telp" placeholder="Masukkan Nomor Telepon" required>
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
          </div>
          <hr>
          <a href="?page=siswa" class="btn btn-outline-primary">Kembali</a>
          <button type="submit" name="tambah_siswa" class="btn btn-primary mx-1">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>