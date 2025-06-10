<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách trạng thái đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h1>Danh sách trạng thái đơn hàng</h1>
        <a href="index.php?act=order-status-createForm" class="btn btn-success mb-3">Thêm trạng thái mới</a>

        <table class="table table-bordered table-striped bg-white">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Tên trạng thái</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($statuses)): ?>
                    <?php foreach ($statuses as $status): ?>
                        <tr>
                            <td><?= $status['id'] ?></td>
                            <td><?= htmlspecialchars($status['name']) ?></td>
                            <td><?= nl2br(htmlspecialchars($status['description'])) ?></td>
                            <td class="">
                                <a href="index.php?act=order-status-edit&id=<?= $status['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Không có trạng thái nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
