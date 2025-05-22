<?php
require_once 'views/layouts/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Thêm danh mục mới</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="index.php?act=category-list">Danh mục</a></li>
        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus me-1"></i>
            Thêm danh mục mới
        </div>
        <div class="card-body">
            <form action="index.php?act=add_category" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select class="form-select" id="status" name="status">
                        <option value="1">Hoạt động</option>
                        <option value="0">Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <a href="index.php?act=category-list" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'views/layouts/footer.php';
?> 