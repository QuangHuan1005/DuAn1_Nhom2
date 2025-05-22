<?php
$basePath = dirname(__DIR__, 2);
?>
<!doctype html>
<html lang="vi" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <base href="/duan1_nhom2/admin/">
    <meta charset="utf-8" />
    <title>Danh sách sản phẩm | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once $basePath . "/views/layouts/libs_css.php"; ?>
</head>

<body>
    <div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Danh sách sản phẩm</h4>
                                </div>

                                <div class="card-body">
                                    <!-- Thông báo -->
                                    <?php if (!empty($_SESSION['success'])): ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?= $_SESSION['success'] ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <?php unset($_SESSION['success']); ?>
                                    <?php endif; ?>

                                    <?php if (!empty($_SESSION['error'])): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $_SESSION['error'] ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <?php unset($_SESSION['error']); ?>
                                    <?php endif; ?>

                                    <!-- Nút thêm sản phẩm -->
                                    <div class="text-end mb-3">
                                        <a href="index.php?act=add_product" class="btn btn-success">
                                            <i class="ri-add-circle-line align-middle me-1"></i> Thêm sản phẩm
                                        </a>
                                    </div>

                                    <!-- Bảng danh sách -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center" style="width: 50px">STT</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th class="text-center">Hình ảnh</th>
                                                    <th>Mô tả</th>
                                                    <th class="text-end">Giá</th>
                                                    <th class="text-center">Tồn kho</th>
                                                    <th>Danh mục</th>
                                                    <th class="text-center" style="width: 150px">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($products)): ?>
                                                    <?php foreach ($products as $product): ?>
                                                        <tr>
                                                            <td class="text-center"><?= htmlspecialchars($product['id']) ?></td>
                                                            <td><?= htmlspecialchars($product['name']) ?></td>
                                                            <td class="text-center">
                                                                <?php if (!empty($product['image_url'])): ?>
                                                                    <img src="<?= htmlspecialchars($product['image_url']) ?>"
                                                                        alt="<?= htmlspecialchars($product['name']) ?>"
                                                                        class="img-thumbnail"
                                                                        style="max-width: 80px; height: 80px; object-fit: cover;">
                                                                <?php else: ?>
                                                                    <span class="text-muted">Không có ảnh</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <div class="description-cell"
                                                                    title="<?= htmlspecialchars($product['description']) ?>">
                                                                    <?= htmlspecialchars($product['description']) ?>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <?= number_format($product['price'], 0, ',', '.') ?> VND
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge <?= $product['stock_quantity'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                                                    <?= htmlspecialchars($product['stock_quantity']) ?>
                                                                </span>
                                                            </td>
                                                            <td><?= htmlspecialchars($product['category_name']) ?></td>

                                                            <td class="text-center">
                                                                <div class="d-flex gap-2 justify-content-center">
                                                                    <a href="index.php?act=view_product&id=<?= urlencode($product['id']) ?>"
                                                                        class="btn btn-info btn-sm"
                                                                        title="Xem chi tiết">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                    <a href="index.php?act=edit_product&id=<?= urlencode($product['id']) ?>"
                                                                        class="btn btn-warning btn-sm"
                                                                        title="Sửa">
                                                                        <i class="ri-edit-line"></i>
                                                                    </a>
                                                                    <a href="index.php?act=product-soft-delete&id=<?= urlencode($product['id']) ?>"
                                                                        class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"
                                                                        title="Xóa">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center">Không có sản phẩm nào.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS tùy chỉnh -->
    <style>
        .description-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .table> :not(caption)>*>* {
            padding: 0.75rem;
            vertical-align: middle;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .img-thumbnail {
            padding: 0.25rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
    </style>
</body>

</html>