<?php
require './views/layouts/layout_top.php'; ?>
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
        <div class="row">
            <?php if ($product): ?>

                <div class="col-md-6">
                    <div class="all">
                        <div class="slider">
                            <img src="<?= ($product['image_url']) ?>" alt="<?= ($product['name']) ?>">
                            <!-- <div class="owl-carousel owl-theme main">
                                <img src="<?= ($product['image_url']) ?>" style="height: 500px;" class="item-box">
                                <div style="background-image: url(img/products/shoes/1.jpg);" class="item-box"></div>
                                <div style="background-image: url(img/products/shoes/2.jpg);" class="item-box"></div>
                                <div style="background-image: url(img/products/shoes/3.jpg);" class="item-box"></div>
                                <div style="background-image: url(img/products/shoes/4.jpg);" class="item-box"></div>
                                <div style="background-image: url(img/products/shoes/5.jpg);" class="item-box"></div>
                                <div style="background-image: url(img/products/shoes/6.jpg);" class="item-box"></div>
                            </div>
                            <div class="left nonl"><i class="ti-angle-left"></i></div>
                            <div class="right"><i class="ti-angle-right"></i></div> -->
                        </div>
                        <!-- <div class="slider-two">
                            <div class="owl-carousel owl-theme thumbs">
                                <div style="background-image: url(img/products/shoes/1.jpg);" class="item active"></div>
                                <div style="background-image: url(img/products/shoes/2.jpg);" class="item"></div>
                                <div style="background-image: url(img/products/shoes/3.jpg);" class="item"></div>
                                <div style="background-image: url(img/products/shoes/4.jpg);" class="item"></div>
                                <div style="background-image: url(img/products/shoes/5.jpg);" class="item"></div>
                                <div style="background-image: url(img/products/shoes/6.jpg);" class="item"></div>
                            </div>
                            <div class="left-t nonl-t"></div>
                            <div class="right-t"></div>
                        </div> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#">Category</a></li>
                            <li><?= ($product['name']) ?></li>
                        </ul>
                    </div>
                <?php endif; ?>
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

                    <!-- /prod_info -->
                    <div class="product_actions">
                        <ul>
                            <!-- <li>
                            <a href="#"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="ti-control-shuffle"></i><span>Add to Compare</span></a>
                        </li> -->
                        </ul>
                    </div>
                    <!-- /product_actions -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

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

        <!-- /tabs_product -->
        <div class="tab_content_wrapper">
            <div class="container">
                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="false"
                                    aria-controls="collapse-A">
                                    Mô tả
                                </a>
                            </h5>

                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12">
                                        <h3>Chi tiết sản phẩm</h3>
                                        <p><?= $product['description'] ?>₫</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /TAB A -->
                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                    aria-controls="collapse-B">
                                    Đánh giá
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <?php if (!empty($comments)): ?>
                                        <?php foreach ($comments as $cmt): ?>


                                            <div class="col-lg-6">
                                                <div class="review_content">
                                                    <div class="clearfix add_bottom_10">
                                                        <!-- <span class="rating"><i class="icon-star"></i><i
                                                                class="icon-star"></i><i class="icon-star"></i><i
                                                                class="icon-star"></i><i
                                                                class="icon-star"></i><em>5.0/5.0</em></span> -->
                                                        <em><?= date('d/m/Y H:i', strtotime($cmt['created_at'])) ?></em>
                                                    </div>
                                                    <h4><?= $cmt['user_name'] ?></h4>
                                                    <p><?= nl2br($cmt['content']) ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Chưa có bình luận nào.</p>
                                    <?php endif; ?>
                                </div>
                                <!-- /row -->
                                <div class="row justify-content-between">
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
                                <!-- /row -->
                                <!-- <p class="text-end"><a href="leave-review.html" class="btn_1">Leave a review</a></p> -->
                            </div>
                            <!-- /card-body -->
                        </div>
                    </div>
                    <!-- /tab B -->
                </div>
                <!-- /tab-content -->
            </div>
            <!-- /container -->
        </div>
        <!-- /tab_content_wrapper -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Sản phẩm liên quan </h2>
                <span>Sản phẩm</span>
                <!-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> -->
            </div>
            <div class="owl-carousel owl-theme products_carousel">
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new">New</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                    data-src="img/products/shoes/4.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="product-detail-1.html">
                            <h3>ACG React Terra</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$110.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to
                                        compare</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new">New</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                    data-src="img/products/shoes/5.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="product-detail-1.html">
                            <h3>Air Zoom Alpha</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$140.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to
                                        compare</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon hot">Hot</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                    data-src="img/products/shoes/8.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="product-detail-1.html">
                            <h3>Air Color 720</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$120.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to
                                        compare</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon off">-30%</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                    data-src="img/products/shoes/2.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="product-detail-1.html">
                            <h3>Okwahn II</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$90.00</span>
                            <span class="old_price">$170.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to
                                        compare</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon off">-50%</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                    data-src="img/products/shoes/3.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="product-detail-1.html">
                            <h3>Air Wildwood ACG</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$75.00</span>
                            <span class="old_price">$155.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to
                                        compare</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
            </div>
            <!-- /products_carousel -->
        </div>
        <!-- /container -->

        <div class="feat">
            <div class="container">
                <ul>
                    <li>
                        <div class="box">
                            <i class="ti-gift"></i>
                            <div class="justify-content-center">
                                <h3>Free Shipping</h3>
                                <p>For all oders over $99</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                            <i class="ti-wallet"></i>
                            <div class="justify-content-center">
                                <h3>Secure Payment</h3>
                                <p>100% secure payment</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                            <i class="ti-headphone-alt"></i>
                            <div class="justify-content-center">
                                <h3>24/7 Support</h3>
                                <p>Online top support</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!--/feat-->

</main>
<?php require_once './views/layouts/layout_bottom.php'; ?>