<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light p-4">
<div class="container">
    <h1>Sửa danh mục</h1>
    <form action="index.php?act=category-update&id=<?= $category['id'] ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <!-- Nếu bạn thực sự muốn dùng select, còn không thì dùng input như bên dưới -->
            <!--
            <select name="name" class="form-select" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat['name']) ?>"
                        <?= $cat['name'] === $category['name'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            -->

            <!-- Hoặc dùng input -->
            <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($category['name']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($category['description']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="index.php?act=category-list" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>
