<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm trạng thái đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h1>Thêm trạng thái đơn hàng mới</h1>
        <form action="index.php?act=order-status-create" method="post" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label class="form-label">Tên trạng thái</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" rows="4" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="index.php?act=order-status-list" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
