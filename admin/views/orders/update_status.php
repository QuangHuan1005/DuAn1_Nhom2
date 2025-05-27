<?php
$basePath = dirname(__DIR__, 2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cập nhật trạng thái đơn hàng #<?= htmlspecialchars($order['id']) ?></title>
    <?php require_once $basePath . "/views/layouts/libs_css.php"; ?>
</head>
<body class="bg-light">
<div class="container p-4">
    <h1>Cập nhật trạng thái đơn hàng #<?= htmlspecialchars($order['id']) ?></h1>
    <a href="index.php?act=orderIndex" class="btn btn-secondary mb-3">← Quay lại danh sách</a>

    <form action="index.php?act=orderUpdateStatus&id=<?= htmlspecialchars($order['id']) ?>" method="post">
        <div class="mb-3">
            <label for="status_id" class="form-label">Trạng thái đơn hàng</label>
            <select name="status_id" id="status_id" class="form-select" required>
    <?php foreach ($statuses as $status): ?>
        <?php
        $isCompleted = $status['id'] == 5;
        $canSelectCompleted = isset($order['is_received']) && $order['is_received'];

        if ($isCompleted && !$canSelectCompleted) {
            continue;
        }
        ?>
        <option value="<?= htmlspecialchars($status['id']) ?>"
            <?= $order['status_id'] == $status['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($status['name']) ?>
        </option>
    <?php endforeach; ?>
</select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
    </form>
</div>
<?php require_once $basePath . "/views/layouts/libs_js.php"; ?>
</body>
</html>
