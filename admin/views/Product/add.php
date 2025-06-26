<?php
$basePath = dirname(__DIR__, 2);
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>
<!doctype html>
<html lang="vi">

<head>
    <base href="/duan1_nhom2/admin/">
    <meta charset="utf-8" />
    <title>Thêm sản phẩm | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once $basePath . "/views/layouts/libs_css.php"; ?>
</head>

<body>
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-lg-3 col-md-4 vh-100">
                <?php require_once $basePath . "/views/layouts/siderbar.php"; ?>
            </nav>

            <main class="col-lg-9 col-md-8 d-flex justify-content-center align-items-start py-4 bg-white">
                <div class="w-75">

                    <h2 class="mb-4">Thêm sản phẩm</h2>

                    <form action="index.php?act=add_product" method="POST" enctype="multipart/form-data">
                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" <?= ($old['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($errors['category_id'])): ?>
                                <div class="text-danger"><?= $errors['category_id'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Tên sản phẩm -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="<?= htmlspecialchars($old['name'] ?? '') ?>">
                            <?php if (!empty($errors['name'])): ?>
                                <div class="text-danger"><?= $errors['name'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea name="description" id="description" rows="4" class="form-control"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                            <?php if (!empty($errors['description'])): ?>
                                <div class="text-danger"><?= $errors['description'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Giá -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" name="price" id="price" class="form-control"
                                   value="<?= htmlspecialchars($old['price'] ?? '') ?>">
                            <?php if (!empty($errors['price'])): ?>
                                <div class="text-danger"><?= $errors['price'] ?></div>
                            <?php endif; ?>
                        </div>

                        

                        <!-- Tồn kho -->
                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label">Tồn kho</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control"
                                   value="<?= htmlspecialchars($old['stock_quantity'] ?? '') ?>">
                            <?php if (!empty($errors['stock_quantity'])): ?>
                                <div class="text-danger"><?= $errors['stock_quantity'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Ảnh -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh sản phẩm</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <?php if (!empty($errors['image'])): ?>
                                <div class="text-danger"><?= $errors['image'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Nút -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                            <a href="index.php?act=product-list" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </form>

                </div>
            </main>
        </div>
    </div>

    <?php require_once $basePath . "/views/layouts/libs_js.php"; ?>
</body>
</html>
