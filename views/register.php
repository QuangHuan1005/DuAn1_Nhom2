<<<<<<< HEAD
<?php
require './views/layouts/layout_top.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/client/register.css" />
</head>
<body>
=======<main class="bg_gray">
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

<?php if (!empty($error)) : ?>
    <p class="error-message"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form class="register-form" action="index.php?act=handle-register" method="POST" enctype="multipart/form-data">
  <h2 class="form-title">Đăng ký tài khoản</h2>
  <div class="row">
    <input type="text" name="username" placeholder="Tên đăng nhập" required class="input-field">
    <input type="email" name="email" placeholder="Email" required class="input-field">
  </div>

  <div class="row">
    <input type="password" name="password" placeholder="Mật khẩu" required class="input-field">
    <input type="password" name="confirm" placeholder="Nhập lại mật khẩu" required class="input-field">
  </div>

  <div class="row">
    <input type="text" name="fullname" placeholder="Họ tên" class="input-field">
    <input type="text" name="phone" placeholder="Số điện thoại" class="input-field">
  </div>

  <input type="text" name="address" placeholder="Địa chỉ" class="input-field full-width">

  <input type="file" name="avatar" class="input-file">

  <button type="submit" class="btn-submit">Đăng ký</button>
</form>

  
</body>
</html>