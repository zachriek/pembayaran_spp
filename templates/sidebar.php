<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="index.php">
      <span class="align-middle">Pembayaran SPP</span>
    </a>
    <ul class="sidebar-nav">
      <li class="sidebar-header">
        Halaman
      </li>
      <li class="sidebar-item <?= !isset($_GET['page'])  ? "active" : ''; ?>">
        <a class="sidebar-link" href="index.php">
          <?php if (isset($_SESSION['user']['level'])) : ?>
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dasbor</span>
          <?php else : ?>
            <i class="align-middle" data-feather="home"></i> <span class="align-middle">Beranda</span>
          <?php endif; ?>
        </a>
      </li>
      <?php if (isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == 'admin') : ?>
        <li class="sidebar-item <?= isset($_GET['page']) && str_contains($_GET['page'], 'kelas') ? 'active' : '';  ?>">
          <a class="sidebar-link" href="index.php?page=kelas">
            <i class="align-middle" data-feather="bookmark"></i> <span class="align-middle">Data Kelas</span>
          </a>
        </li>
        <li class="sidebar-item <?= isset($_GET['page']) && str_contains($_GET['page'], 'siswa') ? 'active' : '';  ?>">
          <a class="sidebar-link" href="index.php?page=siswa">
            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data Siswa</span>
          </a>
        </li>
        <li class="sidebar-item <?= isset($_GET['page']) && str_contains($_GET['page'], 'petugas') ? 'active' : '';  ?>">
          <a class="sidebar-link" href="index.php?page=petugas">
            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Data Petugas</span>
          </a>
        </li>
        <li class="sidebar-item <?= isset($_GET['page']) && str_contains($_GET['page'], 'spp') ? 'active' : '';  ?>">
          <a class="sidebar-link" href="index.php?page=spp">
            <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Data SPP</span>
          </a>
        </li>
      <?php endif; ?>
      <?php if (isset($_SESSION['user']['level'])) : ?>
        <li class="sidebar-item <?= isset($_GET['page']) && str_contains($_GET['page'], 'pembayaran') ? 'active' : '';  ?>">
          <a class="sidebar-link" href="index.php?page=pembayaran">
            <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Transaksi Pembayaran</span>
          </a>
        </li>
      <?php endif; ?>
      <li class="sidebar-item <?= isset($_GET['page']) && str_contains($_GET['page'], 'histori') ? 'active' : '';  ?>">
        <a class="sidebar-link" href="index.php?page=histori">
          <i class="align-middle" data-feather="eye"></i> <span class="align-middle">Histori Pembayaran</span>
        </a>
      </li>
    </ul>
  </div>
</nav>