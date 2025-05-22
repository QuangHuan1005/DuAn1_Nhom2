<?php
require_once 'views/layouts/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Chi tiết danh mục</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="index.php?act=category-list">Danh mục</a></li>
        <li class="breadcrumb-item active">Chi tiết</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            Thông tin danh mục
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">ID</th>
                            <td><?php echo $category['id']; ?></td>
                        </tr>
                        <tr>
                            <th>Tên danh mục</th>
                            <td><?php echo $category['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td><?php echo $category['description']; ?></td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                <?php if ($category['status'] == 1): ?>
                                    <span class="badge bg-success">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Không hoạt động</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($category['created_at'])); ?></td>
                        </tr>
                        <?php if (isset($category['updated_at'])): ?>
                        <tr>
                            <th>Ngày cập nhật</th>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($category['updated_at'])); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                <a href="index.php?act=edit_category&id=<?php echo $category['id']; ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Chỉnh sửa
                </a>
                <a href="index.php?act=category-list" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'views/layouts/footer.php';
?> 