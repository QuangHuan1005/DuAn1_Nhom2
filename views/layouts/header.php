<?php
require_once 'models/CartModel.php';
$cartModel = new CartModel();

$cart_count = 0;
if (isset($_SESSION['user']['id'])) {
  // Đếm số sản phẩm khác nhau thay vì tổng số lượng
  $cart_items = $cartModel->getCartItems($_SESSION['user']['id']);
  $cart_count = count($cart_items);
} elseif (isset($_SESSION['cart'])) {
  $cart_count = count($_SESSION['cart']);
}
?>
<header class="version_1">
  <div class="layer"></div><!-- Mobile menu overlay mask -->
  <div class="main_header">
    <div class="container">
      <div class="row small-gutters">
        <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
          <div id="logo">
            <a href="index-2.html">
              <img src="./assets/allaia/img/logo.svg" alt="" width="100" height="35">
            </a>
          </div>
        </div>
        <nav class="col-xl-6 col-lg-7">
          <a class="open_close" href="#0">
            <div class="hamburger hamburger--spin">
              <div class="hamburger-box">
                <div class="hamburger-inner"></div>
              </div>
            </div>
          </a>
          <!-- Mobile menu button -->
          <div class="main-menu">
            <div id="header_menu">
              <a href="index-2.html">
                <img src="./assets/allaia/img/logo_black.svg" alt="" width="100" height="35">
              </a>
              <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
            </div>
            <ul>
              <li><a href="?act=home">Trang chủ</a></li>
              <li><a href="?act=page">Sản phẩm</a></li>
              <li><a href="blog.html">Blog</a></li>
              <li><a href="https://1.envato.market/3KVvr" target="_parent">Buy Template</a></li>
            </ul>
          </div>
          <!--/main-menu -->
        </nav>
        <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end">
          <a class="phone_top" href="tel://9438843343">
            <strong><span>Liên hệ hotline:</span>+94 423-23-221</strong>
          </a>

        </div>
      </div>
      <!-- /row -->
    </div>
  </div>
  <!-- /main_header -->

  <div class="main_nav Sticky">
    <div class="container">
      <div class="row small-gutters">
        <div class="col-xl-3 col-lg-3 col-md-3">
        </div>
        <div class="col-xl-5 col-lg-7 col-md-6 d-none d-md-block">
          <form action="index.php" method="get">
            <input type="hidden" name="act" value="search">
            <div class="custom-search-input">
              <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm...">
              <button type="submit"><i class="header-icon_search_custom"></i></button>
            </div>
          </form>
        </div>
        <div class="col-xl-2 col-lg-3 d-lg-flex align-items-center justify-content-end text-end">
          <ul class="top_tools">
            <li>
              <?php if (isset($_SESSION['user'])): ?>
                👤 Xin chào, <?= $_SESSION['user']['username'] ?>
              <?php endif; ?>
            </li>
          </ul>

        </div>
        <div class="col-xl-2 col-lg-3 col-md-3">
          <ul class="top_tools">

            <li>
              <div class="dropdown dropdown-cart">
                <a href="?act=cart" class="cart_bt">
                  <strong><?= $cart_count ?></strong>
                </a>
              </div>
            </li>

            <li><a href="my-wishlist.html" class="wishlist"><span>Wishlist</span></a></li>
            <li>

              <div class="dropdown dropdown-access">

                <a href="?act=profile" class="access_link"><span>Account</span></a>

                <div class="dropdown-menu">
                  <?php if (!isset($_SESSION['user'])): ?>
                    <a href="?act=login" class="btn_1">Đăng nhập/Đăng ký</a>
                  <?php else: ?>
                    <ul>
                      <li><a href="?act=profile"><i class="ti-user"></i>Tài khoản của tôi</a></li>
                      <li><a href="track-order.html"><i class="ti-truck"></i>Đơn hàng</a></li>
                      <li><a href="help.html"><i class="ti-help-alt"></i>Câu hỏi thường gặp</a></li>
                      <li><a href="?act=logout"><i class="ti-shift-left"></i>Đăng xuất</a></li>
                    </ul>
                  <?php endif; ?>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>