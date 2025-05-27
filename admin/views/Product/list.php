<?php
$basePath = dirname(__DIR__, 2);
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Sử dụng Bootstrap CDN giống như trang danh mục -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div id="layout-wrapper">
        <div >
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
    <div class="container">
        <h1>Danh sách sản phẩm</h1>
        <a href="index.php?act=add_product" class="btn btn-success mb-3">Thêm sản phẩm</a>

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

        <table class="table table-bordered table-striped bg-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">STT</th>
                    <th>Tên sản phẩm</th>
                    <th class="text-center">Hình ảnh</th>
                    <th>Mô tả</th>
                    <th class="text-end">Giá</th>
                    <th class="text-center">Tồn kho</th>
                    <th>Danh mục</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="text-center"><?= htmlspecialchars($product['id']) ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td class="text-center">
                                <?php
                                $imagePath = 'uploads/' . $product['image_url'];
                                $absolutePath = $basePath . '/uploads/' . $product['image_url'];
                                $defaultImage = 'uploads/no-image.png';
                                ?>
                                <img src="<?= (file_exists($absolutePath) && !empty($product['image_url'])) ? $imagePath : $defaultImage ?>"
                                     alt="<?= htmlspecialchars($product['name']) ?>"
                                     class="img-thumbnail"
                                     style="max-width: 80px; height: 80px; object-fit: cover;">
                            </td>
                            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($product['description']) ?>">
                                <?= htmlspecialchars($product['description']) ?>
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
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="index.php?act=view_product&id=<?= urlencode($product['id']) ?>" class="btn btn-info btn-sm" title="Xem">
                                        Xem
                                    </a>
                                    <a href="index.php?act=edit_product&id=<?= urlencode($product['id']) ?>" class="btn btn-warning btn-sm" title="Sửa">
                                        Sửa
                                    </a>
                                    <a href="index.php?act=product-soft-delete&id=<?= urlencode($product['id']) ?>"
                                       onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"
                                       class="btn btn-danger btn-sm" title="Xóa">
                                        Xóa
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

        <!-- Phân trang -->
        <?php if (isset($totalPages) && $totalPages > 1): ?>
            <nav>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="index.php?act=product-list&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>