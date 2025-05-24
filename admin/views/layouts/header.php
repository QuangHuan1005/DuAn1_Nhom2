<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

               <div class="dropdown ms-sm-3 header-item topbar-user">
  <button 
    type="button" 
    class="btn d-flex align-items-center p-0" 
    id="page-header-user-dropdown" 
    data-bs-toggle="dropdown" 
    aria-haspopup="true" 
    aria-expanded="false"
  >
    <img 
      class="rounded-circle header-profile-user" 
      src="assets/images/users/avatar-1.jpg" 
      alt="Header Avatar" 
      width="40" height="40"
    >
    <div class="ms-2 text-start d-none d-xl-block">
      <div class="fw-semibold user-name-text">Anna Adame</div>
      <div class="fs-12 text-muted user-name-sub-text">Founder</div>
    </div>
    <i class="mdi mdi-chevron-down ms-2"></i>
  </button>
  
  <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="page-header-user-dropdown">
    <li>
      <h6 class="dropdown-header">Welcome, Anna!</h6>
    </li>
    <li>
      <a class="dropdown-item d-flex align-items-center" href="/duan1_nhom2/logout.php">
        <i class="mdi mdi-logout text-muted fs-18 me-2"></i> Logout
      </a>
    </li>
  </ul>
</div>

                </div>
            </div>
        </div>
    </div>
</header>