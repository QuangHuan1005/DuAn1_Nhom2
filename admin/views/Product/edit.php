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
       

        <main class="col-lg-9 col-md-8 py-5 px-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Chỉnh sửa sản phẩm</h4>
                </div>

                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên sản phẩm:</label>
                            <input type="text" name="name" class="form-control" 
                                   value="<?= htmlspecialchars($product['name']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Danh mục:</label>
                            <select name="category_id" class="form-control" required>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"
                                        <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả:</label>
                            <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Giá:</label>
                            <input type="number" name="price" class="form-control" 
                                   value="<?= htmlspecialchars($product['price']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Số lượng:</label>
                            <input type="number" name="stock_quantity" class="form-control"
                                   value="<?= htmlspecialchars($product['stock_quantity']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Trạng thái:</label>
                            <select name="status" class="form-control" required>
                                <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Hiển thị</option>
                                <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Ẩn</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ảnh hiện tại:</label><br>
                            <?php if (!empty($product['image_url'])): ?>
                                <img src="<?= $product['image_url'] ?>" 
                                     alt="Ảnh sản phẩm" class="img-thumbnail" style="max-width: 200px;">
                            <?php else: ?>
                                <p class="text-muted">Không có ảnh</p>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Chọn ảnh mới (nếu muốn thay):</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="index.php?act=product-list" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
