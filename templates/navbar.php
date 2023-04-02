<nav class="navbar navbar-expand navbar-light navbar-bg">
  <a class="sidebar-toggle js-sidebar-toggle">
    <i class="hamburger align-self-center"></i>
  </a>
  <div class="navbar-collapse collapse">
    <ul class="navbar-nav navbar-align">
      <li class="nav-item dropdown">
        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
          <i class="align-middle" data-feather="settings"></i>
        </a>

        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
          <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded-circle me-1" alt="User" /> <span class="text-dark"><?= isset($_SESSION['user']['nama']) ?  $_SESSION['user']['nama'] : $_SESSION['user']['nama_petugas'] ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
          <a class="dropdown-item" href="logout.php" onclick="return confirm('Apakah kamu yakin ingin logout');">Log out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>