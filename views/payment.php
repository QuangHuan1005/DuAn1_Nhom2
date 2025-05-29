<?php require_once './views/layouts/layout_top.php'; ?>

<?php if (!empty($_SESSION['order_success'])): ?>
  <div class="alert alert-success">
    <?= htmlspecialchars($_SESSION['order_success']) ?>
  </div>
  <?php unset($_SESSION['order_success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['order_error'])): ?>
  <div class="alert alert-danger">
    <?= htmlspecialchars($_SESSION['order_error']) ?>
  </div>
  <?php unset($_SESSION['order_error']); ?>
<?php endif; ?>

<div class="container my-5">
  <h2 class="mb-4">Thông tin thanh toán</h2>
  
  <form action="index.php?controller=checkout&action=placeOrder" method="POST" id="checkout-form" novalidate>
    <div class="row">
      <!-- Cột trái: Thông tin người nhận -->
      <div class="col-md-6">
        <div class="mb-3">
          <label for="fullname" class="form-label">Họ và tên *</label>
          <input type="text" class="form-control <?= !empty($errors['fullname']) ? 'is-invalid' : '' ?>" id="fullname" name="fullname" placeholder="Nhập họ và tên"
            value="<?= htmlspecialchars($oldInput['fullname'] ?? '') ?>" required>
          <div class="invalid-feedback"><?= $errors['fullname'] ?? 'Vui lòng nhập họ và tên.' ?></div>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Số điện thoại *</label>
          <input type="tel" class="form-control <?= !empty($errors['phone']) ? 'is-invalid' : '' ?>" id="phone" name="phone" placeholder="Nhập số điện thoại"
            pattern="^[0-9]{9,15}$" value="<?= htmlspecialchars($oldInput['phone'] ?? '') ?>" required>
          <div class="invalid-feedback"><?= $errors['phone'] ?? 'Vui lòng nhập số điện thoại hợp lệ (9-15 chữ số).' ?></div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Địa chỉ email *</label>
          <input type="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Nhập địa chỉ email"
            value="<?= htmlspecialchars($oldInput['email'] ?? '') ?>" required>
          <div class="invalid-feedback"><?= $errors['email'] ?? 'Vui lòng nhập địa chỉ email hợp lệ.' ?></div>
        </div>

        <div class="mb-3">
          <label for="province" class="form-label">Tỉnh/Thành phố *</label>
          <select class="form-select <?= !empty($errors['province']) ? 'is-invalid' : '' ?>" id="province" name="province" required>
            <option value="">Chọn Tỉnh/Thành phố</option>
            <option value="Hà Nội" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Hà Nội') ? 'selected' : '' ?>>Hà Nội</option>
            <option value="Hồ Chí Minh" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Hồ Chí Minh') ? 'selected' : '' ?>>Hồ Chí Minh</option>
            <option value="Đà Nẵng" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Đà Nẵng') ? 'selected' : '' ?>>Đà Nẵng</option>
          </select>
          <div class="invalid-feedback"><?= $errors['province'] ?? 'Vui lòng chọn Tỉnh/Thành phố.' ?></div>
        </div>

        <div class="mb-3">
          <label for="district" class="form-label">Quận/Huyện *</label>
          <select class="form-select <?= !empty($errors['district']) ? 'is-invalid' : '' ?>" id="district" name="district" required>
            <option value="">Chọn Quận/Huyện</option>
            <!-- Các option sẽ được điền bởi JS -->
          </select>
          <div class="invalid-feedback"><?= $errors['district'] ?? 'Vui lòng chọn Quận/Huyện.' ?></div>
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Địa chỉ *</label>
          <input type="text" class="form-control <?= !empty($errors['address']) ? 'is-invalid' : '' ?>" id="address" name="address" placeholder="Số nhà, tên đường..."
            value="<?= htmlspecialchars($oldInput['address'] ?? '') ?>" required>
          <div class="invalid-feedback"><?= $errors['address'] ?? 'Vui lòng nhập địa chỉ.' ?></div>
        </div>

        <div class="mb-3">
          <label for="note" class="form-label">Ghi chú đơn hàng</label>
          <textarea class="form-control" id="note" name="note" rows="3" placeholder="Ghi chú thêm nếu có..."><?= htmlspecialchars($oldInput['note'] ?? '') ?></textarea>
        </div>
      </div>

      <!-- Cột phải: Thông tin đơn hàng + thanh toán -->
      <div class="col-md-6">
        <div class="card p-3 shadow-sm mb-3">
          <h5 class="mb-3">Đơn hàng của bạn</h5>
          <table class="table table-bordered align-middle text-center mb-0">
            <thead class="table-light">
              <tr>
                <th class="text-start">Sản phẩm</th>
                <th>Tạm tính</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              if (!empty($items) && is_array($items)):
                foreach ($items as $item):
                  $subtotal = $item['price'] * $item['quantity'];
                  $total += $subtotal;
              ?>
              <tr>
                <td class="text-start"><?= htmlspecialchars($item['name']) ?> × <?= intval($item['quantity']) ?></td>
                <td><?= number_format($subtotal, 0, ',', '.') ?> ₫</td>
              </tr>
              <?php
                endforeach;
              else:
              ?>
              <tr>
                <td colspan="2">Giỏ hàng trống.</td>
              </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Tạm tính</th>
                <td><?= number_format($total, 0, ',', '.') ?> ₫</td>
              </tr>
              <tr>
                <th>Phí vận chuyển</th>
                <td>30.000 ₫</td>
              </tr>
              <tr>
                <th>Tổng</th>
                <td><strong><?= number_format($total + 30000, 0, ',', '.') ?> ₫</strong></td>
              </tr>
            </tfoot>
          </table>
        </div>

        <h5>Phương thức thanh toán</h5>
        <div class="form-check mb-3">
          <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" 
            <?= (empty($oldInput['payment_method']) || $oldInput['payment_method'] === 'cod') ? 'checked' : '' ?>>
          <label class="form-check-label" for="cod">
            Thanh toán khi nhận hàng (COD)
          </label>
        </div>

        <button type="submit" class="btn btn-danger w-100">Đặt hàng</button>

        <p class="mt-3 small text-muted">
          Thông tin cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng, cải thiện trải nghiệm, và cho các mục đích đã nêu trong chính sách bảo mật.
        </p>
      </div>
    </div>
  </form>
</div>

<script>
  (function(){
    const districtsByProvince = {
      "Hà Nội": ["Quận Ba Đình", "Quận Hoàn Kiếm", "Quận Đống Đa"],
      "Hồ Chí Minh": ["Quận 1", "Quận 3", "Quận 5"],
      "Đà Nẵng": ["Quận Hải Châu", "Quận Thanh Khê", "Quận Sơn Trà"]
    };

    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');

    // Hàm cập nhật dropdown Quận/Huyện theo Tỉnh/Thành phố
    function updateDistricts() {
      const selectedProvince = provinceSelect.value;
      const districts = districtsByProvince[selectedProvince] || [];
      
      districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
      districts.forEach(d => {
        const opt = document.createElement('option');
        opt.value = d;
        opt.textContent = d;
        districtSelect.appendChild(opt);
      });

      // Giữ lại giá trị cũ nếu có
      const oldDistrict = <?= json_encode($oldInput['district'] ?? '') ?>;
      if(oldDistrict) {
        districtSelect.value = oldDistrict;
      }
    }

    provinceSelect.addEventListener('change', updateDistricts);

    // Khởi tạo khi load trang
    updateDistricts();

    const form = document.getElementById('checkout-form');
    
    form.addEventListener('submit', function(event) {
      // Reset lại trạng thái validation
      [...form.elements].forEach(el => {
        el.classList.remove('is-invalid');
      });

      let valid = true;

      // Kiểm tra fullname
      const fullname = form.fullname.value.trim();
      if (!fullname) {
        valid = false;
        form.fullname.classList.add('is-invalid');
      }

      // Kiểm tra phone với regex
      const phone = form.phone.value.trim();
      const phonePattern = /^[0-9]{9,15}$/;
      if (!phonePattern.test(phone)) {
        valid = false;
        form.phone.classList.add('is-invalid');
      }

      // Kiểm tra email
      const email = form.email.value.trim();
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        valid = false;
        form.email.classList.add('is-invalid');
      }

      // Kiểm tra province
      if (!form.province.value) {
        valid = false;
        form.province.classList.add('is-invalid');
      }

      // Kiểm tra district
      if (!form.district.value) {
        valid = false;
        form.district.classList.add('is-invalid');
      }

      // Kiểm tra address
      const address = form.address.value.trim();
      if (!address) {
        valid = false;
        form.address.classList.add('is-invalid');
      }

      if (!valid) {
        event.preventDefault();
        event.stopPropagation();
      }
    });
  })();
</script>
