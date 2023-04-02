<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$nisn = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM siswa WHERE nisn='$nisn'");
if ($query) {
  echo "<script>
          window.alert('Siswa berhasil dihapus!');
          window.location.href = 'index.php?page=siswa';
        </script>";
} else {
  echo "<script>
          window.alert('Siswa gagal dihapus!');
          window.location.href = 'index.php?page=siswa';
        </script>";
}
