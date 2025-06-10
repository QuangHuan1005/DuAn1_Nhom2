<?php
require './views/layouts/layout_top.php'; ?>
<h2></h2>


<main class="bg_gray">


    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Category</a></li>
                    <li>Page active</li>
                </ul>
            </div>
            <h1>Chi tiết đơn hàng</h1>

        </div>
        <!-- /page_header -->
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="step last">
                    <h3>Danh sách đơn hàng</h3>
                    <table class="table table-striped product-list mb-5">
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tong = 0;
                            foreach ($orderDetails as $product):
                                $thanhtien = $product['unit_price'] * $product['quantity'];
                                $tong += $thanhtien;
                                ?>
                                <tr>
                                    <td><img src="<?= $product['image_url'] ?>" width="60"></td>
                                    <td>
                                        <a href="?act=product-detail&id=<?= $product['product_id'] ?>">
                                            <?= $product['product_name'] ?>
                                        </a>
                                    </td>
                                    <td><?= number_format($product['unit_price']) ?>đ</td>
                                    <td><?= $product['quantity'] ?></td>
                                    <td><?= number_format($thanhtien) ?>đ</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4" align="right"><strong>Tổng cộng:</strong></td>
                                <td><strong><?= number_format($tong) ?>đ</strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <p><a href="index.php?act=my_orders">← Quay lại danh sách đơn hàng</a></p>
                    <!-- /step -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step last">
                    <h3>Địa chỉ nhận hàng</h3>


                        <div class="box_general summary">
                            <ul>
                                <li class="clearfix"><em>Họ tên:</em> <span><?= $order['receiver_name'] ?></span></li>
                                <li class="clearfix"><em>Số điện thoại</em> <span><?= $order['receiver_phone'] ?></span>
                                </li>
                                <li class="clearfix"><em>Email:</em> <span><?= $order['receiver_email'] ?></span></li>
                            </ul>
                            <ul>
                                <li class="clearfix"><em><strong>Địa chỉ:</strong></em>
                                    <span><?= $order['shipping_address'] ?></span>
                                </li>
                                <li class="clearfix"><em><strong>Trạng thái đơn hàng:</strong></em>
                                    <span><?= $order['payment_status'] ?></span>
                                </li>

                            </ul>
                            <div class="total clearfix">Phương thức thanh toán
                                <span>COD</span>
                                <!-- <span><?= $order['payment_method_id'] ?></span> -->
                            </div>

                            <!-- <a href="confirm.html" class="btn_1 full-width">Confirm and Pay</a> -->
                        </div>
                    <!-- /box_general -->
                </div>
                <!-- /step -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>