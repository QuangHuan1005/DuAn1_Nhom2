<h2>Thêm người dùng</h2>
<form method="POST" enctype="multipart/form-data" action="index.php?act=userStore">
  <div class="mb-3">
    <label>Tên người dùng</label>
    <input type="text" name="username" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Số điện thoại</label>
    <input type="text" name="phone" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Ảnh đại diện</label>
    <input type="file" name="avatar" class="form-control">
  </div>
  <div class="mb-3">
    <label>Mật khẩu</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Quyền</label>
    <select name="role" class="form-control">
  <option value="client">client</option>
  <option value="admin">Admin</option>
</select>

  </div>
  <button type="submit" class="btn btn-success">Thêm</button>
</form>