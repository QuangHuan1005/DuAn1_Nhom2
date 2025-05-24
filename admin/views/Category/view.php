<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết danh mục</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Chi tiết danh mục</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?= htmlspecialchars($category['id']) ?></td>
        </tr>
        <tr>
            <th>Tên danh mục</th>
            <td><?= htmlspecialchars($category['name']) ?></td>
        </tr>
        <tr>
            <th>Mô tả</th>
            <td><?= nl2br(htmlspecialchars($category['description'])) ?></td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td><?= htmlspecialchars($category['created_at'] ?? 'Không rõ') ?></td>
        </tr>
    </table>
    <a href="index.php?act=category-list" class="btn btn-secondary">Quay lại</a>
</div>
</body>
</html>
