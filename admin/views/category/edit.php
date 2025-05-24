<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Cập nhật danh mục</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- hoặc dùng CDN -->
</head>
<body>

<?php include './views/layouts/header.php'; ?>
<?php include './views/layouts/siderbar.php'; ?>

<div class="container-fluid">
    <main class="col-md-8 p-4 main-content order-md-1" style="width: 75%; margin-left: 400px;">
        <h1>Cập nhật danh mục</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="<?= BASE_URL_ADMIN ?>?act=edit_category&id=<?= $category['id'] ?>" method="post" class="form">
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= htmlspecialchars($category['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($category['description']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary form-control">Cập nhật</button>
        </form>
    </main>
</div>

<?php include './views/layouts/libs_css.php'; ?>

</body>
</html>
