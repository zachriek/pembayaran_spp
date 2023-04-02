<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$id_petugas = $_GET['id'];

$levels = ['petugas', 'admin'];

$petugas_query = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas='$id_petugas'");
$data = mysqli_fetch_array($petugas_query);

if (isset($_POST['ubah_petugas'])) {
  $nama_petugas = htmlspecialchars($_POST['nama_petugas']);
  $username = htmlspecialchars($_POST['username']);
  $level = htmlspecialchars($_POST['level']);

  $query = mysqli_query($conn, "UPDATE petugas SET nama_petugas='$nama_petugas',username='$username',level='$level' WHERE id_petugas='$id_petugas'");

  if ($_POST['password'] != '') {
    $password = md5(htmlspecialchars($_POST['password']));
    mysqli_query($conn, "UPDATE petugas SET password='$password' WHERE id_petugas='$id_petugas'");
  }

  if ($query) {
    echo "<script>
						window.alert('Petugas berhasil diubah!');
						window.location.href = 'index.php?page=petugas';
					</script>";
  } else {
    echo "<script>
						window.alert('Petugas gagal diubah!');
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
            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" placeholder="Masukkan Nama Petugas" value="<?= $data['nama_petugas']; ?>" required autofocus>
          </div>
          <div class="mb-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" value="<?= $data['username']; ?>" required>
          </div>
          <div class="mb-4">
            <label for="level" class="form-label">Level</label>
            <select name="level" id="level" class="form-select" required>
              <option value="">Pilih Level</option>
              <?php foreach ($levels as $level) : ?>
                <?php if ($level === $data['level']) : ?>
                  <option class="text-capitalized" value="<?= $data['level'] ?>" selected><?= $data['level']; ?> (DIPILIH)</option>
                <?php else : ?>
                  <option class="text-capitalize" value="<?= $level ?>"><?= $level; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password <span class="text-sm fw-bold">- (Opsional)</span></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
          </div>
          <hr>
          <a href="?page=petugas" class="btn btn-outline-primary">Kembali</a>
          <button type="submit" name="ubah_petugas" class="btn btn-primary mx-1">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>