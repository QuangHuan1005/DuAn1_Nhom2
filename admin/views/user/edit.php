<h2>Sửa người dùng</h2>
<form method="POST" enctype="multipart/form-data" action="index.php?act=userUpdate&id=<?= $user['id'] ?>">
  
  <input type="hidden" name="old_avatar" value="<?= $user['avatar'] ?>">
  <div class="mb-3">
    <label>Tên người dùng</label>
    <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
  </div>
  <div class="mb-3">
    <label>Số điện thoại</label>
    <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>" required>
  </div>
  <div class="mb-3">
    <label>Ảnh đại diện hiện tại</label><br>
    <img src="uploads/<?= $user['avatar'] ?>" width="80">
    <input type="file" name="avatar" class="form-control mt-2">
  </div>
  <div class="mb-3">
    <label>Quyền</label>
    <select name="role" class="form-control">
      <option value="client" <?= $user['role'] == 'client' ? 'selected' : '' ?>>User</option>
      <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Cập nhật</button>
</form>
