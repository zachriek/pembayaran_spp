<?php

if (!isset($_SESSION['user']['level']) || $_SESSION['user']['level'] != 'admin') {
  header("Location: index.php");
}

$id_spp = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM spp WHERE id_spp='$id_spp'");
if ($query) {
  echo "<script>
          window.alert('SPP berhasil dihapus!');
          window.location.href = 'index.php?page=spp';
        </script>";
} else {
  echo "<script>
          window.alert('SPP gagal dihapus!');
          window.location.href = 'index.php?page=spp';
        </script>";
}
