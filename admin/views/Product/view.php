<?php
$basePath = dirname(__DIR__, 2);
?>
<!doctype html>
<html lang="vi">

<head>
    <base href="/duan1_nhom2/admin/">
    <meta charset="utf-8" />
    <title>Xem sản phẩm | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once $basePath . "/views/layouts/libs_css.php"; ?>
</head>

<body class="bg-light">
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-lg-3 col-md-4  text-white vh-100 p-0">
                <?php require_once $basePath . "/views/layouts/siderbar.php"; ?>
            </nav>

            <main class="col-lg-9 col-md-8 py-5 px-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Chi tiết sản phẩm</h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Tên sản phẩm:</label>
                            <p class="form-control-plaintext"><?= htmlspecialchars($product['name']) ?></p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Ảnh sản phẩm:</label><br>
                            <?php if (!empty($product['image_url'])): ?>
                                <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="Ảnh sản phẩm" class="img-thumbnail" style="max-width: 300px;">
                            <?php else: ?>
                                <p class="text-muted">Không có ảnh</p>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Mô tả:</label>
                            <p class="form-control-plaintext"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Giá:</label>
                            <p class="form-control-plaintext text-danger h5"><?= number_format($product['price'], 0, ',', '.') ?> đ</p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Tồn kho:</label>
                            <p class="form-control-plaintext"><?= $product['stock_quantity'] ?></p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Danh mục:</label>
                            <p class="form-control-plaintext"><?= htmlspecialchars($product['category_name'] ?? 'Không rõ') ?></p>
                        </div>

                        <a href="index.php?act=product-list" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle"></i> Quay lại
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php require_once $basePath . "/views/layouts/libs_js.php"; ?>
</body>

</html>
