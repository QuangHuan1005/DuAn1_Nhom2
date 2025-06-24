<?php require './views/layouts/layout_top.php'; ?>

<main class="bg_gray">
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Category</a></li>
                    <li>Chi tiết đơn hàng</li>
                </ul>
            </div>
            <h1>Chi tiết đơn hàng #<?= htmlspecialchars($order['order_code']) ?></h1>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="step last">
                    <h3>Danh sách sản phẩm trong đơn hàng</h3>
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
                            <?php $tong = 0; ?>
                            <?php foreach ($orderDetails as $product): ?>
                                <?php
                                $thanhtien = $product['unit_price'] * $product['quantity'];
                                $tong += $thanhtien;
                                ?>
                                <tr>
                                    <td><img src="<?= htmlspecialchars($product['image_url']) ?>" width="60" alt="Ảnh sản phẩm"></td>
                                    <td>
                                        <a href="?act=product-detail&id=<?= $product['product_id'] ?>">
                                            <?= htmlspecialchars($product['product_name']) ?>
                                        </a>
                                    </td>
                                    <td><?= number_format($product['unit_price']) ?>đ</td>
                                    <td><?= $product['quantity'] ?></td>
                                    <td><?= number_format($thanhtien) ?>đ</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                                <td><strong><?= number_format($tong) ?>đ</strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <p><a href="index.php?act=my_orders">← Quay lại danh sách đơn hàng</a></p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="step last">
                    <h3>Thông tin giao hàng</h3>
                    <div class="box_general summary">
                        <ul>
                            <li class="clearfix"><em>Họ tên:</em> <span><?= htmlspecialchars($order['receiver_name']) ?></span></li>
                            <li class="clearfix"><em>Số điện thoại:</em> <span><?= htmlspecialchars($order['receiver_phone']) ?></span></li>
                            <li class="clearfix"><em>Email:</em> <span><?= htmlspecialchars($order['receiver_email']) ?></span></li>
                            <li class="clearfix"><em><strong>Địa chỉ:</strong></em> <span><?= htmlspecialchars($order['shipping_address']) ?></span></li>
                            <li class="clearfix"><em>Ngày đặt hàng:</em> <span><?= $order['created_at'] ?></span></li>
                            <li class="clearfix"><em>Ngày giao hàng:</em> <span><?= $order['updated_at'] ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="step last">
                    <h3>Tóm tắt đơn hàng</h3>
                    <div class="box_general summary">
                        <ul>
                            <?php
                            $status_id = $order['status_id'];
                            $statusMap = [
                                1 => ['label' => 'Chờ xác nhận', 'class' => 'badge bg-warning text-dark'],
                                2 => ['label' => 'Chờ lấy hàng', 'class' => 'badge bg-primary'],
                                3 => ['label' => 'Đang giao hàng', 'class' => 'badge bg-info text-dark'],
                                4 => ['label' => 'Đã giao hàng', 'class' => 'badge bg-secondary'],
                                5 => ['label' => 'Đã hủy', 'class' => 'badge bg-danger'],
                                6 => ['label' => 'Hoàn thành', 'class' => 'badge bg-success'],
                            ];
                            ?>

                            <?php if (isset($statusMap[$status_id])): ?>
                                <li class="clearfix">
                                    <em><strong>Trạng thái đơn hàng:</strong></em>
                                    <span class="<?= $statusMap[$status_id]['class'] ?> px-2 py-1 rounded-pill"><?= $statusMap[$status_id]['label'] ?></span>
                                </li>
                            <?php endif; ?>

                            <li class="clearfix">
                                <em><strong>Tình trạng thanh toán:</strong></em>
                                <?php
                                $payment_status = strtolower($order['payment_status'] ?? '');
                                $paymentClass = match ($payment_status) {
                                    'đã thanh toán' => 'badge bg-success text-white',
                                    'chưa thanh toán' => 'badge bg-danger text-white',
                                    default => 'badge bg-secondary text-white',
                                };
                                ?>
                                <span class="<?= $paymentClass ?> px-2 py-1 rounded-pill"><?= htmlspecialchars($order['payment_status'] ?? 'Chưa xác định') ?></span>
                            </li>

                            <li class="clearfix">
                                <em><strong>Phương thức vận chuyển:</strong></em>
                                <span>Thanh toán khi nhận hàng (COD)</span>
                            </li>

                            <li class="clearfix">
                                <em><strong>Tổng giá tiền:</strong></em>
                                <span><?= number_format($tong) ?>đ</span>
                            </li>

                            <li class="clearfix">
                                <em><strong>Chi phí vận chuyển:</strong></em>
                                <span>30,000đ</span>
                            </li>
                        </ul>

                        <div class="total clearfix">
                            Tổng giá trị đơn hàng: <span><?= number_format($tong + 30000) ?>đ</span>
                        </div>

                        <?php if ($order['status_id'] == 4): ?>
                            <form action="index.php?act=my_orders_complete" method="POST" onsubmit="return confirm('Bạn xác nhận đã nhận hàng?');">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <button type="submit" class="btn_1 full-width mt-3">Hoàn thành đơn hàng</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once './views/layouts/layout_bottom.php'; ?>
