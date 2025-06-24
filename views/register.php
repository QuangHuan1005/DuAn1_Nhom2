<?php require './views/layouts/layout_top.php'; ?>

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

        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8">
                <div class="box_account">
                    <h3 class="client">Tạo tài khoản</h3>
                    <div class="form_container">
                        <?php if (!empty($error)): ?>
                            <p style="color: red; margin-bottom: 16px;"><?php echo htmlspecialchars($error); ?></p>
                        <?php endif; ?>

                        <form id="registerForm" action="index.php?act=handle-register" method="post" enctype="multipart/form-data" novalidate>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Tên đăng nhập*" required
                                    value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                                <small class="error-msg" id="error-username"></small>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email*" required
                                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                                <small class="error-msg" id="error-email"></small>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu*" required>
                                <small class="error-msg" id="error-password"></small>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Nhập lại mật khẩu*" required>
                                <small class="error-msg" id="error-confirm"></small>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Họ tên"
                                    value="<?php echo htmlspecialchars($_POST['fullname'] ?? ''); ?>">
                                <small class="error-msg" id="error-fullname"></small>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Số điện thoại"
                                    value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                                <small class="error-msg" id="error-phone"></small>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Địa chỉ"
                                    value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
                                <small class="error-msg" id="error-address"></small>
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file" class="form-control" name="avatar" id="avatar" accept="image/*">
                                <small class="error-msg" id="error-avatar"></small>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Đăng ký" class="btn_1 full-width">
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <a href="index.php?act=login">Đã có tài khoản? <span style="color: blue;">Đăng nhập</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once './views/layouts/layout_bottom.php'; ?>

<style>
.error-msg {
    color: red;
    font-size: 0.875em;
    height: 18px;
    margin-top: 3px;
    display: block;
}
</style>

<script>
document.getElementById('registerForm').addEventListener('submit', function(event) {
    // Xóa hết lỗi cũ
    const errorFields = document.querySelectorAll('.error-msg');
    errorFields.forEach(el => el.textContent = '');

    let isValid = true;

    const username = document.getElementById('username').value.trim();
    const email    = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirm  = document.getElementById('confirm').value;
    const fullname = document.getElementById('fullname').value.trim();
    const phone    = document.getElementById('phone').value.trim();
    const address  = document.getElementById('address').value.trim();
    const avatarInput = document.getElementById('avatar');

    // Username
    if (username.length < 4) {
        document.getElementById('error-username').textContent = "Tên đăng nhập phải có ít nhất 4 ký tự.";
        isValid = false;
    }

    // Email
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/i;
    if (!emailPattern.test(email)) {
        document.getElementById('error-email').textContent = "Email không hợp lệ.";
        isValid = false;
    }

    // Password
    if (password.length < 6) {
        document.getElementById('error-password').textContent = "Mật khẩu phải có ít nhất 6 ký tự.";
        isValid = false;
    }

    // Confirm password
    if (password !== confirm) {
        document.getElementById('error-confirm').textContent = "Mật khẩu xác nhận không khớp.";
        isValid = false;
    }

    // Fullname (bắt buộc, tối thiểu 2 ký tự)
    if (fullname.length < 2) {
        document.getElementById('error-fullname').textContent = "Họ tên phải có ít nhất 2 ký tự.";
        isValid = false;
    }

    // Address (bắt buộc, tối thiểu 5 ký tự)
    if (address.length < 5) {
        document.getElementById('error-address').textContent = "Địa chỉ phải có ít nhất 5 ký tự.";
        isValid = false;
    }

    // Phone (nếu nhập)
    if (phone !== '' && !/^[0-9]{9,11}$/.test(phone)) {
        document.getElementById('error-phone').textContent = "Số điện thoại không hợp lệ. Phải từ 9 đến 11 chữ số.";
        isValid = false;
    }

    // Avatar (nếu có)
    if (avatarInput.files.length > 0) {
        const file = avatarInput.files[0];
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            document.getElementById('error-avatar').textContent = "Chỉ cho phép upload file ảnh (jpg, png, gif).";
            isValid = false;
        }
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            document.getElementById('error-avatar').textContent = "Ảnh đại diện không được lớn hơn 2MB.";
            isValid = false;
        }
    }

    if (!isValid) {
        event.preventDefault(); // ngăn form submit nếu có lỗi
    }
});

</script>

<?php require './views/layouts/layout_bottom.php'; ?>
