<?php require './views/layouts/layout_top.php'; ?>

<main>
    <?php if (isset($_SESSION['cart_error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['cart_error']) ?>
        </div>
        <?php unset($_SESSION['cart_error']); ?>
    <?php endif; ?>

    <div class="container margin_30">
        <div class="countdown_inner">-20% Ưu đãi này kết thúc sau <div data-countdown="2025/05/25" class="countdown">
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
                            <li><a href="#">Danh mục</a></li>
                            <li><?= $product['name'] ?></li>
                        </ul>
                    </div>

                    <div class="prod_info">
                        <h1><?= ($product['name']) ?></h1>
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
                                    <!-- <div class="col-lg-5 col-md-6 mb-2">
                                    <div class="price_main">
                                        <span class="new_price"><?= number_format($product['discount_price']) ?>₫</span>
                                        <span class="percentaged"></span>
                                        <span class="old_price"><?= number_format($product['price']) ?>₫</span>
                                    </div>
                                </div> -->

                                    <div class="row align-items-center">
                                        <div class="col-lg-5 col-md-6 mb-2">
                                            <div class="price_main">
                                                <span
                                                    class="new_price"><?= number_format($product['discount_price'] ?? 0, 0, ',', '.') ?>₫</span>

                                                <?php
                                                $original = $product['price'] ?? 0;
                                                $discount = $product['discount_price'] ?? 0;
                                                $percent = 0;

                                                if ($original > 0 && $discount < $original) {
                                                    $percent = round((($original - $discount) / $original) * 100);
                                                }
                                                ?>

                                                <?php if ($percent > 0): ?>
                                                    <span class="percentaged text-danger">-<?= $percent ?>%</span>
                                                <?php endif; ?>

                                                <span
                                                    class="old_price"><?= number_format($product['price'] ?? 0, 0, ',', '.') ?>₫</span>

                                            </div>


                                        </div>
                                        <div class="col-lg-4 col-md-6 mb-2">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <button type="submit" class="btn_1" title="Thêm vào giỏ hàng">
                                                <i class="ti-shopping-cart"></i> Thêm vào giỏ hàng
                                            </button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Tabs -->
    <div class="tabs_product">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab" role="tab">Mô tả</a>
                </li>
                <li class="nav-item">
                    <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Bình luận</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab_content_wrapper">
        <div class="container">
            <div class="tab-content" role="tablist">
                <!-- Mô tả -->
                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">Mô tả</h5>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-lg-12">
                                <h3>Chi tiết sản phẩm</h3>
                                <p><?= nl2br($product['description']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bình luận -->
                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                    <div class="card-header" role="tab" id="heading-B">
                        <h5 class="mb-0">Đánh giá</h5>
                    </div>
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
                <!-- /tab B -->
            </div>
        </div>
    </div>

    <!-- Sản phẩm liên quan (gợi ý) -->
    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Sản phẩm liên quan</h2>
            <span>Sản phẩm</span>
        </div>

        <div class="owl-carousel owl-theme products_carousel">
            <div class="item">
                <div class="grid_item">
                    <span class="ribbon new">New</span>
                    <figure>
                        <a href="product-detail-1.html">
                            <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg" alt="">
                        </a>
                    </figure>
                    <div class="rating">
                        <i class="icon-star voted"></i><i class="icon-star voted"></i>
                        <i class="icon-star voted"></i><i class="icon-star voted"></i>
                        <i class="icon-star"></i>
                    </div>
                    <a href="product-detail-1.html">
                        <h3>ACG React Terra</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">110.000₫</span>
                    </div>
                    <ul>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" title="Yêu thích"><i
                                    class="ti-heart"></i></a></li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" title="So sánh"><i
                                    class="ti-control-shuffle"></i></a></li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" title="Thêm vào giỏ"><i
                                    class="ti-shopping-cart"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- /item -->
            <!-- Thêm các item khác nếu cần -->
        </div>
    </div>
</main>

<?php require './views/layouts/layout_bottom.php'; ?>