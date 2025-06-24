<?php require_once './views/layouts/layout_top.php'; ?>

<main class="bg_gray">
  <div class="container margin_30">
    <div class="page_header">
      <div class="breadcrumbs">
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Thanh toán</a></li>
        </ul>
      </div>
      <h1>Thanh toán</h1>
    </div>

    <form action="index.php?act=payment" method="POST" id="checkout-form" novalidate>
      <div class="row">

        <!-- Thông tin người nhận -->
        <div class="col-lg-4 col-md-6">
          <div class="step first">
            <h3>1. Thông tin người nhận</h3>
            <div class="tab-content checkout">
              <div class="tab-pane fade show active">
                <div class="row no-gutters">
                  <div class="col-6 form-group pr-1">
                    <input type="text" name="fullname" class="form-control <?= !empty($errors['fullname']) ? 'is-invalid' : '' ?>" placeholder="Họ và tên" value="<?= htmlspecialchars($oldInput['fullname'] ?? '') ?>" required>
                    <div class="invalid-feedback"><?= $errors['fullname'] ?? 'Vui lòng nhập họ và tên.' ?></div>
                  </div>
                  <div class="col-6 form-group pl-1">
                    <input type="tel" name="phone" class="form-control <?= !empty($errors['phone']) ? 'is-invalid' : '' ?>" placeholder="Số điện thoại" pattern="^[0-9]{9,15}$" value="<?= htmlspecialchars($oldInput['phone'] ?? '') ?>" required>
                    <div class="invalid-feedback"><?= $errors['phone'] ?? 'Vui lòng nhập số điện thoại hợp lệ (9-15 chữ số).' ?></div>
                  </div>
                </div>

                <div class="form-group">
                  <input type="email" name="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" placeholder="Email" value="<?= htmlspecialchars($oldInput['email'] ?? '') ?>" required>
                  <div class="invalid-feedback"><?= $errors['email'] ?? 'Vui lòng nhập email hợp lệ.' ?></div>
                </div>

                <div class="form-group">
                  <select name="province" id="province" class="form-control <?= !empty($errors['province']) ? 'is-invalid' : '' ?>" required>
                    <option value="">Chọn Tỉnh/Thành phố</option>
                    <option value="Hà Nội" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Hà Nội') ? 'selected' : '' ?>>Hà Nội</option>
                    <option value="Hồ Chí Minh" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Hồ Chí Minh') ? 'selected' : '' ?>>Hồ Chí Minh</option>
                    <option value="Đà Nẵng" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Đà Nẵng') ? 'selected' : '' ?>>Đà Nẵng</option>
                  </select>
                  <div class="invalid-feedback"><?= $errors['province'] ?? 'Vui lòng chọn tỉnh/thành phố.' ?></div>
                </div>

                <div class="form-group">
                  <select name="district" id="district" class="form-control <?= !empty($errors['district']) ? 'is-invalid' : '' ?>" required>
                    <option value="">Chọn Quận/Huyện</option>
                  </select>
                  <div class="invalid-feedback"><?= $errors['district'] ?? 'Vui lòng chọn quận/huyện.' ?></div>
                </div>

                <div class="form-group">
                  <input type="text" name="address" class="form-control <?= !empty($errors['address']) ? 'is-invalid' : '' ?>" placeholder="Số nhà, tên đường..." value="<?= htmlspecialchars($oldInput['address'] ?? '') ?>" required>
                  <div class="invalid-feedback"><?= $errors['address'] ?? 'Vui lòng nhập địa chỉ.' ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Thanh toán & vận chuyển -->
        <div class="col-lg-4 col-md-6">
          <div class="step middle payments">
            <h3>2. Thanh toán & Vận chuyển</h3>

            <label class="container_radio">Thanh toán khi nhận hàng (COD)
              <input type="radio" name="payment_method" value="cod" <?= (empty($oldInput['payment_method']) || $oldInput['payment_method'] === 'cod') ? 'checked' : '' ?>>
              <span class="checkmark"></span>
            </label>

            <hr>
            <label class="container_radio">Standard Shipping
              <input type="radio" name="shipping" value="standard" <?= ($oldInput['shipping'] ?? 'standard') === 'standard' ? 'checked' : '' ?>>
              <span class="checkmark"></span>
            </label>

            <label class="container_radio">Express Shipping
              <input type="radio" name="shipping" value="express" <?= ($oldInput['shipping'] ?? '') === 'express' ? 'checked' : '' ?>>
              <span class="checkmark"></span>
            </label>
          </div>
        </div>

        <!-- Tóm tắt đơn hàng -->
        <div class="col-lg-4 col-md-6">
          <div class="step last">
            <h3>3. Tóm tắt đơn hàng</h3>
            <div class="box_general summary">
              <ul>
                <?php
                $total = 0;
                if (!empty($items)):
                  foreach ($items as $item):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <li class="clearfix">
                      <em><?= $item['quantity'] ?>x - <?= htmlspecialchars($item['name']) ?></em>
                      <span><?= number_format($subtotal, 0, ',', '.') ?> ₫</span>
                    </li>
                <?php endforeach; endif; ?>
                <li class="clearfix"><em><strong>Tạm tính</strong></em><span><?= number_format($total, 0, ',', '.') ?> ₫</span></li>
                <li class="clearfix"><em><strong>Phí vận chuyển</strong></em><span>30.000 ₫</span></li>
              </ul>
              <div class="total clearfix">Tổng <span><?= number_format($total + 30000, 0, ',', '.') ?> ₫</span></div>
              <button type="submit" class="btn btn-danger w-100 mt-3">Đặt hàng</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php if (!empty($_SESSION['order_success'])): ?>
      <div class="alert alert-success mt-3"><?= htmlspecialchars($_SESSION['order_success']) ?></div>
      <?php unset($_SESSION['order_success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['order_error'])): ?>
      <div class="alert alert-danger mt-3"><?= htmlspecialchars($_SESSION['order_error']) ?></div>
      <?php unset($_SESSION['order_error']); ?>
    <?php endif; ?>
  </div>
</main>

<script>
  const districtsByProvince = {
    "Hà Nội": ["Quận Ba Đình", "Quận Hoàn Kiếm", "Quận Đống Đa"],
    "Hồ Chí Minh": ["Quận 1", "Quận 3", "Quận 5"],
    "Đà Nẵng": ["Quận Hải Châu", "Quận Thanh Khê", "Quận Sơn Trà"]
  };

  const provinceSelect = document.getElementById('province');
  const districtSelect = document.getElementById('district');

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

    const oldDistrict = <?= json_encode($oldInput['district'] ?? '') ?>;
    if (oldDistrict) {
      districtSelect.value = oldDistrict;
    }
  }

  provinceSelect.addEventListener('change', updateDistricts);
  updateDistricts();

  (() => {
    const form = document.getElementById('checkout-form');
    form.addEventListener('submit', (e) => {
      let valid = true;
      const fullname = form.fullname.value.trim();
      const phone = form.phone.value.trim();
      const email = form.email.value.trim();
      const address = form.address.value.trim();
      const phonePattern = /^[0-9]{9,15}$/;
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!fullname) { valid = false; form.fullname.classList.add('is-invalid'); }
      if (!phonePattern.test(phone)) { valid = false; form.phone.classList.add('is-invalid'); }
      if (!emailPattern.test(email)) { valid = false; form.email.classList.add('is-invalid'); }
      if (!form.province.value) { valid = false; form.province.classList.add('is-invalid'); }
      if (!form.district.value) { valid = false; form.district.classList.add('is-invalid'); }
      if (!address) { valid = false; form.address.classList.add('is-invalid'); }

      if (!valid) {
        e.preventDefault();
        e.stopPropagation();
      }
    });
  })();
</script>

<?php require_once './views/layouts/layout_bottom.php'; ?>
