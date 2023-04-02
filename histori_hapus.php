<?php

if (!isset($_SESSION['user']['level'])) {
  header("Location: index.php");
}

$id_pembayaran = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM pembayaran WHERE id_pembayaran='$id_pembayaran'");
if ($query) {
  echo "<script>
          window.alert('Histori berhasil dihapus!');
          window.location.href = 'index.php?page=histori';
        </script>";
} else {
  echo "<script>
          window.alert('Histori gagal dihapus!');
          window.location.href = 'index.php?page=histori';
        </script>";
}
