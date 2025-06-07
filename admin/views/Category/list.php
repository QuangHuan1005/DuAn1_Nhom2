<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="">
    <div class="container">
        <h1>Danh sách danh mục</h1>
        <a href="index.php?act=category-add" class="btn btn-success mb-3">Thêm danh mục mới</a>

        <table class="table table-bordered table-striped bg-white">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $index => $cat): ?>
                        <tr>
                            <td class="text-center"><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($cat['name']) ?></td>
                            <td><?= nl2br(htmlspecialchars($cat['description'])) ?></td>
                            <td>
                                <a href="index.php?act=category-view&id=<?= $cat['id'] ?>" class="btn btn-info btn-sm">Xem</a>
                                <a href="index.php?act=category-edit&id=<?= $cat['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="index.php?act=category-soft-delete&id=<?= $cat['id'] ?>"
                                    onclick="return confirm('Bạn có chắc muốn ẩn?')"
                                    class="btn btn-danger btn-sm">Ẩn</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Chưa có danh mục nào</td>
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
                            <a class="page-link" href="index.php?act=category-list&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</body>

</html>