<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$levels = ['petugas', 'admin'];

if (isset($_POST['tambah_petugas'])) {
  $nama_petugas = htmlspecialchars($_POST['nama_petugas']);
  $username = htmlspecialchars($_POST['username']);
  $level = htmlspecialchars($_POST['level']);
  $password = md5(htmlspecialchars($_POST['password']));

  $query = mysqli_query($conn, "INSERT INTO petugas(username,password,nama_petugas,level) VALUES('$username','$password','$nama_petugas','$level')");

  if ($query) {
    echo "<script>
						window.alert('Petugas baru berhasil dibuat!');
						window.location.href = 'index.php?page=petugas';
					</script>";
  } else {
    echo "<script>
						window.alert('Petugas gagal dibuat!');
						window.location.href = 'index.php?page=petugas_tambah';
					</script>";
  }
}

?>

<h1 class="h3 mb-3">Tambah Data Petugas</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST">
          <div class="mb-4">
            <label for="nama_petugas" class="form-label">Nama Petugas</label>
            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" placeholder="Masukkan Nama Petugas" required autofocus>
          </div>
          <div class="mb-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required>
          </div>
          <div class="mb-4">
            <label for="level" class="form-label">Level</label>
            <select name="level" id="level" class="form-select" required>
              <option value="">Pilih Level</option>
              <?php foreach ($levels as $level) : ?>
                <option value="<?= $level ?>" class="text-capitalize"><?= $level; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
          </div>
          <hr>
          <a href="?page=petugas" class="btn btn-outline-primary">Kembali</a>
          <button type="submit" name="tambah_petugas" class="btn btn-primary mx-1">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>