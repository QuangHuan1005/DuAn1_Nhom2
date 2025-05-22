<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="assets/admin/user.css" />
</head>
<body>
    <h2 class="page-title">Quản lý người dùng</h2>

    <a href="index.php?act=userCreate" class="btn btn-add-user">➕ Thêm người dùng mới</a>

    <form method="GET" class="search-form" style="margin: 10px 0;">
        <input type="hidden" name="act" value="userIndex" />
        <input type="text" name="keyword" class="search-input" placeholder="Tìm kiếm tên, email, SĐT..." value="<?= $_GET['keyword'] ?? '' ?>" />
        <button type="submit" class="btn btn-search">Tìm kiếm</button>
    </form>

    <table class="user-table" border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead class="user-table-head">
            <tr>
                <th class="col-id">ID</th>
                <th class="col-username">Tên</th>
                <th class="col-email">Email</th>
                <th class="col-phone">SĐT</th>
                <th class="col-avatar">Ảnh</th>
                <th class="col-role">Quyền</th>
                <th class="col-actions">Thao tác</th>
            </tr>
        </thead>
        <tbody class="user-table-body">
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr class="user-row">
                        <td class="user-id"><?= $user['id'] ?></td>
                        <td class="user-username"><?= $user['username'] ?></td>
                        <td class="user-email"><?= $user['email'] ?></td>
                        <td class="user-phone"><?= $user['phone'] ?></td>
                        <td class="user-avatar">
                            <img src="../uploads/<?= $user['avatar'] ?>" alt="Avatar <?= $user['username'] ?>" width="50" height="50" />
                        </td>
                        <td class="user-role"><?= $user['role'] ?></td>
                        <td class="user-actions">
                            <a href="index.php?act=userEdit&id=<?= $user['id'] ?>" class="btn btn-edit">✏️ Sửa</a> | 
                            <a href="index.php?act=userDelete&id=<?= $user['id'] ?>" class="btn btn-delete" onclick="return confirm('Xác nhận xoá người dùng này?')">🗑️ Xoá</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="7" align="center" class="no-data">Không tìm thấy người dùng nào.</td></tr>
            <?php endif; ?>
        </tbody>
    </table> 
   <div style="margin-top: 15px; text-align: center;">
    <?php if ($totalPages > 1): ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?act=userIndex&page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>" 
               style="margin: 0 5px; padding: 4px 8px; text-decoration: none; border: 1px solid #ccc; <?= $i == $page ? 'font-weight: bold; background: #ddd;' : '' ?>">
               <?= $i ?>
            </a>
        <?php endfor; ?>
    <?php endif; ?>
</div>


</body>
</html>
