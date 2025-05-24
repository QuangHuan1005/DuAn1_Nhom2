<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php include './views/layouts/header.php'; ?>
<?php include './views/layouts/siderbar.php'; ?>

<div class="container-fluid">
    <main class="p-4" style="margin-left: 250px;">
        <h1 class="mb-4">Danh sách Danh Mục</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="mb-3 text-end">
            <a href="<?= BASE_URL_ADMIN ?>?act=add_category" class="btn btn-primary">Thêm danh mục</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-secondary">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Tên danh mục</th>
                    <th class="text-center">Mô tả</th>
                    <th class="text-center">Ngày tạo</th>
                    <th class="text-center">Ngày cập nhật</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td class="text-center"><?= $category['id'] ?></td>
                        <td class="text-center"><?= htmlspecialchars($category['name']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($category['description']) ?></td>
                        <td class="text-center"><?= $category['created_at'] ?></td>
                        <td class="text-center"><?= $category['updated_at'] ?></td>
                        <td class="text-center">
                            <a class="btn btn-warning btn-sm" href="<?= BASE_URL_ADMIN ?>?act=edit_category&id=<?= $category['id'] ?>">Sửa</a>
                            <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteCategory(<?= $category['id'] ?>)">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

<?php include './views/layouts/libs_css.php'; ?>
<script>
    function deleteCategory(id) {
        if (confirm("Bạn có chắc chắn muốn xóa danh mục này?")) {
            window.location.href = "<?= BASE_URL_ADMIN ?>?act=delete_category&id=" + id;
        }
    }
</script>
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

</body>
</html>
