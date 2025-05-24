<?php
// session_start();
$basePath = dirname(__DIR__, 2);
?>
<!doctype html>
<html lang="vi" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <base href="/duan1_nhom2/admin/">
    <meta charset="utf-8" />
    <title>Thêm sản phẩm | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once $basePath . "/views/layouts/libs_css.php"; ?>
</head>

<body>
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-lg-3 col-md-4  vh-100">
                <?php require_once $basePath . "/views/layouts/siderbar.php"; ?>
            </nav>

            <main class="col-lg-9 col-md-8 d-flex justify-content-center align-items-start py-4 bg-white">
                <div class="w-75">

                    <h2>Thêm sản phẩm mới</h2>

                    <?php if (!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error'] ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <form action="index.php?act=add_product" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>">
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" id="status" class="form-select">
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div> -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label">Tồn kho</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh sản phẩm</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>



                        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        <a href="index.php?act=product-list" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php require_once $basePath . "/views/layouts/libs_js.php"; ?>
</body>

</html>