<?php require_once './views/layouts/layout_top.php'; ?>

<main class="bg-light py-5">
  <div class="container">
    <h1 class="mb-4 text-primary">Thanh toán</h1>
    <form action="index.php?act=payment" method="POST" id="checkout-form" class="needs-validation" novalidate autocomplete="off">
      <div class="row gy-4">

        <!-- 1. Thông tin người dùng -->
        <section class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">1. Thông tin người dùng và địa chỉ thanh toán</h5>
            </div>
            <div class="card-body">

              <!-- Họ tên -->
              <div class="mb-3">
                <label for="fullname" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                <input type="text" id="fullname" name="fullname" class="form-control <?= !empty($errors['fullname']) ? 'is-invalid' : '' ?>" placeholder="Nhập họ và tên" value="<?= htmlspecialchars($oldInput['fullname'] ?? '') ?>" required>
                <div class="invalid-feedback"><?= $errors['fullname'] ?? 'Vui lòng nhập họ và tên.' ?></div>
              </div>

              <!-- SĐT -->
              <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                <input type="tel" id="phone" name="phone" pattern="^[0-9]{9,15}$" class="form-control <?= !empty($errors['phone']) ? 'is-invalid' : '' ?>" placeholder="Nhập số điện thoại" value="<?= htmlspecialchars($oldInput['phone'] ?? '') ?>" required>
                <div class="invalid-feedback"><?= $errors['phone'] ?? 'Vui lòng nhập số điện thoại hợp lệ (9-15 chữ số).' ?></div>
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" placeholder="Nhập địa chỉ email" value="<?= htmlspecialchars($oldInput['email'] ?? '') ?>" required>
                <div class="invalid-feedback"><?= $errors['email'] ?? 'Vui lòng nhập địa chỉ email hợp lệ.' ?></div>
              </div>

              <!-- Tỉnh -->
              <div class="mb-3">
                <label for="province" class="form-label">Tỉnh/Thành phố <span class="text-danger">*</span></label>
                <select id="province" name="province" class="form-select <?= !empty($errors['province']) ? 'is-invalid' : '' ?>" required>
                  <option value="" disabled selected>Chọn Tỉnh/Thành phố</option>
                  <option value="Hà Nội" <?= ($oldInput['province'] ?? '') === 'Hà Nội' ? 'selected' : '' ?>>Hà Nội</option>
                  <option value="Hồ Chí Minh" <?= ($oldInput['province'] ?? '') === 'Hồ Chí Minh' ? 'selected' : '' ?>>Hồ Chí Minh</option>
                  <option value="Đà Nẵng" <?= ($oldInput['province'] ?? '') === 'Đà Nẵng' ? 'selected' : '' ?>>Đà Nẵng</option>
                </select>
                <div class="invalid-feedback"><?= $errors['province'] ?? 'Vui lòng chọn Tỉnh/Thành phố.' ?></div>
              </div>

              <!-- Quận -->
              <div class="mb-3">
                <label for="district" class="form-label">Quận/Huyện <span class="text-danger">*</span></label>
                <select id="district" name="district" class="form-select <?= !empty($errors['district']) ? 'is-invalid' : '' ?>" required>
                  <option value="" disabled selected>Chọn Quận/Huyện</option>
                  <!-- Dữ liệu JS thêm sau -->
                </select>
                <div class="invalid-feedback"><?= $errors['district'] ?? 'Vui lòng chọn Quận/Huyện.' ?></div>
              </div>

              <!-- Địa chỉ -->
              <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ chi tiết <span class="text-danger">*</span></label>
                <input type="text" id="address" name="address" class="form-control <?= !empty($errors['address']) ? 'is-invalid' : '' ?>" placeholder="Số nhà, tên đường..." value="<?= htmlspecialchars($oldInput['address'] ?? '') ?>" required>
                <div class="invalid-feedback"><?= $errors['address'] ?? 'Vui lòng nhập địa chỉ.' ?></div>
              </div>

            </div>
          </div>
        </section>

        <!-- 2. Thanh toán và vận chuyển -->
        <section class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">2. Thanh toán & Vận chuyển</h5>
            </div>
            <div class="card-body">

              <div class="mb-3">
                <label class="form-label fw-semibold">Phương thức thanh toán</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" <?= ($oldInput['payment_method'] ?? 'cod') === 'cod' ? 'checked' : '' ?>>
                  <label class="form-check-label" for="cod">Thanh toán khi nhận hàng (COD)</label>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold">Phương thức vận chuyển</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="shipping" id="standard" value="standard" <?= ($oldInput['shipping'] ?? 'standard') === 'standard' ? 'checked' : '' ?>>
                  <label class="form-check-label" for="standard">Standard Shipping</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="shipping" id="express" value="express" <?= ($oldInput['shipping'] ?? '') === 'express' ? 'checked' : '' ?>>
                  <label class="form-check-label" for="express">Express Shipping</label>
                </div>
              </div>

            </div>
          </div>
        </section>

        <!-- 3. Tóm tắt đơn hàng -->
        <section class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">3. Tóm tắt đơn hàng</h5>
            </div>
            <div class="card-body">
              <ul class="list-group mb-3">
                <?php
                $total = 0;
                if (!empty($items) && is_array($items)):
                  foreach ($items as $item):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <li class="list-group-item d-flex justify-content-between">
                  <div><?= htmlspecialchars($item['name']) ?> × <?= intval($item['quantity']) ?></div>
                  <div><?= number_format($subtotal, 0, ',', '.') ?> ₫</div>
                </li>
                <?php endforeach; else: ?>
                <li class="list-group-item text-center">Giỏ hàng trống.</li>
                <?php endif; ?>
              </ul>

              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between">
                  <strong>Tạm tính</strong>
                  <span><?= number_format($total, 0, ',', '.') ?> ₫</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                  <strong>Phí vận chuyển</strong>
                  <span>30.000 ₫</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                  <strong>Tổng</strong>
                  <strong><?= number_format($total + 30000, 0, ',', '.') ?> ₫</strong>
                </li>
              </ul>

              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Xác nhận đặt hàng</button>
              </div>
            </div>
          </div>
        </section>

      </div>
    </form>
  </div>
</main>
<script>
  (function () {
    const districtsByProvince = {
      "Hà Nội": ["Quận Ba Đình", "Quận Hoàn Kiếm", "Quận Đống Đa"],
      "Hồ Chí Minh": ["Quận 1", "Quận 3", "Quận 5"],
      "Đà Nẵng": ["Quận Hải Châu", "Quận Thanh Khê", "Quận Sơn Trà"]
    };

    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');
    const oldDistrict = <?= json_encode($oldInput['district'] ?? '') ?>;

    function updateDistricts() {
      const selectedProvince = provinceSelect.value;
      const districts = districtsByProvince[selectedProvince] || [];

      districtSelect.innerHTML = '<option value="" disabled selected>Chọn Quận/Huyện</option>';
      districts.forEach(district => {
        const opt = document.createElement('option');
        opt.value = district;
        opt.textContent = district;
        if (district === oldDistrict) opt.selected = true;
        districtSelect.appendChild(opt);
      });
    }

    provinceSelect.addEventListener('change', updateDistricts);
    if (provinceSelect.value) {
      updateDistricts();
    }
  })();

  (() => {
    'use strict';
    const form = document.getElementById('checkout-form');
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  })();
</script>

<?php require_once './views/layouts/layout_bottom.php'; ?>
