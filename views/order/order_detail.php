<?php
require './views/layouts/layout_top.php'; ?>
<h2>Chi tiết đơn hàng #<?= ($_GET[' ']) ?></h2>

<?php if (count($items) > 0): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Hình</th>
            <th>Sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        <?php 
        $total = 0;
        foreach ($items as $item): 
            $subtotal = $item['unit_price'] * $item['quantity'];
            $total += $subtotal;
        ?>
            <tr>
                <td><img src="<?= htmlspecialchars($item['image_url']) ?>" width="80"></td>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= number_format($item['unit_price']) ?>đ</td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($subtotal) ?>đ</td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="4" align="right"><strong>Tổng cộng:</strong></td>
            <td><strong><?= number_format($total) ?>đ</strong></td>
        </tr>
    </table>
<?php else: ?>
    <p>Không tìm thấy chi tiết đơn hàng.</p>
<?php endif; ?>

<p><a href="index.php?action=my_orders">← Quay lại danh sách đơn hàng</a></p>
