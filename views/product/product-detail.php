<?php require './views/layouts/layout_top.php'; ?>

<main>
    <?php if (!empty($_SESSION['cart_error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['cart_error']) ?>
        </div>
        <?php unset($_SESSION['cart_error']); ?>
    <?php endif; ?>

    <div class="container margin_30">
        <div class="countdown_inner">
            <?php
            $original = $product['price'] ?? 0;
            $discount = $product['discount_price'] ?? 0;
            $percent = 0;

            if ($original > 0 && $discount < $original) {
                $percent = round((($original - $discount) / $original) * 100);
            }
            ?>
            <?php if ($percent > 0): ?>
                -<?= $percent ?>%
            <?php endif; ?>
            <div data-countdown="2025/06/25" class="countdown">
            </div>
        </div>

        <?php if ($product): ?>
            <div class="row">
                <!-- Hình ảnh sản phẩm -->
                <div class="col-md-6">
                    <div class="all">
                        <div class="slider">
                            <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>">
                        </div>

                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="col-md-6">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="index.php">Trang chủ</a></li>
                            <li><a href="#"><?= $product['category_name'] ?></a></li>
                            <li><?= $product['name'] ?></li>
                        </ul>
                    </div>

                    <div class="prod_info">
                        <h1><?= ($product['name']) ?></h1>
                       <?php if (($product['category_active'] ?? 1) == 0 || ($product['status'] ?? 1) == 0): ?>
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6">

                                    <div class="price_main">
                                        <span>Sản phẩm đã ngừng kinh doanh</span>
                                    </div>
                                </div>

                                <!-- <button class="btn btn-secondary" disabled>Không thể mua</button> -->
                            <?php else: ?>
                                <span class="rating"><em>Tồn kho:
                                        <?= isset($product['stock_quantity']) ? (int) $product['stock_quantity'] : 'Không có thông tin' ?></em></span>
                                <p><small>SKU: MTKRY-00<?= ($product['id']) ?></small>
                                    <!-- <br>Sed ex labitur adolescens scriptorem. Te
                        saepe verear tibique sed. Et wisi ridens vix, lorem iudico blandit mel cu. Ex vel sint zril
                        oportere, amet wisi aperiri te cum.</p> -->

                                <div class="prod_options">
                                    <form action="./?act=cart/add" method="post">
                                        <div class="row align-items-center mb-3">
                                            <label class="col-xl-3 col-lg-4 col-md-4 col-5"><strong>Số lượng</strong></label>
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-7">
                                                <input type="number" name="quantity" value="1" min="1" class="form-control"
                                                    style="width: 100px;" required>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-lg-6 col-md-6">

                                                <div class="price_main">
                                                    <?php
                                                    $original = $product['price'] ?? 0;
                                                    $discount = $product['discount_price'] ?? null;
                                                    $final_price = ($discount !== null && $discount < $original) ? $discount : $original;

                                                    // Tính phần trăm giảm giá nếu có
                                                    $percent = 0;
                                                    if ($discount !== null && $original > 0 && $discount < $original) {
                                                        $percent = round((($original - $discount) / $original) * 100);
                                                    }
                                                    ?>

                                                    <span
                                                        class="new_price"><?= number_format($final_price, 0, ',', '.') ?>₫</span>

                                                    <?php if ($percent > 0): ?>
                                                        <span class="percentage">-<?= $percent ?>%</span>
                                                        <span
                                                            class="old_price"><del><?= number_format($original, 0, ',', '.') ?>₫</del></span>
                                                    <?php endif; ?>
                                                </div>



                                            </div>
                                            <div class="col-lg-5 col-md-6">
                                                <div class="btn_add_to_cart"><input type="hidden" name="product_id"
                                                        value="<?= $product['id'] ?>">
                                                    <button type="submit" class="btn_1" title="Thêm vào giỏ hàng">
                                                        <i class="ti-shopping-cart"></i> Thêm vào giỏ hàng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
<?php endif; ?>
                            </div>
                        
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tabs -->
            <div class="tabs_product">
                <div class="container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab" role="tab">Mô
                                tả</a>
                        </li>
                        <li class="nav-item">
                            <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Bình luận</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab_content_wrapper">
                <div class="container">
                    <div class="tab-content">
                        <!-- Mô tả -->
                        <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                            <div class="card-body">
                                <h3>Chi tiết sản phẩm</h3>
                                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                            </div>
                        </div>

                        <!-- Bình luận -->
                        <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <?php if (!empty($comments)): ?>
                                        <?php foreach ($comments as $cmt): ?>
                                            <div class="col-lg-6">
                                                <div class="review_content">
                                                    <div class="clearfix add_bottom_10">
                                                        <em><?= date('d/m/Y H:i', strtotime($cmt['created_at'])) ?></em>
                                                    </div>
                                                    <h4><?= htmlspecialchars($cmt['user_name']) ?></h4>
                                                    <p><?= nl2br(htmlspecialchars($cmt['content'])) ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Chưa có bình luận nào.</p>
                                    <?php endif; ?>
                                </div>

                                <div class="row justify-content-between mt-3">
                                    <div class="col-lg-6">
                                        <h3>Bình luận</h3>
                                        <?php if (isset($_SESSION['user'])): ?>
                                            <form method="post" action="index.php?act=add_comment">
                                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                <textarea name="content" rows="4" cols="50" required
                                                    placeholder="Nhập bình luận..."></textarea><br>
                                                <button type="submit">Gửi bình luận</button>
                                            </form>
                                        <?php else: ?>
                                            <p>Vui lòng <a href="index.php?act=login">đăng nhập</a> để bình luận.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sản phẩm liên quan -->
            <div class="container margin_60_35">
                <div class="main_title">
                    <h2>Sản phẩm liên quan</h2>
                    <span>Sản phẩm</span>
                </div>
                <?php print_r($relatedProducts)
                    ?>
                <div class="owl-carousel owl-theme products_carousel">
                    <?php foreach ($relatedProducts as $product): ?>
                        <div class="item">
                            <div class="grid_item">
                                <!-- <span class="ribbon new">New</span> -->
                                <figure>
                                    <a href="?act=product-detail&id=<?= $product['id'] ?>">
                                        <img class="owl-lazy" src="<?= $product['image_url'] ?>" data-src="" alt="">
                                    </a>
                                </figure>
                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                        class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                                </div>
                                <a href="?act=product-detail&id=<?= $product['id'] ?>">
                                    <h3><?= $product['name'] ?></h3>
                                </a>
                                <?php if ($product['category_active'] == 0 || $product['status'] == 0): ?>
                                    <div class="price_box">
                                        <span class="text-danger">Sản phẩm đã ngừng kinh doanh</span>
                                    </div>
                                    <!-- <button class="btn btn-secondary" disabled>Không thể mua</button> -->
                                <?php else: ?>
                                    <div class="price_box">
                                        <?php if (!empty($product['discount_price']) && $product['discount_price'] < $product['price']): ?>
                                            <span class="new_price"><?= number_format($product['discount_price']) ?>₫</span>
                                            <span class="old_price"><del><?= number_format($product['price']) ?>₫</del></span>
                                        <?php else: ?>
                                            <span class="new_price"><?= number_format($product['price']) ?>₫</span>
                                        <?php endif; ?>
                                    </div>

                                <?php endif; ?>
                                <!-- <ul>
                                    <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to favorites"><i class="ti-heart"></i><span>Add to
                                                favorites</span></a></li>
                                    <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to
                                                compare</span></a></li>
                                    <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                                    </li>
                                </ul> -->
                            </div>
                            <!-- /grid_item -->
                        </div>
                        <!-- /item -->
                    <?php endforeach ?>

                </div>
            </div>
        </div>
</main>

<?php require './views/layouts/layout_bottom.php'; ?>