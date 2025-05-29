<?php
$basePath = dirname(__DIR__, 2);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Chi tiết đơn hàng #<?= htmlspecialchars($order['order_code']) ?></title>
    <?php require_once $basePath . "/views/layouts/libs_css.php"; ?>
</head>
<body class="bg-light">
<div class="container p-4">
    <h1 class="mb-4">Chi tiết đơn hàng #<?= htmlspecialchars($order['order_code']) ?></h1>
    <a href="index.php?act=orderIndex" class="btn btn-secondary mb-4">← Quay lại danh sách</a>

    <table class="table table-bordered">
        <tbody>
            <tr><th>Mã đơn</th><td><?= htmlspecialchars($order['order_code']) ?></td></tr>
            <tr><th>Tên người nhận</th><td><?= htmlspecialchars($order['receiver_name']) ?></td></tr>
            <tr><th>Email người nhận</th><td><?= htmlspecialchars($order['receiver_email']) ?></td></tr>
            <tr><th>SĐT người nhận</th><td><?= htmlspecialchars($order['receiver_phone']) ?></td></tr>
            <tr><th>Địa chỉ giao hàng</th><td><?= htmlspecialchars($order['shipping_address']) ?></td></tr>
            <tr><th>Trạng thái đơn hàng</th><td><?= htmlspecialchars($order['status_name'] ?? 'Chưa cập nhật') ?></td></tr>
           <tr><th><strong>Tổng tiền</strong></th>
            <td><strong><?= number_format($order['total_amount'], 0, ',', '.') ?> đ</strong></td>
            </tr>
            <tr><th>Phương thức thanh toán</th><td><?= htmlspecialchars($order['payment_method_name'] ?? 'Chưa cập nhật') ?></td></tr>
            <tr><th>Trạng thái thanh toán</th><td><?= htmlspecialchars($order['payment_status'] ?? 'Chưa cập nhật') ?></td></tr>
            <tr><th>Ngày tạo</th><td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($order['created_at']))) ?></td></tr>
            <tr><th>Ngày cập nhật</th><td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($order['updated_at']))) ?></td></tr>
        </tbody>
    </table>

    <h4 class="mt-5">Sản phẩm trong đơn hàng</h4>
    <table class="table table-striped table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderItems as $index => $item): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['unit_price'], 0, ',', '.') ?> đ</td>
                    <td><?= number_format($item['unit_price'] * $item['quantity'], 0, ',', '.') ?> đ</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once $basePath . "/views/layouts/libs_js.php"; ?>
</body>
</html>
