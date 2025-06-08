<h2>Sửa quyền & trạng thái người dùng</h2>
<form method="POST" action="index.php?act=userUpdate&id=<?= $user['id'] ?>">

  <div class="mb-3">
    <label>Quyền</label>
    <select name="role" class="form-control">
      <option value="client" <?= $user['role'] == 'client' ? 'selected' : '' ?>>User</option>
      <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
    </select>
  </div>

  <div class="mb-3">
    <label>Trạng thái</label>
    <select name="status" class="form-control">
      <option value="1" <?= $user['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
      <option value="0" <?= $user['status'] == 0 ? 'selected' : '' ?>>Ngừng hoạt động</option>
    </select>
  </div>

  <button type="submit" class="btn btn-success">Cập nhật</button>
</form>
