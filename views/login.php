<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="assets/client/login.css" />
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>

        <?php if (!empty($error)) : ?>
            <p style="color: red; margin-bottom: 16px;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="index.php?act=handle-login" method="post">
            <input type="text" name="username" placeholder="Tên đăng nhập" required />
            <input type="password" name="password" placeholder="Mật khẩu" required />
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>