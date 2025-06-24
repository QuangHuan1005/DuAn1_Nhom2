<?php require_once './views/layouts/layout_top.php'; ?>

        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8">
                <div class="box_account">
                    <h3 class="client">Đăng nhập</h3>
                    <div class="form_container">
                        <div class="row no-gutters">
        
                            <?php if (!empty($error)): ?>
                                <p style="color: red; margin-bottom: 16px;"><?php echo htmlspecialchars($error); ?></p>
                            <?php endif; ?>
                            <form action="index.php?act=handle-login" method="post">

                                <div class="form-group">
                                    <input type="text" class="form-control" name="username"
                                        placeholder="Tên đăng nhập*" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" value=""
                                        placeholder="Mật khẩu*" required>
                                </div>
                                <div class="clearfix add_bottom_15">
                                    <div class="checkboxes float-start">
                                        <label class="container_check">Remember me
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="float-end"><a id="forgot" href="javascript:void(0);">Lost Password?</a>
                                    </div>
                                </div>
                                <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width">
                                </div>
                            </form>
                            <div id="forgot_pw">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email_forgot" id="email_forgot"
                                        placeholder="Type your email">
                                </div>
                                <p>A new password will be sent shortly.</p>
                                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1">
                                </div>
                            </div>
                            <a href="index.php?act=register">Chưa có tài khoản? <span style="color: blue;">Đăng ký ngay</span></a>
                        </div>
                        <!-- /form_container -->
                    </div>
                    <!-- /box_account -->
                    <div class="row">
                        <div class="col-md-6 d-none d-lg-block">
                            </ul>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-8">

                    <!-- /box_account -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
</main>
<?php require_once './views/layouts/layout_bottom.php';?>