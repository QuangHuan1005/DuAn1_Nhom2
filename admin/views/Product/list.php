<?php
$basePath = dirname(__DIR__, 2);
$page = $page ?? ($_GET['page'] ?? 1);
$keyword = $keyword ?? ($_GET['keyword'] ?? '');
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <h1 class="mb-4 ">Danh sách sản phẩm</h1>

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
                Thêm sản phẩm
            </a>
        </div>

        <!-- Form tìm kiếm theo chữ cái đầu -->
        <form method="GET" action="index.php" class="row g-3 mb-3">
            <input type="hidden" name="act" value="product-list">
            <div class="col">
                <input type="text" name="keyword" class="form-control" placeholder="Nhập chữ cái đầu tên sản phẩm"
                    value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </form>

        <!-- Bảng danh sách sản phẩm -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped bg-white align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" style="width: 50px;">STT</th>
                        <th>Tên sản phẩm</th>
                        <th class="text-center">Hình ảnh</th>
                        <th>Mô tả</th>
                        <th class="text-end">Giá</th>
                        <th class="text-center">Tồn kho</th>
                        <th class="text-center">Trạng thái</th>
                        <th>Danh mục</th>
                        <th class="text-center" style="width: 150px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $index => $product): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($product['name']) ?></td>
                                <td>
                                    <a href="index.php?act=view_product&id=<?= $product['id'] ?>">
                                        <img src="/DuAn1_Nhom2/<?= htmlspecialchars($product['image_url']) ?>" alt="Ảnh"
                                            class="img-thumbnail" width="60">
                                    </a>
                                </td>
                                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                    title="<?= htmlspecialchars($product['description']) ?>">
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
                                <td class="text-center">
                                    <span class="badge <?= $product['status'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $product['status'] == 1 ? 'Hiển thị' : 'Ẩn' ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($product['category_name']) ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="index.php?act=view_product&id=<?= urlencode($product['id']) ?>"
                                            class="btn btn-info btn-sm" title="Xem">Xem</a>
                                        <a href="index.php?act=edit_product&id=<?= urlencode($product['id']) ?>"
                                            class="btn btn-warning btn-sm" title="Sửa">Sửa</a>

                                        <a href="index.php?act=product-soft-delete&id=<?= urlencode($product['id']) ?>"
                                            onclick="return confirm('<?= $product['status'] == 1 ? 'Bạn có chắc muốn ẩn sản phẩm này?' : 'Bạn có chắc muốn hiển thị lại sản phẩm này?' ?>')"
                                            class="btn btn-sm <?= $product['status'] == 1 ? 'btn-secondary' : 'btn-success' ?>"
                                            title="<?= $product['status'] == 1 ? 'Ẩn' : 'Hiển thị' ?>">
                                            <?= $product['status'] == 1 ? 'Ẩn' : 'Hiển thị' ?>
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


        <!-- Phân trang -->

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link"
                            href="index.php?act=product-list&page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>



    </div>
    </div>
    </div>

    <!-- Bootstrap JS (với Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>