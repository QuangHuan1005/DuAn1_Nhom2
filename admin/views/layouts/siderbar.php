<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
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
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <!-- User Dropdown -->
    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">Anna Adame</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text">
                        <i class="ri ri-circle-fill fs-10 text-success align-baseline"></i>
                        <span class="align-middle">Online</span>
                    </span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <h6 class="dropdown-header">Welcome Anna!</h6>
            <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="auth-logout-basic.html"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Logout</span></a>
        </div>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <ul class="navbar-nav" id="navbar-nav">

                <li class="menu-title"><span>Quản lý</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=category-list">
                        <i class="ri-stack-line"></i> <span>Quản lý danh mục</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=product-list">
                        <i class="ri-shopping-bag-3-line"></i> <span>Quản lý sản phẩm</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php?act=userIndex">
                        <i class="ri-user-settings-line"></i> <span>Quản lý người dùng</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="orders.php">
                        <i class="ri-file-list-3-line"></i> <span>Danh sách đơn hàng</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="order-detail.php">
                        <i class="ri-file-info-line"></i> <span>Chi tiết đơn hàng</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="order-status.php">
                        <i class="ri-exchange-line"></i> <span>Trạng thái đơn hàng</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="statistics.php">
                        <i class="ri-bar-chart-line"></i> <span>Thống kê</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    
    <div class="sidebar-background"></div>
</div>
