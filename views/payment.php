<?php require_once './views/layouts/layout_top.php'; ?>

<main class="bg-light py-5">

  <div class="container">

    <h1 class="mb-4 text-primary">Thanh toán</h1>

    <form action="index.php?act=payment" method="POST" id="checkout-form" novalidate class="needs-validation" autocomplete="off">

      <div class="row gy-4">

        <!-- Thông tin người dùng và địa chỉ -->
        <section class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">1. Thông tin người dùng và địa chỉ thanh toán</h5>
            </div>
            <div class="card-body">

              <div class="mb-3">
                <label for="fullname" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                <input type="text" id="fullname" name="fullname" class="form-control <?= !empty($errors['fullname']) ? 'is-invalid' : '' ?>"
                  placeholder="Nhập họ và tên" value="<?= htmlspecialchars($oldInput['fullname'] ?? '') ?>" required>
                <div class="invalid-feedback"><?= $errors['fullname'] ?? 'Vui lòng nhập họ và tên.' ?></div>
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                <input type="tel" id="phone" name="phone" pattern="^[0-9]{9,15}$" class="form-control <?= !empty($errors['phone']) ? 'is-invalid' : '' ?>"
                  placeholder="Nhập số điện thoại" value="<?= htmlspecialchars($oldInput['phone'] ?? '') ?>" required>
                <div class="invalid-feedback"><?= $errors['phone'] ?? 'Vui lòng nhập số điện thoại hợp lệ (9-15 chữ số).' ?></div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>"
                  placeholder="Nhập địa chỉ email" value="<?= htmlspecialchars($oldInput['email'] ?? '') ?>" required>
                <div class="invalid-feedback"><?= $errors['email'] ?? 'Vui lòng nhập địa chỉ email hợp lệ.' ?></div>
              </div>

              <div class="mb-3">
                <label for="province" class="form-label">Tỉnh/Thành phố <span class="text-danger">*</span></label>
                <select id="province" name="province" class="form-select <?= !empty($errors['province']) ? 'is-invalid' : '' ?>" required>
                  <option value="" disabled selected>Chọn Tỉnh/Thành phố</option>
                  <option value="Hà Nội" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Hà Nội') ? 'selected' : '' ?>>Hà Nội</option>
                  <option value="Hồ Chí Minh" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Hồ Chí Minh') ? 'selected' : '' ?>>Hồ Chí Minh</option>
                  <option value="Đà Nẵng" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Đà Nẵng') ? 'selected' : '' ?>>Đà Nẵng</option>
                </select>
                <div class="invalid-feedback"><?= $errors['province'] ?? 'Vui lòng chọn Tỉnh/Thành phố.' ?></div>
              </div>

              <div class="mb-3">
                <label for="district" class="form-label">Quận/Huyện <span class="text-danger">*</span></label>
                <select id="district" name="district" class="form-select <?= !empty($errors['district']) ? 'is-invalid' : '' ?>" required>
                  <option value="" disabled selected>Chọn Quận/Huyện</option>
                  <!-- JS sẽ load district -->
                </select>
                <div class="invalid-feedback"><?= $errors['district'] ?? 'Vui lòng chọn Quận/Huyện.' ?></div>
              </div>

              <div class="mb-3">
                <label for="address" class="form-label">Số nhà, tên đường... <span class="text-danger">*</span></label>
                <input type="text" id="address" name="address" class="form-control <?= !empty($errors['address']) ? 'is-invalid' : '' ?>"
                  placeholder="Nhập địa chỉ chi tiết" value="<?= htmlspecialchars($oldInput['address'] ?? '') ?>" required>
                <div class="invalid-feedback"><?= $errors['address'] ?? 'Vui lòng nhập địa chỉ.' ?></div>
              </div>

            </div>
          </div>
          <!-- /step -->
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="step middle payments">
            <h3>2. Thanh toán và Vận chuyển</h3>
            <ul>
              <!-- <li>
              <label class="container_radio">Credit Card<a href="#0" class="info" data-bs-toggle="modal"
                  data-bs-target="#payments_method"></a>
                <input type="radio" name="payment" checked>
                <span class="checkmark"></span>
              </label>
            </li>
            <li>
              <label class="container_radio">Paypal<a href="#0" class="info" data-bs-toggle="modal"
                  data-bs-target="#payments_method"></a>
                <input type="radio" name="payment">
                <span class="checkmark"></span>
              </label>
            </li> -->
              <li>
                <label class="container_radio">Thanh toán khi nhận hàng (COD)<a href="#0" class="info"
                    data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                  <input type="radio" name="payment_method" id="cod" value="cod" <?= (empty($oldInput['payment_method']) || $oldInput['payment_method'] === 'cod') ? 'checked' : '' ?>>
                  <span class="checkmark"></span>
                </label>
              </li>
              <!-- <li>
              <label class="container_radio">Bank Transfer<a href="#0" class="info" data-bs-toggle="modal"
                  data-bs-target="#payments_method"></a>
                <input type="radio" name="payment">
                <span class="checkmark"></span>
              </label>
            </li> -->
            </ul>
            <!-- <div class="payment_info d-none d-sm-block">
            <figure><img src="img/cards_all.svg" alt=""></figure>
            <p>Sensibus reformidans interpretaris sit ne, nec errem nostrum et, te nec meliore philosophia. At vix
              quidam periculis. Solet tritani ad pri, no iisque definitiones sea.</p>
          </div> -->

            <h6 class="pb-2">Phương thức vận chuyển</h6>


            <ul>
              <li>
                <label class="container_radio">Standard shipping<a href="#0" class="info" data-bs-toggle="modal"
                    data-bs-target="#payments_method"></a>
                  <input type="radio" name="shipping" checked>
                  <span class="checkmark"></span>
                </label>
              </li>
              <li>
                <label class="container_radio">Express shipping<a href="#0" class="info" data-bs-toggle="modal"
                    data-bs-target="#payments_method"></a>
                  <input type="radio" name="shipping">
                  <span class="checkmark"></span>
                </label>
              </li>

              <!-- Cột phải: Thông tin đơn hàng + thanh toán -->
              <!-- <div class="col-md-6">
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
                            <td class="text-start"><?= htmlspecialchars($item['name']) ?> × <?= intval($item['quantity']) ?>
                            </td>
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
                        <th class="text-start">Tạm tính</th>
                        <td class="text-center"><?= number_format($total, 0, ',', '.') ?> ₫</td>
                      </tr>
                      <tr>
                        <th class="text-start">Phí vận chuyển</th>
                        <td class="text-center">30.000 ₫</td>
                      </tr>
                      <tr>
                        <th class="text-start">Tổng</th>
                        <td class="text-center"><strong><?= number_format($total + 30000, 0, ',', '.') ?> ₫</strong>
                        </td>
                      </tr>
                    </tfoot>


                  </table>
                </div> -->
            </ul>
        </section>

        <!-- Thanh toán & Vận chuyển -->
       

        <!-- Tóm tắt đơn hàng -->
        <section class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">3. Tóm tắt đơn hàng</h5>
            </div>
            <div class="card-body">
              <ul class="list-group mb-3">
                <?php if (!empty($items) && is_array($items)):
                  foreach ($items as $item):
                    $subtotal = $item['price'] * $item['quantity'];
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span><strong><?= intval($item['quantity']) ?>x</strong> <?= htmlspecialchars($item['name']) ?></span>
                  <span><?= number_format($subtotal, 0, ',', '.') ?> ₫</span>
                </li>
                <?php endforeach; else: ?>
                <li class="list-group-item text-center">Giỏ hàng trống</li>
                <?php endif; ?>
              </ul>

              <div class="d-flex justify-content-between fs-5 fw-bold">
                <span>Tổng cộng</span>
                <span><?= number_format($total + 30000, 0, ',', '.') ?> ₫</span>
              </div>
            </div>
          </div>
        </section>

      </div>

      <div class="row justify-content-center mt-4">
        <div class="col-md-4 d-grid">
          <button type="submit" class="btn btn-primary btn-lg">Đặt hàng</button>
        </div>
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

  // Bootstrap 5 form validation
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
