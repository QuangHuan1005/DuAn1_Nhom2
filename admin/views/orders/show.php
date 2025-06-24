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
    <style>
        /* Tăng khoảng cách bảng, thêm shadow nhẹ */
        .info-table {
            box-shadow: 0 0 8px rgb(0 0 0 / 0.1);
            margin-bottom: 2rem;
        }
        /* Header bảng in hoa, đậm, màu primary */
        .info-table thead th {
            text-transform: uppercase;
            font-weight: 600;
            background-color: #0d6efd;
            color: #fff;
            text-align: center;
        }
        /* Căn giữa các cột số, phải các cột tiền */
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
        /* Hình ảnh trong bảng */
        .product-img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
        }
        /* Footer tổng tiền */
        .table-footer {
            font-weight: 700;
            background-color: #f8f9fa;
            font-size: 1.1rem;
        }
        /* Responsive: khi nhỏ hơn md thì 2 bảng nằm dọc */
        @media (min-width: 768px) {
            .info-table-wrapper {
                display: flex;
                gap: 2rem;
            }
            .info-table-wrapper > table {
                flex: 1;
                margin-bottom: 0;
            }
        }
        /* Căn chỉnh cột số lượng và tiền */
        .text-end {
            text-align: right !important;
        }
        /* Fix header bảng chi tiết khi scroll */
        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }
        .table-responsive thead th {
            position: sticky;
            top: 0;
            background-color: #cfe2ff;
            z-index: 10;
        }
    </style>
</head>
<body class="bg-light">
<div class="container p-4">
    <h1 class="mb-4">Chi tiết đơn hàng #<?= htmlspecialchars($order['order_code']) ?></h1>
    <a href="index.php?act=orderIndex" class="btn btn-secondary mb-4">← Quay lại danh sách</a>

    <!-- Bảng 1 và 2 nằm ngang -->
    <div class="info-table-wrapper mb-5">
        <!-- Thông tin chung đơn hàng -->
        <table class="table table-bordered info-table mb-0">
            <thead>
                <tr>
                    <th colspan="2">Thông tin chung đơn hàng</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Mã đơn hàng</th>
                    <td><?= htmlspecialchars($order['order_code']) ?></td>
                </tr>
                <tr>
                    <th>Ngày đặt</th>
                    <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($order['created_at']))) ?></td>
                </tr>
                <tr>
                    <th>Trạng thái đơn hàng</th>
                    <td><?= htmlspecialchars($order['status_name'] ?? 'Chưa cập nhật') ?></td>
                </tr>
                <tr>
                    <th>Trạng thái thanh toán</th>
                    <td><?= htmlspecialchars($order['payment_status'] ?? 'Chưa cập nhật') ?></td>
                </tr>
                <tr>
                    <th>Phương thức thanh toán</th>
                    <td><?= htmlspecialchars($order['payment_method_name'] ?? 'Chưa cập nhật') ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Thông tin khách hàng -->
        <table class="table table-bordered info-table mb-0">
            <thead>
                <tr>
                    <th colspan="2">Thông tin khách hàng</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Tên người nhận</th>
                    <td><?= htmlspecialchars($order['receiver_name']) ?></td>
                </tr>
                <tr>
                    <th>Tên tài khoản</th>
                    <td><?= htmlspecialchars($order['username'] ?? 'Chưa cập nhật') ?></td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td><?= htmlspecialchars($order['shipping_address']) ?></td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td><?= htmlspecialchars($order['receiver_phone']) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($order['receiver_email']) ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Bảng chi tiết đơn hàng -->
    <h4 class="mb-3">Chi tiết đơn hàng</h4>
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover table-bordered align-middle mb-0">
            <thead class="table-primary text-center">
                <tr>
                    <th style="width:50px;">STT</th>
                    <th class="text-start">Tên sản phẩm</th>
                    <th style="width:100px;">Hình ảnh</th>
                    <th style="width:130px;" class="text-end">Giá bán</th>
                    <th style="width:100px;" class="text-center">Số lượng</th>
                    <th style="width:150px;" class="text-end">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalOrderAmount = 0;
                foreach ($orderItems as $index => $item): 
                    $lineTotal = $item['unit_price'] * $item['quantity'];
                    $totalOrderAmount += $lineTotal;
                ?>
                <tr>
                    <td class="text-center"><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td class="text-center">
                        <?php if(!empty($item['image_url'])): ?>
                            <img src="/DuAn1_Nhom2/<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" class="product-img" />
                        <?php else: ?>
                            <span class="text-muted">Không có ảnh</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end"><?= number_format($item['unit_price'], 0, ',', '.') ?> đ</td>
                    <td class="text-center"><?= $item['quantity'] ?></td>
                    <td class="text-end"><?= number_format($lineTotal, 0, ',', '.') ?> đ</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="table-footer">
                    <td colspan="5" class="text-end">Tổng tiền đơn hàng:</td>
                    <td class="text-end"><?= number_format($totalOrderAmount, 0, ',', '.') ?> đ</td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>

<?php require_once $basePath . "/views/layouts/libs_js.php"; ?>
</body>
</html>
