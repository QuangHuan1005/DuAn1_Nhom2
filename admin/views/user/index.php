<?php
$basePath = dirname(__DIR__, 2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quản lý người dùng</title>
    <?php require_once $basePath . "/views/layouts/libs_css.php"; ?>
</head>
<body class="bg-light">
<div class="d-flex" style="min-height: 100vh;">
    <main class="flex-grow-1 p-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Quản lý người dùng</h2>
            </div>

            <div class="card-body">
                <form method="GET" class="row g-2 mb-3">
                    <input type="hidden" name="act" value="userIndex" />
                    <div class="col">
                        <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm tên, email, SĐT..." value="<?= $_GET['keyword'] ?? '' ?>" />
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>

                <div class="d-flex justify-content-center">
                    <div style="width: 100%; max-width: 1000px;">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>SĐT</th>
                                    <th>Ảnh</th>
                                    <th>Quyền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)) : ?>
                                    <?php 
                                    $start = ($page - 1) * $limit + 1; 
                                    foreach ($users as $index => $user) : 
                                        $stt = $start + $index;
                                    ?>
                                        <tr>
                                            <td><?= $stt ?></td> 
                                            <td><?= htmlspecialchars($user['username']) ?></td>
                                            <td><?= htmlspecialchars($user['email']) ?></td>
                                            <td><?= htmlspecialchars($user['phone']) ?></td>
                                            <td>
                                                <?php if (!empty($user['avatar'])): ?>
                                                    <img src="../uploads/<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" width="50" height="50" />
                                                <?php else: ?>
                                                    <span class="text-muted">Chưa có ảnh</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($user['role']) ?></td>
                                            <td>
                                                <?php if ($user['status'] == 1): ?>
                                                    <span class="badge bg-success">Hoạt động</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Ngừng hoạt động</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="index.php?act=userEdit&id=<?= $user['id'] ?>" class="btn btn-sm btn-warning">✏️ Sửa</a>
                                                <a href="index.php?act=userDelete&id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xoá người dùng này?')">🗑️ Xoá</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr><td colspan="8">Không tìm thấy người dùng nào.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if ($totalPages > 1): ?>
                    <div class="text-center mt-3">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?act=userIndex&page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>" 
                               class="btn btn-sm <?= $i == $page ? 'btn-dark' : 'btn-outline-secondary' ?> mx-1">
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
