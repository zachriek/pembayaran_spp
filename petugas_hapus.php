<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$id_petugas = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas='$id_petugas'");
if ($query) {
  echo "<script>
          window.alert('Petugas berhasil dihapus!');
          window.location.href = 'index.php?page=petugas';
        </script>";
} else {
  echo "<script>
          window.alert('Petugas gagal dihapus!');
          window.location.href = 'index.php?page=petugas';
        </script>";
}
