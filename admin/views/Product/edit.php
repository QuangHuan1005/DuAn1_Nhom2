<?php
$basePath = dirname(__DIR__, 2);
?>
<!doctype html>
<html lang="vi">

<head>
    <base href="/duan1_nhom2/admin/">
    <meta charset="utf-8" />
    <title>Chỉnh sửa sản phẩm | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once $basePath . "/views/layouts/libs_css.php"; ?>
</head>

<body class="bg-light">
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-lg-3 col-md-4 text-white vh-100 p-0">
                <?php require_once $basePath . "/views/layouts/siderbar.php"; ?>
            </nav>

            <main class="col-lg-9 col-md-8 py-5 px-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Chỉnh sửa sản phẩm</h4>
                    </div>

                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tên sản phẩm:</label>
                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Ảnh sản phẩm hiện tại:</label><br>
                                <?php if (!empty($product['image_url'])): ?>
                                    <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="Ảnh sản phẩm" class="img-thumbnail" style="max-width: 200px;">
                                <?php else: ?>
                                    <p class="text-muted">Không có ảnh</p>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Chọn ảnh mới (nếu muốn thay):</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Mô tả:</label>
                                <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Giá:</label>
                                <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Tồn kho:</label>
                                <input type="number" name="stock_quantity" class="form-control" value="<?= $product['stock_quantity'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Danh mục:</label>
                                <select name="category_id" class="form-select" required>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>" <?= ($product['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Trạng thái:</label>
                                <select name="status" class="form-select">
                                    <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Hiển thị</option>
                                    <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Ẩn</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php?act=product-list" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left-circle"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save"></i> Lưu thay đổi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php require_once $basePath . "/views/layouts/libs_js.php"; ?>
</body>

</html>
