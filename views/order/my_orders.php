<?php require './views/layouts/layout_top.php'; ?>

<?php if (!empty($orders) && is_array($orders) && count($orders) > 0): ?>
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
                <h1>Danh sách đơn hàng của bạn</h1>
            </div>

            <table class="table table-striped product-list mb-5">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Giá</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Tình trạng thanh toán</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $statusMap = [
                        1 => 'bg-warning',
                        2 => 'bg-secondary',
                        3 => 'bg-info',
                        4 => 'bg-primary',
                        5 => 'bg-danger',
                        6 => 'bg-success',
                    ];
                    $cancelable_statuses = ['1', '2'];
                    ?>

                    <?php foreach ($orders as $order): ?>
                        <?php if (!is_array($order)) continue; ?>
                        <tr>
                            <td>
                                <div class="thumb_product">
                                    <img src="./assets/allaia/img/products/shoes/2.jpg" class="lazy" alt="Image">
                                </div>
                                <span class="item_product">
                                    <a href="?act=order_detail&id=<?= $order['id'] ?? 0 ?>">
                                        #<?= isset($order['order_code']) ? htmlspecialchars($order['order_code']) : 'Không rõ mã' ?>
                                    </a>
                                </span>
                            </td>
                            <td>
                                <strong><?= isset($order['total_amount']) ? number_format($order['total_amount'] + 30000) . '₫' : '0₫' ?></strong>
                            </td>
                            <td>
                                <span class="badge rounded-pill <?= $statusMap[$order['status_id']] ?? 'bg-light' ?>">
                                    <?= $order['status_name'] ?? 'Không rõ trạng thái' ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-warning"><?= $order['payment_status'] ?? 'Không rõ' ?></span>
                            </td>
                            <td>
                                <strong>
                                    <?= !empty($order['created_at']) ? date('d/m/Y H:i', strtotime($order['created_at'])) : 'Không rõ thời gian' ?>
                                </strong>
                            </td>
                            <td class="options">
                                <a href="index.php?act=order_detail&id=<?= $order['id'] ?? 0 ?>" title="Xem chi tiết">
                                    <i class="ti-eye text-info"></i>
                                </a>

                                <?php if (isset($order['status_id']) && in_array($order['status_id'], $cancelable_statuses)): ?>
                                    <form action="index.php?act=my_orders_complete" method="POST"
                                        onsubmit="return confirm('Bạn chắc chắn muốn hủy đơn hàng?');" style="display:inline;">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                        <button type="submit" class="btn" style="background:none; border:none; padding:0;" title="Hủy đơn hàng">
                                            <i class="ti-trash text-danger"></i>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <a href="#" onclick="alert('Đơn hàng đang được giao hoặc đã giao, không thể hủy.'); return false;"
                                        title="Không thể hủy đơn hàng">
                                        <i class="ti-trash text-muted"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="pagination__wrapper">
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li><a href="index.php?act=my_orders&page=<?= $page - 1 ?>" class="prev" title="previous page">&#10094;</a></li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li>
                            <a href="index.php?act=my_orders&page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages): ?>
                        <li><a href="index.php?act=my_orders&page=<?= $page + 1 ?>" class="next" title="next page">&#10095;</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </main>
<?php else: ?>
    <div class="container margin_30">
        <p>Không có đơn hàng nào.</p>
    </div>
<?php endif; ?>

<?php require_once './views/layouts/layout_bottom.php'; ?>
