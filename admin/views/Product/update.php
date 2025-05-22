<?php $basePath = dirname(__DIR__, 2); ?>
<div class="container mt-4">
    <h2>Cập nhật sản phẩm</h2>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <form action="index.php?act=edit_product&id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">-- Chọn danh mục --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="description" rows="4" class="form-control"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" id="price" class="form-control" value="<?= $product['price'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Tồn kho</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" value="<?= $product['stock_quantity'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label><br>
            <?php if (!empty($product['image_url'])): ?>
                <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="Ảnh sản phẩm" style="max-width: 100px;">
            <?php else: ?>
                <p class="text-muted">Chưa có ảnh</p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh mới (nếu thay)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-select">
                <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Hiển thị</option>
                <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="index.php?act=product-list" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
