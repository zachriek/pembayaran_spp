<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$id_kelas = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas='$id_kelas'");
if ($query) {
  echo "<script>
          window.alert('Kelas berhasil dihapus!');
          window.location.href = 'index.php?page=kelas';
        </script>";
} else {
  echo "<script>
          window.alert('Kelas gagal dihapus!');
          window.location.href = 'index.php?page=kelas';
        </script>";
}
