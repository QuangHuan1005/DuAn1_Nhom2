<?php
require './views/layouts/layout_top.php'; ?>

<main class="bg_gray">
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Category</a></li>
                    <li>Page active</li>
                </ul>
            </div>
            <h1>Tài khoản của tôi</h1>
        </div>
        <!-- /page_header -->

        <div class="row">
            <div class="col-lg-6">
                <div class="box_profile_details">
                    <h3>Chi tiết người dùng</h3>
                    <div class="data_profile">
                        <p>Name: <?= ($user['fullname']) ?>
                        <p>
                            <!-- <p>Last Name: Doe<p> -->
                        <p>Số điện thoại: <?= ($user['phone']) ?></p>
                        <p>Email: <?= ($user['email']) ?></p>
                        <p>Địa chỉ: <?= ($user['address']) ?></p>
                    </div>
                    <p><a href="#0">Chỉnh sửa/Thay đổi</a></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box_profile_details">
                    <h3>Chi tiết tài khoản</h3>
                    <div class="data_profile">
                        <p>Tên đăng nhập: <?= $user['username'] ?></p>
                        <p>Mật khẩu: ********</p>
                        <p>Vai trò: <?= ($user['role']) ?></p>
                        <p>Ngày tạo: <?= ($user['created_at']) ?></p>
                        <p></p>
                    </div>
                    <p><a href="#0">Chỉnh sửa/Thay đổi</a></p>
                </div>
            </div>
        </div>
        <!-- /row -->

        <div class="row">
            <div class="col-lg-6 col-md-6">
                <a class="box_topic" href="?act=my_orders">
                    <i class="ti-bag"></i>
                    <h3>Đơn hàng của tôi</h3>
                </a>
            </div>
            <div class="col-lg-6 col-md-6">
                <a class="box_topic" href="my-wishlist.html">
                    <i class="ti-heart"></i>
                    <h3>Sản phẩm yêu thích</h3>
                </a>
            </div>
            <!-- <div class="col-lg-4 col-md-6">
                <a class="box_topic" href="leave-review.html">
                    <i class="ti-comment"></i>
                    <h3>Leave a review</h3>
                </a>
            </div> -->
        </div>
        <!-- /row -->

    </div>
    <!-- /container -->
</main>
<?php require_once './views/layouts/layout_bottom.php'; ?>