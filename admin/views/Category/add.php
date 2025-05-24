<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm danh mục</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Thêm danh mục mới</h2>
    <form action="index.php?act=category-store" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" name="description" id="description" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="index.php?act=category-list" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
