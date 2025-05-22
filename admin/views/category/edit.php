<?php
require_once 'views/layouts/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Chỉnh sửa danh mục</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="index.php?act=category-list">Danh mục</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Chỉnh sửa danh mục
        </div>
        <div class="card-body">
            <form action="index.php?act=edit_category&id=<?php echo $category['id']; ?>" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $category['name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $category['description']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select class="form-select" id="status" name="status">
                        <option value="1" <?php echo $category['status'] == 1 ? 'selected' : ''; ?>>Hoạt động</option>
                        <option value="0" <?php echo $category['status'] == 0 ? 'selected' : ''; ?>>Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="index.php?act=category-list" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'views/layouts/footer.php';
?> 