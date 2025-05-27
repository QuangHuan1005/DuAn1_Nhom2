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
                                <th>SĐT người nhận</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
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
                                        <td><?= htmlspecialchars($order['receiver_phone']) ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                        <td>
                                            <?php 
                                            echo htmlspecialchars($order['status_name'] ?? 'Không xác định');
                                            ?>
                                        </td>
                                       <td>
                        <a href="index.php?act=orderView&id=<?= $order['id'] ?>" class="btn btn-sm btn-info">👁️ Xem</a>
                        <?php if ($order['status_id'] != 4 && $order['status_id'] != 5): ?>
                        <a href="index.php?act=orderEditStatus&id=<?= $order['id'] ?>" class="btn btn-sm btn-warning">✏️ Cập nhật</a>
                         <?php endif; ?>
                        <a href="index.php?act=orderDelete&id=<?= $order['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa đơn hàng này?')">🗑️ Xóa</a>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr><td colspan="8">Không tìm thấy đơn hàng nào.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($totalPages > 1): ?>
                    <div class="text-center mt-3">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?act=orderIndex&page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>" 
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
