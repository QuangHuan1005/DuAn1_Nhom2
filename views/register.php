<main class="bg_gray">
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li>Đăng ký</li>
                </ul>
            </div>
            <h1>Đăng ký tài khoản mới</h1>
        </div>
        <!-- /page_header -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8">
                <div class="box_account">
                    <h3 class="client">Tạo tài khoản</h3>
                    <div class="form_container">

                        <?php if (!empty($error)): ?>
                            <p style="color: red; margin-bottom: 16px;"><?php echo htmlspecialchars($error); ?></p>
                        <?php endif; ?>

                        <form action="index.php?act=handle-register" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập*" required>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email*" required>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu*" required>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm" placeholder="Nhập lại mật khẩu*" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="fullname" placeholder="Họ tên">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="address" placeholder="Địa chỉ">
                            </div>

                            <div class="form-group">
                                <input type="file" class="form-control" name="avatar">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn_1 full-width">Đăng ký</button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <a href="index.php?act=login">Đã có tài khoản? <span style="color: blue;">Đăng nhập</span></a>
                        </div>
                    </div>
                </div>
                <!-- /box_account -->
            </div>
        </div>
        <!-- /row -->
    </div>
</main>
<?php require_once './views/layouts/layout_bottom.php';?>