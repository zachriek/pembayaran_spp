<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$id = $_GET['id'];

$kelas_query = mysqli_query($conn, "SELECT * FROM kelas");
$kelas = [];
while ($row = mysqli_fetch_array($kelas_query)) {
  $kelas[] = $row;
}

$siswa_query = mysqli_query($conn, "SELECT * FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nisn='$id'");
$data = mysqli_fetch_array($siswa_query);

if (isset($_POST['ubah_siswa'])) {
  $nisn = htmlspecialchars($_POST['nisn']);
  $nis = htmlspecialchars($_POST['nis']);
  $nama = htmlspecialchars($_POST['nama']);
  $id_kelas = htmlspecialchars($_POST['id_kelas']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $no_telp = htmlspecialchars($_POST['no_telp']);

  $query = mysqli_query($conn, "UPDATE siswa SET nisn='$nisn',nis='$nis',nama='$nama',id_kelas='$id_kelas',alamat='$alamat',no_telp='$no_telp' WHERE nisn='$id'");

  if ($_POST['password'] != '') {
    $password = md5(htmlspecialchars($_POST['password']));
    mysqli_query($conn, "UPDATE siswa SET password='$password' WHERE nisn='$id'");
  }

  if ($query) {
    echo "<script>
						window.alert('Siswa berhasil diubah!');
						window.location.href = 'index.php?page=siswa';
					</script>";
  } else {
    echo "<script>
						window.alert('Siswa gagal diubah!');
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
            <input type="number" class="form-control" name="nisn" id="nisn" placeholder="Masukkan NISN" value="<?= $data['nisn']; ?>" required autofocus>
          </div>
          <div class="mb-4">
            <label for="nis" class="form-label">NIS</label>
            <input type="number" class="form-control" name="nis" id="nis" placeholder="Masukkan NIS" value="<?= $data['nis']; ?>" required>
          </div>
          <div class="mb-4">
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Siswa" value="<?= $data['nama']; ?>" required>
          </div>
          <div class="mb-4">
            <label for="id_kelas" class="form-label">Kelas</label>
            <select name="id_kelas" id="id_kelas" class="form-select" required>
              <option value="">Pilih Kelas</option>
              <?php foreach ($kelas as $data_kelas) : ?>
                <?php if ($data_kelas['id_kelas'] === $data['id_kelas']) : ?>
                  <option value="<?= $data['id_kelas'] ?>" selected><?= $data['nama_kelas']; ?> (DIPILIH)</option>
                <?php else : ?>
                  <option value="<?= $data_kelas['id_kelas'] ?>"><?= $data_kelas['nama_kelas']; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" placeholder="Masukkan Alamat" required><?= $data['alamat']; ?></textarea>
          </div>
          <div class="mb-4">
            <label for="no_telp" class="form-label">Nomor Telepon</label>
            <input type="number" class="form-control" name="no_telp" id="no_telp" placeholder="Masukkan Nomor Telepon" value="<?= $data['no_telp']; ?>" required>
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password <span class="text-sm fw-bold">- (Opsional)</span></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
          </div>
          <hr>
          <a href="?page=siswa" class="btn btn-outline-primary">Kembali</a>
          <button type="submit" name="ubah_siswa" class="btn btn-primary mx-1">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>