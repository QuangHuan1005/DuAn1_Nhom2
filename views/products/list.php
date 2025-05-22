<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="assets/allaia/css/style.css">
</head>
<body>
    <div class="container">
        <div class="row small-gutters">

            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-6 col-md-4">
                        <div class="grid_item">
                            <?php if (!empty($product['discount_price'])): ?>
                                <span class="ribbon off">
                                    -<?= round(100 - ($product['discount_price'] / $product['price']) * 100) ?>%
                                </span>
                            <?php endif; ?>
                            <figure>
                                <a href="index.php?controller=product&action=detail&id=<?= $product['id'] ?>">
                                    <img class="img-fluid" src="<?= $product['image_url'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                </a>
                            </figure>
                            <a href="index.php?controller=product&action=detail&id=<?= $product['id'] ?>">
                                <h3><?= htmlspecialchars($product['name']) ?></h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">$<?= number_format($product['discount_price'] ?? $product['price'], 2) ?></span>
                                <?php if (!empty($product['discount_price'])): ?>
                                    <span class="old_price">$<?= number_format($product['price'], 2) ?></span>
                                <?php endif; ?>
                            </div>
                            <ul>
                                <li><a href="#" class="tooltip-1" title="Yêu thích"><i class="ti-heart"></i></a></li>
                                <li><a href="#" class="tooltip-1" title="So sánh"><i class="ti-control-shuffle"></i></a></li>
                                <li><a href="#" class="tooltip-1" title="Thêm vào giỏ"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có sản phẩm nào để hiển thị.</p>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>
