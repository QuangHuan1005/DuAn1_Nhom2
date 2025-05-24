<div class="container py-4">
  <div class="card shadow-sm mx-auto" style="max-width: 600px;">
    <div class="card-header bg-success text-white">
      <h3 class="mb-0">Chi tiết người dùng</h3>
    </div>
    <div class="card-body">
      <table class="table table-borderless">
        <tbody>
          <tr>
            <th scope="row" style="width: 150px;">ID</th>
            <td><?= htmlspecialchars($user['id']) ?></td>
          </tr>
          <tr>
            <th scope="row">Tên người dùng</th>
            <td><?= htmlspecialchars($user['username']) ?></td>
          </tr>
          <tr>
            <th scope="row">Email</th>
            <td><?= htmlspecialchars($user['email']) ?></td>
          </tr>
          <tr>
            <th scope="row">Số điện thoại</th>
            <td><?= htmlspecialchars($user['phone']) ?></td>
          </tr>
          <tr>
            <th scope="row">Quyền</th>
            <td><?= htmlspecialchars($user['role']) ?></td>
          </tr>
          <tr>
            <th scope="row">Ảnh đại diện</th>
            <td>
              <?php if (!empty($user['avatar'])): ?>
                <img src="../uploads/<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" class="img-thumbnail" style="max-width: 150px;">
              <?php else: ?>
                <span class="text-muted">Không có ảnh đại diện</span>
              <?php endif; ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer text-end">
      <a href="index.php?act=userIndex" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle"></i> Quay lại danh sách
      </a>
    </div>
  </div>
</div>
