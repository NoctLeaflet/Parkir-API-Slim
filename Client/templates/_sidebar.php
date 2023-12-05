<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="index.php?page=dashboard"><img src="assets/images/logoS.png" alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="index.php?page=dashboard"><img src="assets/images/logo-miniS.png" alt="logo" /></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="assets/images/faces/face15.jpg" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
            <span>Gold Member</span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="index.php?page=dataUser" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-calendar-today text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
            </div>
          </a>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <!-- /////////////////////////////// list nav ////////////////////////////// -->
    <!-- Dashboard -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="index.php?page=dashboard">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <!-- Data Master -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#data-master" aria-expanded="false" aria-controls="data-master">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Data Master</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="data-master">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=dataUser">Data User</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=jenisKendaraan">Jenis Kendaraan</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=tempatParkir">Tempat Parkir</a></li>
        </ul>
      </div>
    </li>
    <!-- Data Transaksi -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#data-transaksi" aria-expanded="false" aria-controls="data-transaksi">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Data Transaksi</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="data-transaksi">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=parkir">Parkir</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=hstparkir">History Parkir</a></li>
        </ul>
      </div>
    </li>
    <!-- /////////////////////////////// End list nav ////////////////////////////// -->
  </ul>
</nav>