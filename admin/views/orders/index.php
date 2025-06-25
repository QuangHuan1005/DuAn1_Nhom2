<?php
$basePath = dirname(__DIR__, 2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quản lý đơn hàng</title>
    <?php require_once $basePath . "/views/layouts/libs_css.php"; ?>
</head>

<body class="bg-light">
    <div class="d-flex" style="min-height: 100vh;">
        <main class="flex-grow-1 p-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Quản lý đơn hàng</h2>
                </div>

                <div class="card-body">
                    <form method="GET" class="row g-2 mb-3">
                        <input type="hidden" name="act" value="orderIndex" />
                        <div class="col">
                            <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm theo tên người nhận..." value="<?= htmlspecialchars($keyword) ?>" />
                        </div>
                        <div class="col-auto">
                            <select name="status_id" class="form-select">
                                <option value="all">-- Tất cả trạng thái --</option>
                                <?php foreach ($statuses as $status): ?>
                                    <option value="<?= $status['id'] ?>" <?= ($status_id == $status['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($status['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn</th>
                                    <th>Tên người nhận</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái đơn hàng</th>
                                    <th>Trạng thái thanh toán</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($orders)) : ?>
                                    <?php
                                    $start = ($page - 1) * $limit + 1;
                                    foreach ($orders as $index => $order) :
                                        $stt = $start + $index;
                                    ?>
                                        <tr>
                                            <td><?= $stt ?></td>
                                            <td><?= htmlspecialchars($order['order_code']) ?></td>
                                            <td><?= htmlspecialchars($order['receiver_name']) ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                            <td>
                                                <?php
                                                $statusClass = match ($order['status_id']) {
                                                    1 => 'badge bg-secondary text-white px-2 py-1 rounded-pill',          
                                                    2 => 'badge bg-warning text-dark px-2 py-1 rounded-pill',            
                                                    3 => 'badge bg-info text-dark px-2 py-1 rounded-pill',             
                                                    4 => 'badge bg-success text-white px-2 py-1 rounded-pill',           
                                                    5 => 'badge bg-danger text-white px-2 py-1 rounded-pill',            
                                                    6 => 'badge bg-primary text-white px-2 py-1 rounded-pill',           
                                                    default => 'badge bg-light text-dark px-2 py-1 rounded-pill',         
                                                };


                                                ?>
                                                <span class="<?= $statusClass ?>"><?= htmlspecialchars($order['status_name'] ?? 'Không xác định') ?></span>

                                            </td>
                                            <td>
                                                <?php
                                                $paymentClass = match (strtolower($order['payment_status'] ?? '')) {
                                                    'đã thanh toán'   => 'badge bg-success text-white px-2 py-1 rounded-pill',
                                                    'chưa thanh toán' => 'badge bg-danger text-white px-2 py-1 rounded-pill',
                                                    default           => 'badge bg-secondary text-white px-2 py-1 rounded-pill',
                                                };

                                                ?>
                                                <span class="<?= $paymentClass ?>"><?= htmlspecialchars($order['payment_status'] ?? 'Chưa xác định') ?></span>

                                            </td>
                                            <td class="text-nowrap">
                                                <div class="d-flex justify-content-center align-items-center gap-1 flex-nowrap">
                                                    <a href="index.php?act=orderView&order_code=<?= urlencode($order['order_code']) ?>" class="btn btn-sm btn-info px-2 py-1">Xem</a>
                                                    <?php if (!in_array($order['status_id'], [4, 5, 6])): ?>
                                                        <a href="index.php?act=orderEditStatus&id=<?= $order['id'] ?>" class="btn btn-sm btn-warning px-2 py-1">Cập nhật</a>
                                                    <?php endif; ?>

                                                </div>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="8">Không tìm thấy đơn hàng nào.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if ($totalPages > 1): ?>
                        <div class="text-center mt-3">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?act=orderIndex&page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>&status_id=<?= $status_id ?>"
                                    class="btn btn-sm <?= $i == $page ? 'btn-primary' : 'btn-outline-secondary' ?> mx-1">
                                    <?= $i ?>
                                </a>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
    <?php require_once $basePath . "/views/layouts/libs_js.php"; ?>
</body>

</html>